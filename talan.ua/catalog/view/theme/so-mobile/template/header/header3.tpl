<?php 
//Check Home page
$barStatic = $mobile['barnav'] ? '' : 'bar-static';
//if($this->soconfig->is_mobile_page() || $this->soconfig->is_home_page()) : 
?>
	<header class=" bar bar-nav bar-navhome typeheader-<?php echo isset($mobile['mobileheader']) ? $mobile['mobileheader'] : '0'?> <?php echo $barStatic;?>">
		<div class=" navbar-bar ">
			<!-- LOGO -->
			<div class="menu_block">
				<div class="navbar-menu">
				   <a class="toggle-panel" href="#panel-menu">
					<div class="icon_bar"></div>
				   </a>
				</div>
				<div class="navbar-logo">
				   <?php  $this->soconfig->get_logoMobile();?> 
				</div>
				
				<script>
			
					if(window.location.pathname=='/mob/'){
						$('.navbar-logo a').on('click', function(e) {
							e.preventDefault();
						});
					}
			
				</script>
				
				<div class="header-link pull-right">
					<div class="header-wishlist">
						<a href="/login/" id="wishlist-total" class="top-link-wishlist" title="<?php echo $text_wishlist; ?>">
							<div class="icon_login"></div>
						</a>
					</div>
					<div class="header-cart">
						<a href="/cart/" class=""></a>
					</div>
				</div>
			</div>
			<div class="navbar-search">
				<!-- BOX CONTENT SEARCH -->
				<?php echo $search; ?>
			</div>
		</div>
	</header>
<?php 
//Check Subpage page
//else: ?>
	<!--<header class="bar bar-nav <?php echo $barStatic;?>">
		<a class="btn btn-link btn-nav pull-left" href="#" onClick="history.go(-1); return false;">
			<span class="icon icon-left-nav"></span>
		</a>
		<a class="btn btn-link btn-nav pull-right toggle-panel" href="#panel-menu">
			<span class="icon icon-bars"></span>
		</a>
		<h1 class="title"><?php echo $title ?></h1>
	</header>-->
<?php //endif;?>