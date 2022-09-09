<?php
     
     if( !empty($_POST) ){
       $txt_id = utf8_decode($_POST["txt_id"]);
        $txt_carne = utf8_decode($_POST["txt_carne"]);
        $txt_nombres = utf8_decode($_POST["txt_nombres"]);
        $txt_apellidos = utf8_decode($_POST["txt_apellidos"]);
        $txt_direccion = utf8_decode($_POST["txt_direccion"]);
        $txt_telefono = utf8_decode($_POST["txt_telefono"]);
        $txt_ce = utf8_decode($_POST["txt_ce"]);
        $drop_ts = utf8_decode($_POST["drop_ts"]);
        $txt_fn = utf8_decode($_POST["txt_fn"]);
      include("datos_conexion.php");
        $db_conexion = mysqli_connect($db_host,$db_usr,$db_pass,$db_nombre);
        $sql ="";
        if(isset($_POST['btn_agregar'])  ){
          $sql = "INSERT INTO estudiantes(carne,nombres,apellidos,dirección,telefono,correo_electronico,fecha_nacimiento,id_tipo_sangre) VALUES ('". $txt_carne ."','". $txt_nombres ."','". $txt_apellidos ."','". $txt_direccion ."','". $txt_telefono ."','". $txt_ce ."','". $txt_fn ."',". $drop_ts .");";
        }
        if( isset($_POST['btn_modificar'])  ){
          $sql = "update estudiantes set carne='". $txt_carne ."',nombres='". $txt_nombres ."',apellidos='". $txt_apellidos ."',dirección='". $txt_direccion ."',telefono='". $txt_telefono ."',correo_electronico='". $txt_ce ."',fecha_nacimiento='". $txt_fn ."',id_tipo_sangre=". $drop_ts ." where id_estudiante = ". $txt_id.";";
        }
        if( isset($_POST['btn_eliminar'])  ){
          $sql = "delete from estudiantes  where id_estudiante = ". $txt_id.";";
        }
         
          if ($db_conexion->query($sql)===true){
            $db_conexion->close();
           
            header('Location: /php_estudiantes');
           
          }else{
            $db_conexion->close();
          
          }

      }
     
    
      
      ?>