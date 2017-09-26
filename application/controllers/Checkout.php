<?php
    defined('BASEPATH') OR exit('No direct script access allowed');
    /**
    * 
    */

class Checkout extends CI_Controller{

    public function index()
    {
        
       
        $this->load->view('checkout_details');
    }
        
      
    public function notice()
    {
        $thirdbit = $this->uri->segment(3);
        if (empty($thirdbit)) {
            redirect(site_url('store'));
        }

        //getting button form the form
        $yes_btn = $this->input->post('yes-btn');
        $no_btn = $this->input->post('no-btn');

        if ($yes_btn == 'Yes- let do it') {
            redirect(site_url('member-login'));
        }elseif($no_btn == 'No Thanks') {
            redirect(site_url('Checkout/index'));
        }

        $this->load->view('chkout_notice');
    }



}
