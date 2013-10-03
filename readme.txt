=== Individual Multisite Author ===
Contributors: webzunft
Donate link: http://webgilde.com/
Tags: multisite, author, author description, author bio, bio, biography
Requires at least: 3.6
Tested up to: 3.6.1
Stable tag: 1.0.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This plugin enables individual author descriptions for each single blog in a multisite network.

== Description ==

When running [WordPress Multisites](http://codex.wordpress.org/Create_A_Network) to maintain various top level domains or a multilingual version of your site you might probably run into the problem of having the same author description / biography on each of them.

This is unfortunate not only on multilingual sites.

Long story short, this plugin enables you to enter the author biography for each user on a per blog basis.

You don’t have to do anything, but to install and activate the plugin and to enter the author bio into the new field.

Please visit the github repository on https://github.com/webzunft/multisite-individual-author if you want to contribute, post a specific feature request or bug report.

**Some things site admins and developers might want to know:**

* the plugin only works when multisite support is enabled, but wouldn’t harm a normal blog when activated (is just not doing anything there)
* the biography is saved using a custom profile field for each blog with the pattern 'ima_description_BLOGID', e.g. _img_description_3_
* the filter get_the_author_description is used to load the "right" description; this is used by the`_author_meta()` and `get_the_author_meta()` functions


== Installation ==

1. Upload the folder `individual-multisite-author` to the `/wp-content/plugins/` directory
1. Activate the IMA through the 'Plugins' menu in WordPress

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==

= 1.0.1 =
* updated files, to fix showing the plugin on wordpress.org

= 1.0 =
* initializing the plugin