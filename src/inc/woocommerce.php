<?php
// Agrega el campo de video en WooCommerce
function cf_stream_add_video_field() {
    woocommerce_wp_text_input(array(
        'id'          => '_cf_stream_video_id',
        'label'       => __('Cloudflare Video ID', 'woocommerce'),
        'desc_tip'    => true,
        'description' => __('Ingresa la ID del video de Cloudflare Stream.', 'woocommerce'),
    ));
}
add_action('woocommerce_product_options_general_product_data', 'cf_stream_add_video_field');

// Guarda la ID del video
function cf_stream_save_video_field($post_id) {
    $video_id = isset($_POST['_cf_stream_video_id']) ? sanitize_text_field($_POST['_cf_stream_video_id']) : '';
    update_post_meta($post_id, '_cf_stream_video_id', $video_id);
}
add_action('woocommerce_process_product_meta', 'cf_stream_save_video_field');
