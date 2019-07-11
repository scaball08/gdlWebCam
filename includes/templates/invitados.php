
      <?php 

            try {
                          require_once('includes/funciones/bd_conexion.php');
              
                          $obj_conect = new Connection();
                          $conectar = $obj_conect->get_connection();
                          $conectar->set_charset('utf8');
                          $consul = mysqli_query($conectar,"SELECT * FROM `invitados` ");

             $error = "";
            } catch (Exception $e) {
              $error = $e->getMessage();
            }

      ?>

     

         <section class="invitados contenedor seccion">
            <h2>Invitados</h2>
            <ul class="lista-invitados clearfix">
          <?php while( $invitados = mysqli_fetch_array($consul)){  ?>

                <li>
                   <div class="invitado">
                    <a class="invitado-info" href="#invitado<?php  echo $invitados['invitado_id'] ; ?>">
                     <img src="img/<?php  echo $invitados['url_imagen'] ; ?>" alt="imagen invitado">
                     <p><?php  echo $invitados['nombre_invitado'] . " ". $invitados['apellido_invitado']  ; ?>
                       
                     </p>
                     </a>
                   </div>  
                </li>
                <div style="display:none;">
                   <div class="invitado-info" id="invitado<?php  echo $invitados['invitado_id'] ; ?>">
                     <h2><?php  echo $invitados['nombre_invitado'] . " ". $invitados['apellido_invitado']  ; ?></h2>
                     <img src="img/<?php  echo $invitados['url_imagen'] ; ?>" alt="imagen invitado">
                     <p><?php  echo $invitados['descripcion'] ; ?></p>
                   </div>
                </div>
      
             <?php  } //while de mysqli_fetch_array
               $consul->close(); 
              $conectar->close();
             ?>
            </ul><!-- LISTA INVITADOS -->
          </section> <!-- INVITADOS -->