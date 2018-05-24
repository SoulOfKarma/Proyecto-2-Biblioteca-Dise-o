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
    


    public function agregarAdminLibros()
	{
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {

        $this->load->model('admin_model');
        $datosAutor['arrAutor']=$this->admin_model->getAutores();
        $datosAutor['arrEditorial']=$this->admin_model->getEditorial();
        $datosAutor['arrTipoMaterial']=$this->admin_model->getTipoMaterial();
        $datosAutor['arrDisponible']=$this->admin_model->getDisponibilidad();
            $this->load->view('agregarAdminLibros',$datosAutor);
        }
        else
        {
            redirect('login');
        }


    }

    public function eliminarAdminLibros()
	{
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
         $sql = $this->db->query("
         SELECT id_libro,nombre_libro FROM libros
         ")->result();

         $data = [
             'libros' => $sql
         ];
            $this->load->view('eliminarAdminLibros',$data);
         }
         else
         {
            redirect('login');
         }


    }

    public function modificarAdminLibros()
	{
        $user = $this->session->user;
         $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
         $idlibro = $this->input->post('idlibro');
        
         $this->load->model('admin_model');
         $datosAutor['arrAutor']=$this->admin_model->getAutores();
         $datosAutor['arrEditorial']=$this->admin_model->getEditorial();
         $datosAutor['arrTipoMaterial']=$this->admin_model->getTipoMaterial();
         $datosAutor['arrDisponible']=$this->admin_model->getDisponibilidad();
         $datosAutor['arrLibros']=$this->admin_model->devolverLibroFiltrado($idlibro);
         $datosAutor['arrLibrosisbn']=$this->admin_model->devolverLibroIsbnFiltrado($idlibro);
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
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $nombre_autor = $this->input->post('nomautor');
        $sql = $this->db->query(
            "insert into autor(nombre_autor) values('$nombre_autor')"
        );
       
        $mensaje = '<div class="alert alert-success" role="alert">
        Autor Insertado Correctamente
      </div>';
        $data = [
            'mensaje' => $mensaje,
            
        ];
 
       
        $this->load->view('correctoAdmin',$data);
        }
        else
        {
            redirect('login');
        }
    }

    public function insertTipoMaterial()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $nombre_tipomat = $this->input->post('nomtipomaterial');
        $sql = $this->db->query(
            "insert into tipomaterial(nombre_tipomat) values('$nombre_tipomat')"
        );
      
        $mensaje = '<div class="alert alert-success" role="alert">
        Tipo de Material Insertado Correctamente
      </div>';
        $data = [
            'mensaje' => $mensaje,
            
        ];
 
       
        $this->load->view('correctoAdmin',$data);
        }
        else
        {
            redirect('login');
        }
    }

    public function insertEditorial()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $nombre_editorial = $this->input->post('nomeditorial');
        $sql = $this->db->query(
            "insert into editorial(nombre_editorial) values('$nombre_editorial')"
        );
        
        $mensaje = '<div class="alert alert-success" role="alert">
        Editorial Insertada Correctamente
      </div>';
        $data = [
            'mensaje' => $mensaje,
            
        ];
 
       
        $this->load->view('correctoAdmin',$data);
        }
        else
        {
            redirect('login');
        }
    }

    public function insertLibro()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
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
        $mensaje = '<div class="alert alert-success" role="alert">
            Libro Ingresado Correctamente
          </div>';
            $data = [
                'mensaje' => $mensaje,
                
            ];
    
           
            $this->load->view('correctoAdmin',$data);
        }
        else
        {
            redirect('login');
        }
    }

    public function deleteLibro()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $idEditorial = $this->input->post('idlibro');
        $this->db->where('id_libro',$idEditorial);
        $this->db->delete('libros');
        $mensaje = '<div class="alert alert-success" role="alert">
            Libro Eliminado Correctamente
          </div>';
            $data = [
                'mensaje' => $mensaje,
                
            ];
    
           
            $this->load->view('correctoAdmin',$data);
       // redirect('Admin/eliminarAdminLibros');
        }
         else
        {
          redirect('login');
        }
        }

    public function updateLibro()
    {

        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
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
        $this->admin_model->modificarLibro($data);
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
        
       $mensaje = '<div class="alert alert-success" role="alert">
       Libro Modificado Correctamente
     </div>';
       $data = [
           'mensaje' => $mensaje,
           
       ];

      
       $this->load->view('correctoAdmin',$data);
           // redirect('Admin/listadoModificarLibro');
        }
        else
        {
            redirect('login');
        }
    }

    public function listadoModificarLibro()
    {
        $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
            $sql = $this->db->query("
            SELECT id_libro,nombre_libro FROM libros
            ")->result();
    
            $data = [
                'libros' => $sql
            ];
    
    
            
                $this->load->view('listadoModificarLibro',$data);
            }
            else
            {
                redirect('login');
            }
    }

    public function listarAdminLibros()
    {
        $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
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
        $this->load->model('admin_model');
       

        $data = [
            'libros' => $sql,
            'arrAutor'=>$this->admin_model->getAutores(),
            'arrEditorial'=>$this->admin_model->getEditorial(),
            'arrTipoMaterial'=>$this->admin_model->getTipoMaterial(),
            
        ];

       
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {
            redirect('login');
        }
    

    }

    public function filtrarPorBusquedaAlum()
    {
        $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
        $this->load->model('admin_model');
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
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
    }
    else
    {
        redirect('login');
    }
    }

    public function filtrarPorBusquedaAutor()
    {
        $user = $this->session->user;
            $pass = $this->session->pass;
            if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
            {
        $this->load->model('admin_model');
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
        $this->db->where('libros.id_autor',$fillibro);
        $q = $this->db->get('libros');

        
        
        
        if($q->num_rows()>0)
        {
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
    }
    else
    {
        redirect('login');
    }
    }
    
    public function filtrarPorBusquedaEditorial()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $this->load->model('admin_model');
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
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
    }
    else
    {
        redirect('login');
    }
    }

    public function filtrarPorBusquedaMaterial()
    {
        $user = $this->session->user;
        $pass = $this->session->pass;
        if(isset($user)&&!empty($user)&&isset($pass)&&!empty($pass))
        {
        $this->load->model('admin_model');
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
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
        else
        {  
            $data = [
                'libros' => $q->result(),
                'arrAutor'=>$this->admin_model->getAutores(),
                'arrEditorial'=>$this->admin_model->getEditorial(),
                'arrTipoMaterial'=>$this->admin_model->getTipoMaterial()
            ];
            $this->load->view('listarAdminLibros',$data);
        }
    }
    else
    {
        redirect('login');
    }
    }


    
   
}
