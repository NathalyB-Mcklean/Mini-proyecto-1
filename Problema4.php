<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suma de Pares e Impares</title>
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
            max-width: 1000px;
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

        .results-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }

        .result-card {
            padding: 30px;
            border-radius: 15px;
            text-align: center;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }

        .result-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
        }

        .card-pares {
            background: linear-gradient(135deg, #e0f7fa 0%, #b2ebf2 100%);
        }

        .card-pares::before {
            background: linear-gradient(90deg, #00bcd4, #0097a7);
        }

        .card-impares {
            background: linear-gradient(135deg, #fce4ec 0%, #f8bbd0 100%);
        }

        .card-impares::before {
            background: linear-gradient(90deg, #e91e63, #c2185b);
        }

        .card-total {
            background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
        }

        .card-total::before {
            background: linear-gradient(90deg, #ff9800, #f57c00);
        }

        .result-card h2 {
            font-size: 1.3em;
            margin-bottom: 15px;
            color: #333;
        }

        .result-card .number {
            font-size: 3em;
            font-weight: bold;
            color: #667eea;
            margin: 10px 0;
        }

        .result-card .count {
            font-size: 1em;
            color: #666;
            margin-top: 10px;
        }

        .chart-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
        }

        .chart-title {
            text-align: center;
            font-size: 1.5em;
            margin-bottom: 25px;
            color: #333;
        }

        .comparison-chart {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            height: 300px;
            padding: 20px;
            background: white;
            border-radius: 10px;
        }

        .bar-container {
            flex: 1;
            max-width: 200px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .bar {
            width: 100%;
            border-radius: 10px 10px 0 0;
            position: relative;
            transition: transform 0.3s;
            display: flex;
            align-items: flex-end;
            justify-content: center;
            padding-bottom: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        }

        .bar:hover {
            transform: scale(1.05);
        }

        .bar-pares {
            background: linear-gradient(to top, #00bcd4, #4dd0e1);
        }

        .bar-impares {
            background: linear-gradient(to top, #e91e63, #f06292);
        }

        .bar-value {
            color: white;
            font-weight: bold;
            font-size: 1.5em;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }

        .bar-label {
            margin-top: 15px;
            font-size: 1.1em;
            font-weight: 600;
            color: #555;
        }

        .details-section {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .detail-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 3px 10px rgba(0,0,0,0.1);
        }

        .detail-card h3 {
            margin-bottom: 15px;
            color: #333;
            font-size: 1.2em;
            border-bottom: 3px solid;
            padding-bottom: 10px;
        }

        .detail-card.pares h3 {
            border-color: #00bcd4;
            color: #00bcd4;
        }

        .detail-card.impares h3 {
            border-color: #e91e63;
            color: #e91e63;
        }

        .detail-info {
            line-height: 1.8;
            color: #555;
        }

        .detail-info strong {
            color: #333;
        }

        .formula-box {
            background: #f0f4f8;
            padding: 15px;
            border-radius: 8px;
            margin-top: 15px;
            font-family: 'Courier New', monospace;
            text-align: center;
            border-left: 4px solid #667eea;
        }

        .percentage-bar {
            width: 100%;
            height: 30px;
            background: #e0e0e0;
            border-radius: 15px;
            overflow: hidden;
            margin-top: 15px;
            display: flex;
        }

        .percentage-fill-pares {
            background: linear-gradient(90deg, #00bcd4, #4dd0e1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
        }

        .percentage-fill-impares {
            background: linear-gradient(90deg, #e91e63, #f06292);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            font-size: 0.9em;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🔢 Suma de Números Pares e Impares</h1>
            <p>Análisis de números del 1 al 200</p>
        </div>

        <div class="content">
            <?php
            // Clase para cálculos de números (PSR-1: StudlyCaps)
            class NumberCalculator {
                private $rangoInicio;
                private $rangoFin;

                public function __construct($inicio = 1, $fin = 200) {
                    $this->rangoInicio = $inicio;
                    $this->rangoFin = $fin;
                }

                // Método estático para verificar si es par (operador ternario)
                public static function esPar($numero) {
                    return $numero % 2 === 0 ? true : false;
                }

                // Método para calcular suma de pares usando for
                public function calcularSumaPares() {
                    $suma = 0;
                    $cantidad = 0;
                    
                    for ($i = $this->rangoInicio; $i <= $this->rangoFin; $i++) {
                        if (self::esPar($i)) {
                            $suma += $i;
                            $cantidad++;
                        }
                    }
                    
                    return ['suma' => $suma, 'cantidad' => $cantidad];
                }

                // Método para calcular suma de impares usando while
                public function calcularSumaImpares() {
                    $suma = 0;
                    $cantidad = 0;
                    $i = $this->rangoInicio;
                    
                    while ($i <= $this->rangoFin) {
                        if (!self::esPar($i)) {
                            $suma += $i;
                            $cantidad++;
                        }
                        $i++;
                    }
                    
                    return ['suma' => $suma, 'cantidad' => $cantidad];
                }

                // Método estático para obtener primeros N números de un tipo
                public static function obtenerPrimerosNumeros($cantidad, $esPar, $inicio, $fin) {
                    $numeros = [];
                    $contador = 0;
                    
                    for ($i = $inicio; $i <= $fin && $contador < $cantidad; $i++) {
                        // Usando operador ternario para la condición
                        $cumpleCondicion = $esPar ? self::esPar($i) : !self::esPar($i);
                        
                        if ($cumpleCondicion) {
                            $numeros[] = $i;
                            $contador++;
                        }
                    }
                    
                    return $numeros;
                }

                // Método para calcular estadísticas completas
                public function calcularEstadisticas() {
                    $pares = $this->calcularSumaPares();
                    $impares = $this->calcularSumaImpares();
                    $total = $pares['suma'] + $impares['suma'];
                    
                    return [
                        'pares' => $pares,
                        'impares' => $impares,
                        'total' => $total,
                        'porcentajePares' => ($pares['suma'] / $total) * 100,
                        'porcentajeImpares' => ($impares['suma'] / $total) * 100
                    ];
                }
            }

            // Crear instancia y calcular
            $calculadora = new NumberCalculator(1, 200);
            $estadisticas = $calculadora->calcularEstadisticas();
            
            // Obtener ejemplos de números
            $ejemplosPares = NumberCalculator::obtenerPrimerosNumeros(10, true, 1, 200);
            $ejemplosImpares = NumberCalculator::obtenerPrimerosNumeros(10, false, 1, 200);
            
            // Calcular altura de barras proporcional
            $maxSuma = max($estadisticas['pares']['suma'], $estadisticas['impares']['suma']);
            $alturaPares = ($estadisticas['pares']['suma'] / $maxSuma) * 100;
            $alturaImpares = ($estadisticas['impares']['suma'] / $maxSuma) * 100;
            ?>

            <!-- Tarjetas de resultados -->
            <div class="results-grid">
                <div class="result-card card-pares">
                    <h2>📘 Números Pares</h2>
                    <div class="number"><?php echo number_format($estadisticas['pares']['suma']); ?></div>
                    <div class="count"><?php echo $estadisticas['pares']['cantidad']; ?> números</div>
                </div>

                <div class="result-card card-impares">
                    <h2>📕 Números Impares</h2>
                    <div class="number"><?php echo number_format($estadisticas['impares']['suma']); ?></div>
                    <div class="count"><?php echo $estadisticas['impares']['cantidad']; ?> números</div>
                </div>

                <div class="result-card card-total">
                    <h2>📊 Suma Total</h2>
                    <div class="number"><?php echo number_format($estadisticas['total']); ?></div>
                    <div class="count">200 números</div>
                </div>
            </div>

            <!-- Gráfica de comparación -->
            <div class="chart-section">
                <h3 class="chart-title">Comparación Visual de Sumas</h3>
                <div class="comparison-chart">
                    <div class="bar-container">
                        <div class="bar bar-pares" style="height: <?php echo $alturaPares; ?>%;">
                            <span class="bar-value"><?php echo number_format($estadisticas['pares']['suma']); ?></span>
                        </div>
                        <div class="bar-label">Pares</div>
                    </div>

                    <div class="bar-container">
                        <div class="bar bar-impares" style="height: <?php echo $alturaImpares; ?>%;">
                            <span class="bar-value"><?php echo number_format($estadisticas['impares']['suma']); ?></span>
                        </div>
                        <div class="bar-label">Impares</div>
                    </div>
                </div>

                <!-- Barra de porcentaje -->
                <div class="percentage-bar">
                    <div class="percentage-fill-pares" style="width: <?php echo $estadisticas['porcentajePares']; ?>%;">
                        <?php echo round($estadisticas['porcentajePares'], 1); ?>%
                    </div>
                    <div class="percentage-fill-impares" style="width: <?php echo $estadisticas['porcentajeImpares']; ?>%;">
                        <?php echo round($estadisticas['porcentajeImpares'], 1); ?>%
                    </div>
                </div>
            </div>

            <!-- Detalles por categoría -->
            <div class="details-section">
                <div class="detail-card pares">
                    <h3>🔵 Detalles de Números Pares</h3>
                    <div class="detail-info">
                        <p><strong>Cantidad:</strong> <?php echo $estadisticas['pares']['cantidad']; ?> números</p>
                        <p><strong>Suma total:</strong> <?php echo number_format($estadisticas['pares']['suma']); ?></p>
                        <p><strong>Promedio:</strong> <?php echo number_format($estadisticas['pares']['suma'] / $estadisticas['pares']['cantidad'], 2); ?></p>
                        <p><strong>Primeros 10:</strong></p>
                        <div class="formula-box">
                            <?php 
                            // Usando foreach para mostrar ejemplos
                            $primerosParesStr = '';
                            foreach ($ejemplosPares as $numero) {
                                $primerosParesStr .= $numero . ', ';
                            }
                            echo rtrim($primerosParesStr, ', ') . '...';
                            ?>
                        </div>
                    </div>
                </div>

                <div class="detail-card impares">
                    <h3>🔴 Detalles de Números Impares</h3>
                    <div class="detail-info">
                        <p><strong>Cantidad:</strong> <?php echo $estadisticas['impares']['cantidad']; ?> números</p>
                        <p><strong>Suma total:</strong> <?php echo number_format($estadisticas['impares']['suma']); ?></p>
                        <p><strong>Promedio:</strong> <?php echo number_format($estadisticas['impares']['suma'] / $estadisticas['impares']['cantidad'], 2); ?></p>
                        <p><strong>Primeros 10:</strong></p>
                        <div class="formula-box">
                            <?php 
                            // Usando implode para unir array
                            echo implode(', ', $ejemplosImpares) . '...';
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Análisis adicional -->
            <div class="chart-section" style="margin-top: 30px;">
                <h3 class="chart-title">📐 Análisis Matemático</h3>
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 20px;">
                    <?php
                    // Array con análisis usando switch
                    $analisis = [
                        'diferencia' => abs($estadisticas['pares']['suma'] - $estadisticas['impares']['suma']),
                        'razon' => $estadisticas['pares']['suma'] / $estadisticas['impares']['suma']
                    ];
                    
                    foreach ($analisis as $tipo => $valor):
                        $descripcion = '';
                        
                        // Usando switch-case para descripciones
                        switch ($tipo) {
                            case 'diferencia':
                                $descripcion = 'Diferencia entre sumas';
                                break;
                            case 'razon':
                                $descripcion = 'Razón Pares/Impares';
                                $valor = round($valor, 4);
                                break;
                            default:
                                $descripcion = 'Otro análisis';
                        }
                    ?>
                        <div style="background: white; padding: 20px; border-radius: 10px; text-align: center;">
                            <p style="color: #666; margin-bottom: 10px;"><?php echo $descripcion; ?></p>
                            <p style="font-size: 2em; font-weight: bold; color: #667eea;">
                                <?php echo number_format($valor, 2); ?>
                            </p>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>