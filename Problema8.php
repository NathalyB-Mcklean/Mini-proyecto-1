<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 8 - Estación del Año</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p8-encabezado">
                <h1>Problema 8: Estación del Año</h1>
                <p class="p8-descripcion">
                    Determina la estación del año según el clima tropical de Panamá
                </p>
            </div>

            <div class="p8-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p8-seccion-formulario">
                    <form method="POST">
                        <div class="form-group">
                            <label for="fecha">Seleccione una fecha:</label>
                            <input type="date" id="fecha" name="fecha" 
                                   value="<?php echo isset($_POST['fecha']) ? htmlspecialchars($_POST['fecha']) : ''; ?>" 
                                   required>
                        </div>
                        <button type="submit" class="p8-boton-calcular">Determinar Estación</button>
                    </form>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fecha'])) {
                    $fecha = $_POST['fecha'];
                    $date = new DateTime($fecha);
                    $mes = (int)$date->format('m');
                    $dia = (int)$date->format('d');
                    
                    $estacion = '';
                    $imagen = '';
                    $icono = '';
                    $descripcion = '';
                    
                    // Determinar estación según tabla exacta
                    // Verano: Del 21 de diciembre al 20 de marzo
                    // Otoño: Del 21 de marzo al 21 de junio
                    // Invierno: Del 22 de junio al 22 de septiembre
                    // Primavera: Del 23 de septiembre al 20 de diciembre
                    
                    if (($mes == 3 && $dia >= 21) || ($mes == 4) || ($mes == 5) || ($mes == 6 && $dia <= 21)) {
                        // Otoño: 21 marzo - 21 junio
                        $estacion = 'Otoño';
                        $imagen = 'img/otono.jpg';
                        $icono = '🍂';
                        $descripcion = 'Estación de otoño: del 21 de marzo al 21 de junio. Clima templado y hojas que caen.';
                    } elseif (($mes == 6 && $dia >= 22) || ($mes == 7) || ($mes == 8) || ($mes == 9 && $dia <= 22)) {
                        // Invierno: 22 junio - 22 septiembre
                        $estacion = 'Invierno';
                        $imagen = 'img/invierno.jpg';
                        $icono = '❄️';
                        $descripcion = 'Estación de invierno: del 22 de junio al 22 de septiembre. Temperaturas frías y días cortos.';
                    } elseif (($mes == 9 && $dia >= 23) || ($mes == 10) || ($mes == 11) || ($mes == 12 && $dia <= 20)) {
                        // Primavera: 23 septiembre - 20 diciembre
                        $estacion = 'Primavera';
                        $imagen = 'img/primavera.jpg';
                        $icono = '🌸';
                        $descripcion = 'Estación de primavera: del 23 de septiembre al 20 de diciembre. Florecimiento y temperaturas agradables.';
                    } else {
                        // Verano: 21 diciembre - 20 marzo
                        $estacion = 'Verano';
                        $imagen = 'img/verano.jpg';
                        $icono = '☀️';
                        $descripcion = 'Estación de verano: del 21 de diciembre al 20 de marzo. Temperaturas cálidas y días largos.';
                    }
                    
                    $fechaFormateada = $date->format('d/m/Y');
                    ?>

                    <div class="p8-resultado-card">
                        <p class="p8-fecha-info">Fecha seleccionada: <strong><?php echo $fechaFormateada; ?></strong></p>
                    </div>

                    <div class="p8-estacion-card">
                        <div class="p8-estacion-icono"><?php echo $icono; ?></div>
                        <div class="p8-estacion-nombre"><?php echo $estacion; ?></div>
                        <img src="<?php echo $imagen; ?>" alt="<?php echo $estacion; ?>" class="p8-estacion-imagen">
                        <div class="p8-estacion-descripcion"><?php echo $descripcion; ?></div>
                    </div>

                <?php
                }
                ?>

                <div class="p8-referencia-box">
                    <h3>📅 Tabla de Estaciones</h3>
                    
                    <div class="p8-referencia-item">
                        <span class="p8-referencia-icono">☀️</span>
                        <div class="p8-referencia-texto">
                            <strong>Verano:</strong> Del 21 de diciembre al 20 de marzo
                        </div>
                    </div>
                    
                    <div class="p8-referencia-item">
                        <span class="p8-referencia-icono">🍂</span>
                        <div class="p8-referencia-texto">
                            <strong>Otoño:</strong> Del 21 de marzo al 21 de junio
                        </div>
                    </div>
                    
                    <div class="p8-referencia-item">
                        <span class="p8-referencia-icono">❄️</span>
                        <div class="p8-referencia-texto">
                            <strong>Invierno:</strong> Del 22 de junio al 22 de septiembre
                        </div>
                    </div>
                    
                    <div class="p8-referencia-item">
                        <span class="p8-referencia-icono">🌸</span>
                        <div class="p8-referencia-texto">
                            <strong>Primavera:</strong> Del 23 de septiembre al 20 de diciembre
                        </div>
                    </div>
                </div>

                <div style="text-align: center;">
                    <a href="index.php" class="p8-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>