<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clasificación por Edad</title>
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
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            overflow: hidden;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
        }

        .header h1 {
            font-size: 2em;
            margin-bottom: 10px;
        }

        .content {
            padding: 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
        }

        .btn {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: transform 0.2s;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(102, 126, 234, 0.4);
        }

        .results {
            margin-top: 30px;
        }

        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 20px;
            border-radius: 12px;
            text-align: center;
        }

        .stat-card.nino {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .stat-card.adolescente {
            background: linear-gradient(135deg, #a1c4fd 0%, #c2e9fb 100%);
        }

        .stat-card.adulto {
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
        }

        .stat-card.adulto-mayor {
            background: linear-gradient(135deg, #d299c2 0%, #fef9d7 100%);
        }

        .stat-card h3 {
            font-size: 1.2em;
            margin-bottom: 10px;
            color: #333;
        }

        .stat-card .number {
            font-size: 2.5em;
            font-weight: bold;
            color: #667eea;
        }

        .chart-container {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .chart-title {
            text-align: center;
            font-size: 1.3em;
            margin-bottom: 20px;
            color: #333;
        }

        .bar-chart {
            display: flex;
            align-items: flex-end;
            justify-content: space-around;
            height: 250px;
            padding: 10px;
        }

        .bar {
            flex: 1;
            margin: 0 10px;
            background: linear-gradient(to top, #667eea, #764ba2);
            border-radius: 8px 8px 0 0;
            position: relative;
            transition: transform 0.3s;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            align-items: center;
        }

        .bar:hover {
            transform: scale(1.05);
        }

        .bar-value {
            color: white;
            font-weight: bold;
            font-size: 1.2em;
            margin-bottom: 10px;
        }

        .bar-label {
            text-align: center;
            margin-top: 10px;
            font-size: 0.9em;
            color: #555;
        }

        .age-list {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 12px;
            margin-top: 20px;
        }

        .age-item {
            padding: 15px;
            background: white;
            margin-bottom: 10px;
            border-radius: 8px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .age-badge {
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 600;
            font-size: 0.9em;
        }

        .badge-nino {
            background: #ffecd2;
            color: #d65a31;
        }

        .badge-adolescente {
            background: #a1c4fd;
            color: #2563eb;
        }

        .badge-adulto {
            background: #c2e9fb;
            color: #0891b2;
        }

        .badge-adulto-mayor {
            background: #d299c2;
            color: #7e22ce;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>📊 Sistema de Clasificación de Edades</h1>
            <p>Ingresa 5 edades para analizar</p>
        </div>

        <div class="content">
            <form method="POST">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="form-group">
                        <label for="edad<?php echo $i; ?>">Edad <?php echo $i; ?>:</label>
                        <input type="number" id="edad<?php echo $i; ?>" name="edades[]" 
                               min="0" max="120" required 
                               value="<?php echo isset($_POST['edades'][$i-1]) ? htmlspecialchars($_POST['edades'][$i-1]) : ''; ?>">
                    </div>
                <?php endfor; ?>
                
                <button type="submit" class="btn">Analizar Edades</button>
            </form>

            <?php
            // Clase para clasificación de edades (PSR-1: StudlyCaps para clases)
            class AgeClassifier {
                // Método estático para clasificar edad
                public static function clasificarEdad($edad) {
                    // Usando switch-case
                    switch (true) {
                        case ($edad >= 0 && $edad <= 12):
                            return 'Niño';
                        case ($edad >= 13 && $edad <= 17):
                            return 'Adolescente';
                        case ($edad >= 18 && $edad <= 59):
                            return 'Adulto';
                        case ($edad >= 60):
                            return 'Adulto Mayor';
                        default:
                            return 'Edad inválida';
                    }
                }

                // Método estático para obtener clase CSS
                public static function obtenerClaseCss($clasificacion) {
                    // Usando operador ternario anidado
                    return $clasificacion === 'Niño' ? 'nino' :
                           ($clasificacion === 'Adolescente' ? 'adolescente' :
                           ($clasificacion === 'Adulto' ? 'adulto' : 'adulto-mayor'));
                }

                // Método estático para procesar edades
                public static function procesarEdades($edades) {
                    $resultados = [];
                    $estadisticas = [
                        'Niño' => 0,
                        'Adolescente' => 0,
                        'Adulto' => 0,
                        'Adulto Mayor' => 0
                    ];

                    // Usando foreach para iterar
                    foreach ($edades as $edad) {
                        $clasificacion = self::clasificarEdad($edad);
                        $resultados[] = [
                            'edad' => $edad,
                            'clasificacion' => $clasificacion,
                            'clase' => self::obtenerClaseCss($clasificacion)
                        ];
                        $estadisticas[$clasificacion]++;
                    }

                    return [
                        'resultados' => $resultados,
                        'estadisticas' => $estadisticas
                    ];
                }
            }

            // Procesamiento del formulario
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edades'])) {
                $edadesIngresadas = array_map('intval', $_POST['edades']);
                
                // Validación usando ciclo for
                $edadesValidas = true;
                for ($i = 0; $i < count($edadesIngresadas); $i++) {
                    if ($edadesIngresadas[$i] < 0 || $edadesIngresadas[$i] > 120) {
                        $edadesValidas = false;
                        break;
                    }
                }

                if ($edadesValidas) {
                    $datos = AgeClassifier::procesarEdades($edadesIngresadas);
                    $resultados = $datos['resultados'];
                    $estadisticas = $datos['estadisticas'];
                    $maxValor = max($estadisticas);
                    ?>

                    <div class="results">
                        <h2 style="text-align: center; color: #333; margin-bottom: 20px;">📈 Resultados del Análisis</h2>
                        
                        <!-- Estadísticas en tarjetas -->
                        <div class="stats-grid">
                            <?php foreach ($estadisticas as $categoria => $cantidad): ?>
                                <div class="stat-card <?php echo AgeClassifier::obtenerClaseCss($categoria); ?>">
                                    <h3><?php echo $categoria; ?></h3>
                                    <div class="number"><?php echo $cantidad; ?></div>
                                    <p><?php echo $cantidad === 1 ? 'persona' : 'personas'; ?></p>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Gráfica de barras -->
                        <div class="chart-container">
                            <h3 class="chart-title">Distribución por Categoría</h3>
                            <div class="bar-chart">
                                <?php foreach ($estadisticas as $categoria => $cantidad): ?>
                                    <?php 
                                    // Calcular altura proporcional (usando operador ternario)
                                    $altura = $maxValor > 0 ? ($cantidad / $maxValor) * 100 : 0;
                                    ?>
                                    <div style="display: flex; flex-direction: column; align-items: center; flex: 1;">
                                        <div class="bar" style="height: <?php echo $altura; ?>%; min-height: 40px;">
                                            <span class="bar-value"><?php echo $cantidad; ?></span>
                                        </div>
                                        <div class="bar-label"><?php echo $categoria; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Lista detallada de edades -->
                        <div class="age-list">
                            <h3 style="margin-bottom: 15px; color: #333;">Detalle de Edades Clasificadas</h3>
                            <?php 
                            // Usando while con contador
                            $contador = 0;
                            while ($contador < count($resultados)): 
                                $resultado = $resultados[$contador];
                            ?>
                                <div class="age-item">
                                    <span><strong>Persona <?php echo $contador + 1; ?>:</strong> <?php echo $resultado['edad']; ?> años</span>
                                    <span class="age-badge badge-<?php echo $resultado['clase']; ?>">
                                        <?php echo $resultado['clasificacion']; ?>
                                    </span>
                                </div>
                            <?php 
                                $contador++;
                            endwhile; 
                            ?>
                        </div>
                    </div>

                    <?php
                } else {
                    echo '<div style="background: #fee; color: #c33; padding: 15px; border-radius: 8px; margin-top: 20px; text-align: center;">
                            ⚠️ Por favor, ingresa edades válidas entre 0 y 120 años.
                          </div>';
                }
            }
            ?>
        </div>
    </div>
</body>
</html>