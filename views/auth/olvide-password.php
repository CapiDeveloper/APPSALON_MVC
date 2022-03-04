<h1 class="nombre-pagina">Olvide Password</h1>
<p class="descripcion-pagina">Reestablece tu password escribiendo tu email a continuacion</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>
<form action="/olvide" method="POST" class="formulario">
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" placeholder="tu email">
    </div>
    <input type="submit" class="boton" value="Enviar Instrucciones">
</form>
<div class="acciones">
    <a href="/crear-cuenta">¿Ya tienes una cuenta? Inicia Session</a>
    <a href="/olvide">¿Aun no tienes una cuenta? Crear una</a>
</div>