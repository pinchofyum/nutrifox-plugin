<?php
/**
 * Plugin Name:     Nutrifox
 * Plugin URI:      https://nutrifox.com/
 * Description:     Embed Nutrifox recipes in WordPress in one moment or less.
 * Author:          Pinch of Yum
 * Author URI:      http://pinchofyum.com/
 * Text Domain:     nutrifox
 * Domain Path:     /languages
 * Version:         0.1.0-alpha
 *
 * @package         Nutrifox
 */

/**
 * Register the Nutrifox shortcode and oEmbed handler
 */
function nutrifox_action_init() {
	add_shortcode( 'nutrifox', 'nutrifox_shortcode' );
	wp_embed_register_handler( 'nutrifox', '#^https?://nutrifox\.com/embed/label/(?P<id>\d+)#', 'nutrifox_shortcode' );
}
add_action( 'init', 'nutrifox_action_init' );

/**
 * Render the Nutrifox shortcode
 *
 * @param array $attr Shortcode attributes.
 */
function nutrifox_shortcode( $attr ) {
	if ( empty( $attr['id'] ) ) {
		return '';
	}
	ob_start(); ?>
<div class="nutrifox-label" data-recipe-id="<?php echo (int) $attr['id']; ?>"></div>
<script async src="https://nutrifox.com/embed.js" charset="utf-8"></script>
	<?php
	return trim( ob_get_clean() );
}

/**
 * If Nutrifox is in the body content, load JS as early as possible
 */
function nutrifox_action_wp_head_early() {
	if ( ! is_singular()
		|| empty( get_queried_object()->post_content )
		|| false === strpos( get_queried_object()->post_content, 'nutrifox' ) ) {
		return;
	}
	?>
	<script async src="https://nutrifox.com/embed.js" charset="utf-8"></script>
	<?php
}
add_action( 'wp_head', 'nutrifox_action_wp_head_early', 1 );