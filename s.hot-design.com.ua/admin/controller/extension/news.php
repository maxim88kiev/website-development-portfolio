<?php
class ControllerExtensionNews extends Controller {
	private $error = array();
	
	public function index() {
		$this->language->load('extension/news');
		
		$this->load->model('extension/news');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true)
		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/news', 'user_token=' . $this->session->data['user_token'] . $url, true)
   		);
		
		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];
		
			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		
			unset($this->error['warning']);
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else { 
			$page = 1;
		}
		
		$url = '';
		
		$filter_data = array(
			'page' => $page,
			'limit' => $this->config->get('config_limit_admin'),
			'start' => $this->config->get('config_limit_admin') * ($page - 1),
		);
		
		$total = $this->model_extension_news->getTotalNews();
		
		$pagination = new Pagination();
		$pagination->total = $total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/product', 'user_token=' . $this->session->data['user_token'] . $url . '&page={page}', true);

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($total - $this->config->get('config_limit_admin'))) ? $total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $total, ceil($total / $this->config->get('config_limit_admin')));

		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_title'] = $this->language->get('text_title');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_date'] = $this->language->get('text_date');
		$data['text_action'] = $this->language->get('text_action');
		$data['text_edit'] = $this->language->get('text_edit');
		$data['text_list'] = $this->language->get('text_list');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');
		
		$data['button_add'] = $this->language->get('button_add');
		$data['button_delete'] = $this->language->get('button_delete');
		
		$url = '';
		
		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}
		
		$data['add'] = $this->url->link('extension/news/insert', '&user_token=' . $this->session->data['user_token'] . $url, true);
		$data['delete'] = $this->url->link('extension/news/delete', 'user_token=' . $this->session->data['user_token'] . $url, true);
		
		$data['all_news'] = array();
		
		$all_news = $this->model_extension_news->getAllNews($filter_data);
		
		foreach ($all_news as $news) {
			$data['all_news'][] = array (
				'news_id' 			=> $news['news_id'],
				'title' 			=> $news['title'],
				'short_description'	=> $news['short_description'],
				'date_added' 		=> date($this->language->get('date_format_short'), strtotime($news['date_added'])),
				'edit' 				=> $this->url->link('extension/news/edit', 'news_id=' . $news['news_id'] . '&user_token=' . $this->session->data['user_token'] . $url, true)
			);
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/news_list', $data));	
	}
	
	public function edit() {
		$this->language->load('extension/news');
		
		$this->load->model('extension/news');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_extension_news->editNews($this->request->get['news_id'], $this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/news', 'user_token=' . $this->session->data['user_token'], true));
		}
		
		$this->form();
	}
	
	public function insert() {
		$this->language->load('extension/news');
		
		$this->load->model('extension/news');
		
		$this->document->setTitle($this->language->get('heading_title'));
		
		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
			$this->model_extension_news->addNews($this->request->post);		
			
			$this->session->data['success'] = $this->language->get('text_success');
						
			$this->response->redirect($this->url->link('extension/news', 'user_token=' . $this->session->data['user_token'], true));
		}

		$this->form();
	}
	
	protected function form() {
		$this->language->load('extension/news');
		
		$this->load->model('extension/news');
		
		$data['breadcrumbs'] = array();

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('text_home'),
			'href'      => $this->url->link('common/home', 'user_token=' . $this->session->data['user_token'], true),
      		'separator' => false
   		);

   		$data['breadcrumbs'][] = array(
       		'text'      => $this->language->get('heading_title'),
			'href'      => $this->url->link('extension/news', 'user_token=' . $this->session->data['user_token'], true),
      		'separator' => ' :: '
   		);
		
		if (isset($this->request->get['news_id'])) {
			$data['action'] = $this->url->link('extension/news/edit', '&news_id=' . $this->request->get['news_id'] . '&user_token=' . $this->session->data['user_token'], true);
		} else {
			$data['action'] = $this->url->link('extension/news/insert', '&user_token=' . $this->session->data['user_token'], true);
		}
		
		$data['cancel'] = $this->url->link('extension/news', '&user_token=' . $this->session->data['user_token'], true);
		
		$data['heading_title'] = $this->language->get('heading_title');
		
		$data['text_image'] = $this->language->get('text_image');
		$data['text_title'] = $this->language->get('text_title');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_short_description'] = $this->language->get('text_short_description');
		$data['text_status'] = $this->language->get('text_status');
		$data['text_keyword'] = $this->language->get('text_keyword');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_browse'] = $this->language->get('text_browse');
		$data['text_clear'] = $this->language->get('text_clear');
		$data['text_image_manager'] = $this->language->get('text_image_manager');
		
		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		
		$data['user_token'] = $this->session->data['user_token'];
		
		$this->load->model('localisation/language');
		
		$data['languages'] = $this->model_localisation_language->getLanguages();
		
		if (isset($this->error['warning'])) {
			$data['error'] = $this->error['warning'];
		} else {
			$data['error'] = '';
		}
		
		if (isset($this->request->get['news_id'])) {
			$news = $this->model_extension_news->getNews($this->request->get['news_id']);
		} else {
			$news = array();
		}
		
		if (isset($this->request->post['news'])) {
			$data['news'] = $this->request->post['news'];
		} elseif (!empty($news)) {
			$data['news'] = $this->model_extension_news->getNewsDescription($this->request->get['news_id']);
		} else {
			$data['news'] = '';
		}
		
		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($news)) {
			$data['image'] = $news['image'];
		} else {
			$data['image'] = '';
		}
		
		$this->load->model('tool/image');
		
		if (isset($this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($news)) {
			$data['thumb'] = $this->model_tool_image->resize($news['image'] ? $news['image'] : 'no_image.png', 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);;
		}
		
		$data['no_image'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		
		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($news)) {
			$data['keyword'] = $this->model_extension_news->getNewsKeywords($news['news_id']);
		} else {
			$data['keyword'] = '';
		}
		
		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($news)) {
			$data['status'] = $news['status'];
		} else {
			$data['status'] = '';
		}
		
		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('extension/news_form', $data));
	}
	
	public function delete() {
		$this->language->load('extension/news');
		
		$this->load->model('extension/news');

		$this->document->setTitle($this->language->get('heading_title'));
		
		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $news_id) {
				$this->model_extension_news->deleteNews($news_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');
		}
		
		$this->response->redirect($this->url->link('extension/news', 'user_token=' . $this->session->data['user_token'], true));
	}
	
	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'extension/news')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
 
		if (!$this->error) {
			return true; 
		} else {
			return false;
		}
	}
	
	protected function validate() {
		if (!$this->user->hasPermission('modify', 'extension/news')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}
		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}