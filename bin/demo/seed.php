<?php
/**
 * Seed the local demo site. Run by bin/demo/reset.sh on an emptied site:
 *   wp eval-file bin/demo/seed.php
 *
 * Builds the pages from the active theme's page patterns, a blog with posts, comments and
 * featured images, the primary menu and the private design system page. Page content is a
 * pattern reference, so a page always renders the active theme's current version of its pattern.
 */

if ( ! defined( 'WP_CLI' ) ) {
	return;
}

require_once ABSPATH . 'wp-admin/includes/file.php';
require_once ABSPATH . 'wp-admin/includes/media.php';
require_once ABSPATH . 'wp-admin/includes/image.php';

/* Site settings. */

update_option( 'blogname', 'Origin' );
update_option( 'blogdescription', 'A small studio for brand and web work.' );
update_option( 'timezone_string', 'America/New_York' );
update_option( 'default_ping_status', 'closed' );
update_option( 'default_pingback_flag', 0 );
update_option( 'thread_comments', 1 );
update_option( 'page_comments', 0 );
update_option( 'posts_per_page', 10 );

/* Helpers. */

function oc_demo_p( $text ) {
	return "<!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph -->";
}

function oc_demo_h( $text, $level = 2 ) {
	$attrs = 2 === $level ? '' : ' {"level":' . $level . '}';
	return "<!-- wp:heading$attrs -->\n<h$level class=\"wp-block-heading\">$text</h$level>\n<!-- /wp:heading -->";
}

function oc_demo_list( $items, $ordered = false ) {
	$tag   = $ordered ? 'ol' : 'ul';
	$attrs = $ordered ? ' {"ordered":true}' : '';
	$lis   = array_map( static fn( $item ) => "<!-- wp:list-item -->\n<li>$item</li>\n<!-- /wp:list-item -->", $items );
	return "<!-- wp:list$attrs -->\n<$tag class=\"wp-block-list\">" . implode( "\n", $lis ) . "</$tag>\n<!-- /wp:list -->";
}

function oc_demo_quote( $text, $cite ) {
	return "<!-- wp:quote -->\n<blockquote class=\"wp-block-quote\"><!-- wp:paragraph -->\n<p>$text</p>\n<!-- /wp:paragraph --><cite>$cite</cite></blockquote>\n<!-- /wp:quote -->";
}

function oc_demo_image( $id, $caption = '' ) {
	$url  = wp_get_attachment_image_url( $id, 'large' );
	$alt  = esc_attr( get_post_meta( $id, '_wp_attachment_image_alt', true ) );
	$cap  = $caption ? "<figcaption class=\"wp-element-caption\">$caption</figcaption>" : '';
	return "<!-- wp:image {\"id\":$id,\"sizeSlug\":\"large\",\"linkDestination\":\"none\"} -->\n<figure class=\"wp-block-image size-large\"><img src=\"$url\" alt=\"$alt\" class=\"wp-image-$id\"/>$cap</figure>\n<!-- /wp:image -->";
}

function oc_demo_code( $code ) {
	return "<!-- wp:code -->\n<pre class=\"wp-block-code\"><code>" . esc_html( $code ) . "</code></pre>\n<!-- /wp:code -->";
}

function oc_demo_import_image( $file, $alt ) {
	$path = get_template_directory() . '/patterns/images/' . $file;
	if ( ! is_readable( $path ) ) {
		WP_CLI::error( "Missing theme image: $path" );
	}
	$tmp = wp_tempnam( $file );
	copy( $path, $tmp );
	$id = media_handle_sideload( array( 'name' => $file, 'tmp_name' => $tmp ), 0, $alt );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $id->get_error_message() );
	}
	update_post_meta( $id, '_wp_attachment_image_alt', $alt );
	return $id;
}

function oc_demo_insert( $args ) {
	$id = wp_insert_post( wp_slash( $args ), true );
	if ( is_wp_error( $id ) ) {
		WP_CLI::error( $id->get_error_message() );
	}
	return $id;
}

/* Authors: the studio. Users survive a reset, so reuse them. */

