=== FX random image ===
Contributors: aivarasfx
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=U4ABQ5TFC8UHQ
Tags: random, images
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.0.1

Plugin displays random image from attached images to page or post.

== Description ==

Plugin creates widget that displays one random image from current page or post attached images, or from any page or post set by ID. You can set size of image to display.

Displays a random image from post or page you specify. Plugin creates FX-Random-image widget. Use widget to add image to sidebar or add <code>&lt;?php FX_Random_Image($pageID, $link, $size); ?&gt;</code> function to theme. $pageID is page/post ID from there to take images, if $link = true adds link to image, $link = false no link on image, $size - image size ('thumbnail', 'medium' or 'large'). Example <code>&lt;?php FX_Random_Image(1, false, 'large'); ?&gt;</code>

== Installation ==

1. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Use Widget to add image to widget area or place `<?php FX_random_image(); ?>` code in your templates

== Frequently Asked Questions ==

= How to use it? =

Use Widget to add to sidebar and set pageID in widget.


Or place `<?php FX_random_image($pageID, $link, $size); ?>` code in your templates

$pageID -  page/post ID from there to take images
$link - if $link = true adds link to image, $link = false no link on image 
$size - image size ('thumbnail', 'medium' or 'large')

Example <code>&lt;?php FX_Random_Image(1, false, 'large'); ?&gt;</code>

== Screenshots ==


== Changelog ==

= 1.0.1 =
* Fixed some description.

= 1.0.0 =
* New versions started.

== Upgrade Notice ==

*


