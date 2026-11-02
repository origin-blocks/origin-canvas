# Getting Started

Canvas installs from a ZIP file like any WordPress theme, and from then on you work in the Site Editor. Canvas 1.4.3 needs WordPress 7.0 or later and PHP 7.4 or later, and is tested up to WordPress 7.1.

## Install Origin Canvas

In your WordPress dashboard, go to **Appearance > Themes > Add New > Upload Theme**.

Click **Choose File**, select the Canvas ZIP file, then click **Install Now**.

## Activate the Theme

After WordPress finishes installing the theme, click **Activate**.

Canvas becomes the active theme for your site, and its templates, patterns, styles and block styles become available in the editor.

## Open the Site Editor

Go to **Appearance > Editor**.

The Site Editor is where you edit templates, template parts, styles and site-wide design settings for a block theme.

## Choose a Starting Point

Start from a page pattern. Canvas ships seven: Home: Logos and Cards, Home: Editorial Cover, About: Small on Purpose, Services: A Brand and a Site, Pricing: Plans and FAQ, Contact: Write to the Studio and Landing Page. Each is built from the theme's section patterns, so you can swap any section for another from the same category.

Insert a page pattern into a new page, and set the page's template to **Page (Full Width, No Title)** so the pattern's own hero opens the page. The page patterns carry the demo content of a four-person studio in Nashville. Replace the sample text, links and images with your own.

## Updating from 1.3.1

Canvas 1.4.0 renamed the theme's colors by tone. Base to Base 7 are the light colors, from the white page background to the darkest light gray, and Contrast to Contrast 5 are the dark colors, from the heading color to the lightest dark gray. Primary keeps its name. The old names map as follows:

- Surface Base is now Base
- Surface Muted and On Dark are now Base 2
- Surface Subtle is now Base 3
- Surface Subtle Hover is now Base 4
- Border is now Base 5
- Input Border is now Base 6
- Text Heading is now Contrast
- Text Body is now Contrast 2
- Text Muted is now Contrast 3
- Base 7, Contrast 4 and Contrast 5 are new

The Compact spacing size is now Small Medium. Block styles changed too: the List block's Check and Check Circle are now Check Primary and Check Circle Primary, with Check Neutral and Check Circle Neutral beside them; the Navigation block's Hover Accent is now Hover Primary; and the Button block's Outline Strong has left the Styles picker, so a button saved with it renders as Outline.

A site updated in place keeps rendering the same. The theme loads compatibility styles for the old names on the front end, in the Block Editor and in the Site Editor, and saved content keeps the old names. Five cases render differently, and the [Upgrading from 1.3.1 section of the readme](https://github.com/origin-blocks/origin-canvas/blob/1.4.3/readme.txt) lists them with the known limits. A tool that moves saved content to the new names is available on request from [support](support.md).

Card images inserted under Canvas 1.0.x display again in 1.4.3. Those versions kept the card images in a folder that 1.1.0 moved, and the theme now points the saved addresses at the new folder for Image and Cover blocks until 2.0.0.

## Next Steps

- Learn how [the Site Editor](site-editor.md) handles styles, templates, template parts and saved changes.
- Choose a visual direction with [style variations](style-variations.md).
- Use [patterns and templates](patterns-and-templates.md) to build pages and site structure.
- Visit [Support](support.md) if you need help.

[Docs Home](index.md)
