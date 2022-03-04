<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Inicia seccion con tus datos</p>
<?php include_once __DIR__.'/../templates/alertas.php'; ?>
<form method="POST" action="/" class="formulario">
    <div class="campo">
        <label for="email">Email</label>
        <input type="email"/ id="email" name="email" placeholder="Tu email" value="<?php echo s($auth->email); ?>">
    </div>
    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Tu contraseña" id="password" >
    </div>
        <input type="submit" value="Iniciar Session" class="boton">
</form>
<div class="acciones">
    <a href="/crear-cuenta">¿Aun no tienes una cuenta? Crea una</a>
    <a href="/olvide">¿Olvidaste tu password?</a>
</div>