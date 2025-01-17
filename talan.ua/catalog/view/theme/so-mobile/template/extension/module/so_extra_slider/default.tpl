
<div class="module <?php echo $direction_class?> <?php echo $class_suffix; ?>">
	<?php if($disp_title_module) { ?>
		<h3 class="modtitle"><span><?php echo $head_name; ?></span></h3>
	<?php } ?>

<?php if($pre_text != '')
	{
?>
	<div class="form-group">
		<?php echo html_entity_decode($pre_text);?>
	</div>
<?php
	}
?>
<div class="modcontent">
	<?php if (!empty($products)) {
	$count_item = count($products); 
	$cls_btn_page = ($button_page == 'top') ? 'buttom-type1':'button-type2';
	$btn_type 	  = ($button_page == 'top') ? 'button-type1':'button-type2';
	$suffix = rand() . time();
	$tag_id = 'sp_extra_slider_' . $suffix;
	$class_respl = 'preset00-'.$nb_column0.' preset01-'.$nb_column1.' preset02-'.$nb_column2.' preset03-'.$nb_column3.' preset04-'.$nb_column4;
	$btn_prev = ($button_page == 'top') ? '&#171;':'&#139;';
	$btn_next = ($button_page == 'top') ? '&#187;':'&#155;';
	$i = 0;
	?>
	<div id="<?php echo $tag_id ; ?>"
		 class="so-extraslider <?php echo $cls_btn_page; ?> <?php echo $class_respl; ?> <?php echo $btn_type; ?> ">
		<!-- Begin extraslider-inner -->
		<div class="loading-placeholder"></div>
	<div class="extraslider-inner products-list grid wrapper-scroll" data-effect="<?php echo $effect; ?>">
			<?php  foreach ($products as $product) {
			$i++;
			?>
			<?php if ($i % $nb_rows == 1 || $nb_rows == 1) { ?>
			<div class="item item-scroll">
				<?php } ?>
				<div class="product-layout <?php echo $products_style; ?>">
					<div class="product-item-container ">
							<div class="left-block so-quickview">
								<div class="product-image-container">
									<a class="hidden" data-product='<?php echo $product['product_id'];?>' href="<?php echo $product['href'];?>" target="<?php echo $item_link_target;?>"></a>
									<a class="lt-image" 
									   href="<?php echo $product['href'] ?>" target="<?php echo $item_link_target ?>"
									   title="<?php echo $product['name'] ?>">
									<?php if($product_image_num ==2){?>
										<img src="<?php echo $product['thumb']?>" class="img-thumb1" alt="<?php echo $product['nameFull'] ?>">
										<img src="<?php echo $product['thumb2']?>" class="img-thumb2" alt="<?php echo $product['nameFull'] ?>">
									<?php }else{?>
										<img src="<?php echo $product['thumb']?>" alt="<?php echo $product['nameFull'] ?>">
									<?php }?>
									</a>
								</div>
								
								<div class="box-label">
									<?php if ($product['special'] && $display_sale) : ?>
										<span class="label-product label-sale"><?php echo $product['discount']; ?></span>
									<?php endif; ?>
									<?php if ($product['productNew'] && $display_new) : ?>
										<span class="label-product label-new"><?php echo $objlang->get('text_new'); ?></span>
									<?php endif; ?>
								</div>
							</div>
						<?php if($display_title == 1 || $display_description == 1 || $display_price == 1 || $display_addtocart == 1 || $display_wishlist == 1 || $display_compare == 1 || $display_readmore_link == 1){ ?>
							<div class="right-block">
								<?php if($display_title) { ?>
									<div class="caption">
										<h4>
											<a href="<?php echo $product['href'];?>" target="<?php echo $item_link_target;?>"
											   title="<?php echo $product['nameFull']; ?>"  >
												<?php echo html_entity_decode($product['name']); ?>
											</a>
										</h4>
										<?php if($display_rating){
										if (!empty($product['rating']))
										{
								?>
								<div class="rating">
									<?php for ($k = 1; $k <= 5; $k++) { ?>
										<?php if ($product['rating'] < $k) { ?>
										<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
										<?php } else { ?>
										<span class="fa fa-stack"><i class="fa fa-star fa-stack-2x"></i><i class="fa fa-star-o fa-stack-2x"></i></span>
										<?php } ?>
									<?php } ?>
								</div>
								<?php }else{ ?>
								<div class="rating">
									<?php for ($j = 1; $j <= 5; $j++) { ?>
									<span class="fa fa-stack"><i class="fa fa-star-o fa-stack-2x"></i></span>
									<?php } ?>
								</div>
								<?php 	}
									}
								?>

								<?php if($display_description == 1 || $display_price == 1 || $display_addtocart == 1 || $display_wishlist == 1 || $display_compare == 1 || $display_readmore_link == 1) { ?>
									<!-- Begin item-content -->
	
										<?php if($display_description) { ?>
											<div class="item-des">
												<?php echo html_entity_decode($product['description']); ?>
											</div>
										<?php } ?>

										<?php if($display_price) { ?>
											<div  class="price">
												<?php if (!$product['special']) { ?>
												<span class="price-new">
													<?php echo $product['price']; ?>
												</span>
												<?php } else { ?>
													<span class="price-new"><?php echo $product['special']; ?></span>&nbsp;&nbsp;
													<span class="price-old"><?php echo $product['price']; ?></span>&nbsp;
												<?php } ?>
												<?php if ($product['tax']) { ?>
													<span class="price-percent-reduction hidden"><?php echo $objlang->get('text_tax'); ?> <?php echo $product['tax']; ?></span>
												<?php } ?>
											</div>
										<?php } ?>

										

										<?php if ($display_readmore_link == 1 && $products_style != 'style1' && $products_style !='style2') { ?>
										<div class="item-readmore">
											<a href="<?php echo $product['href'];?>" title="<?php echo $product['name']; ?>" target="<?php echo $item_link_target;?>" >
												<?php echo $readmore_text ; ?>
											</a>
										</div>
										<?php } ?>

									<!-- End item-content -->
								<?php } ?>
									</div>
								<?php } ?>
								<?php if($display_addtocart || $display_readmore_link || $display_wishlist || $display_compare) { ?>
									<div class="button-group">
										<?php if ($display_addtocart == 1) { ?>
										<!--<button  class="addToCart btn-button" type="button" onclick="cart.add('<?php //echo $product['product_id']; ?>');">
											
											<?php //echo $objlang->get('button_cart'); ?>
											
										</button>-->
										
										<a class="new_product_but" href="<?php echo $product['href'];?>">Посмотреть</a>
										
										<?php } ?>
										<?php if ($display_wishlist == 1) { ?>
										<button class="wishlist btn-button" type="button" data-toggle="tooltip" title="<?php echo $objlang->get('button_wishlist'); ?>" onclick="wishlist.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-heart"></i></button>
										<?php } ?>
										<?php if ($display_compare == 1) { ?>
										<button class="compare btn-button" type="button" data-toggle="tooltip" title="<?php echo $objlang->get('button_compare'); ?>" onclick="compare.add('<?php echo $product['product_id']; ?>');"><i class="fa fa-exchange"></i></button>
										<?php } ?>
									</div>
								<?php } ?>


								
							</div>
							<!-- End item-info -->
						<?php } ?>

					</div>
					<!-- End item-wrap-inner -->
				</div>
				<!-- End item-wrap -->
				<?php if ($i % $nb_rows == 0 || $i == $count_item) { ?>
			</div>
				<?php } ?>
			<?php } ?>

		</div>
		<!--End extraslider-inner -->
	</div>
	<script type="text/javascript">
		//<![CDATA[
		jQuery(document).ready(function ($) {
			;(function (element) {
				var $element = $(element),
						$extraslider = $(".extraslider-inner", $element),
						_delay = <?php echo $delay; ?>,
						_duration = <?php echo $duration; ?>,
						_effect = '<?php echo $effect; ?>';

				$extraslider.on("initialized.owl.carousel2", function () {
					var $item_active = $(".owl2-item.active", $element);
					if ($item_active.length > 1 && _effect != "none") {
						_getAnimate($item_active);
					}
					else {
						var $item = $(".owl2-item", $element);
						$item.css({"opacity": 1, "filter": "alpha(opacity = 100)"});
					}
					<?php if($dots == "true") { ?>
					if ($(".owl2-dot", $element).length < 2) {
						$(".owl2-prev", $element).css("display", "none");
						$(".owl2-next", $element).css("display", "none");
						$(".owl2-dot", $element).css("display", "none");
					}
					<?php }?>

					setTimeout(function() {
					   $extraslider.parent().find('.loading-placeholder').hide();
					}, 1000);

				});

				$extraslider.owlCarousel2({
					rtl: <?php echo $direction?>,
					margin: <?php echo $margin;?>,
					slideBy: <?php echo $slideBy;?>,
					autoplay: <?php echo $autoplay;?>,
					autoplayHoverPause: <?php echo $autoplayHoverPause ;?>,
					autoplayTimeout: <?php echo $autoplayTimeout; ?>,
					autoplaySpeed: <?php echo $autoplaySpeed; ?>,
					startPosition: <?php echo $startPosition; ?>,
					mouseDrag: <?php echo $mouseDrag;?>,
					touchDrag: <?php echo $touchDrag; ?>,
					autoWidth: true,
					responsive: {
						0: 	{ items: <?php echo $nb_column4;?> } ,
						480: { items: <?php echo $nb_column3;?> },
						768: { items: <?php echo $nb_column2;?> },
						992: { items: <?php echo $nb_column1;?> },
						1200: {items: <?php echo $nb_column0;?>}
					},
					dotClass: "owl2-dot",
					dotsClass: "owl2-dots",
					dots: <?php echo $dots; ?>,
					dotsSpeed:<?php echo $dotsSpeed; ?>,
					nav: <?php echo $nav; ?>,
					loop: <?php echo $loop; ?>,
					navSpeed: <?php echo $navSpeed; ?>,
					navText: ['<i class="fa fa-chevron-left"></i>', '<i class="fa fa-chevron-right"></i>'],
					navClass: ["owl2-prev", "owl2-next"]

				});

				$extraslider.on("translate.owl.carousel2", function (e) {
					<?php if($dots == "true") { ?>
					if ($(".owl2-dot", $element).length < 2) {
						$(".owl2-prev", $element).css("display", "none");
						$(".owl2-next", $element).css("display", "none");
						$(".owl2-dot", $element).css("display", "none");
					}
					<?php } ?>

					var $item_active = $(".owl2-item.active", $element);
					_UngetAnimate($item_active);
					_getAnimate($item_active);
				});

				$extraslider.on("translated.owl.carousel2", function (e) {

					<?php if($dots == "true") { ?>
					if ($(".owl2-dot", $element).length < 2) {
						$(".owl2-prev", $element).css("display", "none");
						$(".owl2-next", $element).css("display", "none");
						$(".owl2-dot", $element).css("display", "none");
					}
					<?php } ?>

					var $item_active = $(".owl2-item.active", $element);
					var $item = $(".owl2-item", $element);

					_UngetAnimate($item);

					if ($item_active.length > 1 && _effect != "none") {
						_getAnimate($item_active);
					} else {

						$item.css({"opacity": 1, "filter": "alpha(opacity = 100)"});

					}
				});

				function _getAnimate($el) {
					if (_effect == "none") return;
					//if ($.browser.msie && parseInt($.browser.version, 10) <= 9) return;
					$extraslider.removeClass("extra-animate");
					$el.each(function (i) {
						var $_el = $(this);
						$(this).css({
							"-webkit-animation": _effect + " " + _duration + "ms ease both",
							"-moz-animation": _effect + " " + _duration + "ms ease both",
							"-o-animation": _effect + " " + _duration + "ms ease both",
							"animation": _effect + " " + _duration + "ms ease both",
							"-webkit-animation-delay": +i * _delay + "ms",
							"-moz-animation-delay": +i * _delay + "ms",
							"-o-animation-delay": +i * _delay + "ms",
							"animation-delay": +i * _delay + "ms",
							"opacity": 1
						}).animate({
							opacity: 1
						});

						if (i == $el.size() - 1) {
							$extraslider.addClass("extra-animate");
						}
					});
				}

				function _UngetAnimate($el) {
					$el.each(function (i) {
						$(this).css({
							"animation": "",
							"-webkit-animation": "",
							"-moz-animation": "",
							"-o-animation": "",
							"opacity": 1
						});
					});
				}

			})("#<?php echo $tag_id ; ?>");
		});
		//]]>
	</script>
	<?php
	} else {
	   echo $objlang->get('text_noitem');
	} ?>
</div> <!-- /.modcontent -->
<?php if($post_text != '')
{
?>
	<div class="form-group">
		<?php echo html_entity_decode($post_text);?>
	</div>
<?php
}
?>

</div>
