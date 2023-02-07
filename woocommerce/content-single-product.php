<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$product_images_attr = $product_image_summary_class = '';

$product_images_class  	= woodmart_product_images_class();
$product_summary_class 	= woodmart_product_summary_class();
$single_product_class  	= woodmart_single_product_class();
$content_class 			= woodmart_get_content_class();
$product_design 		= woodmart_product_design();
$breadcrumbs_position 	= woodmart_get_opt( 'single_breadcrumbs_position' );
$image_width 			= woodmart_get_opt( 'single_product_style' );
$full_height_sidebar    = woodmart_get_opt( 'full_height_sidebar' );
$page_layout            = woodmart_get_opt( 'single_product_layout' );
$tabs_location 			= woodmart_get_opt( 'product_tabs_location' );
$reviews_location 		= woodmart_get_opt( 'reviews_location' );

//Full width image layout
if ( $image_width == 5 ) {
	if ( 'wpb' === woodmart_get_opt( 'page_builder', 'wpb' ) ) {
		$product_images_class .= ' vc_row vc_row-fluid vc_row-no-padding';
		$product_images_attr = 'data-vc-full-width="true" data-vc-full-width-init="true" data-vc-stretch-content="true"';
	} else {
		$product_images_class .= ' wd-section-stretch-content';
	}
}

$container_summary = $container_class = $full_height_sidebar_container = 'container';

if ( $full_height_sidebar && $page_layout != 'full-width' ) {
	$single_product_class[] = $content_class;
	$product_image_summary_class = 'col-lg-12 col-md-12 col-12';
} else {
	$product_image_summary_class = $content_class;
}

if ( woodmart_get_opt( 'single_full_width' ) ) {
	$container_summary = 'container-fluid';
	$full_height_sidebar_container = 'container-fluid';
}

if ( $full_height_sidebar && $page_layout != 'full-width' ) {
	$container_summary = 'container-none';
	$container_class = 'container-none';
}

?>

<?php if ( ( ( $product_design == 'alt' && ( $breadcrumbs_position == 'default' || empty( $breadcrumbs_position ) ) ) || $breadcrumbs_position == 'below_header' ) && ( woodmart_get_opt( 'product_page_breadcrumbs', '1' ) || woodmart_get_opt( 'products_nav' ) ) ): ?>
	<div class="single-breadcrumbs-wrapper">
		<div class="container">
			<?php if ( woodmart_get_opt( 'product_page_breadcrumbs', '1' ) ) : ?>
				<?php woodmart_current_breadcrumbs( 'shop' ); ?>
			<?php endif; ?>

			<?php if ( woodmart_get_opt( 'products_nav' ) ): ?>
				<?php woodmart_products_nav(); ?>
			<?php endif ?>
		</div>
	</div>
<?php endif ?>

<div class="container">
	<?php
		/**
		 * Hook: woocommerce_before_single_product.
		 */
		 do_action( 'woocommerce_before_single_product' );

		 if ( post_password_required() ) {
		 	echo get_the_password_form();
		 	return;
		 }

	?>
</div>

<?php if ( $full_height_sidebar && $page_layout != 'full-width' ) echo '<div class="' . $full_height_sidebar_container . '"><div class="row full-height-sidebar-wrap">'; ?>

<div id="product-<?php the_ID(); ?>" <?php wc_product_class( $single_product_class, $product ); ?>>

	<div class="<?php echo esc_attr( $container_summary ); ?>">

		<?php
			/**
			 * Hook: woodmart_before_single_product_summary_wrap.
			 *
			 * @hooked woocommerce_output_all_notices - 10
			 */
			do_action( 'woodmart_before_single_product_summary_wrap' );
		?>

		<div class="row product-image-summary-wrap">
			<div class="product-image-summary <?php echo esc_attr( $product_image_summary_class ); ?>">
				<div class="row product-image-summary-inner">
					<div class="<?php echo esc_attr( $product_images_class ); ?> product-images" <?php echo !empty( $product_images_attr ) ? $product_images_attr: ''; ?>>
						<div class="product-images-inner">
							<?php
								/**
								 * woocommerce_before_single_product_summary hook
								 *
								 * @hooked woocommerce_show_product_sale_flash - 10
								 * @hooked woocommerce_show_product_images - 20
								 */
								do_action( 'woocommerce_before_single_product_summary' );
							?>
						</div>
					</div>
					<?php if ( $image_width == 5 && 'wpb' === woodmart_get_opt( 'page_builder', 'wpb' ) ): ?>
						<div class="vc_row-full-width"></div>
					<?php endif ?>
					<div class="<?php echo esc_attr( $product_summary_class ); ?> summary entry-summary">
						<div class="summary-inner">
							<?php if ( ( ( $product_design == 'default' && ( $breadcrumbs_position == 'default' || empty( $breadcrumbs_position ) ) ) || $breadcrumbs_position == 'summary' ) && ( woodmart_get_opt( 'product_page_breadcrumbs', '1' ) || woodmart_get_opt( 'products_nav' ) ) ): ?>
								<div class="single-breadcrumbs-wrapper">
									<div class="single-breadcrumbs">
										<?php if ( woodmart_get_opt( 'product_page_breadcrumbs', '1' ) ) : ?>
											<?php woodmart_current_breadcrumbs( 'shop' ); ?>
										<?php endif; ?>

										<?php if ( woodmart_get_opt( 'products_nav' ) ): ?>
											<?php woodmart_products_nav(); ?>
										<?php endif ?>
									</div>
								</div>
							<?php endif ?>

							<?php
								/**
								 * woocommerce_single_product_summary hook
								 *
								 * @hooked woocommerce_template_single_title - 5
								 * @hooked woocommerce_template_single_rating - 10
								 * @hooked woocommerce_template_single_price - 10
								 * @hooked woocommerce_template_single_excerpt - 20
								 * @hooked woocommerce_template_single_add_to_cart - 30
								 * @hooked woocommerce_template_single_meta - 40
								 * @hooked woocommerce_template_single_sharing - 50
								 */
								do_action( 'woocommerce_single_product_summary' );
							?>
							<!-- <div class="quick-buy">Быстрый заказ</div> -->
						</div>
						<div class="woocommerce-product-details">
							<?php
								/**
								 * woocommerce_after_single_product_summary hook
								 *
								 * @hooked woocommerce_output_product_data_tabs - 10
								 * @hooked woocommerce_upsell_display - 15
								 * @hooked woocommerce_output_related_products - 20
								 */
								do_action( 'woocommerce_after_single_product_summary' );
							?>
						</div>
					</div>
				</div><!-- .summary -->
			</div>

			<?php 
				if ( ! $full_height_sidebar ) {
					/**
					 * woocommerce_sidebar hook
					 *
					 * @hooked woocommerce_get_sidebar - 10
					 */
					do_action( 'woocommerce_sidebar' );
				}
			?>

		</div>
		
		<?php
			/**
			 * woodmart_after_product_content hook
			 *
			 * @hooked woodmart_product_extra_content - 20
			 */
			do_action( 'woodmart_after_product_content' );
		?>

	</div>

	<?php do_action( 'woodmart_after_product_tabs' ); ?>

	<div class="<?php echo esc_attr( $container_class ); ?> related-and-upsells"><?php 
		/**
		 * woodmart_woocommerce_after_sidebar hook
		 *
		 * @hooked woocommerce_upsell_display - 10
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woodmart_woocommerce_after_sidebar' );
	?></div>

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

<?php 
	if ( $full_height_sidebar && $page_layout != 'full-width' ) {
		/**
		 * woocommerce_sidebar hook
		 *
		 * @hooked woocommerce_get_sidebar - 10
		 */
		do_action( 'woocommerce_sidebar' );
	}
