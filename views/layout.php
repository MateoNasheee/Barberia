<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>App Salón</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>

<div class="contenedor-app">
        <!-- Barra de Navegación -->
     


        <!-- Contenido Principal -->
        <div class="app">
            <?php echo $contenido; ?>
        </div>


    


<script>
document.addEventListener('DOMContentLoaded', () => {
    const carrusel = document.querySelector('.imagen .carrusel');
    const slides = document.querySelectorAll('.imagen .slide');
    const prevButton = document.querySelector('.imagen .prev');
    const nextButton = document.querySelector('.imagen .next');
    const indicadores = document.querySelectorAll('.imagen .indicadores .indicador');
    const totalSlides = slides.length;
    let currentIndex = 0;
    let intervalo;

    // Función para actualizar el carrusel
    function actualizarCarrusel() {
        carrusel.style.transform = `translateX(-${currentIndex * 100}%)`;
        actualizarIndicadores();
    }

    // Función para actualizar los indicadores
    function actualizarIndicadores() {
        indicadores.forEach(indicador => indicador.classList.remove('active'));
        indicadores[currentIndex].classList.add('active');
    }

    // Función para avanzar al siguiente slide
    function siguienteSlide() {
        currentIndex = (currentIndex + 1) % totalSlides;
        actualizarCarrusel();
    }

    // Función para retroceder al slide anterior
    function anteriorSlide() {
        currentIndex = (currentIndex - 1 + totalSlides) % totalSlides;
        actualizarCarrusel();
    }

    // Evento para el botón siguiente
    nextButton.addEventListener('click', () => {
        siguienteSlide();
        resetIntervalo();
    });

    // Evento para el botón anterior
    prevButton.addEventListener('click', () => {
        anteriorSlide();
        resetIntervalo();
    });

    // Evento para los indicadores
    indicadores.forEach(indicador => {
        indicador.addEventListener('click', () => {
            currentIndex = parseInt(indicador.getAttribute('data-slide'));
            actualizarCarrusel();
            resetIntervalo();
        });
    });

    // Animación automática cada 5 segundos
    function iniciarIntervalo() {
        intervalo = setInterval(siguienteSlide, 5000);
    }

    // Reiniciar el intervalo cuando se navega manualmente
    function resetIntervalo() {
        clearInterval(intervalo);
        iniciarIntervalo();
    }

    // Iniciar el carrusel
    iniciarIntervalo();

    // Opcional: pausa al pasar el mouse sobre el carrusel
    carrusel.addEventListener('mouseenter', () => {
        clearInterval(intervalo);
    });

    carrusel.addEventListener('mouseleave', () => {
        iniciarIntervalo();
    });
});
</script>

<?php
    echo $script ?? '';
?>
</body>
</html>
