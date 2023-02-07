<?php
/**
 *
 * The framework's functions and definitions
 */

/**
 * ------------------------------------------------------------------------------------------------
 * Define constants.
 * ------------------------------------------------------------------------------------------------
 */

add_filter( 'user_has_cap', 'wpse_67225_unfiltered_upload' );

function wpse_67225_unfiltered_upload( $caps )
{
    $caps['unfiltered_upload'] = 1;
    return $caps;
}



use Elementor\Utils;

define( 'WOODMART_THEME_DIR', get_template_directory_uri() );
define( 'WOODMART_THEMEROOT', get_template_directory() );
define( 'WOODMART_IMAGES', WOODMART_THEME_DIR . '/images' );
define( 'WOODMART_SCRIPTS', WOODMART_THEME_DIR . '/js' );
define( 'WOODMART_STYLES', WOODMART_THEME_DIR . '/css' );
define( 'WOODMART_FRAMEWORK', '/inc' );
define( 'WOODMART_DUMMY', WOODMART_THEME_DIR . '/inc/dummy-content' );
define( 'WOODMART_CLASSES', WOODMART_THEMEROOT . '/inc/classes' );
define( 'WOODMART_CONFIGS', WOODMART_THEMEROOT . '/inc/configs' );
define( 'WOODMART_HEADER_BUILDER', WOODMART_THEME_DIR . '/inc/header-builder' );
define( 'WOODMART_ASSETS', WOODMART_THEME_DIR . '/inc/admin/assets' );
define( 'WOODMART_ASSETS_IMAGES', WOODMART_ASSETS . '/images' );
define( 'WOODMART_API_URL', 'https://xtemos.com/licenses/api/' );
define( 'WOODMART_DEMO_URL', 'https://woodmart.xtemos.com/' );
define( 'WOODMART_PLUGINS_URL', WOODMART_DEMO_URL . 'plugins/' );
define( 'WOODMART_DUMMY_URL', WOODMART_DEMO_URL . 'dummy-content/' );
define( 'WOODMART_SLUG', 'woodmart' );
define( 'WOODMART_CORE_VERSION', '1.0.28' );
define( 'WOODMART_WPB_CSS_VERSION', '1.0.2' );


/**
 * ------------------------------------------------------------------------------------------------
 * Load all CORE Classes and files
 * ------------------------------------------------------------------------------------------------
 */

if ( ! function_exists( 'woodmart_load_classes' ) ) {
	function woodmart_load_classes() {
		$classes = array(
			'Singleton.php',
			'Ajaxresponse.php',
			'Api.php',
			'Googlefonts.php',
			'Import.php',
			'Importversion.php',
			'Layout.php',
			'License.php',
			'Notices.php',
			'Options.php',
			'Stylesstorage.php',
			'Theme.php',
			'Themesettingscss.php',
			'Vctemplates.php',
			'Wpbcssgenerator.php',
			'Registry.php',
			'Pagecssfiles.php',
		);

		foreach ( $classes as $class ) {
			$file_name = WOODMART_CLASSES . DIRECTORY_SEPARATOR . $class;
			if ( file_exists( $file_name ) ) {
				require $file_name;
			}
		}
	}
}

woodmart_load_classes();

new WOODMART_Theme();

add_action( 'wp_enqueue_scripts', 'my_scripts_method' );
function my_scripts_method() {
	// отменяем зарегистрированный jQuery
	wp_deregister_script('jquery-core');
	wp_deregister_script('jquery');

	// регистрируем
	wp_register_script( 'jquery-core', 'https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js', false, null, true );
	wp_register_script( 'jquery', false, array('jquery-core'), null, true );

	// подключаем
	wp_enqueue_script( 'jquery' );
}

function filter_all_widget_title( $title, $insta=[] ) {
	$class =  ( isset( $insta['collapseClass']))?$insta['collapseClass']:'';
	return "<span class='my-custom-class " . $class . "'>$title</span>";
}

add_filter( 'widget_title', 'filter_all_widget_title',10,2 );
add_action( 'template_redirect', function(){
	ob_start( function( $buffer ){
		$buffer = str_replace( array( 'type="text/javascript"', "type='text/javascript'" ), '', $buffer );
		$buffer = str_replace( array( 'type="text/css"', "type='text/css'" ), '', $buffer );
		return $buffer;
	});
});

add_filter( 'aioseo_canonical_url', 'aioseo_filter_canonical_url' );

function aioseo_filter_canonical_url( $url ) {
   //if ( is_singular() ) {
    //  return '';
   //}
 //  return $url;
 return '';
}

function custom_widget_title_tag( $params ) {

   $params[0]['before_title'] = '<b class="widget_title">' ; // Открывающий тег

   $params[0]['after_title']  = '</b>' ;// Закрывающий тег

   return $params;

}

add_filter( 'dynamic_sidebar_params' , 'custom_widget_title_tag' );

function remove_category( $string, $type) {           if ($type != 'single' && $type == 'category' && (strpos( $string, 'category') !== false) )          {              $url_without_category = str_replace( "/category/", "/", $string );              return trailingslashit( $url_without_category );          }      return $string;  }
add_filter( 'user_trailingslashit', 'remove_category', 100, 2);