$authors = array();
foreach ( array(
	'claire' => array( 'Claire Bennett', 'Co-founder. Claire started the studio in 2018 and runs every first call.' ),
	'marcus' => array( 'Marcus Holloway', 'Co-founder and Designer. Marcus draws the marks and builds the sites.' ),
	'hannah' => array( 'Hannah Wright', 'Brand Strategist. Hannah writes the words and asks the questions.' ),
) as $login => $person ) {
	$user  = get_user_by( 'login', $login );
	$names = explode( ' ', $person[0] );
	$data  = array(
		'user_login'   => $login,
		'user_email'   => "$login@example.test",
		'display_name' => $person[0],
		'first_name'   => $names[0],
		'last_name'    => $names[1],
		'description'  => $person[1],
		'role'         => 'author',
	);
	if ( $user ) {
		$data['ID'] = $user->ID;
		wp_update_user( $data );
		$authors[ $login ] = $user->ID;
	} else {
		$data['user_pass'] = wp_generate_password( 32 );
		$authors[ $login ] = wp_insert_user( $data );
	}
}

/* Images from the theme. */

$img = array();
foreach ( array(
	'wireframe' => array( 'studio-wireframe-review.webp', 'Printed wireframes laid out on a table for review' ),
	'type'      => array( 'studio-type-proofs.webp', 'Type proofs pinned up for comparison' ),
	'review'    => array( 'studio-review.webp', 'Two designers reviewing work at a shared desk' ),
	'worktable' => array( 'studio-worktable.webp', 'A studio worktable with sketches and a laptop' ),
	'workshop'  => array( 'hero-cover-thistle-pine.webp', 'A woodworking shop with tools on the wall' ),
	'meeting'   => array( 'gallery-meeting-table.webp', 'A meeting table set up for a client call' ),
	'laptop'    => array( 'workspace-laptop.webp', 'A laptop open on a tidy desk' ),
	'paper'     => array( 'gallery-paper-stock.webp', 'Paper stock samples fanned out on a desk' ),
	'screen'    => array( 'gallery-screen-review.webp', 'A website reviewed on a large screen' ),
	'proofs'    => array( 'gallery-proof-wall.webp', 'A wall of printed page proofs' ),
	'layouts'   => array( 'studio-one-project.webp', 'Three printed page layouts marked up on a desk' ),
) as $key => $image ) {
	$img[ $key ] = oc_demo_import_image( $image[0], $image[1] );
}

/* Pages: Home, one page for every other page pattern, and Blog. */

$page_args = static fn( $title, $content, $order ) => array(
	'post_type'    => 'page',
	'post_status'  => 'publish',
	'post_title'   => $title,
	'post_content' => $content,
	'post_author'  => $authors['claire'],
	'menu_order'   => $order,
	'page_template' => 'page-no-title',
);

$pattern_ref = static fn( $slug ) => '<!-- wp:pattern {"slug":"' . $slug . '"} /-->';

$home = oc_demo_insert( $page_args( 'Home', $pattern_ref( 'origin-canvas/page-studio' ), 0 ) );

$page_patterns = array();
foreach ( WP_Block_Patterns_Registry::get_instance()->get_all_registered() as $pattern ) {
	if ( preg_match( '#^origin-canvas/page-#', $pattern['name'] ) && 'origin-canvas/page-studio' !== $pattern['name'] ) {
		$title                              = html_entity_decode( $pattern['title'], ENT_QUOTES, 'UTF-8' );
		$page_patterns[ $pattern['name'] ] = trim( preg_replace( '/^Page:\s*/i', '', $title ) );
	}
}
asort( $page_patterns );

$menu  = array( array( 'Home', $home ) );
$order = 1;
foreach ( $page_patterns as $slug => $title ) {
	$id     = oc_demo_insert( $page_args( $title, $pattern_ref( $slug ), $order++ ) );
	$menu[] = array( $title, $id );
}

$blog = oc_demo_insert(
	array(
		'post_type'   => 'page',
		'post_status' => 'publish',
		'post_title'  => 'Blog',
		'post_author' => $authors['claire'],
		'menu_order'  => $order,
	)
);
$menu[] = array( 'Blog', $blog );

update_option( 'show_on_front', 'page' );
update_option( 'page_on_front', $home );
update_option( 'page_for_posts', $blog );

/* Categories and tags. */

$cats = array();
foreach ( array(
	'brand'  => array( 'Brand identity', 'Marks, type, color and the things they get printed on.' ),
	'web'    => array( 'Websites', 'How we plan, write, build and launch sites for small businesses.' ),
	'studio' => array( 'Studio notes', 'How the studio runs, what we charge and what we ask.' ),
) as $key => $cat ) {
	$cats[ $key ] = wp_insert_term( $cat[0], 'category', array( 'description' => $cat[1] ) )['term_id'];
}

