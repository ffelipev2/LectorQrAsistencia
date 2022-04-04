<!DOCTYPE html>
<html>
    <head>
        <title>Asistencia Make It</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="bootstrap-5.1.3-dist/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="bootstrap-5.1.3-dist/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="bootstrap-5.1.3-dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="js/funciones.js" type="text/javascript"></script>
        <script src="js/scripts.js" type="text/javascript"></script>
        <script>
            function ingresoHabilitar() {
                var x = document.getElementById("myDIV");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
            function registroHabilitar() {
                var x = document.getElementById("myDIV2");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>
    </head>
    <body>
        <div class="container">
            <div class="text-center">
                <img src="img/pngegg.png" width="300" height="300" class="center-block" >
            </div>  
        </div>
        </br>

        <div class="container" id="contenedor">
            <div class="d-grid gap-4 mb-4">
                <button type="button" onclick="ingresoHabilitar()" class="btn btn-primary btn-lg btn-block" >Ingreso</button>
                <div id="myDIV" style="display: none" class="mx-auto">
                    <h2> Selecciona el espacio a utilizar</h2>
                    <select class="form-select" aria-label="Default select example" id="espacio" required>
                        <option  disabled="disabled" selected>Selecciona</option>
                        <option value="Cowork">Cowork</option>
                        <option value="Freework">Freework</option>
                        <option value="3D printing">3D printing</option>
                        <option value="Meeting space">Meeting space</option>
                    </select>
                    </br>
                    <div class="col text-center">
                        <button type="button" onclick="marcarEntrada()" class="btn btn-primary btn-lg btn-block mx" >Marcar Ingreso</button>
                    </div> 
                </div>
                <button type="button" onclick="marcarSalida()" class="btn btn-primary btn-lg btn-block">Salida</button>
                <button type="button" onclick="registroHabilitar()" class="btn btn-primary btn-lg btn-block">Registro</button>
                <div id="myDIV2" style="display: none" class="mx-auto">
                    <h2> Completa con tus datos</h2>
                    <form action="index.php" method="post">
                        <label for="exampleFormControlInput1" class="form-label">Rut</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="rut" required oninput="checkRut(this)" name="rut">
                        <label for="exampleFormControlInput1" class="form-label" >Nombre</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="nombre">
                        <label for="exampleFormControlInput1" class="form-label">Apellido</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1"  name="apellido">
                        </br>
                        <div class="col text-center">
                            <button value="reg" type="submit" class="btn btn-primary btn-lg btn-block mx" name="registro">Registrar</button>
                        </div> 
                    </form>
                </div>
            </div>
        </div>
        <div id="barcode">

        </div>
    </body>
</html>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registromakeitQR";

if (isset($_POST['registro'])) { // salida
    $rut = $_POST['rut'];
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    //echo $rut;
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO usuarios (rut, nombre, apellido) VALUES ('$rut', '$nombre', '$apellido')";
        // use exec() because no results are returned
        if ($conn->exec($sql)) {
            echo "<script> Swal.fire('Registro completo', 'Has clic en aceptar', 'success') </script>";
        }
    } catch (PDOException $e) {
        //echo $sql . "<br>" . $e->getMessage();
        echo "<script> Swal.fire({icon: 'error', title: 'Oops...', text: 'Oh no! ocurrio un Error'}) </script>";
    }
    $conn = null;
}
?>
