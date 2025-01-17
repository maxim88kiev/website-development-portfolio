jQuery(document).ready(function($) {
	$('.so-groups-sticky .sticky-backtop').on('click', function() {
		$('html, body').animate({ scrollTop: 0 }, 'slow', function () {});
	});

	$('.so-groups-sticky *[data-target="popup"]').on('click', function() {
		$('html').addClass('overflow-hidden');
		$($(this).attr('data-popup')).removeClass('popup-hidden');
		$('.popup').animate({
			scrollTop:'0px'
		}, 500);
	});

	$('.so-groups-sticky *[data-target="popup-close"]').on('click', function() {
		$('html').removeClass('overflow-hidden');
		$($(this).attr('data-popup-close')).addClass('popup-hidden');
	});

	$(document).keyup(function(e) {
	     if (e.keyCode == 27) {
	        $('html').removeClass('overflow-hidden');
			$('.so-groups-sticky .popup').addClass('popup-hidden');
	    }
	});

	$('.so-groups-sticky .nav-secondary ul li span i').click(function(){
		if ($(this).hasClass('more')) {
			$('.so-groups-sticky .nav-secondary ul li').removeClass('active');
			$(this).parent().parent().addClass('active');
	    	$(this).parent().parent().children('ul').stop(true, true).slideDown('slow');
	    	$('.so-groups-sticky .nav-secondary ul li').each(function() {
				if ($(this).hasClass('active')) {
					$(this).parent('ul').parent('li').addClass('active');
					$(this).children('ul').slideDown('slow');
				}
			})
			$('.so-groups-sticky .nav-secondary ul li:not(".active") ul').stop(true, true).slideUp('slow');
	    }
	    else {
	    	$(this).parent().parent().children('ul').stop(true, true).slideUp('slow');
	    	$(this).parent().parent().removeClass('active');
	    }
	});

	$('.so-groups-sticky #button-search, .so-groups-sticky .sbmsearch').on('click', function() {
		$('.so-groups-sticky #button-search').attr('disabled','disabled');
		$('.so-groups-sticky #button-search').addClass('loading disabled');
		$('.so-groups-sticky #button-search').prepend('<i class="fa fa-refresh fa-spin"></i>');
		var url = $('base').attr('href') + 'index.php?route=product/search';
		var value = $('.so-groups-sticky #input-search').val();
		if (value) {
			url += '&search=' + encodeURIComponent(value);
		}
		location = url;
	});
	$('.so-groups-sticky #input-search').on('keydown', function(e) {
		if (e.keyCode == 13) {
			$('.so-groups-sticky #button-search').trigger('click');
		}
	});

	$('.so-groups-sticky select[name="select-currency"]').on('change', function() {
		$(this).attr('disabled','disabled');
		$('#form-currency input[name="code"]').val(this.value);
		$('#form-currency').submit();
	});

	$('.so-groups-sticky select[name="select-language"]').on('change', function() {
		$(this).attr('disabled','disabled');
		$('#form-language input[name="code"]').val(this.value);
		$('#form-language').submit();
	});
})

var cart = {
	'add': function(product_id, quantity) {
		$.ajax({
			url: 'index.php?route=extension/module/so_tools/add_cart',
			type: 'post',
			data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				$('.alert, .text-danger').remove();

				if (json['redirect']) {
					location = json['redirect'];
				}

				if (json['success']) {
					$('#wrapper').before('<div class="alert alert-success"><i class="fa fa-check-circle"></i> ' + json['success'] + ' <button type="button" class="fa fa-close close" data-dismiss="alert"></button></div>');
					$('#cart  .total-shopping-cart ').html(json['total'] );
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
					timer = setTimeout(function () {
						$('.alert').addClass('fadeOut');
					}, 4000);

					$('.so-groups-sticky .popup-mycart .popup-content').load('index.php?route=extension/module/so_tools/info .popup-content .cart-header');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'update': function(key, quantity) {
		$.ajax({
			url: 'index.php?route=checkout/cart/edit',
			type: 'post',
			data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					$('#cart .total-shopping-cart').html(json['total']);
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
					$('.so-groups-sticky .popup-mycart .popup-content').load('index.php?route=extension/module/so_tools/info .popup-content .cart-header');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=extension/module/so_tools/remove_cart',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					$('#cart .total-shopping-cart').html(json['total']);
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
					$('.so-groups-sticky .popup-mycart .popup-content').load('index.php?route=extension/module/so_tools/info .popup-content .cart-header');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}

var voucher = {
	'add': function() {

	},
	'remove': function(key) {
		$.ajax({
			url: 'index.php?route=extension/module/so_tools/remove_cart',
			type: 'post',
			data: 'key=' + key,
			dataType: 'json',
			beforeSend: function() {
				$('#cart > button').button('loading');
			},
			complete: function() {
				$('#cart > button').button('reset');
			},
			success: function(json) {
				// Need to set timeout otherwise it wont update the total
				setTimeout(function () {
					//$('#cart > button').html('<span id="cart-total"><i class="fa fa-shopping-cart"></i> ' + json['total'] + '</span>');
					$('#cart .total-shopping-cart').html(json['total']);
				}, 100);

				if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
					location = 'index.php?route=checkout/cart';
				} else {
					$('#cart > ul').load('index.php?route=common/cart/info ul li');
					$('.so-groups-sticky .popup-mycart .popup-content').load('index.php?route=extension/module/so_tools/info .popup-content .cart-header');
				}
			},
			error: function(xhr, ajaxOptions, thrownError) {
				alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
			}
		});
	}
}