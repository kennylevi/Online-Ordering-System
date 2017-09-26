<?php 
error_reporting(0);
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class EmailHandler extends CI_controller 
{
    
    public function mailer()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $message = $this->input->post('message');

   
           $this->load->library('email');

            $config = array();  
            $config['protocol'] = 'smtp';  
            $config['smtp_host'] = 'mail.dazinny.com.ng';  
            $config['smtp_user'] = 'info@dazinny.com.ng';  
            $config['smtp_pass'] = 'dazinny2017';  
            $config['smtp_port'] = 25;  
            // $config['newline'] = "\r\n";
            // $config['crlf'] = "\r\n";

            $this->email->initialize($config);
            $this->email->set_newline("\r\n"); 
            
            $this->email->from($email, $name);
            $this->email->to('info@dazinny.com.ng');
            // $this->email->cc('kennylevi90@gmail.com');
            $this->email->subject('From Dazinny Website');
            $this->email->message($message);

            // echo $this->email->print_debugger();
            $mailer = $this->email->send();
       
        //  sending message to db
        $contact_msg = array(
            'Name' => $name,
            'Email' => $email,
            'Message' => $message
        );

        $this->load->model('Section_model');
        $data = $this->Section_model->postContactMessage($contact_msg);

        if($mailer && $data == true){

            $sent['msg'] = '<div class="alert alert-success success-msg" role="alert">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
						</button>
						<p><i class="fa fa-check"></i> Success: Message was sent successfully</p>
			</div>';       
        }else{
            $sent['msg'] = '<div class="alert alert-danger error-msg" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><p><i class="fa fa-exclamation-triangle"></i> Error!: Unable to send message try again later</p>
						</div>';
        }
        header('Content-Type: application/json');
        echo json_encode($sent); 

    }

}
