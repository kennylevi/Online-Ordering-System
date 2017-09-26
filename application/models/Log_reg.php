<?php 
/**
* 
*/
class log_reg extends CI_model
{

    public function getLogin($uname, $pass)
    {
        $this->db->select('*')
                ->from('users')
                ->join('roles','roles.role_id = users.user_role_id')
                ->where('users.user_username', $uname)
                ->where('users.user_password', md5($pass))
                ->where('users.user_status', 1);
        $query = $this->db->get();
        if($query->num_rows() == 1){
            return $query->result();
        }else{
            return false;
        }
    }

    public function last_logged($id)
	{
		
		$date = date("y-m-d h:m:s");
		$dateTime = array('date_logged_in' => $date,);

		$query = $this->db->where('user_id', $id)->update('users', $dateTime);
		if ($query) {
			return true;
		}else{
			return false;
		}
		
	}

}    