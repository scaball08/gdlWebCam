

  <?php  include_once "includes/templates/header.php" ; ?>

  <section class="seccion contenedor">
     <h2>Calendario de Eventos</h2>
      <?php 

            try {
                          require_once('includes/funciones/bd_conexion.php');
              
                          $obj_conect = new Connection();
                          $conectar = $obj_conect->get_connection();
                          $conectar->set_charset('utf8');
                          $consul = mysqli_query($conectar,"SELECT * FROM view_eventos ");

             $error = "";
            } catch (Exception $e) {
              $error = $e->getMessage();
            }

      ?>

     <div class="calendario">
       <?php 
              $calendario =  array();
              while( $registros = mysqli_fetch_array($consul)){

               // Obtener  la fecha para ordenar los eventos 
               $fecha_eventos = $registros['fecha_evento'] ;
              $evento = array('titulo'=> $registros['nombre_evento'],
               'fecha'=> $registros['fecha_evento'],
               'hora'=> $registros['hora_evento'],
               'categoria'=> $registros['cat_evento'],
               'icono'=> $registros['icono'],
               'invitado'=> $registros['nombre_invitado'] . " " . $registros['apellido_invitado'] 
              ); 
               // php agrupa el array por si  su llave tiene el mismo valor var_dum() 
               $calendario[$fecha_eventos] [] = $evento;

                ?>

               
             <?php  } //while de mysqli_fetch_array
               $consul->close(); 
              $conectar->close();
             ?>

              <?php 
              // Imprime todos los eventos
               foreach ($calendario as $dia => $lista_eventos) { ?>
                 
                 <h3>
                   <i class="fa fa-calendar"></i>
                   
                   <?php  
                    // formtear texto a español con:
                   // UNIX: setlocale(LC_TIME,'es_ES.UTF-8');
                   //WINDOWS:setlocale(LC_TIME,'spanish');
    // formatear fecha:date("F j,Y",strtotime($dia) ) ; --> no acepta cambio en la fechas con setlocale
                   setlocale(LC_TIME,'es_ES.UTF-8');
                   setlocale(LC_TIME,'spanish');
                   echo utf8_encode(strftime("%A, %d de %B del %Y",strtotime($dia) )) ; ?>
                 </h3>  

                 <?php foreach ($lista_eventos as $evento ) {?>
                   <div class="dia">
                      <p class="titulo"><?php  echo $evento['titulo']; ?></p>
                      <p class="hora">
                        <i class="far fa-clock" aria-hidden="true" ></i>
                        <?php  echo $evento['hora'] . " ". $evento['fecha']  ; ?>
                      </p>
                      <p>
                         <i class="fas <?php  echo $evento['icono'] ; ?>" aria-hidden="true" ></i> 
                         <?php  echo $evento['categoria']; ?></p>
                      <p>
                        <i class="fas fa-user" aria-hidden="true" ></i>
                        <?php  echo $evento['invitado'] ; ?>
                      </p>

                   </div>
                  <?php  } // fin foeach 2 de eventos ?>
               
                <?php  } // fin foeach 1 de dias  ?>

              
     </div>  <!-- CALENDARIO -->
     
  </section> 
  <?php include_once "includes/templates/footer.php" ; ?> 

