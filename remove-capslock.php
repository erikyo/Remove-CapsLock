<?php
/*
Plugin Name: Remove CapsLock
Description: Remove uppercase text from title content and comments.
Author: Erik
Version: 0.0.1
Author URI: https://codekraft.it/
*/

/**
 * if the first X characters are uppercase it returns the normalised text
 *
 * @param $string string - the string to parse
 * @param $regex - the regex used to match the uppercase text
 *
 * @return string - the clean text
 */
function rcl_denoise( $string, $regex ) {
    return preg_replace_callback(
        $regex,
        function ( $m ) { return ucfirst( strtolower( $m[1] ) ); },
        $string
    );
}

function rcl_filters() {
    $rcl_available_filters = apply_filters( 'rcl_hook_filters' , array(
        // there are two ways to set the content filter. check the docs
        array( 'hook' => 'the_title', 'allowed_chars' => 6 ), // Return the title into a clean format
        array( 'hook' => 'comment_text', 'allowed_chars' => 5 ), // Returning comments in a way that ensures a democratic conversation
        array( 'hook' => 'widget_title', 'allowed_chars' => 6 ), // Return the widget normalized title
    ) );

    foreach ( $rcl_available_filters as $filter ) {

        // get the needed precision for uppercase replace regex (-1 means no replace)
        $text_precision = apply_filters( 'rcl_'. $filter['hook'] , $filter['allowed_chars']  ) ;
        if ( $text_precision < 0 ) return;

        // add the filter with the chosen options
        add_filter( $filter['hook'], function ( $content ) use ( $text_precision ) {
            return rcl_denoise( $content, '/([A-Z\ ,-]{' . $text_precision . ',})/' );
        } );
    }

    // Return the content into human readable format
    add_filter( 'the_content', function ( $content ) {
        $text_precision = intval(apply_filters( 'rcl_the_content', 10 ));
        if ($text_precision < 0) return $content;

        return is_main_query() ? rcl_denoise( $content, '/(?<=>| )([A-Z\ ,-]{' . intval($text_precision) . ',})/' ) : $content;
    } );
}
add_action( 'init', 'rcl_filters', 99 );

?>