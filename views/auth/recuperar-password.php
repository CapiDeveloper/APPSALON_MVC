<h1 class="nombre-pagina">Reestauracion de contraseña</h1>
<p class="descripcion-pagina">Escriba su nueva contraseña a continuacion</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>
<?php if($error) return null; ?> <!-- Ei $error es verdadero no se mostrar las demas lineas -->
<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Tu nuevo password">
    </div>
    <input type="submit" class="boton" value="Guardar nuevo password">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Session</a>
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crear una</a>
</div>