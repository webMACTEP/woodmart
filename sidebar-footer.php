<?php

/**
 * The Footer Sidebar
 */

if (!is_active_sidebar('footer-1') && !is_active_sidebar('footer-2') && !is_active_sidebar('footer-3') && !is_active_sidebar('footer-4') && !is_active_sidebar('footer-5') && !is_active_sidebar('footer-6') && !is_active_sidebar('footer-7')) {
	return;
}

$footer_layout = woodmart_get_opt('footer-layout');

$footer_config = woodmart_get_footer_config($footer_layout);

if (count($footer_config['cols']) > 0) {
?>
	<div class="container main-footer">
		<aside class="footer-sidebar widget-area row" role="complementary">
			<div class="footer-column footer-column-1 col-12 col-sm-3 ">
				<div id="text-9" class="wd-widget widget footer-widget  widget_text"><b class="widget_title"><span class="my-custom-class "></span></b>
					<div class="textwidget">
						<div class="footer-logo" style="max-width: 80%; margin-bottom: 10px;"><img style="margin-bottom: 10px;" data-src="https://www.intefra.ru/wp-content/uploads/2023/01/logo.png" class=" ls-is-cached lazyloaded" src="https://www.intefra.ru/wp-content/uploads/2023/01/logo.png"><noscript><img src="https://www.intefra.ru/wp-content/uploads/2023/01/logo.png" style="margin-bottom: 10px;" /></noscript></div>
						<p>INTEFRA – российская платформа, на которой объединены ведущие итальянские бренды одежды, обуви и аксессуаров.</p>

						<p style="margin-top:40px;"> INTEFRA.RU - с 2012 года - 100% оригинальные товары</p>
					</div>
				</div>
			</div>
			<div class="footer-column footer-column-2 col-12 col-sm-3">
				<div id="nav_menu-4" class="wd-widget widget footer-widget  widget_nav_menu"><b class="widget_title"><span class="my-custom-class "></span></b>
					<div class="menu-1-kategorii-container">
						<ul id="menu-1-kategorii" class="menu">
							<li id="menu-item-37211" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37211"><a href="https://www.intefra.ru/product-category/allshoes/">Обувь</a></li>
							<li id="menu-item-37213" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37213"><a href="https://www.intefra.ru/product-category/jeans/">Джинсы и брюки</a></li>
							<li id="menu-item-37214" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37214"><a href="https://www.intefra.ru/product-category/verhnyaya-odezhda/">Верхняя одежда</a></li>
							<li id="menu-item-37216" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37216"><a href="https://www.intefra.ru/product-category/sportivnye-kostyumy/">Спортивные костюмы</a></li>
							<li id="menu-item-37215" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37215"><a href="https://www.intefra.ru/product-category/pidzhaki-i-kostyumy/">Пиджаки и костюмы</a></li>
							<li id="menu-item-37233" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37233"><a href="https://www.intefra.ru/product-category/sweaters/">Cвитера, поло, джемперы</a></li>

						</ul>
					</div>
				</div>
			</div>
			<div class="footer-column footer-column-3 col-12 col-sm-2">
				<div id="nav_menu-5" class="wd-widget widget footer-widget  widget_nav_menu"><b class="widget_title"><span class="my-custom-class "></span></b>
					<div class="menu-2e-menyu-container">
						<ul id="menu-2e-menyu" class="menu">
							<li id="menu-item-37234" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37234"><a href="https://www.intefra.ru/product-category/futbolki-2/">Футболки и поло</a></li>
							<li id="menu-item-37236" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37236"><a href="https://www.intefra.ru/product-category/bags/">Сумки</a></li>
							<li id="menu-item-37235" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37235"><a href="https://www.intefra.ru/product-category/belts/">Ремни</a></li>
							<li id="menu-item-37237" class="menu-item menu-item-type-taxonomy menu-item-object-product_cat menu-item-37237"><a href="https://www.intefra.ru/product-category/accessories/">Аксессуары</a></li>
							<li id="menu-item-40041" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-40041"><a href="https://www.intefra.ru/brendy/">Бренды</a></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="footer-column footer-column-4 col-12 col-sm-4">
				<div class="location__item">
					<div class="left">
						<b>Офис в России</b>
						<span>Москва, Кутузовский пр. 2
							Санкт-Петербург, Большой проспект П.С. 13</span>
					</div>
					<img src="/wp-content/themes/woodmart/images/loc1.svg" alt="">
				</div>
				<div class="location__item">
					<div class="left">
						<b>Офис в Италии</b>
						<span>Milano, Via Manzoni 23</span>
					</div>
					<img src="/wp-content/themes/woodmart/images/loc1.svg" alt="">
				</div>
				<div class="soc__items"><a href=""><img src="/wp-content/themes/woodmart/images/insta.svg" alt=""></a><a href=""><img src="/wp-content/themes/woodmart/images/tg.svg" alt=""></a></div>
			</div>
		</aside>
	</div>
<?php
}

?>