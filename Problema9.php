<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Potencias - Problema #9</title>
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
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #2c3e50;
            font-size: 2em;
            margin-bottom: 15px;
            font-weight: 600;
        }

        .descripcion {
            text-align: center;
            color: #555;
            font-size: 1.05em;
            margin-bottom: 30px;
            line-height: 1.6;
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
            margin-bottom: 10px;
            font-size: 1.1em;
        }

        input[type="number"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1.1em;
            transition: all 0.3s;
        }

        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .button-group {
            display: flex;
            gap: 15px;
        }

        button {
            flex: 1;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1.05em;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-generar {
            background: #667eea;
            color: white;
        }

        .btn-generar:hover {
            background: #5568d3;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-imprimir {
            background: #27ae60;
            color: white;
        }

        .btn-imprimir:hover {
            background: #229954;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(39, 174, 96, 0.3);
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

        .resultado h2 {
            color: #667eea;
            font-size: 1.5em;
            margin-bottom: 20px;
            text-align: center;
        }

        .potencias-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 20px;
        }

        .potencia-item {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }

        .potencia-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .potencia-formula {
            font-size: 1.1em;
            font-weight: 600;
            margin-bottom: 8px;
        }

        .potencia-resultado {
            font-size: 1.3em;
            font-weight: bold;
            color: #ffd700;
        }

        .back-btn {
            width: 100%;
            margin-top: 30px;
            background: #6c757d;
            color: white;
            padding: 15px;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #5a6268;
        }

        .error {
            background: #ff6b6b;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }

        @media print {
            body {
                background: white;
            }
            
            .form-section, .button-group, .back-btn {
                display: none;
            }
            
            .container {
                box-shadow: none;
                max-width: 100%;
            }
            
            .potencia-item {
                break-inside: avoid;
            }
        }

        .numero-seleccionado {
            text-align: center;
            font-size: 1.2em;
            color: #667eea;
            margin-bottom: 15px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Problema #9</h1>
        <p class="descripcion">
            Solicitar un número (1 al 9)<br>
            Generar o imprimir las <strong>15 primeras potencias</strong> del número<br>
            (4 elevado a la 1, 4 elevado a la 2, ...)
        </p>

        <div class="form-section">
            <form method="POST">
                <div class="form-group">
                    <label for="numero">Ingrese un número del 1 al 9:</label>
                    <input type="number" id="numero" name="numero" min="1" max="9" 
                           value="<?php echo isset($_POST['numero']) ? $_POST['numero'] : ''; ?>" 
                           required>
                </div>

                <div class="button-group">
                    <button type="submit" name="accion" value="generar" class="btn-generar">
                        📊 Generar Potencias
                    </button>
                    <button type="submit" name="accion" value="imprimir" class="btn-imprimir">
                        🖨️ Imprimir
                    </button>
                </div>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numero']) && isset($_POST['accion'])) {
            $numero = (int)$_POST['numero'];
            
            // Validar que el número esté entre 1 y 9
            if ($numero < 1 || $numero > 9) {
                echo '<div class="error">⚠️ Error: El número debe estar entre 1 y 9</div>';
            } else {
                $accion = $_POST['accion'];
                
                // Si la acción es imprimir, agregar script de impresión
                if ($accion == 'imprimir') {
                    echo '<script>window.onload = function() { window.print(); }</script>';
                }
                
                echo '<div class="resultado">';
                echo '<div class="numero-seleccionado">Potencias del número: ' . $numero . '</div>';
                echo '<h2>Las 15 primeras potencias</h2>';
                echo '<div class="potencias-grid">';
                
                // Generar las 15 potencias
                for ($i = 1; $i <= 15; $i++) {
                    $resultado = pow($numero, $i);
                    
                    echo '<div class="potencia-item">';
                    echo '<div class="potencia-formula">' . $numero . '<sup>' . $i . '</sup></div>';
                    echo '<div class="potencia-resultado">' . number_format($resultado, 0, ',', '.') . '</div>';
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</div>';
            }
        }
        ?>

        <button class="back-btn" onclick="window.history.back()">← Volver al Menú</button>
    </div>
</body>
</html>