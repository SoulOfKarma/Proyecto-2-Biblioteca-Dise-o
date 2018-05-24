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

    public function buscarLibroPorId($val)
    {
        $this->db->where('id_libro',$val);
        $q = $this->db->get('libros');
        $data = $q->result_array();
        
        if($q->num_rows()>0)
        {
            foreach($q->result() as $row)
            $arrDatos[htmlspecialchars($row->id_libro, ENT_QUOTES)] = 
            htmlspecialchars($row->nombre_libro, ENT_QUOTES);
            $q->free_result();
                    return $row->nombre_libro;
        }
        else
        {
            return false;
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

    public function buscarDatosPrestamo($rut)
    {
        
        $this->db->where('rut_prestamo',$rut);
        $q = $this->db->get('prestamos');
        $data = $q->result_array();

        if($q->num_rows()>0)
        {
           
            foreach($q->result() as $row)
           
            $q->free_result();
            return $row->cantidad_prestamo;

        }
        else
        {
          return 0;
        }


    }

    public function modificarLibro($data)
    {
       extract($data);
       $this->db->where('id_libro',$idlibro);
       $this->db->update($libros,array('nombre_libro'=>$nombrelibro,'id_autor'=>$idAutor,'id_editorial'=>$idEditorial,'id_tipomaterial'=>$idTipoMat));
       
       return true;
    }

    public function ingresarPrestamo($data)
    {
       
       $this->db->insert('prestamos',$data);
       
       return 'Correcto';
    }

    public function updateDisponibilidad($idlibro)
    {
       
       $this->db->where('id_libro',$idlibro);
       $this->db->update('libros',array('id_disp_libros'=>2));
       
       return true;
    }

    public function updateDevuelto($idpres,$rut,$cant)
    {
       if($cant==2)
       {
        $this->db->where('id_prestamo',$idpres);
        $this->db->where('rut_prestamo',$rut);
        $this->db->update('prestamos',array('id_disp_pres'=>1,'cantidad_prestamo'=>1));
       }
       else if($cant==1)
       {
        $this->db->where('id_prestamo',$idpres);
        $this->db->where('rut_prestamo',$rut);
        $this->db->update('prestamos',array('id_disp_pres'=>1,'cantidad_prestamo'=>0));
       }
      
       
       return 1;
    }

    public function updateCant()
    {
       
    
       $this->db->update('prestamos',array('cantidad_prestamo'=>2));
       
       return 1;
    }

    public function updateDevueltoR($cant)
    {
       
        if($cant==2)
        {
       
         $this->db->update('prestamos',array('cantidad_prestamo'=>1));
        }
        else if($cant==1)
        {
         
         $this->db->update('prestamos',array('cantidad_prestamo'=>0));
        }
       
       
       return 1;
     }

    public function updateDevueltoLibro($idlibro)
    {
        $this->db->where('id_libro',$idlibro);
        $this->db->update('libros',array('id_disp_libros'=>1));
        
        return true;
    }

    public function retornarLibro($id)
    {
        $this->db->where('id_prestamo',$id);
        $q = $this->db->get('prestamos');
        $data = $q->result_array();

        if($q->num_rows()>0)
        {
           
            foreach($q->result() as $row)
           
            $q->free_result();
            return $row->idlibroprestado;

        }
        else
        {
          return 0;
        }
    }

    public function retornarRut($id)
    {
        $this->db->where('id_prestamo',$id);
        $q = $this->db->get('prestamos');
        $data = $q->result_array();

        if($q->num_rows()>0)
        {
           
            foreach($q->result() as $row)
           
            $q->free_result();
            return $row->rut_prestamo;

        }
        else
        {
          return 0;
        }
    }

    public function retornarCantidad($id)
    {
        $this->db->where('id_prestamo',$id);
        $q = $this->db->get('prestamos');
        $data = $q->result_array();

        if($q->num_rows()>0)
        {
           
            foreach($q->result() as $row)
           
            $q->free_result();
            return $row->cantidad_prestamo;

        }
        else
        {
          return 0;
        }
    }

}