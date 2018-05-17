<?php
//if defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {

    public function _construct()
    {
        parent::_construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->model('admin_model');
        $this->load->model('cliente_model');
        /*$user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user) &&isset($pass))
        {
            $this->load->view('indexAdmin');
        }
        else
        {
            $this->load->view('login');
        }*/
    }
    
    public function index()
	{
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           $this->load->view('indexCliente');
          //redirect('login');
        }
        else
        {
            redirect('login');
        }

    } 

    public function listadoLibrosCliente()
    {
        $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        ")->result();

        $data = [
            'libros' => $sql
        ];

        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           
            $this->load->view('listarClienteLibros',$data);
        }
        else
        {
            redirect('login');
        }
    }

    public function buscarUsuarioPrestamo()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           
            $this->load->view('buscarUsuarioPrestamo');
        }
        else
        {
            redirect('login');
        }


    }

    public function validarUsuario()
    {
        $rut_usu = $this->input->post('rut');
        $this->load->model('cliente_model');
       // $data = $this->cliente_model->buscarUsuario($rut_usu);
        
        $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro FROM libros")->result();
        $val = $this->cliente_model->validarBuscarUsuario($rut_usu);
        if($val == 1)
        {
            $data = [
                'libros' => $sql
             //   'usuario' => $this->cliente_model->buscarUsuario($rut_usu)
            ];
            //$data['arrLibros'] = $this->cliente_model->buscarLibro();
           // $data['arrCliente'] = $this->cliente_model->buscarUsuario($rut_usu);

            $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
            $this->load->view('prestarLibro',$data);
            }
            else
            {
            $this->load->view('buscarUsuarioPrestamo');
            }
        }
        else
        { 
            $this->load->view('buscarUsuarioPrestamo');
        }
      
        

        
       
        

    }
}
