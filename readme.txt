=== Individual Multisite Author ===
Contributors: webzunft
Donate link: http://webgilde.com/
Tags: multisite, author, author description, author bio, bio, biography
Requires at least: 4.0
Tested up to: 4.3
Stable tag: 1.2.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables individual author descriptions for each single blog in a multisite network.

== Description ==

When running [WordPress Multisites](http://codex.wordpress.org/Create_A_Network) to maintain various top level domains or a multilingual version of your site you might probably run into the problem of having the same author description / biography on each of them.

This is unfortunate not only on multilingual sites.

Long story short, this plugin enables you to enter the author biography for each user on a per blog basis.

You don’t have to do anything, but to install and activate the plugin and to enter the author bio into through the dashboard(s) of your site(s).

Please visit the github repository on https://github.com/webzunft/multisite-individual-author if you want to contribute, post a specific feature request or bug report.

**Some things site admins and developers might want to know:**

* the plugin only works when multisite support is enabled, but wouldn’t harm a normal blog when activated (is just not doing anything there)
* the biography is saved using a custom profile field for each blog with the pattern 'ima_description_BLOGID', e.g. _img_description_3_
* the filter get_the_author_description is used to load the "right" description; this is used by the`_author_meta()` and `get_the_author_meta()` functions


== Installation ==

1. Upload the folder `individual-multisite-author` to the `/wp-content/plugins/` directory
1. Activate the IMA through the 'Plugins' menu in WordPress

You will now see an additional field for the author description when you visit the author profile.
This field is individual for each blog, so make sure you first login to the right dashboard when changing the authors bio for a specific site in your multisite environment.

== Changelog ==

= 1.2.3 =

* adjust coding to wordpress (extra) standard
* fix deprecation notice for WP 3.0+ (update_usermeta)
* minor code 'optimisation'

= 1.2.2 =

* fixing a bug that prevented the plugin from being loaded completely

= 1.2.1 =

* html tags are now allowed in the bio

= 1.2.0 =

* added textdomain
* added German translation to test textdomain

= 1.1.0 =

(confused commit, please ignore)

= 1.0.2 =
* input field for individual description is now bigger
* added short description for the plugin
* use default description if no site specific description is provided.

= 1.0.1 =
* updated files, to fix showing the plugin on wordpress.org

= 1.0 =
* initializing the plugin

== Upgrade Notice ==

= 1.1 =
Use default description if no site specific description is provided.