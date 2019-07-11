
  <?php include_once "includes/templates/header.php" ; ?>

  <section class="seccion contenedor">
    <h2>La Mejor Conferencia de diseño web en español</h2>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Itaque, ipsa doloribus earum quasi qui dolorum maiores pariatur, quibusdam quidem, consequuntur a soluta deserunt fugit placeat nulla modi, maxime neque tempora.</p>
  </section> <!-- SECCION -->
  
  <section class="programa">
    <div class="contenedor-video">
      <video  autoplay loop  poster="img/bg-talleres.jpg">
        <source src="video/video.mp4" type="video/mp4">
        <source src="video/video.webm" type="video/webm">
        <source src="video/video.ogv" type="video/ogg">  
      </video>
    </div> <!-- Contenedor Video -->

    <div class="contenido-programa">
      <div class="contenedor">
        <div class="programa-evento">
          <h2>Programa del Evento</h2>
           <?php 

            try {
                          require_once('includes/funciones/bd_conexion.php');
              
                          $obj_conect = new Connection();
                          $conectar = $obj_conect->get_connection();
                          $consul = mysqli_query($conectar,"SELECT * FROM `categoria_evento`");

             $error = "";
            } catch (Exception $e) {
              $error = $e->getMessage();
            }

           ?>   

          <nav class="menu-programa">
            <?php while( $cat = mysqli_fetch_array($consul)){  ?>
              <?php $categoria =  $cat['cat_evento'] ; ?>

           <a href="#<?php echo strtolower($categoria); ?>">
            <i class="fas <?php echo $cat['icono']; ?>" aria-hidden="true"></i><?php echo $categoria; ?>
           </a> 
           
           <?php  } //while de mysqli_fetch_array
               $consul->close(); 
              $conectar->close();
             ?>
          </nav>
          
           <?php 

            try {
                  require_once('includes/funciones/bd_conexion.php');
      
                  $obj_con = new Connection();
                  $conec = $obj_con->get_connection();
                  $sql_str = "SELECT * FROM `view_eventos`where `id_cat_evento` = 1 LIMIT 2;";
                  $sql_str .= "SELECT * FROM `view_eventos`where `id_cat_evento` = 2 LIMIT 2;";
                  $sql_str .= "SELECT * FROM `view_eventos`where `id_cat_evento` = 3 LIMIT 2;";
                   $conec->multi_query($sql_str);

             $error = "";
            } catch (Exception $e) {
              $error = $e->getMessage();
            }

           ?>   
           
            
           <?php do{
            $result = $conec->store_result();
            $row = $result->fetch_all(MYSQLI_ASSOC); ?>
             <?php $i=0; ?>
             <?php foreach($row as $evento): ?>
                <?php if($i  % 2 ==0){ ?>
                 <div id="<?php echo strtolower($evento['cat_evento']) ; ?>" class="info-curso ocultar clearfix">
                <?php } ?>
                 <div class="detalle-evento">
                   <h3><?php echo utf8_encode($evento['nombre_evento']); ?></h3>
                   <p><i class="far fa-clock" aria-hidden="true"></i> <?php echo $evento['hora_evento'] ; ?></p>
                   <p><i class="fas fa-calendar-alt" aria-hidden="true"></i> <?php echo $evento['fecha_evento'] ; ?></p>
                   <p><i class="fas fa-user" aria-hidden="true"></i> <?php echo $evento['nombre_invitado'] . " ". $evento['apellido_invitado'] ; ?></p>
                 </div>

                   
               <?php if($i  % 2 ==1){ ?> 
                <a href="calendario.php" class="button float-right">Ver todos</a>  
                </div> <!-- TALLERES -->

               <?php } ?>
                <?php $i++ ; ?>
              <?php endforeach; ?>
              <?php $result->free(); //liberar la memoria para introducir la siguiente fila ?> 
          <?php // introducir la siguiente fila
           }while($conec->more_results() && $conec->next_result()); 
           
          $conec->close();
          ?>





        </div> <!-- PROGRAMA EVENTO -->
      </div>  <!-- CONTEDOR -->
    </div> <!-- CONTENIDO PROGRAMA -->
  </section> <!-- PROGRAMA -->

   <?php include_once "includes/templates/invitados.php" ; ?>   
  <div class="contador parallax">
    <div class="contenedor">
      <ul class="resumen-evento clearfix">
       <li><p class="numero"></p> Invitados</li> 
       <li><p class="numero"></p> Talleres</li> 
       <li><p class="numero"></p> Dias</li> 
       <li><p class="numero"></p> conferencias</li> 
      </ul> 
    </div> <!-- contenedor del contador-->
  </div> <!-- contador parallax -->

  <section class="precios seccion">
    <h2>Precios</h2>
    <div class="contenedor">
      <ul class="lista-precios clearfix">
        <li>
          <div class="tabla-precio">
            <h3>Pase por día</h3>
            <p class="numero">$30</p>
            <ul>
              <li>Bocadillos gratis</li>
              <li>Todas las conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Todos los días</h3>
            <p class="numero">$50</p>
            <ul>
              <li>Bocadillos gratis</li>
              <li>Todas las conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button">comprar</a>
          </div>
        </li>

        <li>
          <div class="tabla-precio">
            <h3>Pase por 2 días</h3>
            <p class="numero">$45</p>
            <ul>
              <li>Bocadillos gratis</li>
              <li>Todas las conferencias</li>
              <li>Todos los talleres</li>
            </ul>
            <a href="#" class="button hollow">comprar</a>
          </div>
        </li>

      </ul> <!-- lista-precios -->
    </div>  <!-- contenedor -->
  </section> <!-- precios seccion -->

  <div id="mapa" class="mapa">
    
  </div>


  <section class="seccion">
    <h2>Testimoniales</h2>
    <div class="testimoniales contenedor clearfix">
 
      <div class="testimonial">
         <blockquote >
           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur soluta qui cum aliquid, perferendis tempore voluptas sapiente nostrum, aperiam voluptatem, eos repellendus iure dicta delectus voluptatibus architecto sed vitae maxime.</p>
           <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
           </footer>
         </blockquote>
      </div> <!-- testimonial -->

      <div class="testimonial">
         <blockquote >
           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur soluta qui cum aliquid, perferendis tempore voluptas sapiente nostrum, aperiam voluptatem, eos repellendus iure dicta delectus voluptatibus architecto sed vitae maxime.</p>
           <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
           </footer>
         </blockquote>
      </div> <!-- testimonial -->

      <div class="testimonial">
         <blockquote >
           <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur soluta qui cum aliquid, perferendis tempore voluptas sapiente nostrum, aperiam voluptatem, eos repellendus iure dicta delectus voluptatibus architecto sed vitae maxime.</p>
           <footer class="info-testimonial clearfix">
              <img src="img/testimonial.jpg" alt="imagen testimonial">
              <cite>Oswaldo Aponte Escobedo <span>Diseñador en @prisma</span></cite>
           </footer>
         </blockquote>
      </div> <!-- testimonial -->

    </div> <!-- contenedor testimonial -->
  </section>


  <div class="newsletter parallax">
     <div class="contenido contenedor">
       <p>Registrate al newsletter:</p>
       <h3>gdlWebCam</h3>
       <a href="#mc_embed_signup" class="boton_newsletter button transparente">Registro</a>
     </div> <!-- contenido -->
  </div>  <!-- newsletter -->

  <section class="seccion">
    <h2>Faltan</h2>
    <div class="cuenta-regresiva contenedor">
      <ul class="clearfix">
        <li><p id="dias" class="numero"></p> días</li>
        <li><p id="horas" class="numero"></p> horas</li>
        <li><p id="minutos" class="numero"></p> minutos</li>
        <li><p id="segundos" class="numero"></p> segundos</li>
      </ul>
    </div>
  </section>
    <?php include_once "includes/templates/footer.php" ; ?> 
  
