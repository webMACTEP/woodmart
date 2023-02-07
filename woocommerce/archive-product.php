<?php
	/**
	 * The Template for displaying product archives, including the main shop page which is a post type archive
	 *
	 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
	 *
	 * HOWEVER, on occasion WooCommerce will need to update template files and you
	 * (the theme developer) will need to copy the new files to your theme to
	 * maintain compatibility. We try to do this as little as possible, but it does
	 * happen. When this occurs the version of the template file will be bumped and
	 * the readme will list any important changes.
	 *
	 * @see https://docs.woocommerce.com/document/template-structure/
 	 * @package WooCommerce/Templates
 	 * @version 3.4.0
	 */

	defined( 'ABSPATH' ) || exit;

	if( woodmart_is_woo_ajax() === 'fragments' ) {
		woodmart_woocommerce_main_loop( true );
		die();
	}

	if ( ! woodmart_is_woo_ajax() ) {
		get_header( 'shop' );
	} else {
		woodmart_page_top_part();
	}

	$cat_desc_position = woodmart_get_opt( 'cat_desc_position' );
?>

<?php
	/**
	 * Hook: woocommerce_sidebar.
	 *
	 * @hooked woocommerce_get_sidebar - 10
	 */
	do_action( 'woocommerce_sidebar' );
?>

<?php
	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */
	do_action( 'woocommerce_before_main_content' );
?>

<?php do_action( 'woodmart_before_shop_page' ); ?>

<?php
	if ( $cat_desc_position == 'before' ) {
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	}
?>

<div class="shop-loop-head erere">
	<div class="wd-shop-tools<?php echo woodmart_get_old_classes( ' woodmart-woo-breadcrumbs' ); ?>">
		<?php if ( woodmart_get_opt( 'shop_page_breadcrumbs', '1' ) ) : ?>
			<?php woodmart_current_breadcrumbs( 'shop' ); ?>
		<?php endif; ?>

		<?php woocommerce_result_count(); ?>
	</div>
	<div class="wd-shop-tools tool-2<?php echo woodmart_get_old_classes( ' woodmart-shop-tools' ); ?>">
		<?php
			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked wc_print_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		?>
	</div>
</div>

<?php do_action( 'woodmart_shop_filters_area' ); ?>

<div class="wd-active-filters<?php echo woodmart_get_old_classes( ' woodmart-active-filters' ); ?>">
	<?php

		do_action( 'woodmart_before_active_filters_widgets' );

		the_widget( 'WC_Widget_Layered_Nav_Filters', array(
			'title' => ''
		), array() );

		do_action( 'woodmart_after_active_filters_widgets' );

	?>
</div>

<?php woodmart_enqueue_js_script( 'shop-loader' ); ?>
<div class="wd-sticky-loader"><span class="wd-loader"></span></div>

<?php do_action( 'woodmart_woocommerce_main_loop' ); ?>

<?php
	if ( $cat_desc_position == 'after' ) {
		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
	}
?>

<?php
	/**
	 * Hook: woocommerce_after_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
?>

<?php
	if ( ! woodmart_is_woo_ajax() ) {
		get_footer( 'shop' );
	} else {
		woodmart_page_bottom_part();
	}
?>

<script>
    jQuery(($) => {
        $wds = $('.my-custom-class.collapse').closest('.wd-widget');
        $wds.each((i, el)=>{
            let t = localStorage.getItem( el.id );
            el.classList.add('collapsable');
            el.classList.toggle('collapsed', ( t==='true' || t===null ) )

        })
        $wds.find('.widget_title').on('click', (e)=>{
            let $t = $( e.target ).closest('.wd-widget');
            $t.toggleClass('collapsed')
            localStorage.setItem( $t[0].id, ($t.hasClass('collapsed')));
        })
    })
</script>
<style>
    .widget{
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .widget_title{
        padding: 30px 0;
        cursor: pointer;

    }
    .collapse:after{
        content: '';
        float: right;
        transition: .3s;
        width: 16px;
	    height: 16px;
	    transform: rotate(180deg);
	    background-repeat: no-repeat;
        background-image: url('/wp-content/themes/woodmart/images/svg/arrow.svg');
    }
    .widget.collapsed .wd-scroll{
        display: block;
    }
    .widget.collapsed .collapse:after{
        transform: rotate(0);
    }
    .woodmart-woocommerce-layered-nav>b{
        width: 100%;
        display: block;
    }
    .widget .wd-scroll{
        margin-bottom: 30px;
    }

    .widget.collapsed .wd-scroll, .widget:not(.collapsable){
        display: none;
    }
    @media screen and (min-width: 600px) {
        #woocommerce_price_filter-2{
            padding-top: 30px;
        }

    }
    @media screen and (min-width: 1024px) {
    {
        .sidebar-container {
            margin-bottom: 40px;
            position: sticky;
            top: 75px;
        }
        .website-wrapper {
             overflow: visible;
        }
    }
    #woocommerce_price_filter-2{
        margin-top: 36px;
        display: block;
    }

    #woocommerce_product_categories-3{
        display: block;
    }
    .widget_product_categories .product-categories li a {
        line-height: 1.2;
    }
</style>





