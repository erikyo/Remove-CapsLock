=== Remove CapsLock ===
Contributors: codekraft
Tags: uppercase, lowercase, text, capslock
Requires at least: 3.0
Requires PHP: 5.6
Stable tag: 0.1.0
Tested up to: 5.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

NORMALIZE ICKY UPPERCASE TEXT IN TITLES, CONTENT AND COMMENTS (without any change to your database).

== Description ==
This plugin automatically filters titles, content and comments, searching and normalizing uppercase text.
You can customize the minimum amount of consecutive characters for each type of content (title, content, comments) before trigger the normalization function on that string.
This plugin is intended to change on-the-fly what is displayed without affecting what is stored in the wordpress database! If you want to change permanently the website content/titles you need to modify posts.
Please before install, be sure there isn't any CSS rule that force uppercase otherwise the font case will be css driven and this plugin consequently useless. Check the troubleshooting section for guidance on this if the plugin seems not to work.

== Setup ==
After installation, the plugin automatically displays normalised texts. So the title, post content, widget titles and comments will be filtered and normalised by default.
You can customize/add/remove filters adding to functions.php the name of the hook and the number of allowed consecutive uppercase characters.

1) To **create your own set** of hook+rule
`
add_action( 'init', function() {
    add_filter( 'rcl_hook_filters', function () { return array(
        array( 'hook' => 'the_title', 'allowed_chars' => 6 ), // title
        array( 'hook' => 'comment_text', 'allowed_chars' => 5 ), // comments
        array( 'hook' => 'widget_title', 'allowed_chars' => 6 ), // widget
        );
    } );
} );
`

2) To **edit a single filter** value (it doesn't create any new filter, only change an already created one). In order to disable a filter, while continue to use the rest of the standard set, you need to set "-1" as value (example below).
`
add_filter( 'rcl_the_title', function () { return 60; } );
add_filter( 'rcl_comment_text', function () { return 3; } );
add_filter( 'rcl_widget_title', function () { return -1; } ); // disabled
`

One last note, since the main post/page content has a different content type (isn't a string) **you need to set the filter for the post content as below**.
`
add_filter( 'rcl_the_content', function () { return 10; } );
// OR to disable the content filter
// add_filter( 'rcl_the_content', function () { return -1; } );
`

If you need to change the default setup and enable uppercase text correction ONLY for comments, you need to add to functions.php the filter as below:
`
// functions.php
add_filter( 'rcl_the_content', function () { return -1; } ); // disabled
add_action( 'init', function() {
    add_filter( 'rcl_hook_filters', function () { return array(
        array( 'hook' => 'comment_text', 'allowed_chars' => 5 ), // 2 or more uppercase digits triggers the text normalization
        );
    } );
} );
`

== Troubleshooting ==

This plugin is not intended to change the css style of your website, because you can do this easily with customizer and without any plugin.
So before installing this plugin I suggest you try to reset the style of the title/content/widget, using the property `text-transform: inherit !important;`


== Changelog ==

= 0.1.0 =
* add filters to provide some plugin customizations

= 0.0.1 =
* just for a joke I made this plugin but it might be useful to you too

== Screenshot ==
1. the plugin options (1/3)
2. the plugin options (2/3)
3. the plugin options (3/3)

== copyright ==
Remove CapsLock, Copyright 2021 Codekraft Studio
Remove CapsLock is distributed under the terms of the GNU GPL

This program is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
See the LICENSE file for more details.