/* Posts. */

$long = implode(
	"\n\n",
	array(
		oc_demo_p( 'A standard project with us takes four weeks, from the first call to a site the client can edit on their own. Most clients ask what happens in those weeks before they sign, so here is the plan we send them, with the parts that tend to move.' ),
		oc_demo_h( 'Week one: questions and a site map' ),
		oc_demo_p( 'We start with a 90-minute call and a shared folder. By the end of the week the client has a one-page brief and a site map they have approved, and we have every login we need.' ),
		oc_demo_list(
			array(
				'A brief in the client&#8217;s own words, read back to them',
				'A site map with one line on the job of each page',
				'A list of the photos, logos and documents we still need',
			)
		),
		oc_demo_h( 'Week two: words first' ),
		oc_demo_p( 'Hannah writes the copy for every page before Marcus draws a single layout. Real words decide how long a heading runs and how much room a service needs, and they make the client&#8217;s review faster because there is something to read.' ),
		oc_demo_h( 'Week three: design and build' ),
		oc_demo_p( 'Design and build run together. We show the home page in the browser on the Tuesday, and the client reviews the rest on a phone and a laptop by Friday.' ),
		oc_demo_image( $img['layouts'], 'Page layouts, printed and marked up in the week-three review.' ),
		oc_demo_h( 'What we check before a review', 3 ),
		oc_demo_list(
			array(
				'Every page at phone width',
				'Every form, sent to a real inbox',
				'Headings in order, and alt text on every image',
				'Page weight under 1 MB on the home page',
			),
			true
		),
		oc_demo_quote( 'We had a site we could edit ourselves by the end of the month, and the booking form has not needed a change since.', 'Owen Parker, Clinic Director, Kestrel Physical Therapy' ),
		oc_demo_h( 'Week four: launch' ),
		oc_demo_p( 'Launch week is mostly checks. The step clients forget is the old site: links in emails, on business cards and in search results still point at its pages. We keep a redirect map from the first call and add it to the server the day before launch.' ),
		oc_demo_code( "# Old addresses to new pages, added the day before launch\nRedirect 301 /services.html /what-we-do/\nRedirect 301 /about-us.html /about/\nRedirect 301 /contact.php /contact/\nRedirect 301 /book-online /book/" ),
		oc_demo_p( 'After launch we hold a 30-minute handover call and send a short guide to editing the site. Thanks for reading. If you have questions about how a project runs, ask in the comments.' ),
	)
);

