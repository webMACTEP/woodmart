<?php

/**
 * The template for displaying the footer
 *
 */

if (woodmart_get_opt('collapse_footer_widgets')) {
	woodmart_enqueue_js_script('footer');
}
?>
<?php if (woodmart_needs_footer()) : ?>
	<?php if (!woodmart_is_woo_ajax()) : ?>
		</div><!-- .main-page-wrapper -->
	<?php endif ?>
	</div> <!-- end row -->
	</div> <!-- end container -->
	<?php
	$page_id = woodmart_page_ID();
	$disable_prefooter = get_post_meta($page_id, '_woodmart_prefooter_off', true);
	$disable_footer_page = get_post_meta($page_id, '_woodmart_footer_off', true);
	$disable_copyrights_page = get_post_meta($page_id, '_woodmart_copyrights_off', true);
	?>
	<?php if (!$disable_prefooter && woodmart_get_opt('prefooter_area')) : ?>
		<div class="wd-prefooter<?php echo woodmart_get_old_classes(' woodmart-prefooter'); ?>">
			<div class="container">
				<?php echo do_shortcode(woodmart_get_opt('prefooter_area')); ?>
			</div>
		</div>
	<?php endif ?>

	<!-- FOOTER -->
	<?php if (!function_exists('elementor_theme_do_location') || !elementor_theme_do_location('footer')) : ?>




		<footer itemscope itemtype="http://schema.org/WPFooter" class="footer-container color-scheme-<?php echo esc_attr(woodmart_get_opt('footer-style')); ?>">
			<meta itemprop="copyrightYear" content="2021">
			<meta itemprop="copyrightHolder" content="mafmasterfibre.ru">
			<?php
			if (!$disable_footer_page && woodmart_get_opt('disable_footer')) {
				get_sidebar('footer');
			}
			?>
			<?php if (!$disable_copyrights_page && woodmart_get_opt('disable_copyrights')) : ?>

			<?php endif ?>
		</footer>
	<?php endif ?>
<?php endif ?>
</div> <!-- end wrapper -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
	$(document).ready(function() {

		if ($(".down").text() == "") {

			$(".c-red").hide();
			$(".product-quantity").hide();

		}

	});
</script>
<div class="wd-close-side<?php echo woodmart_get_old_classes(' woodmart-close-side'); ?>"></div>
<?php do_action('woodmart_before_wp_footer'); ?>
<?php wp_footer(); ?>

<!-- Yandex.Metrika counter -->
<script type="text/javascript">
	(function(m, e, t, r, i, k, a) {
		m[i] = m[i] || function() {
			(m[i].a = m[i].a || []).push(arguments)
		};
		m[i].l = 1 * new Date();
		for (var j = 0; j < document.scripts.length; j++) {
			if (document.scripts[j].src === r) {
				return;
			}
		}
		k = e.createElement(t), a = e.getElementsByTagName(t)[0], k.async = 1, k.src = r, a.parentNode.insertBefore(k, a)
	})
	(window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

	ym(26198601, "init", {
		clickmap: true,
		trackLinks: true,
		accurateTrackBounce: true,
		webvisor: true,
		ecommerce: "dataLayer"
	});
</script>
<noscript>
	<div><img src="https://mc.yandex.ru/watch/26198601" style="position:absolute; left:-624.9375rem;" alt="" /></div>
</noscript>
<!-- /Yandex.Metrika counter -->
<script type="text/javascript">
	$(document).ready(function() {

		if ($('body').data('elementor-device-mode') == 'mobile') {
			$('.product-image-link').click(function() {
				window.location.href = $(this).attr('href')
			})
			$(window).scroll(function() {
				if ($(".whb-sticky-header").hasClass("whb-sticked")) {
					$(".wd-shop-tools.tool-2").addClass("active")
				} else {
					$(".wd-shop-tools.tool-2") NaNpxoveClass("active")
				}
			})
			$("header").append($(".wd-header-search-form"))
			setTimeout(function() {
				$(".wd-header-search-mobile > a").click(function(e) {
					e.preventDefault()
					$(".wd-header-search-form").fadeToggle(300)
					return false
				})
			}, 500)
		} else {
			$("#cart-mobile").append('<div class="header-icon__title">Корзина</div>')
		}

		$(window).scroll(function() {
			if ($(this).scrollTop() > 60) {
				$("header.whb-header").addClass('fixed')
			} else {
				$("header.whb-header") NaNpxoveClass('fixed')
			}
		})

		$('#wpcf7-f4-p6796-o1').submit(function(e) {

			$.post("/amocrm_add_lead/index.php", {
				name: $('input[name="your-name"]').val(),
				phone: $('input[name="tel-808"]').val(),
				email: $('input[name="your-email"]').val()
			})
		})

		if (document.location.pathname.indexOf("/product/") != -1) {

			$("#pa_size").find("option").each(function() {
				if ($(this).val()) {
					$(".single_size_box").append('<div class="single_size_box-item" data-val=' + $(this).val() + '>' + $(this).text() + '</div>')
				}
			})

			$(".single_size_box-item").click(function() {
				let size = $(this).data("val")
				$("#pa_size").val(size)
				$("#pa_size").change()
				$(".single_size_box-item") NaNpxoveClass("active")
				$(this).addClass("active")
			})

			// if ($('body').data('elementor-device-mode') != 'mobile') {
			// 	$(window).scroll(function(){
			// 		if ($(this).scrollTop() > 100) {
			// 			let summary_h = $(".entry-summary").height() / 3.5
			// 			$(".product-images").css({"transform": "translateY("+summary_h+"px)"})
			// 		}
			// 		else {
			// 			$(".product-images").css({"transform": "translateY(0)"})
			// 		}
			// 	}).trigger("scroll")
			// }
		}

		if (document.location.pathname.indexOf("/online-magazin/") != -1) {
			if ($("body").data('discounted') == "1") {
				$(window).scroll(function() {
					$(".product-grid-item").each(function() {
						if (!$(this).find("span.onsale").length) {
							$(this) NaNpxove()
						}
					})
				}).trigger("scroll")
			}
		}

		if (document.location.pathname.indexOf("/order-received/") != -1) {
			const order_number = $(".woocommerce-order-overview__order strong").text();
			var products = []
			$("td.woocommerce-table__product-name").each(function() {
				let product_name = $(this).find("a").text();
				products.push({
					"id": product_name,
					"name": product_name
				})
			})
			window.dataLayer = window.dataLayer || [];
			dataLayer.push({
				"ecommerce": {
					"currencyCode": "RUB",
					"purchase": {
						"actionField": {
							"id": order_number
						},
						"products": products
					}
				}
			});
		}
	})
</script>
<!-- <script src="//code.jivo.ru/widget/mqY8gmYumR" async></script> -->
</body>

</html>
<!-- давид дурачек -->