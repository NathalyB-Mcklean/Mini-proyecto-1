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

<footer style="text-align: center; color: white;">
    <p style="font-weight: bold; font-size: 1.2em; margin-bottom: 12px;">Universidad Tecnológica de Panamá</p>
    <p><strong>Facultad de Ingeniería en Sistemas Computacionales</strong></p>
    <p>Campus Victor Levis Sasso</p>
    <p style="margin-top: 15px;"><strong>Curso:</strong> Ingeniería Web</p>
    <p><strong>Instructor:</strong> Ing. Irina Fong</p>
    
    <div style="font-weight: 600; margin-top: 18px; font-size: 1.05em;">
        <p style="margin-top: 15px;"><strong>Integrantes del Grupo:</strong></p>
        <p>Estudiante #1: Abrego, Abdiel - abdiel.abrego1@utp.ac.pa</p>
        <p>Estudiante #2: Bonilla, Nathaly - nathaly.bonilla1@utp.ac.pa</p>
    </div>
    
    <p style="margin-top: 15px; font-size: 0.9em;">
        Fecha de ejecución: <?php echo htmlspecialchars($fechaActual); ?>
    </p>
    
    <p style="margin-top: 10px; font-size: 0.85em;">
        Mini Proyecto #1 - Sentencias de Control y Clases | © <?php echo date('Y'); ?>
    </p>
</footer>