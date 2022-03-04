<h1 class="nombre-pagina">Crear</h1>
<p class="descripcion-pagina">Agrega mas servicios a su negocio</p>
<?php //@include_once __DIR__.'/../templates/barra.php'; 
    @include_once __DIR__.'/../templates/alertas.php'
?>

<form action="/servicios/crear" method="POST" class="formulario">
    <?php include __DIR__.'/formulario.php'; ?>
    <input type="submit" value="Crear Servicio" class="boton">
</form>