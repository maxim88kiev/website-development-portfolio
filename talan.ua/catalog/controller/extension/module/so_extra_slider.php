<?php
class ControllerExtensionModuleSoextraslider extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/so_extra_slider');
		$data['heading_title'] = $this->language->get('heading_title');
		$data['text_tax'] = $this->language->get('text_tax');
		
		$this->load->model('catalog/category');
		$this->load->model('catalog/product');
		$this->load->model('extension/module/so_extra_slider');
		$this->load->model('tool/image');
		$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/style.css');
		$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/css3.css');
		if (!defined ('OWL_CAROUSEL'))
		{
			$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/animate.css');
			$this->document->addStyle('catalog/view/javascript/so_extra_slider/css/owl.carousel.css');
			$this->document->addScript('catalog/view/javascript/so_extra_slider/js/owl.carousel.js');
			define( 'OWL_CAROUSEL', 1 );
		}
		
		$setting['category'] = self::processCategory($setting['category']); // check category (disable)
		$default = array(
			'objlang'				=> $this->language,
			'name' 					=> '',
			'module_description'	=> array(),
			'disp_title_module'		=> '1',
			'status'				=> '1',
			'class_suffix'			=> '',
			'type_layout'		=> '0',
			'item_link_target'		=> '_blank',
			'products_style'		=> 'style1',	
			'nb_column0'			=> '4',
			'nb_column1'			=> '4',
			'nb_column2'			=> '3',
			'nb_column3'			=> '2',
			'nb_column4'			=> '1',
			'nb_row'				=> '1',
			
			'categorys'				=> array(),
			'child_category'		=> '1',	
			'category_depth'		=> '1',
			'product_sort'			=> 'p.price',
			'product_ordering'		=> 'ASC',
			'limitation'			=> '6',
			
			'display_title'			=> '1',
			'title_maxlength'		=> '50',
			'display_description'	=> '1',
			'description_maxlength' => '100',
			'display_price'			=> '1',
			'display_readmore_link' => '1',
			'readmore_text' 		=> 'Readmore',
			'display_add_to_cart'	=> '1',
			'display_wishlist' 		=> '1',
			'display_compare'		=> '1',
			'display_rating'		=> '1',
			'display_sale'			=> '1',
			'display_new'			=> '1',
			'date_day'				=> '7',
			'product_image_num' 	=> '1',
			
			'product_image'			=> '1',
			'product_get_image_data'=> '1',
			'product_get_image_image'=> '1',
			'width'					=> '200',
			'height'				=> '200',
			'placeholder_path'		=> 'nophoto.png',
			'margin'				=> '5',
			'slideBy'				=> '1',
			'autoplay'				=> '0',
			'autoplayTimeout'		=> '5000',
			'autoplayHoverPause'	=> '0',
			'autoplaySpeed'			=> '1000',
			'smartSpeed'			=> '1000',
			'startPosition'			=> '0',
			'mouseDrag'				=> '1',
			'touchDrag'				=> '1',
			'pullDrag'				=> '1',
			'button_page' 			=> 'top',
			'dots'					=> '1',
			'dotsSpeed'				=> '500',
			'loop'					=> '1',
			'navs'					=> '1',
			'navSpeed'				=> '500',
			'effect'				=> 'starwars',
			'duration'				=> '800',
			'delay'					=> '500',
			
			'post_text'				=> '',
			'pre_text'				=> '',
			'use_cache'				=> '1',
			'cache_time'			=> '3600',
			'direction'				=> ($this->language->get('direction') == 'rtl' ? 'true' : 'false'),
			'direction_class'		=> ($this->language->get('direction') == 'rtl' ? 'so-extraslider-rtl' : 'so-extraslider-ltr')
		);
		$data = array_merge($default,$setting);
		if($setting['category']){
			if($setting['child_category'] && $setting['category'])
			{
				for($i=1; $i<=$setting['category_depth'];$i++)
				{
					foreach ($setting['category'] as $categorys)
					{
						$filter_data = array(
							'category_id'  => $categorys,
						);
						$categoryss = $this->model_extension_module_so_extra_slider->getCategories_son($filter_data);
						foreach ($categoryss as $category)
						{
							$setting['category'][]  = $category['category_id'];
						}
					}

				}
				$setting['category'] = array_unique($setting['category']);
			}
			$str_categorys = implode(",",$setting['category']);
			$filter_data = array(
				'filter_category_id'  => $str_categorys,
				'sort'         => $setting['product_sort'],
				'order'        => $setting['product_ordering'],
				'limit'        => $setting['limitation'] ,
				'start'        => '0'
			);

			$products_arr = $this->model_extension_module_so_extra_slider->getProducts_extra_slider($filter_data);
			
			if (!isset($setting['limit'])) {
				$setting['limit'] = 3;
			}
			if (!isset($setting['width'])) {
				$setting['width'] = 100;
			}
			if (!isset($setting['height'])) {
				$setting['height'] = 200;
			}
			
			$data['products'] = array();
			if(!empty($products_arr)){
				foreach($products_arr as $product_info)
				{
					$product_image = $this->model_extension_module_so_extra_slider->getImageExtra_slider($product_info['product_id']);
					$product_image_first = array_shift($product_image);
					$image2 = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					if($product_image_first != null)
					{
						$image2 = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
					}
					if ($product_info['image'] && $setting['product_get_image_data'] && $setting['product_image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					}elseif($product_image_first['image'] && $setting['product_get_image_image'] && $setting['product_image']){
						$image = $this->model_tool_image->resize($product_image_first['image'], $setting['width'], $setting['height']);
					} else {
						$url = file_exists("image/so_extra_slider/images/".$setting['placeholder_path']);
							if ($url) {
								$image_name = "so_extra_slider/images/".$setting['placeholder_path'];
							} else {
								$image_name = "no_image.png";
							}
							$image = $this->model_tool_image->resize($image_name, $setting['width'], $setting['height']);
					}
					// Check Version
					if(version_compare(VERSION, '2.1.0.2', '>')) {
						if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
						} else {
							$price = false;
						}
					
						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
							$discount = '-'.round((($product_info['price'] - $product_info['special'])/$product_info['price'])*100, 0).'%';
						} else {
							$special = false;
							$discount = false;
						}

						if ($this->config->get('config_tax')) {
							$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price'], $this->session->data['currency']);
						} else {
							$tax = false;
						}

						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
					} else {
						if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
							$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$price = false;
						}

						if ((float)$product_info['special']) {
							$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
						} else {
							$special = false;
						}

						if ($this->config->get('config_tax')) {
							$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
						} else {
							$tax = false;
						}

						if ($this->config->get('config_review_status')) {
							$rating = $product_info['rating'];
						} else {
							$rating = false;
						}
					}
					$name = ((strlen($product_info['name']) > $setting['title_maxlength'] && $setting['title_maxlength'] !=0)  ? utf8_substr(strip_tags(html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')), 0, $setting['title_maxlength']) . '..' : $product_info['name']);
					$description = ((strlen($product_info['description']) > $setting['description_maxlength'] && $setting['description_maxlength'] != 0) ? utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $setting['description_maxlength']) . '..' : $product_info['description']);
					
					$datetimeNow = new DateTime();
					$datetimeCreate = new DateTime($product_info['date_available']);
					$interval = $datetimeNow->diff($datetimeCreate);
					$dateDay = $interval->format('%a');
					$productNew = ($dateDay <= $setting['date_day'] ? 1 : 0);
					$data['products'][] = array(
						'product_id'  	=> $product_info['product_id'],
						'thumb'       	=> $image,
						'thumb2'       	=> $image2,
						'name'        	=> $name,
						'nameFull'		=> $product_info['name'],
						'description' 	=> $description,
						'price'       	=> $price,
						'special'     	=> $special,
						'discount'      => $discount,
						'productNew'	=> $productNew,	
						'tax'         	=> $tax,
						'rating'      	=> $rating,
						'href'        	=> $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);

				}
			}
			
		}
		
		
		$data['display_addtocart'] = $setting['display_add_to_cart'];
	
		
		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['head_name'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['head_name'], ENT_QUOTES, 'UTF-8');
		}else{
			$data['head_name']  = html_entity_decode($setting['head_name'], ENT_QUOTES, 'UTF-8');
			
		}
		$data['moduleid']  = $setting['moduleid'];
		$data['disp_title_module'] = (int)$setting['disp_title_module'];
		$data['autoplay'] = $setting['autoplay'];
		if ($data['autoplay'] == 1) {
			$data['autoplayTimeout'] = $setting['autoplayTimeout'];
		}else{
			$data['autoplayTimeout'] = 0;
		}
		$data['dots'] 	= ($setting['dots'] == 1) ? "true" : "false";
		$data['loop'] 					= ($setting['loop'] == 1 ? "true" : "false");
		$data['nav'] 					= ($setting['navs'] == 1 ? "true" : "false");
		$data['nb_rows'] = $setting['nb_row'];
		$data['count'] = $setting['limitation'];
		$readmore = html_entity_decode($setting['readmore_text']);
		if($readmore){
			$data['readmore_text'] = $readmore;
		}else{
			$data['readmore_text'] = 'Read more';
		}
		
		// caching
		$use_cache = (int)$setting['use_cache'];
		$cache_time = (int)$setting['cache_time'];
		$folder_cache = DIR_CACHE.'so/ExtraSlider/';
		if(!file_exists($folder_cache))
			mkdir ($folder_cache, 0777, true);
		if (!class_exists('Cache_Lite'))
			require_once (DIR_SYSTEM . 'library/so/extra_slider/Cache_Lite/Lite.php');

		$options = array(
			'cacheDir' => $folder_cache,
			'lifeTime' => $cache_time
		);
		$Cache_Lite = new Cache_Lite($options);
		$_data = '';

		//=== Theme Custom Code====
		if ($use_cache){
			$this->hash = md5( serialize($setting));
			$_data = $Cache_Lite->get($this->hash);
			if (!$_data) {
				$_data = $this->getLayoutMod('so_extra_slider',$data,$data['type_layout']);
				$Cache_Lite->save($_data);
				return  $_data;
			} else {
				return  $_data;
			}
		}else{
			if(file_exists($folder_cache))$Cache_Lite->_cleanDir($folder_cache);
			$_data = $this->getLayoutMod('so_extra_slider',$data,$data['type_layout']);
			return  $_data;
		}
		

	}
	
	//=== Theme Custom Code====
	public function getLayoutMod($name=null,$data,$type_layout){
		
		$log_directory  = DIR_TEMPLATE.$this->config->get('theme_default_directory').'/template/extension/module/'.$name;
		if(!file_exists($log_directory)) $log_directory  = DIR_TEMPLATE.'/default/template/extension/module/'.$name;
        
		if (is_dir($log_directory)) {
			$files = scandir($log_directory);
			foreach ($files as  $value) {
				if (strpos($value, '.tpl') == true) {
					$fileNames[] = $value;
				}
			}
		} 
		$fileNames = isset($fileNames) ? $fileNames : '';
		foreach($fileNames as $option_id => $option_value){
			if($option_id == $type_layout){
				$type_morelayout = $this->load->view('extension/module/'.$name.'/'.$option_value, $data);
			}
		}
		return $type_morelayout;
	}
	
	private function processCategory($catids)
	{
		$catpubid = array();
		if (empty($catids)) return;
		foreach ($catids as $i => $cid) {
			$category = $this->model_catalog_category->getCategory($cid);
			$cats[$i] = $category;
			if (empty($category)) {
				unset($cats[$i]);
			} else {
				$catpubid[] = $category['category_id'];
			}
		}
		return $catpubid;
	}

}