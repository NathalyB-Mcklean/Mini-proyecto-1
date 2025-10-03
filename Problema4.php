<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pares e Impares - Problema #4</title>
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
            max-width: 900px;
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
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
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

        .back-btn {
            width: 100%;
            padding: 15px;
            margin-top: 30px;
            background: #6c757d;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.3s;
        }

        .back-btn:hover {
            background: #5a6268;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Problema #4</h1>
            <p>Suma de Números Pares e Impares</p>
        </div>

        <div class="content">
            <div class="description">
                Se desea calcular independientemente la suma de los números pares e impares comprendidos entre 1 y 200.
            </div>

            <?php
            // Inicializar variables
            $sumaPares = 0;
            $sumaImpares = 0;
            $cantidadPares = 0;
            $cantidadImpares = 0;

            // Calcular sumas del 1 al 200
            for ($i = 1; $i <= 200; $i++) {
                if ($i % 2 == 0) {
                    // Es par
                    $sumaPares += $i;
                    $cantidadPares++;
                } else {
                    // Es impar
                    $sumaImpares += $i;
                    $cantidadImpares++;
                }
            }

            // Calcular total
            $sumaTotal = $sumaPares + $sumaImpares;

            // Calcular altura proporcional para las barras
            $maxSuma = max($sumaPares, $sumaImpares);
            $alturaPares = ($sumaPares / $maxSuma) * 100;
            $alturaImpares = ($sumaImpares / $maxSuma) * 100;

            // Calcular promedios
            $promedioPares = $sumaPares / $cantidadPares;
            $promedioImpares = $sumaImpares / $cantidadImpares;
            ?>

            <!-- Tarjetas de resultados -->
            <div class="results-grid">
                <div class="result-card card-pares">
                    <h2>Números Pares</h2>
                    <div class="number"><?php echo number_format($sumaPares); ?></div>
                    <div class="count"><?php echo $cantidadPares; ?> números</div>
                </div>

                <div class="result-card card-impares">
                    <h2>Números Impares</h2>
                    <div class="number"><?php echo number_format($sumaImpares); ?></div>
                    <div class="count"><?php echo $cantidadImpares; ?> números</div>
                </div>

                <div class="result-card card-total">
                    <h2>Suma Total</h2>
                    <div class="number"><?php echo number_format($sumaTotal); ?></div>
                    <div class="count">200 números</div>
                </div>
            </div>

            <!-- Gráfica de comparación -->
            <div class="chart-section">
                <h3 class="chart-title">Comparación Visual</h3>
                <div class="comparison-chart">
                    <div class="bar-container">
                        <div class="bar bar-pares" style="height: <?php echo $alturaPares; ?>%;">
                            <span class="bar-value"><?php echo number_format($sumaPares); ?></span>
                        </div>
                        <div class="bar-label">Pares</div>
                    </div>

                    <div class="bar-container">
                        <div class="bar bar-impares" style="height: <?php echo $alturaImpares; ?>%;">
                            <span class="bar-value"><?php echo number_format($sumaImpares); ?></span>
                        </div>
                        <div class="bar-label">Impares</div>
                    </div>
                </div>
            </div>

            <!-- Detalles por categoría -->
            <div class="details-section">
                <div class="detail-card pares">
                    <h3>Detalles de Números Pares</h3>
                    <div class="detail-info">
                        <p><strong>Cantidad:</strong> <?php echo $cantidadPares; ?> números</p>
                        <p><strong>Suma total:</strong> <?php echo number_format($sumaPares); ?></p>
                        <p><strong>Promedio:</strong> <?php echo number_format($promedioPares, 2); ?></p>
                        <p><strong>Rango:</strong> 2, 4, 6, 8, ... 200</p>
                        <p><strong>Fórmula:</strong> n % 2 == 0</p>
                    </div>
                </div>

                <div class="detail-card impares">
                    <h3>Detalles de Números Impares</h3>
                    <div class="detail-info">
                        <p><strong>Cantidad:</strong> <?php echo $cantidadImpares; ?> números</p>
                        <p><strong>Suma total:</strong> <?php echo number_format($sumaImpares); ?></p>
                        <p><strong>Promedio:</strong> <?php echo number_format($promedioImpares, 2); ?></p>
                        <p><strong>Rango:</strong> 1, 3, 5, 7, ... 199</p>
                        <p><strong>Fórmula:</strong> n % 2 != 0</p>
                    </div>
                </div>
            </div>

            <button class="back-btn" onclick="window.history.back()">← Volver al Menú</button>
        </div>
    </div>
</body>
</html>