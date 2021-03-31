<?php echo $header; ?>
<?php
//Variables Category
$devices = array('lg' => ' Desktops','md' => ' Desktops','sm' => ' Tablets','xs' => ' Phones',);
$other_catalog_column_lg = isset($other_catalog_column_lg) ? $other_catalog_column_lg : '';
$other_catalog_column_md = isset($other_catalog_column_md) ? $other_catalog_column_md : '';
$other_catalog_column_sm = isset($other_catalog_column_sm) ? $other_catalog_column_sm : '';
$other_catalog_column_xs = isset($other_catalog_column_xs) ? $other_catalog_column_xs : '';
$soconfig_pages  = array(
	'other_catalog_column_lg'=>$other_catalog_column_lg,
	'other_catalog_column_md'=>$other_catalog_column_md,
	'other_catalog_column_sm'=>$other_catalog_column_sm,
	'other_catalog_column_xs'=>$other_catalog_column_xs,
);
$short_by = !empty ($pagination) ? 'col-md-9 col-sm-8' : 'col-xs-12';

/*CHECK COOKIE LISTINGTYPE*/	
if(isset($_COOKIE["listingType"])) $listingType = $_COOKIE["listingType"];
else $listingType =  isset($data['product_catalog_mode']) && $data['product_catalog_mode'] ? 'list' : 'grid';
?>
<div class="container content-main">
	<!-- BREADCRUMB -->
    <div class="breadcrumbs">
      <div class="current-name">
        <?php
        $last = count($breadcrumbs);
        $i = 0;
         foreach ($breadcrumbs as $breadcrumb => $crumbInfo) : 
          $i++;
        ?>
          <?php if ($i==$last) : ?>
            <?php echo $crumbInfo['text']; ?>
          <?php  endif;  ?>
        <?php endforeach; ?>
      </div>
        <? require('catalog/view/theme/so-destino/template/common/breadcrumb.tpl'); ?>
    </div>
  
	<div class="row">
		<?php echo $column_left; ?>
	    <?php if ($column_left && $column_right) { ?>
	    <?php $class = 'col-sm-6'; ?>
	    <?php } elseif ($column_left || $column_right) { ?>
	    <?php $class = 'col-sm-12 col-md-9 col-xs-12'; ?>
	    <?php } else { ?>
	    <?php $class = 'col-sm-12'; ?>
	    <?php } ?>
		
	    <div id="content" class="<?php echo $class; ?>"><?php echo $content_top; ?>
	        <div class="products-category">
				
			<?php if ($products) { ?>
				<!-- Filters -->
				<div class="product-filter filters-panel">
				  <div class="row">
					<div class="col-sm-2 view-mode hidden-sm hidden-xs">
						<div class="list-view">
							<button class="btn btn-default grid <?php if($listingType =='grid') { echo 'active'; } ?>"  data-toggle="tooltip" title="<?php echo $button_grid; ?>"><i class="fa fa-th-large"></i></button>
							<button class="btn btn-default list <?php if($listingType =='list') { echo 'active'; } ?>"  data-toggle="tooltip" title="<?php echo $button_list; ?>"><i class="fa fa-bars"></i></button>
						</div>
					</div>
					<div class="short-by-show form-inline text-right col-md-10 col-sm-12">
						<div class="form-group short-by">
							<label class="control-label" for="input-sort"><?php echo $text_sort; ?></label>
							<select id="input-sort" class="form-control" onchange="location = this.value;">
							  <?php foreach ($sorts as $sorts2) { ?>
							  <?php if ($sorts2['value'] == $sort . '-' . $order) { ?>
							  <option value="<?php echo $sorts2['href']; ?>" selected="selected"><?php echo $sorts2['text']; ?></option>
							  <?php } else { ?>
							  <option value="<?php echo $sorts2['href']; ?>"><?php echo $sorts2['text']; ?></option>
							  <?php } ?>
							  <?php } ?>
							</select>
						</div>

						<div class="form-group">
							<label class="control-label" for="input-limit"><?php echo $text_limit; ?></label>
							<select id="input-limit" class="form-control" onchange="location = this.value;">
							  <?php foreach ($limits as $limits2) { ?>
							  <?php if ($limits2['value'] == $limit) { ?>
							  <option value="<?php echo $limits2['href']; ?>" selected="selected"><?php echo $limits2['text']; ?></option>
							  <?php } else { ?>
							  <option value="<?php echo $limits2['href']; ?>"><?php echo $limits2['text']; ?></option>
							  <?php } ?>
							  <?php } ?>
							</select>
						</div>
						
						<div class="product-compare form-group" style="margin: 0 10px"><a href="<?php echo $compare; ?>" id="compare-total" class="btn btn-default"><?php echo $text_compare; ?></a></div>
					
					</div>
					
				  </div>
				</div>
				<!-- //end Filters -->
				
				<!--Changed Listings-->
				<div class="products-category">
				<?php 
					if (file_exists(DIR_TEMPLATE . $theme . '/template/soconfig/listing.php')) include(DIR_TEMPLATE.$theme.'/template/soconfig/listing.php');
					else echo 'Not found';
				?>
				</div>
				<!--// End Changed listings-->
				
				<!-- Filters -->
				<div class="product-filter product-filter-bottom filters-panel">
				  
				   <div class="short-by-show  <?php echo $short_by;?>">
						<div class="form-group" style="margin: 0"><?php echo $results; ?></div>
					</div>
					<?php if (!empty($pagination)){?>
						<div class="box-pagination col-md-3 col-sm-4 text-right"><?php echo $pagination; ?></div>
					<?php }?>
					
				</div>
				<!-- //end Filters -->
			
			<?php } ?>
		    </div>
		</div>	 
		
		<script type="text/javascript"><!--
		 $('.view-mode .list-view button').bind("click", function() {
			if ($(this).is(".active")) {return false;}
			$.cookie('listingType', $(this).is(".grid") ? 'grid' : 'list', { path: '/' });
			location.reload();
		});
		//--></script> 
		<?php echo $content_bottom; ?>
		<?php echo $column_right; ?>
	</div>
</div>
<?php echo $footer; ?>

