<h1 class="nombre-pagina">Crear HTML</h1>
<p class="descripcion-pagina">Llene el siguiente formulario para crear su cuenta</p>
<?php
    include_once __DIR__.'/../templates/alertas.php';
?>
<form class="formulario" method="POST">
    <div class="campo">
        <label for="nombre">Nombre:</label>
        <input type="text" placeholder="Tu nombre" name="nombre" id="nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>
    <div class="campo">
        <label for="apellido">Apellido:</label>
        <input type="text" placeholder="Tu apellido" name="apellido" id="apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>
    <div class="campo">
        <label for="email">Email:</label>
        <input type="email" placeholder="Tu email" name="email" id="email" value="<?php echo s($usuario->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password:</label>
        <input type="password" placeholder="Tu password" name="password" id="password">
    </div>
    <div class="campo">
        <label for="telefono">Telefono:</label>
        <input type="number" placeholder="Tu telefono" name="telefono" id="telefono" value="<?php echo s($usuario->telefono); ?>">
    </div>
    <input type="submit" class="boton" value="Crear Cuenta">
</form>
<div class="acciones">
    <a href="/">¿Ya tienes una cuenta? Inicia Session</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>