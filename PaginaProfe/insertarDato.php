 <!DOCTYPE html>
               <html lang="en">
               <head>
                   <meta charset="UTF-8">
                   <title></title>
                   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
               </head>
               <body>
                    <?php 

                include("conexion.php");
                if(isset($_POST['enviar']))
                {
                    $nombre=$_POST['nombre'];
                    $apellido=$_POST['apellido'];
                    $edad=$_POST['edad'];
                    $rut=$_POST['rut'];
                    echo $nombre;
                    echo $apellido;
                    echo $edad;
                    echo $rut;

                    $sql="INSERT INTO alumno (nombre,apellido,edad,rut) values ('".$nombre."','".$apellido."','".$edad."','".$rut."')";

                    if ($conn->query($sql) === TRUE) {
                     echo "Registro grabado correctamente";
                    } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                     }

                     $conn->close();


                   }               
             ?>
             <script type="text/javascript">swal("Hello world!")</script>
             <script type="text/javascript">setTimeout(function () {window.location.href = "/PaginaProfe/index.php";},15000); </script>
             
               </body>
               </html>              