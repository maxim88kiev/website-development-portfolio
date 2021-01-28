<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		/*if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}*/
		
		$this->document->addLink(HTTPS_SERVER, 'canonical');

		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

        $this->load->language('common/header');

        $data['text_home_slider_1'] = $this->language->get('text_home_slider_1');
        $data['text_home_slider_2'] = $this->language->get('text_home_slider_2');
        $data['text_home_slider_3'] = $this->language->get('text_home_slider_3');

        $data['category_1'] = $this->language->get('category_1');
        $data['category_2'] = $this->language->get('category_2');
        $data['category_3'] = $this->language->get('category_3');
        $data['category_4'] = $this->language->get('category_4');
        $data['category_5'] = $this->language->get('category_5');
        $data['category_6'] = $this->language->get('category_6');
        $data['category_7'] = $this->language->get('category_7');
        $data['category_8'] = $this->language->get('category_8');


		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}