<?php
//if defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_Model extends CI_Model {

    public $variable;

    public function __construct()
    {
        parent::__construct();
      
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

    public function buscarUsuario($rut)
    {
        $this->db->where('rut_usuario',$rut);
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

    public function buscarLibro()
    {
        
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

    

    public function validarBuscarUsuario($rut)
    {
        $this->db->where('rut_usuario',$rut);
        $q = $this->db->get('usuarios');
        $data = $q->result_array();
        
        if($q->num_rows()>0)
        {
            return 1;
        }
        else
        {
            return false;
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

    public function devolverLibroFiltrado($idlibro)
    {
        
        $sql = "select * from libros where id_libro= ? ";
        $query = $this->db->query($sql,array($idlibro));

        if($query->num_rows()>0)
        {
           
            foreach($query->result() as $row)
            $arrDatos[htmlspecialchars($row->id_libro, ENT_QUOTES)] = 
            htmlspecialchars($row->nombre_libro, ENT_QUOTES);
            
                    $query->free_result();
                    return $arrDatos;

        }


    }

    public function modificarLibro($data)
    {
       extract($data);
       $this->db->where('id_libro',$idlibro);
       $this->db->update($libros,array('nombre_libro'=>$nombrelibro,'id_autor'=>$idAutor,'id_editorial'=>$idEditorial,'id_tipomaterial'=>$idTipoMat));
       
       return true;
    }

}