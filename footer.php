<?php
/**
 * Footer del proyecto - Mini Proyecto #1
 * Universidad Tecnológica de Panamá
 */

// Obtener la fecha actual en español
$meses = [
    1 => 'enero', 2 => 'febrero', 3 => 'marzo', 4 => 'abril',
    5 => 'mayo', 6 => 'junio', 7 => 'julio', 8 => 'agosto',
    9 => 'septiembre', 10 => 'octubre', 11 => 'noviembre', 12 => 'diciembre'
];

$dia = date('d');
$mes = $meses[(int)date('m')];
$anio = date('Y');
$fechaActual = "$dia de $mes de $anio";
?>

<footer>
    <div class="footer-container">
        <!-- Columna Izquierda: Información de la Universidad -->
        <div class="footer-left">
            <p style="font-weight: bold; margin-bottom: 8px;">Universidad Tecnológica de Panamá</p>
            <p>Facultad de Ingeniería en Sistemas Computacionales</p>
            <p>Campus Victor Levis Sasso</p>
            <p style="margin-top: 10px;">Curso: Ingeniería Web</p>
            <p>Instructor: Ing. Irina Fong</p>
        </div>
        
        <!-- Línea divisoria vertical -->
        <div class="footer-divider"></div>
        
        <!-- Columna Derecha: Integrantes del Grupo -->
        <div class="footer-right">
            <p style="font-weight: bold; margin-bottom: 8px;">Integrantes</p>
            <p>Estudiante #1: Abrego, Abdiel - abdiel.abrego1@utp.ac.pa</p>
            <p>Estudiante #2: Bonilla, Nathaly - nathaly.bonilla1@utp.ac.pa</p><br>
            <p style="font-weight: bold; margin-bottom: 8px;">Grupo: 1SF132</p>
        </div>
    </div>
    
    <!-- Información inferior centrada -->
    <div class="footer-bottom">
        <p style="margin-top: 15px;">
            Fecha de ejecución: <?php echo htmlspecialchars($fechaActual); ?>
        </p>
        <p style="margin-top: 5px;">
            Mini Proyecto #1 - Sentencias de control y clases | © <?php echo date('Y'); ?>
        </p>
    </div>
</footer>