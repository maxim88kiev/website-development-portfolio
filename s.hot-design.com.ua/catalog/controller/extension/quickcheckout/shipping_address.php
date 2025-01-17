<?php
class ControllerExtensionQuickCheckoutShippingAddress extends Controller {
	public function index() {
		$data = $this->load->language('checkout/checkout');
		$data = array_merge($data, $this->load->language('extension/quickcheckout/checkout'));

		if (isset($this->session->data['shipping_address']['address_id'])) {
			$data['address_id'] = $this->session->data['shipping_address']['address_id'];
		} else {
			$data['address_id'] = $this->customer->getAddressId();
		}

		$this->load->model('account/address');

		$data['addresses'] = $this->model_account_address->getAddresses();

		if (isset($this->session->data['shipping_postcode'])) {
			$data['postcode'] = $this->session->data['shipping_postcode'];
		} elseif (isset($this->session->data['shipping_address']['postcode'])) {
			$data['postcode'] = $this->session->data['shipping_address']['postcode'];
		} else {
			$data['postcode'] = '';
		}

		if (isset($this->session->data['shipping_country_id'])) {
			$data['country_id'] = $this->session->data['shipping_country_id'];
		} elseif (isset($this->session->data['shipping_address']['country_id'])) {
			$data['country_id'] = $this->session->data['shipping_address']['country_id'];
		} else {
			$country = $this->config->get('quickcheckout_field_country');

			$data['country_id'] = $country['default'];
		}

		if (isset($this->session->data['shipping_zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_zone_id'];
		} elseif (isset($this->session->data['shipping_address']['zone_id'])) {
			$data['zone_id'] = $this->session->data['shipping_address']['zone_id'];
		} else {
			$zone = $this->config->get('quickcheckout_field_zone');

			$data['zone_id'] = isset($zone['default']) ? $zone['default'] : 0;
		}

		$this->load->model('localisation/country');

		$data['countries'] = $this->model_localisation_country->getCountries();
		
		
		
		$this->load->model('localisation/city');
		
		$cities_var_cit = "";
		
		$cities_var = $this->model_localisation_city->getCities();
		
		foreach ($cities_var as $value) {
			$cities_var_cit .= "<option value='' city_id='". $value['city_id'] ."' zone_id='". $value['zone_id'] ."'>". $value['name'] ."</option>";
		}
		
		//var_dump($cities_var);
		
		$data['cities'] = $cities_var_cit;
		
		
		// Custom Fields
		$this->load->model('account/custom_field');

		$data['custom_fields'] = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

		if (isset($this->session->data['shipping_address']['custom_field'])) {
			$data['shipping_address_custom_field'] = $this->session->data['shipping_address']['custom_field'];
		} else {
			$data['shipping_address_custom_field'] = array();
		}

		// Fields
		$fields = array(
			'firstname',
			'lastname',
			'company',
			'address_1',
			'address_2',
			'city',
			'postcode',
			'country',
			'zone'
		);

		// All variables
		$data['debug'] = $this->config->get('quickcheckout_debug');

		$sort_order = array();

		foreach ($fields as $key => $field) {
			$field_data = $this->config->get('quickcheckout_field_' . $field);
			
			$field_data['default'] = !empty($field_data['default'][$this->config->get('config_language_id')]) ? $field_data['default'][$this->config->get('config_language_id')] : '';
			$field_data['placeholder'] = !empty($field_data['placeholder'][$this->config->get('config_language_id')]) ? $field_data['placeholder'][$this->config->get('config_language_id')] : '';

			$data['field_' . $field] = $field_data;

			$sort_order[$key] = $field_data['sort_order'];
		}

		array_multisort($sort_order, SORT_ASC, $fields);

		$data['fields'] = $fields;

		return $this->load->view('extension/quickcheckout/shipping_address', $data);
  	}

	public function validate() {
		$this->load->language('checkout/checkout');
		$this->load->language('extension/quickcheckout/checkout');

		$json = array();

		// Validate if customer is logged in.
		if (!$this->customer->isLogged()) {
			$json['redirect'] = $this->url->link('extension/quickcheckout/checkout', '', true);
		}

		// Validate if shipping is required. If not the customer should not have reached this page.
		if (!$this->cart->hasShipping()) {
			$json['redirect'] = $this->url->link('extension/quickcheckout/checkout', '', true);
		}

		if (!$json) {
			if (isset($this->request->post['shipping_address']) && $this->request->post['shipping_address'] == 'existing') {
				$this->load->model('account/address');

				if (empty($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				} elseif (!$this->model_account_address->getAddress($this->request->post['address_id'])) {
					$json['error']['warning'] = $this->language->get('error_address');
				}

				if (!$json) {
					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($this->request->post['address_id']);
				}
			}

			if ($this->request->post['shipping_address'] == 'new') {
				$firstname = $this->config->get('quickcheckout_field_firstname');

				if (!empty($firstname['required'])) {
					if ((utf8_strlen($this->request->post['firstname']) < 1) || (utf8_strlen($this->request->post['firstname']) > 32)) {
						$json['error']['firstname'] = $this->language->get('error_firstname');
					}
				}

				$lastname = $this->config->get('quickcheckout_field_lastname');

				if (!empty($lastname['required'])) {
					if ((utf8_strlen($this->request->post['lastname']) < 1) || (utf8_strlen($this->request->post['lastname']) > 32)) {
						$json['error']['lastname'] = $this->language->get('error_lastname');
					}
				}

				$address_1 = $this->config->get('quickcheckout_field_address_1');

				if (!empty($address_1['required'])) {
					if ((utf8_strlen($this->request->post['address_1']) < 1) || (utf8_strlen($this->request->post['address_1']) > 64)) {
						$json['error']['address_1'] = $this->language->get('error_address_1');
					}
				}

				$address_2 = $this->config->get('quickcheckout_field_address_2');

				if (!empty($address_2['required'])) {
					if ((utf8_strlen($this->request->post['address_2']) < 3) || (utf8_strlen($this->request->post['address_2']) > 64)) {
						$json['error']['address_2'] = $this->language->get('error_address_2');
					}
				}

				$company = $this->config->get('quickcheckout_field_company');

				if (!empty($company['required'])) {
					if ((utf8_strlen($this->request->post['company']) < 3) || (utf8_strlen($this->request->post['company']) > 64)) {
						$json['error']['company'] = $this->language->get('error_company');
					}
				}

				$city = $this->config->get('quickcheckout_field_city');

				if (!empty($city['required'])) {
					if ((utf8_strlen($this->request->post['city']) < 2) || (utf8_strlen($this->request->post['city']) > 128)) {
						$json['error']['city'] = $this->language->get('error_city');
					}
				}

				$this->load->model('localisation/country');

				$country_info = $this->model_localisation_country->getCountry($this->request->post['country_id']);

				if ($country_info && $country_info['postcode_required'] && (utf8_strlen($this->request->post['postcode']) < 2) || (utf8_strlen($this->request->post['postcode']) > 10)) {
					$json['error']['postcode'] = $this->language->get('error_postcode');
				}

				$country = $this->config->get('quickcheckout_field_country');

				if (!empty($country['required'])) {
					if ($this->request->post['country_id'] == '') {
						$json['error']['country'] = $this->language->get('error_country');
					}
				}

				$zone = $this->config->get('quickcheckout_field_zone');

				if (!empty($zone['required'])) {
					if ($this->request->post['zone_id'] == '') {
						$json['error']['zone'] = $this->language->get('error_zone');
					}
				}
				
				// Custom field validation
				$this->load->model('account/custom_field');

				$custom_fields = $this->model_account_custom_field->getCustomFields($this->config->get('config_customer_group_id'));

				foreach ($custom_fields as $custom_field) {
					if ($custom_field['location'] == 'address' && $custom_field['required'] && empty($this->request->post['custom_field'][$custom_field['location']][$custom_field['custom_field_id']])) {
						$json['error']['custom_field' . $custom_field['custom_field_id']] = sprintf($this->language->get('error_custom_field'), $custom_field['name']);
					}
				}

				if (!$json && $this->config->get('quickcheckout_show_shipping_address')) {
					// Default Shipping Address
					$this->load->model('account/address');

					$address_id = $this->model_account_address->addAddress($this->customer->getId(), $this->request->post);

					$this->session->data['shipping_address'] = $this->model_account_address->getAddress($address_id);

					if ($this->config->get('config_customer_activity')) {
						$this->load->model('account/activity');

						$activity_data = array(
							'customer_id' => $this->customer->getId(),
							'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName()
						);

						$this->model_account_activity->addActivity('address_add', $activity_data);
					}
				}
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}