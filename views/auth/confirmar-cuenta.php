<?php 
    include_once __DIR__ . "/../templates/barra.php";
?>


<div class= "centrar-login">
<form class="formulario-login">
<h1 class="nombre-pagina">Confirmar Cuenta</h1>

<?php include_once __DIR__ . '/../templates/alertas.php'; ?>
<p>Tu cuenta ha sido verificada ya puedes iniciar sesión</p>
</form>
</div>

<style>
    .formulario-login p{
        color: while;
    }
</style>

<?php include_once __DIR__ . '/../templates/footer.php'; ?>