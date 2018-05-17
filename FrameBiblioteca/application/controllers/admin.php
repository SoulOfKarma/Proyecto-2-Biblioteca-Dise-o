<?php
//if defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function _construct()
    {
        parent::_construct();
        
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->model('login_model');
        $this->load->model('admin_model');
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
           $this->load->view('indexAdmin');
          //redirect('login');
        }
        else
        {
            redirect('login');
        }

    }
    

	public function listarAdminLibros()
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
           
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {
            redirect('login');
        }


    }

    public function agregarAdminLibros()
	{
        $this->load->model('admin_model');
        $datosAutor['arrAutor']=$this->admin_model->getAutores();
        $datosAutor['arrEditorial']=$this->admin_model->getEditorial();
        $datosAutor['arrTipoMaterial']=$this->admin_model->getTipoMaterial();
        $datosAutor['arrDisponible']=$this->admin_model->getDisponibilidad();

        

        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {

            $this->load->view('agregarAdminLibros',$datosAutor);
        }
        else
        {
            redirect('login');
        }


    }

    public function eliminarAdminLibros()
	{
        $sql = $this->db->query("
        SELECT id_libro,nombre_libro FROM libros
        ")->result();

        $data = [
            'libros' => $sql
        ];


        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('eliminarAdminLibros',$data);
        }
        else
        {
            redirect('login');
        }


    }

    public function modificarAdminLibros()
	{
        $idlibro = $this->input->post('idlibro');
       
        $this->load->model('admin_model');
        $datosAutor['arrAutor']=$this->admin_model->getAutores();
        $datosAutor['arrEditorial']=$this->admin_model->getEditorial();
        $datosAutor['arrTipoMaterial']=$this->admin_model->getTipoMaterial();
        $datosAutor['arrDisponible']=$this->admin_model->getDisponibilidad();
        $datosAutor['arrLibros']=$this->admin_model->devolverLibroFiltrado($idlibro);
        $datosAutor['arrLibrosisbn']=$this->admin_model->devolverLibroIsbnFiltrado($idlibro);
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('modificarAdminLibros',$datosAutor);
        }
        else
        {
            redirect('login');
        }


    }

    public function agregarAutor()
	{
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarAutor');
        }
        else
        {
            redirect('login');
        }


    }

    public function agregarEditorial()
	{
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarEditorial');
        }
        else
        {
            redirect('login');
        }


    }

    public function agregarTipoMaterial()
	{

        

        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarTipoMaterial');
        }
        else
        {
            redirect('login');
        }


    }

    public function insertAutor()
    {
        $nombre_autor = $this->input->post('nomautor');
        $sql = $this->db->query(
            "insert into autor(nombre_autor) values('$nombre_autor')"
        );
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarAutor');
        }
        else
        {
            redirect('login');
        }
    }

    public function insertTipoMaterial()
    {
        $nombre_tipomat = $this->input->post('nomtipomaterial');
        $sql = $this->db->query(
            "insert into tipomaterial(nombre_tipomat) values('$nombre_tipomat')"
        );
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarTipoMaterial');
        }
        else
        {
            redirect('login');
        }
    }

    public function insertEditorial()
    {
        $nombre_editorial = $this->input->post('nomeditorial');
        $sql = $this->db->query(
            "insert into editorial(nombre_editorial) values('$nombre_editorial')"
        );
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            $this->load->view('agregarEditorial');
        }
        else
        {
            redirect('login');
        }
    }

    public function insertLibro()
    {
        $idEditorial = $this->input->post('selEditorial');
        $idAutor = $this->input->post('selAutor');
        $idDisp = $this->input->post('seldisponible');
        $idTipoMat = $this->input->post('selTipoMaterial');
        $codisbn = $this->input->post('codisbn');
        $nombreLibro = $this->input->post('nomlib');

        $sql = $this->db->query(
            "insert into libros(nombre_libro,id_autor,id_editorial,id_tipomaterial,id_disp_libros,codigo_isbn) values('$nombreLibro',
            '$idAutor','$idEditorial','$idTipoMat','$idDisp','$codisbn')"
        );
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
            redirect('Admin/agregarAdminLibros');
        }
        else
        {
            redirect('login');
        }
    }

    public function deleteLibro()
    {
        $idEditorial = $this->input->post('idlibro');
        $this->db->where('id_libro',$idEditorial);
        $this->db->delete('libros');
        redirect('Admin/eliminarAdminLibros');

    }

    public function updateLibro()
    {
        $data = array(
            'libros' => 'libros',
            'idlibro' => $this->input->post('id_libro'),
            'nombrelibro' => $this->input->post('nomlib'),
            'idEditorial' => $this->input->post('selEditorial'),
            'idAutor' => $this->input->post('selAutor'),
            'idTipoMat'=> $this->input->post('selTipoMaterial'),
            'codigo_isbn'=> $this->input->post('codigo_isbn'),
            'id_Disp_Libro' => $this->input->post('seldisponible')

        );
        $this->load->model('admin_model');
        /*$idEditorial = $this->input->post('selEditorial');
        $idAutor = $this->input->post('selAutor');
        $idTipoMat = $this->input->post('selTipoMaterial');
        $nombreLibro = $this->input->post('nomlib');
        $idlibro = $this->input->post('id_libro');
        echo $idEditorial;
        echo $idAutor;
        echo $idTipoMat;
        echo $nombreLibro;
        echo $idlibro;*/
       // $this->admin_model->modificarLibro($idEditorial,$idAutor,$idTipoMat,$nombreLibro,$idlibro);
        
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass)&&$this->admin_model->modificarLibro($data))
        {
            redirect('Admin/listadoModificarLibro');
        }
        else
        {
            redirect('login');
        }
    }

    public function listadoModificarLibro()
    {
            $sql = $this->db->query("
            SELECT id_libro,nombre_libro FROM libros
            ")->result();
    
            $data = [
                'libros' => $sql
            ];
    
    
            $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
                $this->load->view('listadoModificarLibro',$data);
            }
            else
            {
                redirect('login');
            }
    }


    
   
}
