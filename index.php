<?php
        session_start();
?>        
<!DOCTYPE html>
<html lang ="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4bw+/aepP/YC94hEpVNVgiZdgIC5+VKNBQNGCHeKRQN+PtmoHDEXuppvnDJzQIu9" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
    </head>
    <div class="container-fluid">
        <div class="container pt-5">
            <div class="col-md-12">
                <h3 class="text-center">RESTAURANTE PETRONA BURGER</h3>
            </div><br><br>
            <h4>Datos del usuario</h4><br>
            <form action='' method='post'>
                <label for='cedula'><h4>Cédula<h4></label>
                <input class='form-control' type='number' name='cedula' placeholder='Ingrese su numero de cédula'><br>
                <button type='submit' class='btn btn-primary btn-lg' name='agregar'>Agregar</button>
                <button type='submit' class='btn btn-info btn-lg' name='buscar'>Buscar</button>
            </form>
        </div>
    </div>        
<?php 
//validacion de agregar cedulas
            $sw = false;
            $m=0;
             if(isset($_POST['agregar'])){
                $cedula = $_POST['cedula'];
                if(($cedula>=10000000 && $cedula<=99999999) || ($cedula>=1000000000 && $cedula<=9999999999)){
                    if(!isset($_SESSION['tcedulas'])){
                        $_SESSION['tcedulas'][] = array("cedulas"=>$cedula);
                        echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado se agregó correctamente<h5></div></div>";
                    }else{
                        foreach ($_SESSION['tcedulas'] as $key => $value) {
                            if($value['cedulas'] == $cedula){
                                unset($_SESSION['tcedulas'][$key]);
                                $m++;
                                if($m == 1){
                                    $sw = true;
                                }else{
                                    $sw = false;
                                }
                            }else{
                                $sw = true;
                            }
                        }
                        if($sw == true){
                            $_SESSION['tcedulas'][] = array("cedulas"=>$cedula);
                        }
                        if($m==1){
                            echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado ya existe<h5></div></div>";
                        }else{
                            echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado se agregó correctamente<h5></div></div>";
                        }
                    }
                       
                }else{
                    echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado no es válido<h5></div></div>";
                }
            }
//validacion de buscar y mostrar cedulas
            if(isset($_POST['buscar'])){
                    if(!isset($_SESSION['tcedulas'])){
                        echo"<br><div class='container-fluid'><div class='container pt-5'><h5>Ingrese al menos una cédula<h5></div></div>";
                    }else{
                        $cedula = $_POST['cedula'];
                        if(($cedula>=10000000 && $cedula<=99999999) || ($cedula>=1000000000 && $cedula<=9999999999)){
                            if(isset($_SESSION['tcedulas']) ){
                                foreach ($_SESSION['tcedulas'] as $key => $value) {
                                    if($cedula == $value['cedulas']){
                                        $sw = true;
                                        echo"<div class='container-fluid'><div class='container pt-5'><h5>Cédula: ".$value['cedulas']."<h5></div></div>";
                                    }
                                }
                                if($sw == false){
                                    echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado no existe<h5></div></div>";
                                }
                            }
                        }else{
                            echo"<div class='container-fluid'><div class='container pt-5'><h5>El número de cédula ingresado no es válido<h5></div></div>";
                        }    
                    }    
            }

?> 
<div class="container-fluid">
    <div class="container pt-5">
        <form action="" method="post" enctype="multipart/form-data">
            <label for='file'><h4>Foto o firma del ususario<h4></label>
            <input type="file" name="file">
            <input type="submit" value="Enviar">
        </form>
    </div>
</div>  
<?php  
    if ($_FILES){
        $nom_arc = $_FILES['file']['name'];
        $nom_tem = $_FILES['file']['tmp_name'];
        $validator = 1; //Variable validadora
        $file_type = strtolower(pathinfo($nom_arc,PATHINFO_EXTENSION)); //Extensión de nuestro archivo
        //Validamos el tamaño del archivo
        $file_size = $_FILES["file"]["size"];
        if ( $file_size > 10000000) {
        echo "<div class='container-fluid'><div class='container pt-5'><h5>El archivo es muy pesado<h5></div></div>";
        $validator = 0;
        }
        if($file_type != "jpg" && $file_type != "jpeg" && $file_type != "png" && $file_type != "gif" ) {
            echo "<div class='container-fluid'><div class='container pt-5'><h5>Solo se permiten imágenes tipo JPG, JPEG, PNG & GIF<h5></div></div>";
            $validator = 0;
          }
        if($validator == 1){
            rename($nom_tem, 'imgs/users/'.$nom_arc);
            $_SESSION ['tfotos'][] = 'imgs/users/'.$nom_arc;
            echo"<div class='container-fluid'><div class='container pt-5'><h5>La foto ingresada se agregó correctamente<h5></div></div>";
        }
        foreach($_SESSION['tfotos'] as $key => $value){
?>
        <img style="width: 350px; height: 350px;" src="<?php echo $value?>" class="ico" alt="Imagen"/><br>
<?php
        }
    }
