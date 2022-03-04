<?php isAuth(); ?>
<h1 class="nombre-pagina">Panel de Administracion</h1>
<?php 
    include_once __DIR__.'/../templates/barra.php';
?>

<h2>Buscar Citas</h2>
<div class="busqueda">
    <form class="formulario">
        <div class="campo">
            <label for="fecha">Fecha</label>
            <input type="date" id="fecha" name="fecha" value="<?php echo $fecha; ?>">
        </div>
    </form>
</div>
<?php 
    if (count($citas) === 0) {
        echo '<h2>No hay citas en esta fecha</h2>';
    }
?>
<div id="citas-admin">
    <ul class="citas">
        <?php
        $idCita = 0;
        $total = 0;
        foreach($citas as $key => $cita){
            if($idCita !== $cita->id){ 
                $total = 0;    
            ?>
            
            <li>
            <p>Id Cliente: <span><?php echo $cita->id; ?></span></p>
            <p>Nombre: <span><?php echo $cita->cliente; ?></span></p>
            <p>Hora: <span><?php echo $cita->hora; ?></span></p>
            <p>Telefono: <span><?php echo $cita->telefono; ?></span></p>
            <p>Email: <span><?php echo $cita->email; ?></span></p>           
            <h3>Servicios</h3>
            <?php
            } $idCita = $cita->id;
                $total += $cita->precio;
            ?>
        
            <p class="servicio"><span><?php echo $cita->servicio.' - $'.$cita->precio; ?></span></p>
            <!-- </li> -->
            <?php 
                //Saber la ultima posicion
                $actual = $cita->id;
                $proximo = $citas[$key + 1]->id ?? 0; //$key es la posicion en que esta cada citaId de citasServicios, $key empieza en 0

                if (esUltimo($actual,$proximo)) { ?>
                   <p>Total: <span>$<?php echo $total; ?></span></p>
                   <form action="/api/eliminar" method="POST">
                       <input type="hidden" name="id" value="<?php echo $cita->id;?>">
                        <input type="submit" value="Eliminar" class="boton-eliminar">
                   </form>
                <?php } ?>
            <?php } //Fin for each ?>
    </ul>
</div>
<?php
    echo $script="
        <script src='build/js/buscador.js'></script>
    ";
?>
