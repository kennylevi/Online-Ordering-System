<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		$this->load->model('Section_model');
		$data['about'] = $this->Section_model->get_about_content();
		$data['products'] = $this->Section_model->get_products_limit();
		
		$this->load->view('home_page', $data);
	}

	public function post_reservation()
	{
		
		$people = $this->input->post('people');
		$date = $this->input->post('date');
		$fname = strtoupper($this->input->post('fname'));
		$phone = $this->input->post('phone');
		$email = $this->input->post('email');
		$note = ucwords($this->input->post('note'));
		$time = $this->input->post('timepicker');

		// clenning jquery ui date
		$chekdate = $date;
		$chekdate_array = explode("GMT",$chekdate);
		$new_date = strtotime($chekdate_array[0]);
		$dbdate = date('Y-m-d', $new_date);

		// random ref number
		$chars = '1234567890';
		$ref = mt_rand(5, $chars -15);

		$res_value = array(
			'full_name' => $fname,
			'telephone' => $phone,
			'email' => $email,
			'people' => $people,
			'ref_num' => $ref,
			'time' => $time,
			'date' => $dbdate,
			'note' => $note
		 );	

		$this->load->model('Section_model');
		$sub = $this->Section_model->postReservation($res_value);

		if ($sub) {
			$data = array('message' =>'<div class="alert alert-success"><strong><i class="fa fa-check"></i></strong> Your reservation was successfully created!.</div>');
		}else{
			$data = array('message' => '<div class="alert alert-danger"><strong><i class="fa fa-exclamation-triangle"></i></strong> Error sending request!</div>');
		}

		$this->output
			->set_status_header(200)
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES))
			->_display();
		exit();

	}

	public function item_store()
	{
		$this->load->library('pagination');
		$this->load->model('Section_model');
		$data['category'] = $this->Section_model->get_pro_cats();

		// load pagination method
		$config['base_url'] = site_url().'store';
		$config['uri_segment'] = 2;
		$config['per_page'] = 9;
		// pagination styles
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['cur_tag_open'] = '<li class="active"><a href="#">';
		$config['cur_tag_close'] = '</a></li>';


		$page = $this->uri->segment(2,0);
		$data['store_item'] = $this->Section_model->get_store_products($config['per_page'], $page);
		$config['total_rows'] = $this->Section_model->count_store_item();

		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();
			
		$this->load->view('store', $data);

	}

	public function view_item()
	{
		$slug = $this->uri->segment(2);
		if ($slug) {
			$this->load->model('Section_model');
			$data['response'] = $this->Section_model->get_item_slug($slug);

				foreach ($data['response'] as $key => $value) {
					$cat_id = $value->cat_id;
				} 
				// get product item of same category
			$data['pro_suggestion'] = $this->Section_model->get_pro_suggestion($cat_id);
				foreach ($data['pro_suggestion'] as $value) {
					$pro_suggestion = $value;
				}
			$data['count_suggestion'] = count($pro_suggestion);
			$this->load->view('item_view', $data);
		}else {
			redirect(site_url('Admin/full_menu'));
		}
		
	}			
	
}
