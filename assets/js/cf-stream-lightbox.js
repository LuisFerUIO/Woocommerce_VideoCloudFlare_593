jQuery(document).ready(function($) {
    $('.woocommerce-product-gallery').on('click', '.woocommerce-product-gallery__image img', function(event) {
        var imgSrc = $(this).attr('src');
        if (imgSrc.includes('videodelivery.net')) {
            event.preventDefault();
            var videoId = imgSrc.split('/')[3]; // Extrae el ID del video desde la URL
            var videoUrl = 'https://customer-id.cloudflarestream.com/' + videoId;
            $('#cf-stream-video-frame').attr('src', videoUrl);
            $('#cf-stream-video-modal').fadeIn();
        }
    });

    $('.cf-stream-close').on('click', function() {
        $('#cf-stream-video-modal').fadeOut();
        $('#cf-stream-video-frame').attr('src', '');
    });

    $(document).on('click', function(event) {
        if ($(event.target).is('#cf-stream-video-modal')) {
            $('#cf-stream-video-modal').fadeOut();
            $('#cf-stream-video-frame').attr('src', '');
        }
    });
});