$posts = array(
	array(
		'title'   => 'How a four-week website project runs',
		'date'    => '2026-09-22 09:30:00',
		'author'  => 'claire',
		'cat'     => 'web',
		'tags'    => array( 'process', 'launch', 'client work' ),
		'image'   => 'wireframe',
		'excerpt' => 'The plan we send every client before they sign, week by week, with the parts that tend to move.',
		'content' => $long,
	),
	array(
		'title'   => 'Two typefaces for a law firm',
		'excerpt' => 'How we chose a serif and a sans for Ashby &amp; Rowe Law, and the test that settled it.',
		'date'    => '2026-09-08 10:00:00',
		'author'  => 'marcus',
		'cat'     => 'brand',
		'tags'    => array( 'type', 'client work' ),
		'image'   => 'type',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'Ashby &amp; Rowe Law asked for an identity that looked settled without looking old. We tested eleven pairings over two weeks and kept two faces: a serif for headings and letters, and a sans for forms and the website&#8217;s small text.' ),
				oc_demo_p( 'The deciding test was their own correspondence. We set three real client letters in each pairing and printed them on the firm&#8217;s paper, and the partners chose from the stack in under ten minutes.' ),
				oc_demo_image( $img['proofs'] ),
				oc_demo_p( 'Two faces covers everything the firm sends, from engagement letters to the sign on the door, and it keeps the license cost to one renewal a year.' ),
			)
		),
	),
	array(
		'title'   => 'We write the words before we draw the page',
		'excerpt' => 'Every layout we make starts from finished copy, and the reviews go faster for it.',
		'date'    => '2026-08-25 09:00:00',
		'author'  => 'hannah',
		'cat'     => 'studio',
		'tags'    => array( 'copywriting', 'process' ),
		'image'   => 'review',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'Every layout we make starts from finished copy. A heading that runs to two lines needs a different page from one that fits in four words, and we would rather know that before Marcus opens a design file.' ),
				oc_demo_p( 'Clients ask whether writing first slows the project down. It removes a round of revisions, because the review is about what the page says and the design only has to carry it.' ),
				oc_demo_p( 'We draft in a shared document, one page per tab, and the client comments in place. Once the words are approved, they move into the layout unchanged.' ),
			)
		),
	),
	array(
		'title'   => 'What a project with us costs, and why',
		'excerpt' => 'Our fixed prices for a website, an identity and both together, and what each one covers.',
		'date'    => '2026-08-11 11:00:00',
		'author'  => 'claire',
		'cat'     => 'studio',
		'tags'    => array( 'pricing', 'small business' ),
		'image'   => 'worktable',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'A standard website project with us is $6,000 one-off, and an identity on its own is $4,500. We quote a fixed price after the first call, and it covers the copy, the design, the build and a month of fixes after launch.' ),
				oc_demo_p( 'We take one project a month so the three of us can work on it together. That is the reason for the price and for the waiting list in the spring, when most businesses want a new site before summer.' ),
				oc_demo_list(
					array(
						'Website: $6,000, four weeks',
						'Identity: $4,500, three weeks',
						'Identity and website together: $9,500, six weeks',
					)
				),
				oc_demo_p( 'If a project needs more pages or a shop, we say so on the first call and price it before anyone signs.' ),
			)
		),
	),
	array(
		'title'   => 'Photographing a workshop without a photographer',
		'excerpt' => 'Forty portfolio images from one morning in a woodworking shop, with a phone and a tripod.',
		'date'    => '2026-07-28 09:30:00',
		'author'  => 'marcus',
		'cat'     => 'brand',
		'tags'    => array( 'photography', 'client work' ),
		'image'   => 'workshop',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'Thistle &amp; Pine Woodworks had no budget for a photographer, and their portfolio site needed forty images. We spent one morning in the shop with a phone, a tripod and the big garage door open.' ),
				oc_demo_list(
					array(
						'Shoot before 10 a.m., when the light comes in low and even',
						'Keep the same angle for every finished piece',
						'Photograph the tools in use, with the work in the frame',
					)
				),
				oc_demo_p( 'The finished pieces sit on the same bench in every shot, so the portfolio reads as one collection and new work can be added in the same way.' ),
			)
		),
	),
	array(
		'title'   => 'The six questions we ask on the first call',
		'excerpt' => 'The same six questions open every project, and the answers go into the brief word for word.',
		'date'    => '2026-07-14 10:30:00',
		'author'  => 'hannah',
		'cat'     => 'studio',
		'tags'    => array( 'process', 'small business' ),
		'image'   => 'meeting',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'The first call decides most of a project. We ask the same six questions every time and write the answers into the brief word for word.' ),
				oc_demo_list(
					array(
						'Who should call you after visiting the site?',
						'What do they ask on that call?',
						'Which page on your current site do people use most?',
						'What would you remove if you could?',
						'Who edits the site after launch?',
						'What date does the new site have to be live?',
					),
					true
				),
				oc_demo_p( 'The second question gives us the copy for the services page more often than any document a client sends.' ),
			)
		),
	),
	array(
		'title'   => 'A booking page patients finish',
		'excerpt' => 'A physical therapy clinic cut its booking form from fourteen fields to four.',
		'date'    => '2026-06-30 09:00:00',
		'author'  => 'marcus',
		'cat'     => 'web',
		'tags'    => array( 'launch', 'client work' ),
		'image'   => 'laptop',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'Kestrel Physical Therapy had a booking form with fourteen fields, and most visitors left before the end. The new page asks for four things: the visit type, a time, a name and a phone number.' ),
				oc_demo_p( 'Everything else moved to the first appointment, where the front desk was asking for it again anyway. The clinic now takes most of its bookings on a phone, outside office hours.' ),
			)
		),
	),
	array(
		'title'   => 'Colors that survive the office printer',
		'excerpt' => 'Before we sign off a palette, we print it on the client&#8217;s own office printer.',
		'date'    => '2026-06-16 11:30:00',
		'author'  => 'hannah',
		'cat'     => 'brand',
		'tags'    => array( 'color', 'print' ),
		'image'   => 'paper',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'A brand color looks one way on a monitor and another way on the laser printer in a small office. Before we sign off a palette, we print the letterhead, an invoice and a business card on the client&#8217;s own printer.' ),
				oc_demo_p( 'Clearwater Accounting&#8217;s first blue printed close to purple. We moved it two steps toward green, and it now reads the same on screen, on paper and on the sign outside.' ),
			)
		),
	),
	array(
		'title'   => 'Moving an old site without losing its visitors',
		'excerpt' => 'Old addresses live on in brochures and listings, so every one needs a page to land on.',
		'date'    => '2026-06-02 09:00:00',
		'author'  => 'claire',
		'cat'     => 'web',
		'tags'    => array( 'launch', 'small business' ),
		'image'   => 'screen',
		'content' => implode(
			"\n\n",
			array(
				oc_demo_p( 'An old site has visitors who arrive from places the owner has forgotten: a printed brochure, a directory listing, a link in a newsletter from 2019. When the new site goes live, every one of those addresses needs somewhere to land.' ),
				oc_demo_p( 'We export the old site&#8217;s pages in the first week and map each one to a page on the new site. Pages with no new home point to the closest match, and the map goes live with the launch.' ),
			)
		),
	),
);

