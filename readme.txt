=== Remove CapsLock ===
Contributors: codekraft
Tags: uppercase, lowercase, text, capslock
Requires at least: 3.0
Requires PHP: 5.6
Stable tag: 0.0.2
Tested up to: 5.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

REMOVE UPPERCASE TEXT FROM TITLE CONTENT AND COMMENTS.

== Description ==
Remove uppercase text from title content and comments.
You can customize the minimum amount of consecutive characters for each type of content (title, content, comments) before trigger the cleaning function on that string.

== SETUP ==
You can customize the plugin options adding to functions.php the needed filter, there are two kind of filters you can set:

The first is to set your own set of hook+rule:
`
function my_custom_rules() {
add_filter( 'rcl_hook_filters', function () { return array(
    // there are two ways to set the content filter. check the docs
    array( 'hook' => 'the_title', 'allowed_chars' => 6 ), // title
    array( 'hook' => 'comment_text', 'allowed_chars' => 5 ), // comments
    array( 'hook' => 'widget_title', 'allowed_chars' => 6 ), // widget
); } );
}
add_action( 'init', 'my_custom_rules' );
`

the second one allows to edit a single filter value (anyway it doesn't create any other filter).
To disable the filter (while continue to use the rest of the standard set) you need to set "-1" as value
`
add_filter( 'rcl_the_title', function () { return 60; } )
add_filter( 'rcl_comment_text', function () { return 3; } );
add_filter( 'rcl_widget_title', function () { return -1; } ); // disabled
`

One last note, since the main post/page content has a different content type (isn't a string) you need to set the filter indipendently as below (-1 means disabled)
`
add_filter( 'rcl_the_content', function () { return 10; } )
`



= 0.0.2 =
* add filters to provide some plugin customizations

= 0.0.1 =
* so just for a joke I made this plugin but it might be useful for you to make fun of it too

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