?>              
<div class="container-fluid">
        <div class="container pt-5">
            <h4>Menú</h4><br>
            <table class="tbl">
            <thead>
                <th class="text-center"><h5>ID<h5></th>
                <th class="text-center"><h5>COMIDAS<h5></th>
                <th class="text-center"><h5>PRECIO<h5></th>
                <th class="text-center"><h5>ACCIONES<h5></th>
            </thead>
            <tbody>
                <tr>
                    <td class="text-center"><h5>1<h5></td>
                    <td style="width:100px"><img src="imgs/Hamburguesa.png" alt="Hamburguesa" width="100px" heigth="100px"></td>
                    <td class="text-center"><h5>$10.000<h5></td>
                    <td>
                        <form action="" method="post">
                            <input class="form-control" type="hidden" name="txtComida" value="Hamburguesa">
                            <input class="form-control" type="number" name="cant" value="1" style="width:100px;"><br>
                            <input class="form-control" type="hidden" name="txtPrecio" value="10000">
                            <button type="submit" class="btn btn-primary" name="add">Añadir</button>
                        </form>
                    </td>
                </tr>
                <tr>
                <td class="text-center"><h5>2<h5></td>
                <td style="width:100px"><img src="imgs/Bebidas.png" alt="Bebidas" width="100px" heigth="100px"></td>
                <td class="text-center"><h5>$5.000<h5></td>
                <td>
                    <form action="" method="post">
                        <input class="form-control" type="hidden" name="txtComida" value="Bebidas">
                        <input class="form-control" type="number" name="cant" value="1" style="width:100px;"><br>
                        <input class="form-control" type="hidden" name="txtPrecio" value="5000">
                        <button type="submit" class="btn btn-primary" name="add">Añadir</button>
                    </form>
                </td>
                </tr>
                <tr>
                <td class="text-center"><h5>3<h5></td>
                <td style="width:100px"><img src="imgs/Acompañamiento.png" alt="Acompañamiento" width="100px" heigth="100px"></td>
                <td class="text-center"><h5>$5.000<h5></td>
                <td>
                    <form action="" method="post">
                        <input class="form-control" type="hidden" name="txtComida" value="Acompañamiento">
                        <input class="form-control" type="number" name="cant" value="1" style="width:100px;"><br>
                        <input class="form-control" type="hidden" name="txtPrecio" value="5000">
                        <button type="submit" class="btn btn-primary" name="add">Añadir</button>
                    </form>
                </td>
                </tr>
            </tbody>
            </table>
    </div>
</div>    
<?php
        if(isset($_POST['add'])){
            if(empty($_SESSION['tcedulas']) || empty($_SESSION['tfotos'])){
                echo"<div class='container-fluid'><div class='container pt-5'><h5>Ingrese al menos una cédula y una foto<h5></div></div>";
            }else{
                $comida = $_POST['txtComida'];
                $cantidad = $_POST['cant'];
                $precio = $_POST['txtPrecio'];
                if($cantidad < 1){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Agregue una cantidad correcta</h5></div></div>";
                }else{ 
                    $_SESSION['pedido'] [] = array("comida" => $comida, "cantidad" => $cantidad, "precio" => $precio);
                }
            }
        } 
?>
<div class="container-fluid">
        <div class="container pt-5">            
            <div class = "contenedor">
                <div class = "div1">   
                <form action="pedidos.php" method="post">
                    <button type="submit" class="btn btn-success btn-lg" name="listar">Listar pedido</button>
                </form>
                </div>
                <div class = "div2">
                <form action="" method="post">
                    <button type="submit" class="btn btn-danger btn-lg" name="vaciar">Vaciar pedido</button>
                </form>
                </div>
                <div class = "div3">
                <form action="pedidos.php" method="post">
                    <button type="submit" class="btn btn-warning btn-lg" name="mostrar">Mostrar pedido</button>
                </form>
                </div>
            </div><br>
        </div>
</div>
<?php
    if(isset($_POST['vaciar'])){
        session_destroy();
     //unset($_SESSION['pedido']);
    }
    if(isset($_POST['mostrar'])){
        ordenamientos();
    }
?> 

    <style> 
    *{
    padding: 0;
    margin: 0;
    text-decoration: none;
    list-style: none;
    box-sizing: border-box;
    }
    .container-fluid{
        background-image: url("imgs/Fondo.jpg");
        background-size: cover;
        background-repeat: no-repeat;
        background-attachment: fixed;
        background-position: center;
        background-color: #000000;
        color: black;
    }   
    @font-face {
    font-family: 'foodpacker';
    src: url('fonts/foodpacker.ttf');
    }   
    .tbl { border-collapse: collapse; background-color: black;}
    .tbl th, .tbl td { padding: 5px; border: solid 1px #777; font-family: foodpacker; text-shadow: 2px 2px 1px #000000;}
    .tbl-separate { border-collapse: separate; border-spacing: 5px;}
    h3 {
    color: #FFFFFF;
    font-family: foodpacker;
    font-size: 50px; 
    text-shadow: 2px 2px 1px #000000;
    }
    h4 {
    color: #FFFFFF;
    font-family: foodpacker;
    font-size: 35px; 
    text-shadow: 2px 2px 1px #000000;
    }
    h5 {
    color: #FFFFFF;
    font-family: foodpacker;
    font-size: 25px; 
    text-shadow: 2px 2px 1px #000000;
    }
    .contenedor {
        display : flex;
    }
    .div1{
        width: 150px;
    }
    .div2{
        width: 200px;
        margin-left: 35px;
    }
    </style>
</html>