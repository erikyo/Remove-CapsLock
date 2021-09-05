=== Remove CapsLock ===
Contributors: codekraft
Tags: uppercase, lowercase, text, capslock
Requires at least: 3.0
Requires PHP: 5.6
Stable tag: 0.0.1
Tested up to: 5.8
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Remove uppercase text from title content and comments.

== Description ==
Remove uppercase text from title content and comments.
You can customize the minimum amount of consecutive characters for each type of content (title, content, comments) before trigger the cleaning function on that string.

== SETUP ==
Enable the plugin.
Eventually, if you don't like the settings I've made, you can change them adding to functions.php the needed filter

add_filter( 'rcl_title_precision', function () {return 6;} );
add_filter( 'rcl_comment_precision', function () {return 5;} );
add_filter( 'rcl_text_precision', function () {return 10;} );

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
