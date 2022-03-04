<div class="cliente contenedor">
    <div class="info-cliente">
        <picture>
            <source srcset="/build/img/icono-cliente.webp" type="image/webp">
            <img loading="lazy" width="50" height="50" src="/build/img/icono-cliente.png" alt="Imagen cliente">
        </picture>
        <p><?php echo $nombre; ?></p>
    </div>
    <div class="boton logout">
        <a id="cerrar-session" href="/logout">Cerrar session</a>
    </div>
</div>
<?php if(isset($_SESSION['admin'])){ ?>
    <div class="barra-servicios">
        <a class="boton" href="/admin">Ver citas</a>
        <a class="boton" href="/servicios">Ver servicios</a>
        <a class="boton" href="/servicios/crear">Nuevo servicio</a>
    </div>
<?php } ?>