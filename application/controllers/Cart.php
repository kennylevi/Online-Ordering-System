<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 
*/
class Cart extends CI_Controller
{
   
    public function index()
    {
        $data['session_id'] = $this->get_session_id();
        $this->load->view('view_cart', $data);
    }

    public function get_session_id()
    {
        $session_id = $this->session->session_id;
        return $session_id;
    }

    public function add_to_cart()
    {
        $pro_id =  $this->input->post('pro_id');
        if (is_numeric($pro_id)) {
            $item_id = array('pro_id' => $pro_id,);
            $this->load->model('Section_model');
            $pro_data = $this->Section_model->get_products_where($item_id);
     
            $pro_price = $pro_data->pro_price;
            $pro_name = $pro_data->pro_name;
            $pro_qty = $this->input->post('qty', TRUE);
            $pro_image = $pro_data->pro_image;

            $item_data = array(
                'id' => $pro_id,
                'name' => $pro_name,
                'price' => $pro_price,
                'qty' => $pro_qty,
                'options' => array('Image' => $pro_image,) 
            );

            $this->cart->insert($item_data);
            redirect(site_url('view-cart'));
        }
    }

    public function update_cart()
    {
       
        $i = 1;
        foreach ($this->cart->contents() as $items) {

            $this->cart->update(array('rowid' => $items['rowid'], 'qty' => $_POST['qty'.$i]));
            $i++;
        
        } 
        
        $msg = 'cart updated';
        $update = '<div class="update"><i class="text-success fa fa-check-square"></i> '.$msg.'</div>';
        $this->session->set_flashdata('cart_update', $update);
        redirect(site_url('view-cart'));   
    }

    public function delete_item()
    {

        $del_id = $this->uri->segment(3);

        $data = array(
            'rowid' => $del_id,
            'qty' => 0
        );
        $this->cart->update($data);

        $msg = 'Cart Item Deleted';
        $update = '<div class="update"><i class="text-success fa fa-check-square"></i> '.$msg.'</div>';
        $this->session->set_flashdata('cart_delete', $update);
        redirect(site_url('view-cart')); 
    }


}
