<?php
defined( 'ABSPATH' ) or die( "Nothing to see!" );
/**
 * Plugin Name: Optimize feed for Feedly
 * Description: Optimize feed for Feedly
 * Version: 1.0
 * Author: Florian Brinkmann
 * Author URI: http://florianbrinkmann.de
 */

function offf_add_featured_imgage( $content ) {
    global $post;
    if ( has_post_thumbnail( $post->ID ) ) {
        $post_thumbnail_url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
        $post_thumbnail = "<figure><img src='$post_thumbnail_url' class='webfeedsFeaturedVisual'></figure>";
        $content = $post_thumbnail . $content;
    }

    return $content;
}
add_filter( 'the_content_feed', 'offf_add_featured_imgage' );
add_filter( 'the_excerpt_rss', 'offf_add_featured_imgage' );

function offf_add_namespace() {
    echo 'xmlns:webfeeds="http://webfeeds.org/rss/1.0"';
}
add_action( 'rss2_ns', 'offf_add_namespace' );

function offf_add_header_information() {
    echo '<webfeeds:cover image="http://florianbrinkmann.de/florian-brinkmann-feedly-cover-image.png" />
<webfeeds:icon>http://florianbrinkmann.de/florian-brinkmann-icon.svg</webfeeds:icon>
<webfeeds:logo>http://florianbrinkmann.de/florian-brinkmann-logo.svg</webfeeds:logo>
<webfeeds:accentColor>#FF7800</webfeeds:accentColor>';
}
add_action( 'rss2_head', 'offf_add_header_information' );
