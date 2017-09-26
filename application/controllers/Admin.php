<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Admin extends CI_controller
{
	public $item_id;
	public $uname;
	public $editID;
	
	public function index()
	{
		$this->load->view('admin/index');
	}

	//user profile
	public function profile()
	{
		$userId = $this->uri->segment(3);
		if (is_string($userId)) {
			$this->load->model('Section_model');
			$data['details'] = $this->Section_model->get_user_details($userId);

			if (isset($_POST['save'])) {
				$user_id = $this->input->post('user_id');
				$values = $this->profile_insert(); 

				$this->load->model('Section_model');
				$result = $this->Section_model->save_profile($user_id, $values);
				if ($result == true) {
					$content = 'Profile Details Updated Succesfully';
					$msg = '<div class="alert alert-success" alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button> '.$content.'
							</div>';
					$this->session->set_flashdata('profile', $msg);
					redirect(site_url('Admin/profile/'.$userId));
				}
			}
		}	
		$this->load->view('admin/profile', $data);
		
	}

	public function profile_insert()
	{	
		$fname = $this->input->post('full_name');
		$uname = $this->input->post('username');
		$phone = $this->input->post('telephone');

		$update_profile = array(
			'user_full_name' => $fname,
			'user_telephone' => $phone
		 );
		return $update_profile;
	}

	//  About section CMS method starts here

	public function create_about_content()
	{
		$this->load->model('Section_model');
		$data['value'] = $this->Section_model->get_about_content();


		$this->load->view('admin/Add_about', $data);
	}

	public function about_content_submit()
	{
		$content = $this->input->post('content');
		if (empty($content)) {
			$this->session->set_flashdata('err','<div class="alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-exclamation-circle"></i></strong> You forgot to type content!.
						</div>');
				redirect(site_url('admin/create-about-contents'));
		}else{
			$config['upload_path']    = './uploads/';
            $config['allowed_types']  = 'gif|jpg|png|jpeg';

            $this->load->library('upload', $config);

            $this->upload->do_upload('file');

            	$upload_path = $this->upload->data('file_name');
                $full_path = "uploads/" .$upload_path;

                $submit = array('content' => $content , 'image' => $full_path );

                $this->load->model('Section_model');
                $data = $this->Section_model->postAbout($submit);
                if ($data) {
                	$this->session->set_flashdata('success','<div class="alert alert-success alert-dismissible">
                			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                			<strong><i class="fa fa-check"></i></strong> succefully subited!.
                		</div>');
                	redirect(site_url('admin/create-about-contents'));
                }else{
                		$this->session->set_flashdata('failed','<div class="alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-exclamation-triangle"></i></strong> Error Submitting request.
						</div>');
					redirect(site_url('admin/create-about-contents'));	
                }
            
		}

	}
	//  About section CMS method ends here ///////////////////////ends here//////////////////////

	// All reservation method
	public function all_reservations()
	{

		$this->load->model('Section_model');
		$data['resev_item'] = $this->Section_model->getReservation();

		$this->load->view('admin/reservation', $data);
	}

	public function getReservationNote()
	{
		$id = $this->uri->segment(3);
		if ($id) {
			$this->load->model('Section_model');
			$data= $this->Section_model->getNote($id);

			foreach ($data as $value) {
				$note = $value->res_note;
			}						

			echo json_encode($note);
		}
	}

	public function delete_reservation()
	{
		$reservation_id = $this->uri->segment(3);
		if (!is_numeric($reservation_id)) {
			redirect(site_url('Admin/all-reservations'));
		}else {
			$this->load->model('Section_model');
			$result = $this->Section_model->delete_reservation($reservation_id);
			if ($result == true) {
				
				$response['message'] = '<div class="alert alert-success" alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							This reservation was deleted successfully</div>';
				// echo $data['message'];
				header("Content-Type: Application/json");
				echo json_encode($response);
			}else{
				return false;
			}
			
		}
	}

	public function reservation_status()
	{
		$reservation_id = $this->uri->segment(3);
		$this->load->model('Section_model');
		$this->Section_model->reserve_status($reservation_id);
		return true;

	}

	public function resv_payment_status()
	{
		$res_id = $this->uri->segment(3);
		
		if (isset($_POST['value'])) {
			$value = $_POST['value'];

			$this->load->model('Section_model');
			$this->Section_model->change_payment_status($res_id, $value);
		}
	}

	// All reservations ////////////////////////ends here/////////////////////

	// products category and items methods starts here  

	public function add_category()
	{
		$this->load->model('Section_model');
		$data['pro_cat'] = $this->Section_model->get_pro_cats();
		
		$this->load->view('admin/add_pro_cat', $data);
	}

	public function new_category()
	{
		$pro_name = $this->input->post('category');
		if (empty($pro_name)) {
			redirect(site_url('Admin/add-category'));
		}else {
			$item = array(
				'cat_name' => $pro_name,
				'cat_status' => 1 
			);

			$this->load->model('Section_model');
			$result  = $this->Section_model->save_category($item);

			if ($result == true) {
				$this->session->set_flashdata('added', '<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><i class="fa fa-check"></i></strong> New Product Added Ssuccessfully!
                    </div>'
				);
				redirect(site_url('Admin/add-category'));
			}else {
				return false;
			}

		}
	}

	public function edit_category()
	{
		$cat_id = $this->uri->segment(3);
		if ($cat_id) {
			$name = $this->input->post('cat_name');
			
			$this->load->model('Section_model');
			$this->Section_model->edit_cat($cat_id, $name);
		}
		
	}

	public function add_new_products()
	{
		if(isset($_POST['save'])){

			$config['upload_path'] = './uploads/';
			$config['allowed_types'] = 'gif|jpg|png|jpeg';
			$config['max_size']     = '1024';
			$config['max_width'] = '1024';
			$config['max_height'] = '768';
			$config['overwrite'] = true;

			$this->load->library('upload', $config);
			
			if (! $this->upload->do_upload('pro_image')) {
				$this->session->set_flashdata('upload_error', '<div class="alert alert-danger alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							<strong><i class="fa fa-exclamation-triangle"></i></strong>'.$this->upload->display_errors().'
						</div>');
				redirect(site_url('Admin/all-products'));
			}else{
				$this->insert_product();
			}
		}	
		$this->load->view('admin/add_new_product');
	}

	public function insert_product()
	{
		$name = $this->input->post('pro_name');
		$cat_id = $this->input->post('pro_cat');
		$desc = $this->input->post('pro_desc');
		$price = $this->input->post('pro_price');
		$wasPrice = $this->input->post('was_price');

		//product item slug
		$slug = preg_replace("/[\s_]/", "-", $name);

			$upload_data = $this->upload->data();
			$file_name = $upload_data['file_name'];
				
				$insert = array(
					'pro_name' => $name,
					'cat_id' => $cat_id,
					'pro_description' => $desc,
					'pro_image' => $file_name,
					'pro_price' => $price,
					'pro_was_price' => $wasPrice,
					'pro_status' => 1,
					'slug' => $slug,
					'pro_date_created' => date('y-m-d h:i:s')
				);

			$this->load->model('Section_model');
			$data = $this->Section_model->insert_product($insert);
			if ($data == true) {
				$this->session->set_flashdata('item_saved', '<div class="alert alert-success alert-dismissible">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<strong><i class="fa fa-check"></i></strong>Product Item Uploaded!.
				</div>');
				redirect(site_url('Admin/all-products'));
			}else {
				$this->session->set_flashdate('item_error', '<div class="alert alert-danger alert-dismissible" role="alert">
					<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<strong><i class="fa fa-exclamation-triangle"></i></strong> Error Uploading Item.
				</div>');
				redirect(site_url('Admin/all-products'));
			}

		return insert_product();	
	}

	public function load_cat_list()
	{
		echo $this->cat_list();			
	}

	public function cat_list()
	{
		$pro_id = $this->uri->segment(3);
		

		if (is_numeric($pro_id)) {
			$this->load->model('Section_model');
			$data = $this->Section_model->get_selected_product($pro_id);
			foreach ($data as $cat_name) {
				$option = '<option class=".selected bg-info" value="'.$cat_name->cat_id.'">'.$cat_name->cat_name.'</option>';
			}
			$this->load->model('Section_model');
			$data = $this->Section_model->get_cat_list();

			foreach ($data as $value) {
					$option .='<option value="'.$value->cat_id.'">'.$value->cat_name.'</option>';
			}
			return $option;

		}else{
			$this->load->model('Section_model');
			$data = $this->Section_model->get_cat_list();

			$option = '<option>--select product--</option>';
			foreach ($data as $value) {
					$option .='<option value="'.$value->cat_id.'">'.$value->cat_name.'</option>';
			}
			return $option;
		}	

	}

	public function all_products()
	{
		$this->load->model('Section_model');
		$data['result'] = $this->Section_model->get_products();

		$this->load->view('admin/all_products', $data);
	}

	public function edit_products()
	{
		$this->item_id = $this->uri->segment(3);
		if ($this->item_id) {
			$id = array('pro_id' => $this->item_id,);

			$this->load->model('Section_model');
			$data = $this->Section_model->get_products_where($id);
			
			if ($data) {
				$get['form'] =  '
					<form id="edit-form">
						<input type="hidden" name="pro_id" value="'.$data->pro_id.'"/>
						<div class="form-group">
							<label>Item Name</label>
							<input type="text" name="proName" class="form-control" value="'.$data->pro_name.'">
						</div>
						<div class="form-group">
							<label>Item Description</label>
							<textarea name="proDesc" class="form-control" rows="4">'.$data->pro_description.'</textarea>
						</div>
						<div class="form-group">
							<label>Item Price</label>
							<input type="text" name="proPrice" class="form-control" value="'.$data->pro_price.'">
						</div>
						<div class="form-group">
							<label>Item Was Price</label>
							<input type="text" name="wasPrice" class="form-control" value="'.$data->pro_was_price.'">
						</div>
						<div class="form-group">
							<label>Item Product Category</label>
								<select name="product_cat" id="product_cat" class="form-control">
								'.$this->cat_list($data->pro_id).'
								</select>
						</div>
						<button type="button" class="save btn btn-success">Save Changes</button>
					</form>';

				// var_dump($get);
				header('Content-type: Application/json');
				echo json_encode($get);
			}

		}
	}

	public function edit_product_api()
	{
		$this->editID = $this->input->post('pro_id');
		$name = $this->input->post('proName');
		$desc = $this->input->post('proDesc');
		$price = $this->input->post('proPrice');
		$wasprice = $this->input->post('wasPrice');
		$pro = $this->input->post('product_cat');
		$slug = preg_replace("/[\s_]/", "-", $name);
		$slug = $slug;

		$edit = array(
			'cat_id'=> $pro,
			'pro_name' => $name,
			'pro_description' => $desc,
			'pro_price' => $price,
			'pro_was_price' => $wasprice,
			'slug' => $slug
		);
		
		$this->load->model('Section_model');
		$result = $this->Section_model->edit_products($edit, $this->editID);

		if ($result) {
			$data['msg'] = '<p style="color:green;">Updated Succesfully...Refreshing in 5sec</p>';
		}

		header('Content-Type: Application/json');
		echo json_encode($data);
	}

	public function delete_category()
	{
		$id = $this->uri->segment(3);
		if ($id) {
			$this->load->model('Section_model');
			$response = $this->Section_model->cat_delete($id);

			if ($response == true) {
				$data['message'] ='<div class="alert alert-success alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-check"></i></strong> Product category Deleted Successfully!.
						</div>';
			}else{
				$data['message'] = '<div class="alert alert-danger alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-exclamation-circle"></i></strong> An Error Occured!.
						</div>';
			}

			header('Content-Type: Application/json');
			echo json_encode($data);

		}
	}

	public function delete_item_api()
	{
		$item_id = $this->uri->segment(3);
		if ($item_id) {
			
			$this->load->model('Section_model');
			$this->Section_model->delete_product($item_id);

			$data['msg'] = '<div class="alert alert-success alert-dismissible" role="alert">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<strong><i class="fa fa-check"></i></strong> Product Deleted Successfully!.
							</div>';

			header('Content-type: Application/json');
			echo json_encode($data);
		}

	}
	
	public function status_api()
	{
		$itemID = $this->uri->segment(3);

		if (!is_numeric($itemID)) {
			redirect(site_url('Admin/product-items'));
		}else {
			$this->load->model('Section_model');
			$result =$this->Section_model->get_status($itemID);
			if ($result == 1) {
				$update_id = array('pro_status' => 0, );
				$this->load->model('Section_model');
				$chek_status  =$this->Section_model->change_status($update_id, $itemID);
				if ($chek_status == true) {
					echo 'now inactive';
				}
			}else{
				$update_id = array('pro_status' => 1, );
				$this->load->model('Section_model');
				$chek_status  =$this->Section_model->change_status($update_id, $itemID);
				if ($chek_status == true) {
					echo 'now active';
				}
			}
		}
	}
	// product & categorires method/function ends here

	// Login methods starts
	public function Admin_login()
	{
		if (isset($_POST['login'])) {
	
			$this->load->library('form_validation');

			$this->form_validation->set_rules('userID', 'UserID', 'required');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if ($this->form_validation->run() == TRUE) {
				$uname = $this->input->post('userID');
				$pword = $this->input->post('password');

				$this->login_auth($uname, $pword);

			}else{
				// validate form
			}
		}
		
		$this->load->view('admin/login');
	}

	public function login_auth($uname, $pword)
	{

		$this->load->model('Log_reg');
		$value = $this->Log_reg->getLogin($uname, $pword);
		$id = "";
		if($value !=false){

			foreach($value as $details){
				$id .= $details->user_id;
				$session_data = array(
					'full_name' => $details->user_full_name,
					'username' => $details->user_username,
					'role' => $details->role_name
				);
			}
			$this->load->model('Log_reg');
			$this->Log_reg->last_logged($id);
			$this->session->set_userdata(['logged_in'=>$session_data]);
			redirect(site_url('Admin'));

		}else{
				$this->session->set_flashdata('logInError', '<b><i class="fa fa-exclamation-triangle"></i> Invalid username or password or you may have been deactivated</b>');
			redirect(site_url('Admin/admin-login'));
		}

		return login_auth();
	}

	public function add_users()
	{
		$this->load->view('admin/add_users');
	}

	public function add_users_auth()
	{
		$fname = $this->input->post('fname');
		$phone = $this->input->post('telephone');
		$role = $this->input->post('role');
		$gender = $this->input->post('option-yes');
		$username  = $this->input->post('userName');
		$password  = $this->input->post('password');
		$status = 1;
		$date = date('y-m-d h:i:S');

		// checking the values if empty
		if (empty($fname) || empty($phone) || empty($role) || empty($gender) || empty($username) || empty($password)) {
			// return false;
			redirect(site_url('Admin/add-users'));
		}else{
			$addUser = array(
				'user_full_name' => $fname,
				'user_username' => $username,
				'user_password' => md5($password),
				'role_id' => $role,
				'user_telephone' => $phone,
				'user_gender' => $gender,
				'user_status' => $status,
				'user_date_created' => $date
			);
			$this->load->model('Section_model');
			$value  = $this->Section_model->add_users($addUser);
			
			if ($value !=false) {
				$this->session->set_flashdata('success','<div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><i class="fa fa-check"></i></strong> user added successfully!
                    </div>');
				redirect(site_url('Admin/add-users'));
			}else {
				$this->session->set_flashdata('error','<div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong><i class="fa fa-exclamation-circle"></i></strong> Ooops somthing went wrong!
                </div>');
				redirect(site_url('Admin/add-users'));
			}

		}
	}

	public function all_users()
	{
		$this->load->model('Section_model');
		$data['users'] = $this->Section_model->get_all_users();

		$this->load->view('admin/all_users', $data);
	}

	public function deactivate_user()
	{
		$userID = $this->uri->segment(3);
		if ($userID) {

			$this->load->model('Section_model');
			$result = $this->Section_model->check_user_model($userID);
			// deactivateing _user
			if ($result == 1) {
				$set = array(
					'user_status' =>  0
				);
				$this->load->model('Section_model');
				$this->Section_model->deactivate_model($userID, $set);
				return true;
			}elseif ($result == 0) {
				$set = array(
					'user_status' =>  1
				);
				$this->load->model('Section_model');
				$this->Section_model->activate_model($userID, $set);
				return true;
			}else{
				return false;
			}

		}

	}

	// delete user
	public function delete_user()
	{
		$userID = $this->uri->segment(3);
		if ($userID) {
			$this->load->model('Section_model');
			$data = $this->Section_model->delete_model($userID);
			if ($data == true) {
				$msg['msg'] ='<div class="alert alert-success alert-dismissible">
                			<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                			<strong><i class="fa fa-check"></i></strong> Succefully Deleted User!.
                		</div>';
				header('Content-Type:Application/json');
				echo json_encode($msg);
			}else{
				return false;
			}
		}
	}

	// change userpassword
	public function change_password()
	{
		$this->load->view('admin/change_password');
	}

	public function verify_user()
	{
		$url = site_url();
	
		$username = $this->input->post('Username');
		// checking if empty
		if (empty($username)) {
			return false;
			redirect(site_url('Admin/change-password'));
		}else {
			$this->load->model('Section_model');
			$result = $this->Section_model->verify_user_model($username);

			if ($result) {
				$_SESSION['id'] = $result[0]->user_id;
				$this->uname = $result[0]->user_username; 

				if ($this->uname == $username) {
					$this->session->set_flashdata('verified','<div class="col-lg-6">
							<section class="panel">
								<header class="panel-heading">
									'.$username.' is verified enter New password
								</header>
								<div class="panel-body">
									<form role="form" action="'.$url.'Admin/update_password" method="POST" id="password-form">
										<div class="form-group">
											<label for="pass1">Password</label>
											<input type="password" class="form-control" name="pass1" id="pass1" placeholder="Enter Password">
										</div>
										<div class="form-group">
											<label for="pass2">Confirm Password</label>
											<input type="password" class="form-control" name="pass2" id="pass2" placeholder="Confirm Password">
										</div>
										<button type="submit" class="btn btn-success">Submit</button>
									</form>

								</div>
							</section>
						</div>'
					);
					redirect(site_url('Admin/change-password'));
				}
			}
			else {
				$this->session->set_flashdata('invalid', '<div class="col-lg-6">
						<section class="panel">
                            <div class="panel-body">
								<div class="alert alert-danger alert-dismissible">
									<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
									<strong><i class="fa fa-exclamation-triangle"></i></strong> '.$username.' is not avialable!.
								</div>
							</div>
						</section>
					</div>'
				);
				redirect(site_url('Admin/change-password'));
			}

		}

	}

	public function update_password()
	{
		$password = $this->input->post('pass1');
	
		$id = $_SESSION['id'];
		
		$pass = array(
			'user_password' => md5($password), 
		);
		
		$this->load->model('Section_model');
		$result = $this->Section_model->update_password($id, $pass);

		if ($result == true) {
			$this->session->set_flashdata('updated', '<div class="col-lg-6">
								<section class="panel">
									<div class="panel-body">
										<div class="alert alert-success alert-dismissible">
											<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											<strong><i class="fa fa-check"></i></strong> Password Updated Succefully!.
										</div>
									</div>	
								</section>
							</div>'
			);
			redirect(site_url('Admin/change-password'));
		}else {
			return false;
		}

	}
	// changing password ////////////////////ends here

	// roles methods ///////////starts here
	public function roles()
	{
		
		$this->load->model('Section_model');
		$data['user_role'] = $this->Section_model->get_roles();

		$this->load->view('admin/roles', $data);
	}

	public function new_role()
	{
		$role_name = $this->input->post('role');
		if(empty($role_name)){
			redirect(site_url('Admin/roles'));
		}else{
			$roles_data = array('role_name' => $role_name, 'role_created_at' => date('Y-m-d h:i:S'));

			$this->load->model('Section_model');
			$result = $this->Section_model->save_roles($roles_data);
			$cName = ucfirst($role_name);
			if ($result) {
				$msg = $cName.' Role Added Successfully';
				$wrapper = '<div class="alert alert-success" alert-dismissible" role="alert">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>'.$msg.'
							</div>';
				$this->session->set_flashdata('role', $wrapper);
				redirect(site_url('Admin/roles'));
			}
		}
		
	}

	public function get_user_role()
	{
		$this->load->model('Section_model');
		$data = $this->Section_model->get_roles();
		$return = '<option>------ select role ------ </option>';
		foreach ($data as $role) {
			$return .= '<option value="'.$role->role_id.'">'.$role->role_name.'</option>';
		}

		echo json_encode($return);
	}

	public function get_edit_form()
	{
		$user_id = $this->uri->segment(3);
		if (is_numeric($user_id)) {
			$data['form'] = '<form action="" id="editForm">
				<input type="hidden" name="user_id" value="'.$user_id.'">
				<div class="form-group">
					<select class="editRole form-control" name="editRole">
						'.$this->role_list($user_id).'
					</select>
				</div> 
				<button type="button" class="save btn btn-success">Save Changes</button>   
			</form>';

			header('Content-type: Application/json');
			echo json_encode($data);
		}
		
	}

	public function role_list()
	{
		$userId = $this->uri->segment(3);

		$this->load->model('Section_model');
		$data = $this->Section_model->get_user_role($userId);
		foreach ($data as $selected_role) {
			$role = '<option class=".selected bg-info" value="'.$selected_role->user_role_id.'">'.$selected_role->role_name.'</option>';
		}
		$this->load->model('Section_model');
		$data = $this->Section_model->get_roles();
		foreach ($data as $option) {
			$role .= '<option value="'.$option->role_id.'">'.$option->role_name.'</option>';
			
		}
		return $role;

	}

	public function save_edited_role()
	{
		$user_id = $this->input->post('user_id');
		$role = $this->input->post('editRole');

		// echo $role.' '.$user_id; die();
		$this->load->model('Section_model');
		$data = $this->Section_model->edit_roles($role, $user_id);
		
		if ($data == true) {
			$result['msg'] = '<p style="color:green;">User role changed succesffully ...refreshing now</p>';	
		}
		header('Content-type: Application/json');
		echo json_encode($result);
	}

	//view sent confirmation mail method ///////////////starts here/////////////
	public function confirmation_message()
	{

		$reservation_id = $this->uri->segment(3);
		$submit = $this->input->post('submit', TRUE);

		if ($submit=='submit') {
			$data = $this->fetch_message_data();
			$this->post_confirm_msg($data);

			$flash_msg = "Message successfully sent to user";
			$holder = '<div class="alert alert-success" alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-check"></i></strong> '.$flash_msg.
					  ' </div>';
			$this->session->set_flashdata('confirm_msg', $holder);
			redirect(site_url('Admin/confirmation_message'));
		}

		if (is_numeric($reservation_id) && $submit != 'submit') {
			$data = $this->fetch_recip_details($reservation_id);
		}else{
			$data = $this->fetch_message_data();
		}
		if (! is_numeric($reservation_id)) {
			$data['headline'] = "Compose Confirmation Message";

		}else{
			$data['headline'] = "Send Confirmation Message To";
		}
		$data['flash'] = $this->session->flashdata('confirm_msg');
		$this->load->view('Admin/confirmation_message', $data);
	}

	//fetching recipient details from db
	public function fetch_recip_details($reserv_id)
	{
		$id = array('res_id' => $reserv_id,);
		$this->load->model('Section_model');
		$result = $this->Section_model->get_reserve_data($id);
		return $result;
	}

	// fetching message datas
	public function fetch_message_data()
	{
		$recp_email = $this->input->post('recip_email');
		$another_email = $this->input->post('another_email');
		$recp_sub = $this->input->post('recip_subject');
		$recp_msg = $this->input->post('recip_message');

		// mailling config
		    $this->load->library('email');

            $config = array();  
            $config['protocol'] = 'smtp';  
            $config['smtp_host'] = 'ssl://mail.dazinny.com.ng';  
            $config['smtp_user'] = 'info@dazinny.com.ng';  
            $config['smtp_pass'] = 'dazinny2017';  
            $config['smtp_port'] = 465;  
            $config['newline'] = "\r\n";
            $config['crlf'] = "\r\n";
			$config['type'] = 'text';
			$config['charset'] = 'utf-8';

            $this->email->initialize($config);
            $this->email->set_newline("\r\n"); 
            
            $this->email->from('info@dazinny.com.ng', 'Dazinny', 'info@dazinny.com.ng');
            $this->email->to($recp_email);
            $this->email->cc('kennylevi90@gmail.com');
            $this->email->subject($recp_sub);
            $this->email->message($recp_msg);

         	$this->email->send();		

		$input_value = array(
			'email' => $recp_email, 
			'another_email' => $another_email,
			'subject' => $recp_sub,
			'message' => $recp_msg,
			'date_created' => date('Y-m-d'),
			'time_created' => date('g:i:A')
		);
		return $input_value;
	}

	public function post_confirm_msg($datas)
	{	
		$this->load->model('Section_model');
		$this->Section_model->save_confirm_msg($datas);
	}

	public function sent_mails()
	{
		$this->load->library('pagination');

		$config['base_url'] = site_url().'Admin/sent_mails';
		$config['uri_segment'] = 3;
		$config['per_page'] = 10;
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

		$page = $this->uri->segment(3,0);

		$this->load->model('Section_model');
		$data['msg_list'] = $this->Section_model->get_sent_msg($config['per_page'], $page);
		$config['total_rows'] = $this->Section_model->get_msg_rows();

		$this->pagination->initialize($config);
		$data['pagination_links'] = $this->pagination->create_links();

		$this->load->view('Admin/sent_messages', $data);
	}

	public function view_sent_mail()
	{
		$msgID =  $this->uri->segment(3);
		$this->load->model('Section_model');
		$data['response'] = $this->Section_model->get_msg_id($msgID);

		$this->load->view('admin/view_sent_message', $data);
	}

	public function delete_row()
	{
		if (isset($_POST['id'])) {
			$del_id = $_POST['id'];
			foreach ($del_id as $value) {
				$this->load->model('Section_model');
				$data = $this->Section_model->delete_msg($value);
			}
			if ($data) {
				$response['del'] = '<div class="alert alert-success" alert-dismissible" role="alert">
  						<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  						<strong><i class="fa fa-check"></i></strong>Selected message has been deleted</div>';
			}	
			header('Content-type: Application/json');
			echo json_encode($response);
		}
		
	}

	// mailing and messages method ends here

	public function log_out()
	{
		 $this->session->unset_userdata('logged_in');
        redirect(site_url('login'));
	}

}
