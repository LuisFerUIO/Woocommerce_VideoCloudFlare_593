<?php
// Mostrar el video en la página del producto
function cf_stream_show_video() {
    global $post;
    $video_id = get_post_meta($post->ID, '_cf_stream_video_id', true);

    if (!empty($video_id)) {
        echo '<div class="cf-stream-video-container">';
        echo '<iframe src="https://customer-xxxxx.cloudflarestream.com/' . esc_attr($video_id) . '/iframe" 
                width="100%" height="400" allow="autoplay; encrypted-media" frameborder="0">
              </iframe>';
        echo '</div>';
    }
}
add_action('woocommerce_single_product_summary', 'cf_stream_show_video', 20);