function ob_add_categories_filter( $filtered_posts ) {
    global $_chosen_attributes;

    $taxonomy        = wc_sanitize_taxonomy_name('product_cat');
    $name            = 'filter_product_cat';
    $query_type_name = 'query_type_product_cat';

    if ( ! empty( $_GET[ $name ] ) && taxonomy_exists( $taxonomy ) ) {

        $_chosen_attributes[ $taxonomy ]['terms'] = explode( ',', $_GET[ $name ] );

		if ( isset( $_GET['trest'] ) ) {
			echo '---------------<pre>';
			var_dump( $_chosen_attributes[ $taxonomy ]['terms']  );
			echo '---------------</pre>';

		}
        if ( empty( $_GET[ $query_type_name ] ) || ! in_array( strtolower( $_GET[ $query_type_name ] ), array(
                'and',
                'or'
            ) )
        ) {
            $_chosen_attributes[ $taxonomy ]['query_type'] = apply_filters( 'woocommerce_layered_nav_default_query_type', 'and' );
        } else {
            $_chosen_attributes[ $taxonomy ]['query_type'] = strtolower( $_GET[ $query_type_name ] );
        }
    }
    return $filtered_posts;
}
//add_filter( 'loop_shop_post_in', 'ob_add_categories_filter', 5, 1 );

function product_shop( $q ) {

    $taxonomy        = wc_sanitize_taxonomy_name('product_cat');
    $name            = 'filter_product_cat';
    $query_type_name = 'query_type_product_cat';

    if ( ! empty( $_GET[ $name ] ) && taxonomy_exists( $taxonomy ) ) {

        $q->set('tax_query', array(array(
            'taxonomy' => 'product_cat',
            'field' => 'slug',
            'terms' => explode(',', $_GET[$name]),
            'operator' => 'IN'
        )));

    }

}
//add_action( 'loop_shop_post_in', 'product_shop', 10, 2 );
add_action( 'woocommerce_product_query', 'product_shop', 10, 2 );

function quick_order($product_id, $name, $phone, $size) {

	global $woocommerce;

	$temp_text = 'Быстрый заказ';
	$quantity = 1;
	$args = array( 
		'variation' => array( 'pa_size' => $size),
	); 

	$address = array(
	  'first_name' => $name,
	  'last_name'  => 'Фамилия',
	  'email'      => 'test@test.ru',
	  'phone'      => $phone,
	  'address_1'  => 'Адрес',
	  'city'       => 'Город',
	  'country'    => 'RU'
	);

	// Now we create the order
	$order = wc_create_order(array('status' => 'pending'));

	// The add_product() function below is located in /plugins/woocommerce/includes/abstracts/abstract_wc_order.php
	$order->add_product( get_product($product_id), $quantity, $args); // This is an existing SIMPLE 
	$order->set_address( $address, 'billing' );
	$order->calculate_totals();
	$order->update_status("processing", 'Imported order', TRUE);

	// Get the WC_Email_New_Order object
	$email_new_order = WC()->mailer()->get_emails()['WC_Email_New_Order'];

	// Sending the new Order email notification for an $order_id (order ID)
	$email_new_order->trigger( $order->get_id() );
}

add_action('wp_ajax_quick_order', 'quick_order_handler');

function quick_order_handler() {

	if (isset($_POST['billing_first_name']) && isset($_POST['billing_phone'])) {
		$product_id = $_POST['product_id'];
		$name = $_POST['billing_first_name'];
		$phone = $_POST['billing_phone'];
		$size = $_POST['size'];
		quick_order($product_id, $name, $phone, $size);
		echo 'Success';
	}
}

add_filter('woocommerce_catalog_orderby', 'wc_customize_product_sorting');

function wc_customize_product_sorting($sorting_options){
    $sorting_options = array(
        'menu_order' => __( 'Сортировка', 'woocommerce' ),
        'date'       => __( 'Новинки', 'woocommerce' ),
        'popularity' => __( 'Рекомендуем', 'woocommerce' ),
        'price'      => __( 'Цены: по возрастанию', 'woocommerce' ),
        'price-desc' => __( 'Цены: по убыванию', 'woocommerce' ),
    );

    return $sorting_options;
}

function get_brand_image() {

	global $wp;

	$current_url = $_SERVER['REQUEST_URI'];
	if ( strpos($current_url, 'brand') !== false ) {

		$brand_name = substr($current_url, 7, -1);
		$brand_image_url = get_site_url() . '/wp-content/uploads/2022/11/';

		$brand_images = array(
			'kiton' => 'Kiton.png', 
			'santoni' => 'Santoni.png', 
			'jacob-cohen' => 'JC.png', 
			'brunello-cucinelli' => 'Brunello.png', 
			'zilli' => 'Zilli.png', 
			'stefano-ricci' => 'SRicci.png', 
			'moreschi' => 'Morechi.png', 
			'artigiani' => 'Artigiani.png', 
			'moorer' => 'Moorer.png', 
			'barrett' => 'Barrett.png', 
			'seraphin' => 'Seraphin.png', 
			'salvatore-ferragamo' => 'Ferragamo.png'
		);

		$brand_image = $brand_image_url . $brand_images[$brand_name];

		return '<meta property="og:image" content="'. $brand_image . '">
		<meta property="twitter:image" content="'. $brand_image . '">';
	}
}

function get_cart_product_price($product) {
	$price = $product->get_regular_price();
	return number_format($price, 0, ',', ' ') . ' ₽';
}

function get_cart_discount($product) {
	$price = '';
	if( $product->is_on_sale() ) {
        $price = intval($product->get_regular_price()) - intval($product->get_sale_price());
        $price = number_format($price, 0, ',', ' ') . ' ₽';
    }
    return $price;
}


add_filter( 'woocommerce_get_order_item_totals', 'adjust_woocommerce_get_order_item_totals' );
function adjust_woocommerce_get_order_item_totals( $totals ) {
	unset($totals['cart_subtotal'] );
	return $totals;
}