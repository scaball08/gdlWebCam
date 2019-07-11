<?php if(isset($_POST['submit'])): 
       $nombre = $_POST['nombre']; 
       $apellido = $_POST['apellido'];
       $email = $_POST['email'];
       $regalo = $_POST['regalo']; 
       $total = $_POST['total_pedido'];
       $fecha = date('Y-m-d H:i:s');

       //Pedidos
       $boletos = $_POST['boletos'];
       $camisas = $_POST['pedido_camisas']; 
       $etiquetas = $_POST['pedido_etiquetas']; 
        include_once "includes/funciones/funciones.php";
       $pedido = productos_json($boletos, $camisas , $etiquetas); 

       //eventos 
       $eventos = $_POST['registro'];
       $registro = eventos_json($eventos); 

       try {
              include_once "includes/funciones/bd_conexion.php";
  
              $mysql = new Connection();
            
            
            
              
              $conexion = $mysql->get_connection();
              // PREPARO LA SENTINCIA PARA EL SP
              $prep_statem = $conexion->prepare("CALL sp_ins_registrado(?,?,?,?,?,?,?,?)"); 
              //INSERTO LOS PARAMETROS EN LA SENTENCIA PREPARADA
              $prep_statem->bind_param("ssssssis",$nombre,$apellido ,$email ,$fecha ,$pedido ,$registro ,$regalo ,$total);
              // EJECUTO LA SENTENCIA
              $prep_statem->execute();
              $prep_statem->close();
              $conexion->close();
               header('Location: validar_registro.php?exitoso=1');
              $error = "Insercion exitosa";

} catch (Exception $e) {
  $error = $e->getMessage();
}   	
       
    ?>
 

<?php endif; ?>

<?php  include_once "includes/templates/header.php" ; ?>

<section class="seccion contenedor">
    <h2>Resumen Registro</h2>
    
   <?php if (isset($_GET['exitoso'])) {
   	 if ($_GET['exitoso'] == "1") {
   	 echo "Registro Exitoso";
   	 }
   }  ?>

 </section>
<?php include_once "includes/templates/footer.php" ; ?> 

