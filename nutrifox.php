<?php
/**
 * Plugin Name:     Nutrifox
 * Plugin URI:      https://nutrifox.com/
 * Description:     Embed Nutrifox recipes in WordPress.
 * Author:          Pinch of Yum
 * Author URI:      http://pinchofyum.com/
 * Text Domain:     nutrifox
 * Domain Path:     /languages
 * Version:         0.1.0-alpha
 *
 * @package         Nutrifox
 */

/**
 * Register the Nutrifox shortcode
 */
function nutrifox_action_init() {
	add_shortcode( 'nutrifox', 'nutrifox_shortcode' );
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
	return ob_get_clean();
}
