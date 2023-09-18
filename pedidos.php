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
            <form action="index.php" method="post">
                <button type='submit' class='btn btn-warning btn-lg' name = 'regresar'>Regresar</button><br><br>
            </form>
        </div>
    </div>
    <?php
    
    if(isset($_POST['delete'])){
        unset($_SESSION['mascotas'][$_POST['key']]);
        ordenamiento();
    }

    if(isset($_POST['listar'])){
        ordenamiento();
    }

    function ordenamiento(){

        $cedula = $_SESSION['tcedulas'];
        echo "<br><br>";
        var_dump($cedula);
        $fotos = $_SESSION ['tfotos'];
        echo "<br><br>";
        var_dump($fotos);
        if(!empty($_SESSION['pedido'])){
            $_SESSION['pedidos'] [] = $_SESSION['pedido'];
            unset($_SESSION['pedido']);
        }
        echo "<br><br>";
        var_dump($_SESSION['pedidos']);
        echo "<br><br>";
        if(empty($cedula) || empty($fotos) || empty($_SESSION['pedidos'])){
            echo "<div class='container-fluid'><div class='container pt-5'><h5>llene todos los campos de la pagina anterior</h5></div></div>";
        }else{
                foreach ($_SESSION['pedidos'] as $key => $valor) {
                    $total = 0;
                    foreach($valor as $key => $value){
                        $totalp = $value['cantidad'] * $value['precio'];
                        $total += $totalp;
                    }
                    $_SESSION['pedidos'][] = array("total" => $total);
                }
                var_dump($_SESSION['pedidos']);
            /*foreach($fotos as $key => $value){
                ?>
                    <div class='container-fluid'><div class='container pt-5'><img style="width: 350px; height: 350px;" src="<?php echo $value?>" class="ico" alt="Imagen"/></h5></div></div>
                <?php
                foreach($cedula as $key => $value){
                echo "<div class='container-fluid'><div class='container pt-5'><h5>Cédula = ".$value['cedulas']."</h5></div></div>";
                foreach($_SESSION['pedidos'] as $key => $valor){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Pedido = ".($key+1)."</h5></div></div>";
                    $total = 0;
                    foreach($valor as $key => $value){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Comida = ".$value['comida']."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Cantidad = ".$value['cantidad']."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Precio = ".$value['precio']."</h5></div></div>";
                    $totalp = $value['cantidad'] * $value['precio'];
                    $total += $totalp;
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>pos = ".$key."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><a href='pedidos.php?item=$key'><button type='submit' class='btn btn-danger'>Eliminar</button></a></div></div>";
                    }
                    if($total > 0){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Total = ".$total."</h5></div></div>";
                    }
                    }
                }
            }*/
        }
    }

    if (isset($_POST['eliminar']) && isset($_POST['key'])) {
        $key = $_POST['key'];
        if (isset($_SESSION['clientes'][$key])) {
            unset($_SESSION['clientes'][$key]);
        }
    }

    //var_dump($_SESSION['pedidos']);

  /*  usort($_SESSION['pedidos'], function($a, $b) {
        return $a['total'] - $b['total'];
    });*/

   /*if(isset($_SESSION['pedidos'])){

       foreach($_SESSION['pedidos'] as $key => $valor){
            if($key==0){
                foreach($valor as $value){
                    ?>
                        <div class='container-fluid'><div class='container pt-5'><img style="width: 350px; height: 350px;" src="<?php echo $value?>" class="ico" alt="Imagen"/></h5></div></div>
                    <?php
                }
            }else if ($key==1){
                foreach($valor as $value){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Cedula: ".$value["cedulas"]."</h5></div></div>";
                }
            }else if ($key==2){
                 foreach($valor as $llave => $value){
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Pedido: ".$llave."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Comida: ".$value["comida"]."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Cantidad: ".$value["cantidad"]."</h5></div></div>";
                    echo "<div class='container-fluid'><div class='container pt-5'><h5>Precio: ".$value["precio"]."</h5></div></div>";
                }
            }else{
                        //echo "<div class='container-fluid'><div class='container pt-5'><h5>Total: ".$valor."</h5></div></div>";
            }
            
        }
    }*/
/*function ordenamiento(){

if(isset($_SESSION['pedidos'])){

    echo "<div class='container-fluid'><div class='container pt-5'><h3>Lista de pedidos</h3>";
    echo "<table class='tbl table table-dark text-center'>";
    echo "<thead><th>ID</th><th>COMIDA</th><th>CANTIDAD</th><th>PRECIO</th><th>ACCIONES</th></thead>";
    echo "<tbody>";
    $total = 0; 
    $pos = 1; 
    foreach($_SESSION['pedidos'] as $indice => $pedidos){
            $total += $pedidos['cantidad']*$pedidos['precio'];
            echo "<tr>";
            echo "<td>".$pos."</td>";
            echo "<td>".$indice."</td>";
            echo "<td>".$pedidos['cantidad']."</td>";
            echo "<td>$".$pedidos['precio']."</td>";
            echo "<td><a href='pedidos.php?item=$indice'><button type='submit' class='btn btn-danger'>Eliminar</button></a></td>";
            echo "</tr>";
            $pos++;  
    }
    echo "</tbody>";
    echo "<tfoot>";
    echo "<tr>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<th></th>";
    echo "<th>TOTAL</th>";
    echo "<th>$$total</th>";
    echo "</tr>";
    echo "</tfoot>";
    echo "</table>";
    echo "<div class='container-fluid'><div class='container pt-5'><form action='index.php' method='post'>
        <button type='submit' class='btn btn-danger' name='vaciar'>Vaciar pedido</button>
        </form></div></div><br>";
}
}

if(isset($_REQUEST['item'])){
    $comida = $_REQUEST['item'];
    unset($_SESSION['pedidos'][$comida]);
    echo "<script>alert('Se eliminó: $comida');</script>";
    header("Location:pedidos.php");
}

if(isset($_POST['vaciar'])){
    session_destroy();;
}*/

/*
$pedidospos = array();
    $pos=1;
    foreach ($_SESSION['pedidos'] as $indice => $arreglo){
        foreach ($arreglo as $key => $value){
        $posicion = 0;
        if(!isset($pedidospos[$posicion])){
            $pedidospos[$posicion] = array();
        }
        $pedidospos[$posicion][] = array("posiciones" => $pos, "comida" => $indice, "total" => $posicion, "key" => $indice);
        $pos++;
    }
    }
        echo "<div class='container-fluid'><div class='container pt-5'><h3>Lista previa de pedidos</h3>";
        echo "<table class='tbl table table-dark'>";
        echo "<tr><th>ID</th><th>COMIDA</th><th>PRECIO</th><th>ACCIONES</th></tr>";
    foreach ($pedidospos as $posicion => $valor) {
        foreach ($valor as $value) {
            echo "<tr>";
            echo "<td>".$value['posiciones']."</td>";
            echo "<td>".$value['comida']."</td>";
            echo "<td>".$value['total']."</td>";
            echo "<td><form action='' method='post'><input type='hidden' name='key' value = ".$value['key']."><button type='submit' class='btn btn-danger' name = 'delete'>Eliminar</button></form></td>";
            echo "</tr>";
        }
    }
    echo "</table></div></div>";

*/ 
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
    .tbl { border-collapse: collapse;}
    .tbl th, .tbl td { padding: 5px; border: solid 1px #777; font-family: foodpacker; text-shadow: 2px 2px 1px #000000;}
    .tbl th { background-color: dark; }
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
    .regresar {
    background-color: #199319;
    color: white;
    padding: 15px 25px;
    text-decoration: none;
    }
    </style>
</html>