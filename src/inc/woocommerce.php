<?php
// Agregar el video a la galería de imágenes del producto en WooCommerce
function cf_stream_add_video_to_gallery($attachment_ids, $product) {
    $video_id = get_post_meta($product->get_id(), '_cf_stream_video_id', true);

    if ($video_id) {
        // Generar una imagen de miniatura del video (asumimos que Cloudflare tiene un endpoint para esto)
        $thumbnail_url = "https://videodelivery.net/{$video_id}/thumbnails/thumbnail.jpg";

        // Crear un array simulando un attachment de imagen
        $video_attachment = [
            'id' => "cf_video_{$video_id}",
            'src' => $thumbnail_url,
            'full_src' => $thumbnail_url,
            'thumbnail' => $thumbnail_url,
            'srcset' => '',
            'sizes' => '',
        ];

        // Agregar el video a la galería
        array_unshift($attachment_ids, $video_attachment);
    }

    return $attachment_ids;
}
add_filter('woocommerce_product_get_gallery_image_ids', 'cf_stream_add_video_to_gallery', 10, 2);

// Agregar script para abrir el video en un modal al hacer clic
function cf_stream_enqueue_scripts() {
    wp_enqueue_script('cf-stream-video-lightbox', plugin_dir_url(__FILE__) . 'js/cf-stream-lightbox.js', ['jquery'], null, true);
    wp_enqueue_style('cf-stream-video-lightbox', plugin_dir_url(__FILE__) . 'css/cf-stream-lightbox.css');
}
add_action('wp_enqueue_scripts', 'cf_stream_enqueue_scripts');

// Agregar el modal HTML al pie de la página
function cf_stream_add_video_modal() {
    echo '<div id="cf-stream-video-modal" class="cf-stream-modal">
            <div class="cf-stream-modal-content">
                <span class="cf-stream-close">&times;</span>
                <iframe id="cf-stream-video-frame" src="" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
            </div>
          </div>';
}
add_action('wp_footer', 'cf_stream_add_video_modal');
