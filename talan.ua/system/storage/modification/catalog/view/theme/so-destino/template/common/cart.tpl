
<div id="cart" class="btn-shopping-cart">
  <a data-loading-text="<?php echo $text_loading; ?>" class="btn-group top_cart dropdown-toggle" data-toggle="dropdown">
    <div class="shopcart">
    <span class="handle pull-left">
     <!--<i class="fa fa-shopping-cart"></i>--> <img src="image/catalog/talan_img/feather_shopping-cart.svg" alt="">
    </span>


    <!-- <span class="text-shopping-cart-mobi hidden-lg hidden-md hidden-sm ">
      <i class="fa fa-cart-plus"></i>
    </span> --> 

		
    </div>
<div class="count block__cart-ount"><?php echo $count; ?></div>
  </a>


  <ul class="dropdown-menu pull-right shoppingcart-box">
      <?php if ($products || $vouchers) { ?>
	  <?php if(count($products) >3):?>
      <li>
          <div class="added_items"><?php echo (count($products) <= 3 ? '' : 'Last 3 added item(s) from '.count($products)) ; ?></div>
      </li>
	  <?php endif; ?>
	  
      <li class="content-item">
          <table class="table table-striped">
        <?php
         $i = 0;
         $products1 = array_reverse($products);
         ?>
              <?php foreach ($products1 as $product) : ?>
              <?php $i ++; ?>
                  <?php if ($i < 100): ?>
                  <tr>
                      <td class="text-center size-img-cart">
                          <?php if ($product['thumb']) { ?>
                            <a href="<?php echo $product['href']; ?>">
                                <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" title="<?php echo $product['name']; ?>" class="preview" />
                            </a>
                          <?php } ?>
                      </td>
                      <td class="text-left">
                          <a class="cart_product_name" href="<?php echo $product['href']; ?>"><?php echo $product['name']; ?></a>
                          <?php if ($product['option']) { ?>
                          <?php foreach ($product['option'] as $option) { ?>
                          <br />
                          - <small><?php echo $option['name']; ?> <?php echo $option['value']; ?></small>
                          <?php } ?>
                          <?php } ?>
                          <?php if ($product['recurring']) { ?>
                          <br />
                          - <small><?php echo $text_recurring; ?> <?php echo $product['recurring']; ?></small>
                          <?php } ?>
                      </td>
                        <td class="text-center count_numb">
                            x <?php echo $product['quantity']; ?>
                        </td>
                        <td class="text-center">
                             <?php echo $product['total']; ?>
                        </td>
                       
                        <td class="text-right">
                            <a onclick="cart.remove('<?php echo $product['cart_id']; ?>');" class="fa fa-trash-o" style="padding:3px;"></a>
                        </td>
                  </tr>
                  <?php endif; ?>
              <?php endforeach; ?>
              <?php foreach ($vouchers as $voucher) { ?>
              <tr>
                  <td class="text-center"></td>
                  <td class="text-left"><?php echo $voucher['description']; ?></td>
                  <td class="text-right">x&nbsp;1</td>
                  <td class="text-right"><?php echo $voucher['amount']; ?></td>
                  <td class="text-center text-danger">
                      <button type="button" onclick="voucher.remove('<?php echo $voucher['key']; ?>');" title="<?php echo $button_remove; ?>" class="btn btn-danger btn-xs">
                          <i class="fa fa-times"></i>
                      </button>
                  </td>
              </tr>
              <?php } ?>
          </table>
      </li>
      <li>
	
		<div class="checkout clearfix">
            <a href="<?php echo $cart; ?>" class="btn btn-view-cart inverse"><?php echo $text_cart; ?></a>

            <script type="text/javascript">
            function clearCart() {
                $.ajax({
                  url: 'index.php?route=checkout/cart/clearcart',
                  dataType: 'json',
                  success: function(json) {
                      $('#cart-total').html(json['total']);
                      if (getURLVar('route') == 'checkout/cart' || getURLVar('route') == 'checkout/checkout') {
                          location = 'index.php?route=checkout/cart';
                      } else {
                          $('#cart > ul').load('index.php?route=common/cart/info ul li');
                      }
                  }
              });
            }
            </script>
            <a onclick="clearCart();" class="btn btn-view-cart inverse" style="color: #f00;"><?php echo $button_clearcart; ?></strong></a>&nbsp;&nbsp;&nbsp;<a href="<?php echo $cart; ?>"><strong>
            
            <a href="<?php echo $checkout; ?>" class="btn btn-checkout pull-right"><?php echo $text_checkout; ?></a>
        </div>
      </li>
      <?php } else { ?>
      <li>
          <p class="text-center empty"><?php echo $text_empty; ?></p>
      </li>
      <?php } ?>
  </ul>
</div>


<style>

.inverse{
	color: #fff !important;
}

</style>

