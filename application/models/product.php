<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Product extends CI_Model{
    public function __construct()
    {
        $this->load->database();
    }
    //get and return product rows
	
   
    //insert transaction data
    public function storeTransaction($data = array()){
        $insert = $this->db->insert('payments',$data);
        return $insert?true:false;
    }
}