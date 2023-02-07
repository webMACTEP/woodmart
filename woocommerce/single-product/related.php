<?php

/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if (!defined('ABSPATH')) {
	exit;
}

$related_product_view = woodmart_get_opt('related_product_view');

function woocommerceCategorySlug($id)
{
	$term = get_term_by('id', $id, 'product_cat', 'ARRAY_A');
	return $term['slug'];
}

function get_related_ids($link)
{

	$ids = array();

	$dom = new domDocument;
	@$dom->loadHTML(file_get_contents($link));
	$dom->preserveWhiteSpace = false;
	$finder = new DomXPath($dom);

	$classname = "product-grid-item";
	$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

	foreach ($nodes as $item) {
		$ids[] = $item->getAttribute('data-id');
	}

	return $ids;
}

function isMobile()
{
	return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
}

global $product;

$url = 'https://www.intefra.ru/product-category/';
$category_slug = woocommerceCategorySlug($product->get_category_ids()[0]);

$product_sex = 'man';
if ($product->get_attribute('pa_sex') != 'Мужской') {
	$product_sex = 'woman';
}

$final_url = $url . $category_slug . '?filter_sex=' . $product_sex;

$ids = get_related_ids($final_url);

shuffle($ids);

$related_products = array();
$similar_products = array();

$_pf = new WC_Product_Factory();

foreach ($ids as $id) {

	if (count($related_products) < 12) {
		if ($id != $product->get_id())
			$related_products[] = $_pf->get_product($id);
	}
}

$sim_ids = array(
	'man' => array(
		'378' => array(43270, 43288, 43315, 43335),
		'530' => array(43604, 43614, 43609, 43599),
		'182' => array(41710, 41706, 41095, 40789),
		'240' => array(41448, 40247, 41553, 40244),
		'462' => array(41672, 41662, 41643, 40588)
	),
	'woman' => array(
		'378' => array(40154, 40117, 40110, 40096),
		'530' => array(41571, 41571, 41571, 41571),
		'182' => array(41487, 41479, 41467, 41130),
		'462' => array(41533, 41558, 39359, 43151)
	)
);

foreach ($sim_ids[$product_sex] as $sim_cat => $sim_id) {

	$similar_id = $sim_id[rand(0, 3)];

	if (count($similar_products) < 5) {
		if ($similar_id != $product->get_id() and $sim_cat != $product->get_category_ids()[0]) {
			$similar_products[] = $_pf->get_product($similar_id);
		}
	}
}

?>

<div id="similar-products" class="related-products">
	<h3 class="title slider-title">С этим товаром покупают</h3>
	<?php
	woodmart_enqueue_inline_style('product-loop');
	if (!isMobile()) {
		$slider_args = array(
			'slides_per_view' => (woodmart_get_opt('related_product_columns')) ? woodmart_get_opt('related_product_columns') : apply_filters('woodmart_related_products_per_view', 4),
			'img_size' => 'woocommerce_thumbnail',
			'products_bordered_grid' => woodmart_get_opt('products_bordered_grid'),
			'custom_sizes' => apply_filters('woodmart_product_related_custom_sizes', false),
			'product_quantity' => woodmart_get_opt('product_quantity'),
		);

		woodmart_set_loop_prop('products_view', 'carousel');

		echo woodmart_generate_posts_slider($slider_args, false, $similar_products);
	} else {
		woodmart_set_loop_prop('products_columns', woodmart_get_opt('related_product_columns'));
		woodmart_set_loop_prop('products_different_sizes', false);
		woodmart_set_loop_prop('products_masonry', false);
		woodmart_set_loop_prop('products_view', 'grid');

		woocommerce_product_loop_start();

		foreach ($similar_products as $similar_product) {
			$post_object = get_post($similar_product->get_id());

			setup_postdata($GLOBALS['post'] = $post_object);

			wc_get_template_part('content', 'product');
		}

		woocommerce_product_loop_end();

		woodmart_reset_loop();

		if (function_exists('woocommerce_reset_loop')) woocommerce_reset_loop();
	}

	?>
</div>


<?php if ($related_products) : ?>

	<div class="related-products">

		<?php
		$heading = apply_filters('woocommerce_product_related_products_heading', __('Related products', 'woocommerce'));

		if ($heading) :
		?>
			<h3 class="title slider-title"><?php echo esc_html($heading); ?></h3>
		<?php endif; ?>

		<?php
		woodmart_enqueue_inline_style('product-loop');
		if ($related_product_view == 'slider') {
			$slider_args = array(
				'slides_per_view' => (woodmart_get_opt('related_product_columns')) ? woodmart_get_opt('related_product_columns') : apply_filters('woodmart_related_products_per_view', 4),
				'img_size' => 'woocommerce_thumbnail',
				'products_bordered_grid' => woodmart_get_opt('products_bordered_grid'),
				'custom_sizes' => apply_filters('woodmart_product_related_custom_sizes', false),
				'product_quantity' => woodmart_get_opt('product_quantity'),
			);

			woodmart_set_loop_prop('products_view', 'carousel');

			echo woodmart_generate_posts_slider($slider_args, false, $related_products);
		} elseif ($related_product_view == 'grid') {

			woodmart_set_loop_prop('products_columns', woodmart_get_opt('related_product_columns'));
			woodmart_set_loop_prop('products_different_sizes', false);
			woodmart_set_loop_prop('products_masonry', false);
			woodmart_set_loop_prop('products_view', 'grid');

			woocommerce_product_loop_start();

			foreach ($related_products as $related_product) {
				$post_object = get_post($related_product->get_id());

				setup_postdata($GLOBALS['post'] = $post_object);

				wc_get_template_part('content', 'product');
			}

			woocommerce_product_loop_end();

			woodmart_reset_loop();

			if (function_exists('woocommerce_reset_loop')) woocommerce_reset_loop();
		}

		?>
	</div>

<?php endif;
?>

<div class="ranee">

	<?php echo do_shortcode('[recently_viewed_products]'); ?>

</div>

<?php
wp_reset_postdata();
