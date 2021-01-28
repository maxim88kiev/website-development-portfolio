<?php
class ControllerExtensionModuleSpecial extends Controller {
	public function index($setting) {
		$this->load->language('extension/module/special');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();

		$filter_data = array(
			'sort'  => 'pd.name',
			'order' => 'ASC',
			'start' => 0,
			'limit' => $setting['limit']
		);

		$results = $this->model_catalog_product->getProductSpecials($filter_data);

		if ($results) {
			foreach ($results as $result) {
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height']);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
				}

$this->document->addScript('catalog/view/javascript/jquery/jquery.images-rotation.js');
				
				$flip_images = array();
				
				$flips = $this->model_catalog_product->getProductImages($result['product_id']);
				
				foreach($flips as $flip){
					$flip_images[] = array(
						'flipimage' => $this->model_tool_image->resize($flip['image'], $setting['width'], $setting['height']),
						'flipid'    => $flip['product_image_id']
					);
				}
				
				if ($this->customer->isLogged() || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

                $data['priceInt'] = $this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax'));
            
				} else {
					$price = false;
				}


                $specialSavings =0; 
            
				if ((float)$result['special']) {
					$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')), $this->session->data['currency']);

                $data['specialInt'] = $this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax'));
                $data['specialSavings'] = round((($data['priceInt']-$data['specialInt'])/$data['priceInt'])*100, 2);
				$specialSavings = $data['specialSavings'];
            
				} else {
					$special = false;
				}

				if ($this->config->get('config_tax')) {
					$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price'], $this->session->data['currency']);
				} else {
					$tax = false;
				}

				if ($this->config->get('config_review_status')) {
					$rating = $result['rating'];
				} else {
					$rating = false;
				}

				$data['products'][] = array(
					'product_id'  => $result['product_id'],
					'thumb'       => $image,

				'rthumbs'	  => $flip_images,
				
					'name'        => $result['name'],
					'description' => utf8_substr(trim(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8'))), 0, $this->config->get('theme_' . $this->config->get('config_theme') . '_product_description_length')) . '..',
					'price'       => $price,
					'special'     => $special,

                'specialSavings'     => $specialSavings,
            
					'tax'         => $tax,
					'rating'      => $rating,
					'href'        => $this->url->link('product/product', 'product_id=' . $result['product_id'])
				);
			}

			return $this->load->view('extension/module/special', $data);
		}
	}
}