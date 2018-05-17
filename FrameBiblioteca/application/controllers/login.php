<?php
//if defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

    public function _construct()
    {
        parent::_construct();
        $this->load->library('session');
        $newdata=array(
            'user'=>'',
            'pass'=>''
        );
        $this->session->set_userdata($newdata);
        $this->load->view('login');
        $this->load->helper('url');
        
        
    }
    
	public function index()
	{
        $newdata=array(
            'user'=>'',
            'pass'=>''
        );
        $this->session->set_userdata($newdata);


        if(isset($_POST['pass'])&&isset($_POST['user']))
        {
            $this->load->model('login_model');

            $data = $this->login_model->returnUsers($_POST['user'],$_POST['pass']);
            
            $val = $data[0]['id_perfil'];
            echo $val;

            if($this->login_model->logeo($_POST['user'],$_POST['pass']))
            {
                if($val==1)
                {
                    $newdata=array(
                        'user'=>$_POST['user'],
                        'pass'=>$_POST['pass']
                    );
                    $this->session->set_userdata($newdata);
                    redirect('admin');
                }
                else if($val==2)
                {
                    $newdata=array(
                        'user'=>$_POST['user'],
                        'pass'=>$_POST['pass']
                    );
                    $this->session->set_userdata($newdata);
                    redirect('cliente');
                }
               
            }
            else
            {
                
                redirect('login');
            }
        }
        
		$this->load->view('login');
    }

    public function listadoLibrosAlumnos()
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

       
            $this->load->view('listadoLibrosAlumnos',$data);
        
    

    }
    
   
}
