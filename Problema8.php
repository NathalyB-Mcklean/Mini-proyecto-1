<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estación del Año - Problema #8</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            padding: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }

        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
        }

        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }

        .content {
            padding: 40px;
        }

        .description {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
            color: #555;
            line-height: 1.8;
        }

        .form-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 8px;
            font-size: 1.05em;
        }

        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s;
        }

        input[type="date"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        button {
            width: 100%;
            padding: 15px;
            background: #667eea;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        button:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .resultado {
            animation: fadeIn 0.5s;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .resultado-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            margin-bottom: 20px;
        }

        .fecha-info {
            color: #555;
            font-size: 1.1em;
            margin-bottom: 15px;
        }

        .fecha-info strong {
            color: #667eea;
            font-size: 1.2em;
        }

        .estacion-card {
            background: linear-gradient(135deg, #a8e6cf 0%, #dcedc8 100%);
            padding: 30px;
            border-radius: 15px;
            margin: 20px 0;
        }

        .estacion-nombre {
            font-size: 1.8em;
            font-weight: bold;
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .estacion-icono {
            font-size: 4em;
            margin-bottom: 15px;
        }

        .estacion-imagen {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .estacion-descripcion {
            background: #f0f4f8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            color: #555;
            line-height: 1.6;
        }

        .referencia-box {
            background: #e8eaf6;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
            border-left: 4px solid #667eea;
        }

        .referencia-box h3 {
            color: #667eea;
            margin-bottom: 15px;
            font-size: 1.2em;
        }

        .referencia-item {
            display: flex;
            align-items: center;
            padding: 10px;
            margin-bottom: 8px;
            background: white;
            border-radius: 8px;
        }

        .referencia-icono {
            font-size: 1.5em;
            margin-right: 12px;
        }

        .referencia-texto {
            color: #555;
            flex: 1;
        }

        .referencia-texto strong {
            color: #2c3e50;
        }

        .back-btn {
            margin-top: 30px;
            background: #6c757d;
        }

        .back-btn:hover {
            background: #5a6268;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Problema #8</h1>
            <p>Estación del Año</p>
        </div>

        <div class="content">
            <div class="description">
                Al ingresar una fecha, el sistema determina la estación del año correspondiente según el clima tropical de Panamá.
            </div>

            <div class="form-section">
                <form method="POST">
                    <div class="form-group">
                        <label for="fecha">Seleccione una fecha:</label>
                        <input type="date" id="fecha" name="fecha" 
                               value="<?php echo isset($_POST['fecha']) ? htmlspecialchars($_POST['fecha']) : ''; ?>" 
                               required>
                    </div>
                    <button type="submit">Determinar Estación</button>
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
                
                // Determinar estación según tabla exacta de la profesora
                // Verano: Del 21 de diciembre al 20 de marzo
                // Otoño: Del 21 de marzo al 21 de junio
                // Invierno: Del 22 de junio al 22 de septiembre
                // Primavera: Del 23 de septiembre al 20 de diciembre
                
                if (($mes == 3 && $dia >= 21) || ($mes == 4) || ($mes == 5) || ($mes == 6 && $dia <= 21)) {
                    // Otoño: 21 marzo - 21 junio
                    $estacion = 'Otoño';
                    $imagen = 'https://images.unsplash.com/photo-1606092195730-5d7b9af1efc5?w=600&h=400&fit=crop';
                    $icono = '🍂';
                    $descripcion = 'Estación de otoño: del 21 de marzo al 21 de junio. Clima templado y hojas que caen.';
                } elseif (($mes == 6 && $dia >= 22) || ($mes == 7) || ($mes == 8) || ($mes == 9 && $dia <= 22)) {
                    // Invierno: 22 junio - 22 septiembre
                    $estacion = 'Invierno';
                    $imagen = 'https://images.unsplash.com/photo-1483664852095-d6cc6870702d?w=600&h=400&fit=crop';
                    $icono = '❄️';
                    $descripcion = 'Estación de invierno: del 22 de junio al 22 de septiembre. Temperaturas frías y días cortos.';
                } elseif (($mes == 9 && $dia >= 23) || ($mes == 10) || ($mes == 11) || ($mes == 12 && $dia <= 20)) {
                    // Primavera: 23 septiembre - 20 diciembre
                    $estacion = 'Primavera';
                    $imagen = 'https://images.unsplash.com/photo-1490750967868-88aa4486c946?w=600&h=400&fit=crop';
                    $icono = '🌸';
                    $descripcion = 'Estación de primavera: del 23 de septiembre al 20 de diciembre. Florecimiento y temperaturas agradables.';
                } else {
                    // Verano: 21 diciembre - 20 marzo
                    $estacion = 'Verano';
                    $imagen = 'https://images.unsplash.com/photo-1473496169904-658ba7c44d8a?w=600&h=400&fit=crop';
                    $icono = '☀️';
                    $descripcion = 'Estación de verano: del 21 de diciembre al 20 de marzo. Temperaturas cálidas y días largos.';
                }
                
                $fechaFormateada = $date->format('d/m/Y');
                
                echo '<div class="resultado">';
                
                echo '<div class="resultado-card">';
                echo '<p class="fecha-info">Fecha seleccionada: <strong>' . $fechaFormateada . '</strong></p>';
                echo '</div>';
                
                echo '<div class="estacion-card">';
                echo '<div class="estacion-icono">' . $icono . '</div>';
                echo '<div class="estacion-nombre">' . $estacion . '</div>';
                echo '<img src="' . $imagen . '" alt="' . $estacion . '" class="estacion-imagen">';
                echo '<div class="estacion-descripcion">' . $descripcion . '</div>';
                echo '</div>';
                
                echo '</div>';
            }
            ?>

            <div class="referencia-box">
                <h3>📅 Tabla de Estaciones</h3>
                
                <div class="referencia-item">
                    <span class="referencia-icono">☀️</span>
                    <div class="referencia-texto">
                        <strong>Verano:</strong> Del 21 de diciembre al 20 de marzo
                    </div>
                </div>
                
                <div class="referencia-item">
                    <span class="referencia-icono">🍂</span>
                    <div class="referencia-texto">
                        <strong>Otoño:</strong> Del 21 de marzo al 21 de junio
                    </div>
                </div>
                
                <div class="referencia-item">
                    <span class="referencia-icono">❄️</span>
                    <div class="referencia-texto">
                        <strong>Invierno:</strong> Del 22 de junio al 22 de septiembre
                    </div>
                </div>
                
                <div class="referencia-item">
                    <span class="referencia-icono">🌸</span>
                    <div class="referencia-texto">
                        <strong>Primavera:</strong> Del 23 de septiembre al 20 de diciembre
                    </div>
                </div>
            </div>

            <button class="back-btn" onclick="window.history.back()">← Volver al Menú</button>
        </div>
    </div>
</body>
</html>