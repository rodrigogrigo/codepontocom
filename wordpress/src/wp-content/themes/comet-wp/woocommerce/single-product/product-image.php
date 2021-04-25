<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $post, $product;
?>
<div class="col-md-6">

	<?php
		if ( has_post_thumbnail() ) {

			$attachment_count = count( $product->get_gallery_image_ids() );

			if ( $attachment_count > 0 ) {
				$gallery = '[product-gallery]';
			} else {
				$gallery = '';
			}

			$slides = array_merge(
        array(get_post_thumbnail_id($post->ID)),
        $product->get_gallery_image_ids()
      );

			?>

			<div class="flexslider nav-inside" id="product-slider">
				<ul class="slides">
	        <?php foreach ($slides as $slide): ?>
	          <li data-thumb="<?php echo wp_get_attachment_thumb_url($slide); ?>">
	            <?php

	            $image_title 	= esc_attr( get_the_title( $slide ) );
							$image_caption 	= get_post( $slide )->post_excerpt;
							$image_link  	= wp_get_attachment_url( $slide );

							$image = wp_get_attachment_image( $slide, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ), array(
								'title'	=> $image_title,
								'data-caption' => get_post_field( 'post_excerpt', $slide ),
								'alt'	=> $image_title,
							));

							echo apply_filters(
								'woocommerce_single_product_image_html',
								sprintf(
									'<div class="product-zoom" data-image-zoom="%s">%s</div>',
									wp_get_attachment_url($slide),
									$image
								),
							$post->ID );
	           	?>
	          </li>
	        <?php endforeach ?>
	       </ul>
      </div>

		<?php } else {

			echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<img src="%s" alt="%s" />', wc_placeholder_img_src(), esc_html__( 'Placeholder', 'comet-wp' ) ), $post->ID );

		}
	?>

</div>
