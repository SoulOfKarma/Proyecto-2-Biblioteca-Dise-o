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

    public function getAutores()
    {
        $query = $this->db->query('select * from autor');
        
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            $arrDatos[htmlspecialchars($row->id_autor, ENT_QUOTES)] = 
            htmlspecialchars($row->nombre_autor, ENT_QUOTES);
            
                    $query->free_result();
                    return $arrDatos;

        }
       

    }


    public function getEditorial()
    {
        $query = $this->db->query('select * from editorial');
        
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            $arrDatos[htmlspecialchars($row->id_editorial, ENT_QUOTES)] = 
            htmlspecialchars($row->nombre_editorial, ENT_QUOTES);
            
                    $query->free_result();
                    return $arrDatos;

        }
       

    }

    public function getTipoMaterial()
    {
        $query = $this->db->query('select * from tipomaterial');
        
        if($query->num_rows()>0)
        {
            foreach($query->result() as $row)
            $arrDatos[htmlspecialchars($row->id_tipomaterial, ENT_QUOTES)] = 
            htmlspecialchars($row->nombre_tipomat, ENT_QUOTES);
            
                    $query->free_result();
                    return $arrDatos;

        }
       

    }
}
