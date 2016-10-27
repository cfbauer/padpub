=== WP-SCSS ===
Contributors: connectthink
Tags: sass, scss, css
Plugin URI: https://github.com/ConnectThink/WP-SCSS
Requires at least: 3.0.1
Tested up to: 4.3
Stable tag: 1.1.9
License: GPLv3 or later
License URI: http://www.gnu.org/copyleft/gpl.html

Compiles .scss files to .css and enqueues them.

== Description ==

Compiles .scss files on your wordpress install using [lefo's scssphp](https://github.com/leafo/scssphp). Includes settings page for configuring directories, error reporting, compiling options, and auto enqueuing.

The plugin only compiles when changes have been made to the scss files. Compiles are made to the matching css file, so disabling this plugin will not take down your stylesheets. In the instance where a matching css file does not exist yet, the plugin will create the appropriate css file in the css directory.

[Get detailed instructions on github](https://github.com/ConnectThink/WP-SCSS)

== Installation ==

1. Upload plugin to plugins directory
2. Active plugin through the 'Plugins' menu in Wordpress
3. Configure plugin options through settings page `settings -> WP-SCSS`.

== Frequently Asked Questions ==

= Can I use a child theme? =

Yes, absolutely. Make sure you define your directories relative to your child theme and that your child theme is active. Otherwise you'll see an error regarding missing directories.

= How do I @import subfiles =

You can import other scss files into parent files and compile them into a single css file. To do this, use @import as normal in your scss file. All imported file names *must* start with an underscore. Otherwise they will be compiled into their own css file.

When importing in your scss file, you can leave off the underscore.

> `@import 'subfile';`


= Does this plugin support Compass? =
Currently there isn't a way to fully support [compass](https://github.com/chriseppstein/compass) with a php compiler. If you want limited support, you can manually import the compass framework. You'll need both the _compass.scss and compass directory.


> `compass / frameworks / compass / stylesheets /

> `@import 'compass';`


Alternatively, you can include [Bourbon](https://github.com/thoughtbot/bourbon) in a similar fashion.

= Can I use .sass syntax with this Plugin? =
This plugin will only work with .scss format.

= It's not updating my css, what's happening? =
Do you have errors printing to the front end? If not, check your log file in your scss directory. The css will not be updated if there are errors in your sass file(s).

Make sure your directories are properly defined in the settings. Paths are defined from the root of the theme.

= I'm having other issues and need help =
If you are having issues with the plugin, create an issue on [github](https://github.com/ConnectThink/WP-SCSS), and we'll do our best to help.

== Changelog ==
= 1.1.9 =
* Added filter to set variables via PHP [@ohlle](https://github.com/ohlle)
* Added option to minify CSS output [@mndewitt](https://github.com/mndewitt)

= 1.1.8 =
Various improvements from pull requests by [@jbrains](https://github.com/jbrains) and [@brainfork](https://github.com/brainfork)

= 1.1.7 =
* Update scssphp to 0.0.12 - pull from #16 [@GabrielGil](https://github.com/GabrielGil)

= 1.1.6 =
* Upgraded scss.inc.php to version 0.0.10; via pull request from [kirkhoff](https://github.com/kirkhoff)

= 1.1.5 =
* Added option to only show errors to logged in users; via pull request from [tolnem](https://github.com/tolnem)

= 1.1.4 =
* Add suport for subfolders in scss directory

= 1.1.3 =
* Hotfix for a accidental character

= 1.1.2 =
* Added support for moved wp-content directories

= 1.1.1 =
* Added error handling for file permissions issues
* Changed error log to .log for auto updating errors

= 1.0.0 =
* Initial Build