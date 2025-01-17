<?php
class ControllerExtensionModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
$data['text_no_price'] = sprintf($this->language->get('text_no_price'), $this->url->link('information/contact'));

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					if ($product_info['image']) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}

					if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);
					} else {
						$special = false;
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


                 /***theme's changes***/
                $data['store_id'] = $this->config->get('config_store_id');
				$store_id = $this->config->get('config_store_id');
                $data['lang'] = $this->config->get('config_language_id');
				$lang = $this->config->get('config_language_id');
				$data['theme'] = $this->config->get('theme_default_directory');
				$data['registry'] = $this->registry;
				$data['our_url'] = $this->registry->get('url');
				$this->load->model('soconfig/general');
				
                /* PAGE PRODUCT */
				$text_config = array(
					'product_catalog_mode',
					'other_catalog_column_lg',
					'other_catalog_column_md',
					'other_catalog_column_sm',
					'other_catalog_column_xs',
					'secondimg',
					'rating_status',
					'lstdescription_status',
					'sale_status',
					'new_status',
					'days',
					'quick_status',
					'discount_status',
					'countdown_status',
					'sale_text',
					'new_text',
					'quick_view_text',
					'scroll_animation',
				);
				
				foreach ($text_config as $text ) {
					$data[$text] = $this->soconfig->get_settings($text);
				}
		
				
				//Language Variables
				$this->load->language('extension/soconfig/soconfig');
				$data['lang_todaysdeal'] = $this->language->get('lang_todaysdeal');
				$data["view_details"]  	= $this->language->get('view_details');
				$data['countdown_title_day'] 	= $this->language->get('countdown_title_day');
				$data['countdown_title_hour'] 	= $this->language->get('countdown_title_hour');
				$data['countdown_title_minute'] = $this->language->get('countdown_title_minute');
				$data['countdown_title_second'] = $this->language->get('countdown_title_second');
                /***end theme's changes***/
            

				if ((float)$product_info['special']) {
                    $discount = '-'.round((($product_info['price'] - $product_info['special'])/$product_info['price'])*100, 0).'%';
                } else {
                    $discount = false;
                }
			   

					// XD Stickers start
						$this->load->model('setting/setting');
						$xd_stickers = $this->config->get('xd_stickers');
						$current_language_id = $this->config->get('config_language_id');
						$product_xd_stickers = array();
						if ($xd_stickers['status']) {
							if ($xd_stickers['sold']['status'] == '1') {
								if ($product_info['quantity'] <= 0) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_sold',
										'text'			=> $xd_stickers['sold']['text'][$current_language_id]
									);
								}
							}
							if ($xd_stickers['sale']['status'] == '1') {
								if ((float)$product_info['special']) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_sale',
										'text'			=> $xd_stickers['sale']['text'][$current_language_id]
									);
								}
							}
							if ($xd_stickers['bestseller']['status'] == '1') {
								$bestsellers = $this->model_catalog_product->getBestSellerProducts((int)$xd_stickers['bestseller']['property']);
								foreach ($bestsellers as $bestseller) {
									if ($bestseller['product_id'] == $product_info['product_id']) {
										$product_xd_stickers[] = array(
											'id'			=> 'xd_sticker_bestseller',
											'text'			=> $xd_stickers['bestseller']['text'][$current_language_id]
										);
									}
								}
							}
							if ($xd_stickers['novelty']['status'] == '1') {
								if ((strtotime($product_info['date_added']) + intval($xd_stickers['novelty']['property']) * 24 * 3600) > time()) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_novelty',
										'text'			=> $xd_stickers['novelty']['text'][$current_language_id]
									);
								}
							}
							if ($xd_stickers['last']['status'] == '1') {
								if ($product_info['quantity'] <= intval($xd_stickers['last']['property']) && $product_info['quantity'] > 0) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_last',
										'text'			=> $xd_stickers['last']['text'][$current_language_id]
									);
								}
							}
							if ($xd_stickers['freeshipping']['status'] == '1') {
								if ((float)$product_info['special'] >= intval($xd_stickers['freeshipping']['property'])) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_freeshipping',
										'text'			=> $xd_stickers['freeshipping']['text'][$current_language_id]
									);
								} else if ((float)$product_info['price'] >= intval($xd_stickers['freeshipping']['property'])) {
									$product_xd_stickers[] = array(
										'id'			=> 'xd_sticker_freeshipping',
										'text'			=> $xd_stickers['freeshipping']['text'][$current_language_id]
									);
								}
							}

							// CUSTOM stickers
							$this->load->model('extension/module/xd_stickers');
							$custom_xd_stickers_id = $this->model_extension_module_xd_stickers->getCustomXDStickersProduct($product_info['product_id']);
							if (!empty($custom_xd_stickers_id)) {
								foreach ($custom_xd_stickers_id as $custom_xd_sticker_id) {
									$custom_xd_sticker = $this->model_extension_module_xd_stickers->getCustomXDSticker($custom_xd_sticker_id['xd_sticker_id']);
									$custom_xd_sticker_text = json_decode($custom_xd_sticker['text'], true);
									// var_dump($custom_xd_sticker);
									if ($custom_xd_sticker['status'] == '1') {
										$custom_sticker_class = 'xd_sticker_' . $custom_xd_sticker_id['xd_sticker_id'];
										$product_xd_stickers[] = array(
											'id'			=> $custom_sticker_class,
											'text'			=> $custom_xd_sticker_text[$current_language_id]
										);
									}
								}
							}
						}
					// XD Stickers end
				
					$data['products'][] = array(

					'product_xd_stickers'  => $product_xd_stickers,
				
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get($this->config->get('config_theme') . '_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,

				'special_end_date'  => $this->model_soconfig_general->getDateEnd($product_info['product_id']),
				'date_available'  => $product_info['date_available'],
				'discount'  => $discount,
			   
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id'])
					);
				}
			}
		}

		if ($data['products']) {
			return $this->load->view('extension/module/featured', $data);
		}
	}
}