?>

<?php if ( $full_height_sidebar && $page_layout != 'full-width' ) echo '</div></div>'; ?>

<!-- Modal -->
<div id="quick-buy-modal">
	<div onclick="$(this).parent().hide()" class="quick-buy-modal__close"></div>
	<div class="quick-buy-modal__title">Быстрый заказ</div>
	<div class="quick-buy-modal-box row">
		<div class="quick-buy-product row col-lg-7">
			<div class="quick-buy-product-img col-lg-6">
				Фото
			</div>
			<div class="quick-buy-product-description col-lg-6">
				<p class="quick-buy-product__name">Название</p>
				<p class="quick-buy-product__price">Цена</p>
				<p class="quick-buy-product__size">Размер: <span>0</span></p>
			</div>
		</div>
		<div class="col-lg-5">
			<div class="quick-buy-formbox">
				<form id="quick-buy-form" action="" method="POST">
					<input class="quick-buy-formbox__intext" type="text" placeholder="Имя" name="billing_first_name" autocomplete="given-name">
					<input class="quick-buy-formbox__intext" type="tel" placeholder="Телефон" name="billing_phone" autocomplete="tel">
					<input class="quick-buy-formbox__size" type="hidden" name="size">
					<button type="submit" name="quick-buy" class="quick-buy-formbox__btn single_add_to_cart_button">Заказать</button>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- Modal-End -->
<script type="text/javascript">
	$('#quick-buy-form').submit(function(e){

		const product_id = $('input[name="product_id"]').val()
		const name = $('input[name="billing_first_name"]').val()
		const phone = $('input[name="billing_phone"]').val()
		const size = $('input[name="size"]').val()

		if (!name || !phone) {
			alert('Заполните поля имя и телефон')
			return false
		}
		e.preventDefault()
		$('.quick-buy-formbox__btn').addClass('loading')
		const ajaxurl = "<?= admin_url('admin-ajax.php'); ?>";	
		$.ajax({
            type: 'POST',
            url: ajaxurl,
	        data: {
	            action: 'quick_order',
	            product_id: product_id,
	            billing_first_name: name,
                billing_phone: phone,
                size: size
	        },
            success: function (result) {
            	console.log(result);
                alert('Заказ успешно оформлен')
                $('#quick-buy-modal').fadeOut(200)
                $('.quick-buy-formbox__btn').removeClass('loading')
            }
        });
	})
	$('.quick-buy').click(function(e){
		e.preventDefault()
		const product_size = $(".single_size_box-item.active")
		if (!product_size.length) {
			$('.quick-buy-product__size').hide()
			// alert('Выберите размер')
			// return false
		}
		else {
			$('.quick-buy-product__size').show()
			$('.quick-buy-formbox__size').val(product_size.text())
		}
		const product_img = $(".woocommerce-product-gallery__image img").first().clone()
		const product_name = $("h1.product_title").text()
		const product_price = $("p.price").first().clone()
		$('.quick-buy-product-img').html(product_img)
		$('.quick-buy-product__name').html(product_name)
		$('.quick-buy-product__price').html(product_price)
		$('.quick-buy-product__size span').html(product_size.text())
		// $('.quick-buy-formbox__size').val(product_size.text())
		$('#quick-buy-modal').fadeIn(200)
	})
</script>