$post_ids = array();
foreach ( $posts as $i => $post ) {
	$id = oc_demo_insert(
		array(
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'post_title'     => $post['title'],
			'post_content'   => $post['content'],
			'post_excerpt'   => $post['excerpt'] ?? '',
			'post_author'    => $authors[ $post['author'] ],
			'post_date'      => $post['date'],
			'post_category'  => array( $cats[ $post['cat'] ] ),
			'tags_input'     => $post['tags'],
			'comment_status' => 'open',
			'ping_status'    => 'closed',
		)
	);
	set_post_thumbnail( $id, $img[ $post['image'] ] );
	$post_ids[ $i ] = $id;
}

/* Comments: the studio team, with a reply and an author comment. */

$comment = static function ( $post, $login, $text, $date, $parent = 0 ) use ( $authors ) {
	$user = get_userdata( $authors[ $login ] );
	return wp_insert_comment(
		array(
			'comment_post_ID'      => $post,
			'comment_author'       => $user->display_name,
			'comment_author_email' => $user->user_email,
			'comment_content'      => $text,
			'comment_date'         => $date,
			'comment_date_gmt'     => get_gmt_from_date( $date ),
			'comment_approved'     => 1,
			'comment_parent'       => $parent,
			'user_id'              => $user->ID,
		)
	);
};

$c = $comment( $post_ids[0], 'marcus', 'The redirect map saves us every time. Starting it on the first call means nothing gets missed in launch week.', '2026-09-22 14:10:00' );
$comment( $post_ids[0], 'claire', 'Agreed. It is the one document nobody asks for and everyone needs on launch day.', '2026-09-22 15:02:00', $c );
$comment( $post_ids[0], 'hannah', 'The copy deadline in week two is the one most likely to move. We now book a working session with the client for it instead of waiting on a document.', '2026-09-23 09:40:00' );
$c = $comment( $post_ids[1], 'hannah', 'Setting their real letters was the turning point. Once the proofs looked like their own mail, the partners stopped comparing and started choosing.', '2026-09-08 16:20:00' );
$comment( $post_ids[1], 'marcus', 'That test goes first on the next identity project.', '2026-09-09 08:45:00', $c );
$comment( $post_ids[3], 'marcus', 'The spring waiting list surprised me in our first year. Now we start booking spring projects in January.', '2026-08-11 15:30:00' );

/* Primary menu. The header's Navigation block has no ref, so it shows the newest menu. */

$links = array();
foreach ( $menu as $item ) {
	$attrs   = array(
		'label' => $item[0],
		'type'  => 'page',
		'id'    => $item[1],
		'url'   => $item[1] === $home ? home_url( '/' ) : get_permalink( $item[1] ),
		'kind'  => 'post-type',
	);
	$links[] = '<!-- wp:navigation-link ' . wp_json_encode( $attrs, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE ) . ' /-->';
}
oc_demo_insert(
	array(
		'post_type'    => 'wp_navigation',
		'post_status'  => 'publish',
		'post_title'   => 'Primary',
		'post_content' => implode( "\n", $links ),
	)
);

WP_CLI::success( sprintf( 'Seeded %d pages, %d posts and the primary menu.', count( $menu ), count( $post_ids ) ) );

/* The private design system page, for administrators. Not in the menu. */

require __DIR__ . '/design-system/seed.php';
