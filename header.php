<?php

/**
 * The Header template for our theme
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<!--<script type="text/javascript">!function(){var t=document.createElement("script");t.type="text/javascript",t.async=!0,t.src='https://vk.com/js/api/openapi.js?169',t.onload=function(){VK.Retargeting.Init("VK-RTRG-1559936-5yKYo"),VK.Retargeting.Hit()},document.head.appendChild(t)}();</script>

<noscript><img src="https://vk.com/rtrg?p=VK-RTRG-1559936-5yKYo" style="position:fixed; left:-999px;" alt=""/></noscript>-->
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
	<?php echo get_brand_image(); ?>
	<?php if (is_product()) :
		global $post, $product;
	?>
		<meta property="twitter:image" content="<?= get_the_post_thumbnail_url($post->ID, 'shop_thumbnail') ?>">
		<meta property="og:image" content="<?= get_the_post_thumbnail_url($post->ID, 'shop_thumbnail') ?>">
	<? endif; ?>
	<?php wp_head(); ?>
	<meta name="yandex-verification" content="0e101f682fbb964b" />

	<?php if (!isset($_GET['dev'])) : ?>
		<style>
			.devmode {
				display: none;
			}
		</style>
	<?php endif; ?>
	<style>
		.quantity,
		.variations a.reset_variations,
		ul.tabs.wc-tabs,
		.wrapp-swatches,
		.wd-product-brands,
		.wd-products-per-page,
		.wd-products-shop-view,
		.woocommerce-result-count,
		.wd-bottom-actions,
		.wd-products-nav,
		.button[name="update_cart"],
		.wd-buttons.wd-pos-r-t,
		.woocommerce-tabs .wd-accordion-title,
		.product-additional-galleries,
		.order-lg-first .slick-arrow {
			display: none !important;
		}

		.c-red {
			color: #ff0303;
		}

		td.product-name {
			max-width: 280px;
			min-width: 142px;
		}

		.thumbnails.slick-slider .slick-track {
			transform: translateY(0) !important;
		}

		.product-image-summary .shop_attributes td,
		.product-image-summary .shop_attributes th {
			padding: 6.5px 0;
			border: none;
		}

		.header-icon {
			display: flex;
			align-items: center;
			justify-content: center;
			height: 40px;
		}

		.header-icon__title {
			cursor: pointer;
			font-size: 12px !important;
		}

		#burger-mobile .wd-tools-icon:before {
			font-size: 36px;
		}

		.product-image-thumbnail {
			width: 60px !important;
			border-color: #ccc !important;
			margin: 5px 1px;
		}

		.product-image-thumbnail[data-slick-index="0"] {
			margin-top: 8px;
		}

		.order-lg-first .slick-list {
			height: 745px !important;
		}

		.woocommerce-product-attributes-item__label {
			display: inline-block;
			margin-right: 6px;
		}

		.woocommerce-product-attributes-item__label::after {
			content: ':';
		}

		.woocommerce-product-attributes-item__value {
			display: inline-block;
			font-size: 14px;
		}

		.product-information-size {
			font-size: 14px;
			margin-bottom: 8px;
		}

		.price del {
			color: #000;
		}

		del .amount {
			color: #000;
			font-size: 18px;
			font-weight: bold;
		}

		ins .amount {
			color: #ff0303;
			font-weight: bold;
		}

		.product-images {
			transition: all 0.6s;
		}

		.product-images .labels-rounded {
			top: 30px !important;
		}

		.product-grid-item .labels-rounded {
			left: unset;
			right: 7px;
		}

		
		

		.product-image-summary .variations {
			margin-bottom: 15px !important;
		}

		.single_size_box {
			/*display: flex;
			justify-content: space-between;*/
			margin-bottom: 30px;
		}

		.single_size_box-item {
			display: inline-block;
			width: 80px;
			padding: 5px 0;
			margin: 0 10px 10px 0;
			text-align: center;
			/*			border-radius: 2px;*/
			border: 2px solid #e6e6e6;
			transition: box-shadow 0.2s;
			cursor: pointer;
		}

		.single_size_box-item:hover {
			box-shadow: 0 0 1px 0 #ccc;
		}

		.single_size_box-item.active {
			border-color: #000;
		}

		span.onsale.product-label {
			display: block !important;
			width: 60px;
			height: 60px;
			padding: 0;
			font-size: 20px;
			font-weight: 800;
			line-height: 58px;
		}

		.product_meta a,
		.woocommerce-product-attributes.shop_attributes a {
			color: #005aff !important;
			text-decoration: underline;
		}

		.woocommerce-product-attributes.shop_attributes a:hover {
			color: #e53030;
			text-decoration: none;
		}

		#woodmart-woocommerce-layered-nav-5 .nosex,
		#woodmart-woocommerce-layered-nav-6 .nosex {
			display: none;
		}

		a.glav-block {
			height: 700px;
		}

		a.glav-block:hover {
			filter: brightness(80%);
		}

		a.glav-block .title {
			position: absolute;
			width: 100%;
			font-size: 48px;
			color: #eee;
			text-transform: uppercase;
			text-shadow: 1px 1px 3px #111;
			bottom: 215px;
		}

		a.glav-block.glav-block-2,
		a.glav-block.glav-block-3 {
			background-size: contain !important;
			background-repeat: no-repeat !important;
			background-position: center center;
		}

		a.glav-block.glav-block-2 {
			border-right: 1px solid #eee;
			background-image: url(/wp-content/uploads/2022/12/1-min.png), linear-gradient(to right, #d5d8d5, #d9dcd9);
		}

		a.glav-block.glav-block-3 {
			background-image: url('/wp-content/uploads/2022/12/2-min.png'), linear-gradient(to right, #d2d4cf, #DFE1DC);
		}

		a.glav-block-parfum {
			display: none;
			background-size: cover !important;
			background-position-x: center;
			background-image: url('https://artigiani.boutique/wp-content/uploads/2023/01/parf.png');
		}

		.tabs-layout-tabs .tabs {
			margin-top: 40px;
		}

		.art-block {
			display: flex;
			justify-content: center;
			margin-top: 60px;
		}

		.art-block img {
			width: 125px;
			margin-right: 30px;
		}

		.art-block-column {
			/*			margin: 0 15px;*/
			text-align: left;
		}

		.woocommerce-product-details {
			margin-top: -7px;
		}

		.tabs-layout-accordion {
			border-top: none;
		}

		.woocommerce-product-attributes-item--attribute_pa_size {
			display: none;
		}

		#qltgm.qltgm-bottom-left,
		#qltgm.qltgm-bottom-right {
			top: auto;
			bottom: 40px;
		}

		.cart-widget-side {
			height: 560px;
			padding-bottom: 30px;
		}

		.shopping-cart-widget-body.wd-scroll {
			--scrollbar-track-bg: rgba(0, 0, 0, 0.2);
			--scrollbar-thumb-bg: rgba(0, 0, 0, 0.4);
		}

		#menu-item-44578,
		#menu-item-44469,
		#menu-item-43430 {
			margin-bottom: 50px;
		}

		#menu-item-44578 .nav-link-text {
			color: red;
		}

		#menu-item-20837 .woodmart-nav-link,
		#menu-item-43430 .woodmart-nav-link,
		#menu-item-11662 .woodmart-nav-link {
			border-top: 1px solid var(--nav-mobile-link-brdcolor);
		}

		.related-products .owl-nav>div {
			visibility: visible;
			opacity: 1;
			-webkit-transform: translateY(0);
			transform: translateY(0);
			pointer-events: visible;
		}

		.product-image-summary-inner {
			overflow: hidden;
			transition: all 0.3s;
		}

		.items-end {
			align-items: end;
		}

		.single_add_to_cart_button.quick-buy {
			position: relative;
			top: -152px;
			left: 135px;
		}

		#quick-buy-modal {
			display: none;
			position: fixed;
			top: 23vh;
			left: 50%;
			z-index: 9999;
			width: 800px;
			margin-left: -400px;
			padding: 30px 0 30px 20px;
			background-color: #fff;
			box-shadow: 0 0 0 9999px rgba(0, 0, 0, .5);
		}

		.quick-buy-modal__close {
			position: absolute;
			top: 20px;
			right: 20px;
			width: 30px;
			height: 30px;
			background-size: cover;
			background-image: url('/wp-content/themes/woodmart/images/svg/close.svg');
			cursor: pointer;
		}

		.quick-buy-modal__title {
			font-size: 28px;
			font-weight: 600;
			margin-bottom: 50px;
			text-align: center;
		}

		.quick-buy-product__name {
			font-weight: 600;
		}

		#quick-buy-modal .quick-buy-formbox__intext {
			margin-bottom: 30px;
			border: none;
			height: 50px;
			font-size: 18px;
			padding-left: 0;
			border-bottom: 1px solid #ccc;
		}

		.quick-buy-formbox__btn {
			width: 100%;
			height: 60px;
		}

		@media (min-width: 990px) {
			a.wd-logo.wd-main-logo {
				position: static;
			}

			header.whb-header {
				margin: 30px 0 60px;
			}

			header.whb-header.fixed {
				position: fixed;
				top: 0;
				left: 0;
				z-index: 9999;
				width: 100%;
				margin: 0;
				padding: 10px 0;
				background: #fff;
				box-shadow: 0 0 5px 0 #ccc;
			}

			.wd-header-search-form input.s {
				border-radius: 25px;
				height: 44px;
				margin-top: 8px;
				padding-left: 50px;
			}

			.wd-header-search-form input.s::placeholder {
				font-family: 'Montserrat';
				font-style: normal;
				font-weight: 400;
				font-size: 14px;
				line-height: 120%;
				/* identical to box height, or 17px */


				color: #B2B2B2;

			}

			.wd-header-search-form .searchform .searchsubmit {
				right: unset;
				top: 9px;
				left: 2px;
			}

			.whb-top-bar .wd-tools-element .wd-tools-icon:before {
				font-size: 24px;
			}

			.whb-header-bottom {
				display: none;
			}

			aside .widget-area {
				position: fixed;
				width: 250px;
				top: 100px;
				z-index: 10;
				background: #fff;
				box-shadow: 0 0 0 20px #fff;
			}
		}

		@media (max-width: 990px) and (min-width: 760px) {

			a.glav-block.glav-block-2,
			a.glav-block.glav-block-3 {
				background-size: cover !important;
			}
		}

		@media (max-width: 990px) {
			#quick-buy-modal {
				width: 100%;
				height: 100%;
				padding: 20px;
				overflow-y: auto;
				top: 0;
				left: 0;
				margin-left: 0;
			}

			.quick-buy-product__name {
				font-size: 22px;
			}

			.quick-buy-product__price {
				font-size: 22px;
			}

			.quick-buy-modal__title {
				margin-bottom: 0;
			}

			.quick-buy-product-img img {
				max-width: 100%;
			}

			.wd-header-search-form {
				display: none;
				position: fixed;
				width: 100%;
				left: 0;
				top: 60px;
				z-index: 101;
				padding: 5px;
				background: #fff;
			}

			.wd-shop-tools .woocommerce-breadcrumb {
				display: none !important;
			}
		}

		@media (max-width: 600px) {
			a.glav-block-parfum {
				display: block;
			}

			.wd-shop-tools.active {
				position: fixed;
				top: 0;
				width: 93%;
				z-index: 100;
				padding: 10px 0 0;
				background: #fff;
				transform: translateY(60px);
				transition: transform 0.2s 0.2s;
			}

			.wd-tools-element.wd-header-mobile-nav.wd-style-text {
				left: -90%;
			}

			.art-block__title {
				margin-bottom: 12px;
			}

			.art-block a {
				margin-bottom: 12px;
			}

			#qltgm.qltgm-bottom-left,
			#qltgm.qltgm-bottom-right {
				top: auto;
				bottom: 80px;
			}

			.woocommerce-product-details {
				margin-top: 30px;
			}

			a.glav-block {
				height: 500px;
			}

			.wd-hover-base .content-product-imagin {
				box-shadow: none;
			}

			/*#cart-mobile {
				position: absolute;
				left: 15px;
			}*/
			.offcanvas-sidebar-mobile .shop-content-area:not(.col-lg-12) .wd-shop-tools:not(:last-child) {
				margin-top: 20px;
			}

			/*::-webkit-scrollbar {
			    -webkit-appearance: none;
			}
			::-webkit-scrollbar:vertical {
			    width: 6px;
			}
			::-webkit-scrollbar-thumb {
			    background-color: #ccc;
			    border: 2px solid #ffffff;
			}
			::-webkit-scrollbar-track {
			    background-color: #ffffff;
			}*/
		}

		@media (max-width: 400px) {
			span.onsale.product-label {
				width: 45px;
				height: 45px;
				font-size: 15px;
				line-height: 45px;
			}

			.art-block img {
				width: 120px;
				margin-right: 15px;
			}
		}
	</style>
	
	<link rel="stylesheet" href="/wp-content/themes/woodmart/css/mystyle.css?=18">
</head>
<?php

$is_discounted = isset($_GET['discounted']) ? 1 : 0;

?>

<body <?php body_class(); ?> data-discounted="<?= $is_discounted ?>">
	<?php if (function_exists('wp_body_open')) : ?>
		<?php wp_body_open(); ?>
	<?php endif; ?>

	<?php do_action('woodmart_after_body_open'); ?>

	<div class="website-wrapper">

		<?php if (woodmart_needs_header()) : ?>

			<!-- HEADER -->
			<?php if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('header')) : ?>
				<header <?php woodmart_get_header_classes(); // location: inc/functions.php 
						?>>
					<?php whb_generate_header(); ?>
				</header><!--END MAIN HEADER-->
			<?php endif ?>

			<?php woodmart_page_top_part(); ?>

		<?php endif ?>