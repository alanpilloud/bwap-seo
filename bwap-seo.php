<?php
/*
Plugin Name: BWAP Seo
Plugin URI: https://github.com/alanpilloud/bwap-seo
Description: Add opengraph, twittercard and automatic desc
Version: 0.1
*/

add_action('wp_head', function () {
    global $post;

    ?>
    <meta property="og:title" content="<?php the_title(); ?>"/>
    <meta name="twitter:title" content="><?php the_title() ?>"/>
    <meta property="og:url" content="<?php the_permalink(); ?>"/>
    <meta property="og:type" content="<?= is_singular('post') ? 'article' : 'page' ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:domain" content="<?php echo get_bloginfo(); ?>"/>
    <?php
    /**
    * Get image
    */
    if (has_post_thumbnail($post->ID)) {
        $img_src = reset(wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'large'));
        echo
        '<meta property="og:image" content="'.$img_src.'"/>',
        '<meta name="twitter:image:src" content="'.$img_src.'"/>';
    }

    /**
    * Get description
    */
    if ($excerpt = $post->post_content) {
        $excerpt = substr(strip_tags($excerpt),0,100);
        if (strlen($post->post_content) > 100) {
          $excerpt .= '[...]';
        }
    } else {
        $excerpt = get_bloginfo('description');
    }

    if (!empty($excerpt)) {
        echo
        '<meta name="description" content="'.$excerpt.'"/>',
        '<meta property="og:description" content="'.$excerpt.'"/>',
        '<meta name="twitter:description" content="'.$excerpt.'"/>';
    }
}, 5);
