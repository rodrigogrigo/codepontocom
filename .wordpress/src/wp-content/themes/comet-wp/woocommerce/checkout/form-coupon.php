<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */
defined( 'ABSPATH' ) || exit;
if ( ! wc_coupons_enabled() ) {
	return;
}
?>

<div class="woocommerce-form-coupon-toggle">
	<?php wc_print_notice( apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'comet-wp' ) . ' <a href="#" class="showcoupon">' . __( 'Click here to enter your code', 'comet-wp' ) . '</a>' ), 'notice' ); ?>
</div>

<form class="checkout_coupon" method="post" style="display:none">

	<div class="form-row form-row-first">
		<div class="input-group">
			<input type="text" name="coupon_code" class="form-control" placeholder="<?php esc_attr_e( 'Coupon code', 'comet-wp' ); ?>" id="coupon_code" value="" />

			<div class="input-group-btn">
				<button type="submit" class="btn btn-color" name="apply_coupon" value="<?php esc_attr_e( 'Apply Coupon', 'comet-wp' ); ?>"><?php esc_html_e( 'Apply coupon', 'comet-wp' ); ?></button>
			</div>
		</div>
	</div>

	<div class="clear"></div>
</form>
