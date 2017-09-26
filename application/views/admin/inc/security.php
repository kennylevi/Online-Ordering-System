<?php
if(!$this->session->has_userdata('logged_in')){
    redirect(site_url('login'));
}else{
    $data = $this->session->userdata('logged_in');
    // print_r($data); die();
    $username = $data['username'];
    $role = $data['role'];
}