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

// Agregar el video como una imagen en la galería de productos
function cf_stream_add_video_to_gallery($html, $attachment_id) {
    global $post;
    $video_id = get_post_meta($post->ID, '_cf_stream_video_id', true);

    if (!empty($video_id)) {
        $video_thumbnail = 'URL_DE_LA_IMAGEN_PREDETERMINADA_DEL_VIDEO'; // Reemplaza con una imagen representativa
        $video_url = 'https://customer-xd1ajhckvre3vwhu.cloudflarestream.com/' . esc_attr($video_id) . '/iframe';

        $html .= '<div class="woocommerce-product-gallery__image">';
        $html .= '<a href="' . esc_url($video_url) . '" class="woocommerce-product-video" target="_blank">';
        $html .= '<img src="' . esc_url($video_thumbnail) . '" alt="Video Preview">';
        $html .= '</a>';
        $html .= '</div>';
    }
    return $html;
}
add_filter('woocommerce_single_product_image_thumbnail_html', 'cf_stream_add_video_to_gallery', 10, 2);
