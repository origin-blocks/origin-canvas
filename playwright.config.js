const { defineConfig, devices } = require( '@playwright/test' );

/**
 * The suite drives assets/js/anchor-navigation.js in Chromium against fixture pages
 * that tests/fixture.js builds and serves from memory, so there is no web server and
 * no WordPress to start. Run `npx playwright install chromium` once per machine.
 */
module.exports = defineConfig( {
	testDir: 'tests',
	forbidOnly: !! process.env.CI,
	retries: 0,
	reporter: 'list',
	projects: [
		{
			name: 'chromium',
			use: { ...devices[ 'Desktop Chrome' ] },
		},
	],
} );
