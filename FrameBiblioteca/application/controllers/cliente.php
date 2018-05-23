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

    public function buscarUsuarioDevolucion()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           
            $this->load->view('buscarUsuarioDevolucion');
        }
        else
        {
            redirect('login');
        }


    }

    public function libroPrestado()
    {
        $this->load->model('cliente_model');
        $fechaPres = $this->input->post('fechapres');
        $fechaDev = $this->input->post('fechadev');
        $nomusu = $this->input->post('nomlib');
        $apeusu = $this->input->post('apelib');
        $rutusu = $this->input->post('rutusu');
        $idlibro = $this->input->post('selLibro');
        $val = $this->cliente_model->buscarLibroPorId($idlibro);

        $cant = $this->cliente_model->buscarDatosPrestamo($rutusu);
        
        if($cant==0)
        {
            $data = array(
                'nombre_prestado' => $nomusu,
                'apellido_prestado' => $apeusu,
                'fecha_prestamo' => $fechaPres,
                'fecha_devolucion' => $fechaDev,
                'cantidad_prestamo' => 1,
                'idlibroprestado' => $idlibro,
                'nombre_libroprestado' => $val,
                'rut_prestamo' => $rutusu,
                'id_disp_pres' => 2
                  );

                  $valor= $this->cliente_model->ingresarPrestamo($data);
                  $this->cliente_model->updateDisponibilidad($idlibro);
        }
        else if($cant==1)
        {
            $data = array(
                'nombre_prestado' => $nomusu,
                'apellido_prestado' => $apeusu,
                'fecha_prestamo' => $fechaPres,
                'fecha_devolucion' => $fechaDev,
                'cantidad_prestamo' => $cant+1,
                'idlibroprestado' => $idlibro,
                'nombre_libroprestado' => $val,
                'rut_prestamo' => $rutusu,
                'id_disp_pres' => 2
                  );

                  $valor= $this->cliente_model->ingresarPrestamo($data);
                  $this->cliente_model->updateDisponibilidad($idlibro);
            
        }
       
        
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           
            $this->load->view('libroPrestado');
        }
        else
        {
            redirect('login');
        }


    }

    public function libroDevuelto()
    {
        $this->load->model('cliente_model');
        $idpres = $this->input->post('idprestamo');
        $idlib = $this->cliente_model->retornarLibro($idpres);
        $cant = $this->cliente_model->retornarCantidad($idpres);

        $val = $this->cliente_model->updateDevuelto($idpres,$cant);

        $this->cliente_model->updateDevueltoLibro($idlib);
       
      if($val==1)
      {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
           
            $this->load->view('indexCliente');
        }
        else
        {
            redirect('login');
        }
      }
      else
      {
        $this->load->view('buscarUsuarioDevolucion');
      }


    }

    public function validarUsuario()
    {
        $rut_usu = $this->input->post('rut');
        $this->load->model('cliente_model');
       // $data = $this->cliente_model->buscarUsuario($rut_usu);
        
        $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro FROM libros")->result();
        $this->db->where('usuarios.rut_usuario',$rut_usu);
        $this->db->where('usuarios.id_perfil',3);
        $q = $this->db->get('usuarios');
        $val = $this->cliente_model->validarBuscarUsuario($rut_usu);
        if($val == 1)
        {
            $data = [
                'libros' => $sql,
                'usuario' =>  $q->result()

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

    public function validarUsuarioDev()
    {
        $rut_usu = $this->input->post('rut');
        $this->load->model('cliente_model');
       // $data = $this->cliente_model->buscarUsuario($rut_usu);
        
        
        
        $val = $this->cliente_model->validarBuscarUsuario($rut_usu);
        if($val == 1)
        {
                 $this->db->where('rut_prestamo',$rut_usu);
                 $this->db->where('id_disp_pres',2);
            $q = $this->db->get('prestamos');
        $this->load->model('cliente_model');
            $data = [
               'prestamos' => $q->result()

             //   'usuario' => $this->cliente_model->buscarUsuario($rut_usu)
            ];
            //$data['arrLibros'] = $this->cliente_model->buscarLibro();
           // $data['arrCliente'] = $this->cliente_model->buscarUsuario($rut_usu);

            $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
            $this->load->view('devolucionLibros',$data);
            }
            else
            {
            $this->load->view('buscarUsuarioDevolucion');
            }
        }
        else
        { 
            $this->load->view('buscarUsuarioDevolucion');
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
        $this->load->model('cliente_model');
       

        $data = [
            'libros' => $sql,
            'arrAutor'=>$this->cliente_model->getAutores(),
            'arrEditorial'=>$this->cliente_model->getEditorial(),
            'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial(),
            
        ];

       
            $this->load->view('listarClienteLibros',$data);
        
    

    }

    public function filtrarPorBusquedaAlum()
    {
        $this->load->model('cliente_model');
      /*  $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        ")->result();*/

        $fillibro = $this->input->post('fillibro');
        
       /* $sql = "
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        where nombre_libro = ?";*/
        $this->db->join('editorial','libros.id_editorial=editorial.id_editorial');
        $this->db->join('autor','libros.id_autor=autor.id_autor');
        $this->db->join('tipomaterial','libros.id_tipomaterial=tipomaterial.id_tipomaterial');
        $this->db->join('disp_libros','libros.id_disp_libros = disp_libros.id_disp_libros');
        
      //  $this->db->where('nombre_libro',$fillibro);
        $this->db->like('nombre_libro',$fillibro,'after');
        $q = $this->db->get('libros');

        
        
        
        if($q->num_rows()>0)
        {
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
    }

    public function filtrarPorBusquedaAutor()
    {
        $this->load->model('cliente_model');
      /*  $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        ")->result();*/

        $fillibro = $this->input->post('idautors');
      
       /* $sql = "
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        where nombre_libro = ?";*/
        $this->db->join('editorial','libros.id_editorial=editorial.id_editorial');
        $this->db->join('autor','libros.id_autor=autor.id_autor');
        $this->db->join('tipomaterial','libros.id_tipomaterial=tipomaterial.id_tipomaterial');
        $this->db->join('disp_libros','libros.id_disp_libros = disp_libros.id_disp_libros');
        
      //  $this->db->where('nombre_libro',$fillibro);
       

        
        
        
        if($q->num_rows()>0)
        {
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
    }
    
    public function filtrarPorBusquedaEditorial()
    {
        $this->load->model('cliente_model');
      /*  $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        ")->result();*/

        $fillibro = $this->input->post('ideditorials');
        
       /* $sql = "
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        where nombre_libro = ?";*/
        $this->db->join('editorial','libros.id_editorial=editorial.id_editorial');
        $this->db->join('autor','libros.id_autor=autor.id_autor');
        $this->db->join('tipomaterial','libros.id_tipomaterial=tipomaterial.id_tipomaterial');
        $this->db->join('disp_libros','libros.id_disp_libros = disp_libros.id_disp_libros');
        
      //  $this->db->where('nombre_libro',$fillibro);
        $this->db->where('libros.id_editorial',$fillibro);
        $q = $this->db->get('libros');

        
        
        
        if($q->num_rows()>0)
        {
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
    }

    public function filtrarPorBusquedaMaterial()
    {
        $this->load->model('cliente_model');
      /*  $sql = $this->db->query("
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        ")->result();*/

        $fillibro = $this->input->post('idTipoMaterials');
       
       /* $sql = "
        SELECT libros.id_libro,libros.nombre_libro,editorial.nombre_editorial,
        autor.nombre_autor,tipomaterial.nombre_tipomat,disp_libros.descripcion_disp,
        libros.codigo_isbn
        FROM
         libros join editorial on libros.id_editorial=editorial.id_editorial
          join autor on libros.id_autor=autor.id_autor join tipomaterial 
          on libros.id_tipomaterial=tipomaterial.id_tipomaterial
           join disp_libros on libros.id_disp_libros = disp_libros.id_disp_libros
        where nombre_libro = ?";*/
        $this->db->join('editorial','libros.id_editorial=editorial.id_editorial');
        $this->db->join('autor','libros.id_autor=autor.id_autor');
        $this->db->join('tipomaterial','libros.id_tipomaterial=tipomaterial.id_tipomaterial');
        $this->db->join('disp_libros','libros.id_disp_libros = disp_libros.id_disp_libros');
        
      //  $this->db->where('nombre_libro',$fillibro);
        $this->db->where('libros.id_tipomaterial',$fillibro);
        $q = $this->db->get('libros');

        
        
        
        if($q->num_rows()>0)
        {
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->cliente_model->getAutores(),
                'arrEditorial'=>$this->cliente_model->getEditorial(),
                'arrTipoMaterial'=>$this->cliente_model->getTipoMaterial()
            ];
            $this->load->view('listarClienteLibros',$data);
        }
    }

}
