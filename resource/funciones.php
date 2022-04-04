<?php

date_default_timezone_set('America/Santiago');
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "registromakeitQR";

if (isset($_POST['param3']) && isset($_POST['param4'])) { // entrada
    $espacio_trabajo = $_POST['param3'];
    $rut = $_POST['param4'];
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
// set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT rut FROM usuarios WHERE rut = '$rut'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) { // si existe el registro.
            $stmt = $conn->prepare("SELECT * FROM datos WHERE rut ='$rut' AND fecha= '$fecha' AND horaSalida=''");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if (!$row) { // si NO existe un registro en la tabla datos
                $sql = "INSERT INTO datos (rut, espacioUtilizado, horaEntrada, fecha) VALUES ('$rut', '$espacio_trabajo', '$hora','$fecha')";
                $conn->exec($sql);
                echo '1';
            } else { // si ya existe el registro lo actualiza
                /*
                  $sql = "UPDATE datos SET espacioUtilizado='$espacio_trabajo', horaEntrada='$hora' WHERE rut='$rut' AND fecha='$fecha'";
                  $stmt = $conn->prepare($sql);
                  $stmt->execute();
                 * */
                echo '2';
            }
            /*
              //$sql = "INSERT INTO datos (rut, espacioUtilizado, horaEntrada, fecha) VALUES ('$rut', '$espacio_trabajo', '$hora','$fecha')";
              if ($conn->exec($sql)) {
              echo '6';
              } else {
              echo '8';
              }
              } else {
              echo '11';
             * */
        } else {
            echo '3';
        }
    } catch (PDOException $e) {
//echo $sql . "<br>" . $e->getMessage();
        echo "0";
    }
    $conn = null;

//echo "Entrada, rut :" . $rut;
//echo "Espacio :" . $espacio_trabajo;
//echo "1";
}
if (isset($_POST['param2'])) { // salida
    $hora = date("H:i:s");
    $fecha = date("Y-m-d");
    $rut = $_POST['param2'];
    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT rut FROM usuarios WHERE rut = '$rut'");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($row) { // si existe el registro.
            $stmt = $conn->prepare("SELECT * FROM datos WHERE rut ='$rut' AND fecha= '$fecha' AND horaSalida=''");
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) { // si NO existe un registro en la tabla datos
                $sql = "UPDATE datos SET horaSalida='$hora' WHERE rut='$rut' AND fecha='$fecha'";
                $conn->exec($sql);
                echo '1';
            } else { // si ya existe el registro lo actualiza
                echo '2';
            }
        } else {
            echo '3';
        }
    } catch (PDOException $e) {
//echo $sql . "<br>" . $e->getMessage();
        echo "0";
    }
    $conn = null;
}
?>