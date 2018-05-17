<?php
//if defined('BASEPATH') OR exit('No direct script access allowed');

class Login_model extends CI_Model {

    public $variable;

    public function __construct()
    {
        parent::__construct();
      
    }
    
    public function logeo($user,$pass)
    {
        
        $this->db->where('user',$user);
        $this->db->where('pass',$pass);
        $q = $this->db->get('usuarios');
        //$data = $q->result_array();

        if($q->num_rows()>0)
        {
            return true;
        }
        else
        {
            return false;
        }

    }

    public function returnUsers($user,$pass)
    {  
        $this->db->where('user',$user);
        $this->db->where('pass',$pass);
        $q = $this->db->get('usuarios');
        $data = $q->result_array();
        
        if($q->num_rows()>0)
        {
            return $data;
        }
        else
        {
            return false;
        }

        
      
    
    }
}
