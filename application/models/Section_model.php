<?php 
/**
* 
*/
class Section_model extends CI_model
{
	private $lastQuery = "";
	private $store_query = "";

	// user profile
	public function get_user_details($user)
	{
		$this->db->select('*')
				->from('users')
				->join('roles', 'roles.role_id = users.user_role_id')
				->where('user_username', $user);
		$query = $this->db->get();
		return $query->result();		
	}

	public function save_profile($user_id, $value)
	{
		$this->db->where('user_id', $user_id)->update('users', $value);
		return true;
	}

	// About CMS model method starts here 
	public function postAbout($data)
	{
		$this->db->where('id', 0);
		$query = $this->db->update('about_section', $data);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function get_about_content()
	{
		$query = $this->db->get('about_section');
		if($query){
			return $query->result();
		}else{
			return false;
		}
	}
	// About CMS model method ///////////////////Ends here //////

	// Reservations starts model method start ////////////

	public function postReservation($value)
	{
		$query = $this->db->insert('reservations', $value);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function getReservation()
	{
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->order_by('res_id','DESC');
		$query = $this->db->get();
		if($query){
			return $query->result();
		}else{
			return false;
		}
	}

	public function delete_reservation($id)
	{
		$this->db->where('res_id', $id)->delete('reservations');
		return true;
	}

	public function reserve_status($id)
	{
		$status = array('res_status' => 1, );
		$this->db->where('res_id', $id)->update('reservations', $status);
		return true;
	}

	public function getNote($id)
	{
		$this->db->select('*');
		$this->db->from('reservations');
		$this->db->where('res_id', $id);
		$query = $this->db->get();
		if($query){
			return $query->result();
		}else{
			return false;
		}
	}

	public function get_reserve_data($resev_id)
	{	
		$query = $this->db->get_where('reservations', $resev_id);

		foreach ($query->result() as $row) {
			$data['full_name'] = $row->res_full_name;
			$data['email'] = $row->res_email;
		}
		return $data;
	}

	public function change_payment_status($resev_id, $value)
	{
		$update = array('res_payment_status' => $value,);

		$this->db->where('res_id', $resev_id)
			 ->update('reservations', $update);
		return true;
	}

	// reservation section ends here////////////////

	// messages model metthods starts ///////
	public function save_confirm_msg($data)
	{
		$this->db->insert('sent_messages', $data);
	}

	public function postContactMessage($values)
	{
		$query = $this->db->insert('contact-messages', $values);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function get_sent_msg($limit, $start)
	{
		$this->db->order_by('date_created', 'desc');
		$this->db->limit($limit,$start);
		$query = $this->db->get('sent_messages');
		$this->lastQuery = $this->db->last_query();
		if ($query) {
			return $query->result();
		}else{
			return false();
		}
	}

	public function get_msg_rows()
	{
		$sql = explode('LIMIT',$this->lastQuery);
		$query = $this->db->query($sql[0]);
		$result  = $query->result();
		return count($result);
	}

	public function delete_msg($id)
	{
		$this->db->where('id', $id)
				->delete('sent_messages');
		return true;		
	}

	public function get_msg_id($id)
	{
		$getID = array('id' => $id, );
		$query = $this->db->get_where('sent_messages', $getID);
		return $query->result();
	}

	// users method db model starts here
	public function get_all_users()
	{
		$this->db->select('*')
				->from('users')
				->join('roles', 'roles.role_id = users.user_role_id');
		$query = $this->db->get();		
		if ($query) {
			return $query->result();
		}else {
			return false;
		}

	}

	public function add_users($datas)
	{
		$query = $this->db->insert('users', $datas);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	// deactivating user model
	public function check_user_model($id)
	{
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_id', $id);
		$query = $this->db->get();
		
		foreach ($query->result() as $data) {
			$res = $data->user_status;
		}
		return $res;
	
	}
	public function deactivate_model($id,$set)
	{	
		$this->db->where('user_id', $id);
		$query = $this->db->update('users', $set);
		if ($query) {
			return true;
		}else{
			return false;
		}

	}
	public function activate_model($id, $set)
	{
		$this->db->where('user_id', $id);
		$query = $this->db->update('users', $set);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	// delete user model
	public function delete_model($id)
	{
		$this->db->where('user_id', $id);
		$query = $this->db->delete('users');
		if ($query) {
			return true;
		}else{
			return false;
		}

	}

	// changing password model
	public function verify_user_model($name)
	{
		
		$this->db->select('*');
		$this->db->from('users');
		$this->db->where('user_username', $name);
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		}else {
			return false;
		}
	}

	public function update_password($id, $data)
	{
		$this->db->where('user_id', $id);
		$query = $this->db->update('users', $data);
		if ($query) {
			return true;
		}else {
			return false;
		}
	}	

	// users model method ////////////////// ends here

	// role model methods ///////////starts here
	public function get_roles()
	{
		$query = $this->db->get('roles');
		return $query->result();
	}

	public function save_roles($roles)
	{
		$this->db->insert('roles', $roles);
		return true;
	}

	public function get_user_role($id)
	{
		$this->db->select('*')
			->from('users')
			->join('roles', 'roles.role_id = users.user_role_id')
			->where('users.user_id', $id);
		$query = $this->db->get();
		
		return $query->result();
	}

	public function edit_roles($role, $id)
	{
		$roles = array('user_role_id' => $role,);
		
		$query = $this->db->where('user_id', $id)->update('users', $roles);
		if ($query) {
			return true;
		}
		
	}

	//role model methods //////// ends here

	// Products item and category  model methods starts here
	public function save_category($name)
	{
		$q = $this->db->insert('categories', $name);
		if ($q) {
			return true;
		}else{
			return false;
		}
	}

	public function edit_cat($id, $cat_name)
	{
		$name = array('cat_name' => $cat_name, );
		$this->db->where('cat_id', $id)->update('categories', $name);
	}

	public function cat_delete($id)
	{
		$res = $this->db->where('cat_id', $id)->delete('categories');
		if ($res) {
			return true;
		}else{ return false;}
	}

	public function get_pro_cats()
	{
		$product = array();
		$cat_name = array();

		$all_product = array();

		$query = $this->db->get('categories');
		if ($query) {
			foreach ($query->result() as $row) {
				$item_id = $row->cat_id;
				$cat_name[] = $row;
				
				$this->db->select('*')->from('products')->where('cat_id', $item_id);
				$sub = $this->db->get();
				
				$product[] =  $sub->result();
			}
			$all_product = ['cat_name' => $cat_name, 'products' => $product];
			return $all_product; 
		}
	}

	public function insert_product($insert)
	{
		$query = $this->db->insert('products', $insert);
		if ($query) {
			return true;
		}else{
			return false;
		}
	}

	public function get_products()
	{
		$this->db->select('*')
				->from('products')
				->join('categories', 'categories.cat_id = products.cat_id');
		$query = $this->db->get();
		if ($query) {
			return $query->result();
		}else {
			return false;
		}
		
	}


	public function get_products_where($id)
	{
		$this->db->select('*')
				->from('products')
				->where($id);
		$query =$this->db->get();			
		foreach ($query->result() as $select_item) {
			$item = $select_item;
		}
		return $item;
	}

	public function get_products_limit()
	{
		$this->db->select('*')
			->from('products')
			->where('pro_status', 1)
			->order_by('pro_id', 'RANDOM')
			->limit(6);
		$query =$this->db->get();
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return FALSE;
		}			

	}

	public function get_store_products($limit, $start)
	{
		$this->db->order_by('pro_id', 'desc');
		$this->db->limit($limit, $start);
		$this->db->where('pro_status', 1);
		$query = $this->db->get('products');
		$this->store_query = $this->db->last_query();
		if ($query) {
			return $query->result();
		}else{
			return false();
		}
	}

	public function count_store_item()
	{
		$sql = explode('LIMIT',$this->store_query);
		$query = $this->db->query($sql[0]);
		$result  = $query->result();
		return count($result);
	}

	public function get_cat_list()
	{
		$query = $this->db->get('categories');
		return $query->result();
	}

	public function get_selected_product($id)
	{
		$this->db->select('*')
				 ->from('products')
				 ->join('categories', 'categories.cat_id = products.cat_id')
				 ->where('products.pro_id', $id);
		$query = $this->db->get();
		return $query->result();
	}

	public function edit_products($e_array, $id)
	{
		$update = $this->db->where('pro_id', $id)->update('products', $e_array);

		if ($update) {
			return true;
		}
	}

	public function get_pro_suggestion($id)
	{
		$suggest = array('cat_id' => $id,);
		$query = $this->db->get_where('products', $suggest);
		return $query->result();
	}
	
	//get product item  by slug
	public function get_item_slug($slug)
	{
		$get_all = array('slug' => $slug, );
		$query = $this->db->get_where('products', $get_all);

		return $query->result();
	}

	public function delete_product($id)
	{
		$this->db->where('pro_id', $id)->delete('products');
	}

	public function get_status($id)
	{
		$this->db->select('pro_status')
				->from('products')
				->where('pro_id', $id);
		$data = $this->db->get();
		foreach ($data->result() as $value) {
			$result = $value->pro_status;
		}	
		return $result;
	}

	public function change_status($status_id, $id)
	{
		$result = $this->db->where('pro_id', $id)->update('products',$status_id);
		if ($result) {
			return true;
		}
	}

}
// products and categories model ends here