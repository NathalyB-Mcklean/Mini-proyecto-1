<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Presupuesto Hospital - Problema #6</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
            font-size: 1em;
            margin-bottom: 25px;
            line-height: 1.8;
            padding: 0 20px;
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

        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 1em;
            transition: all 0.3s;
        }

        input[type="number"]:focus {
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

        .resultado h2 {
            color: #667eea;
            font-size: 1.5em;
            margin-bottom: 25px;
            text-align: center;
        }

        .tabla-container {
            overflow-x: auto;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        thead {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        th {
            padding: 15px;
            text-align: left;
            font-weight: 600;
            font-size: 1.05em;
        }

        td {
            padding: 15px;
            border-bottom: 1px solid #f0f0f0;
            font-size: 1em;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        .total-row {
            background: #e8eaf6 !important;
            font-weight: bold;
            font-size: 1.1em;
        }

        .total-row td {
            color: #667eea;
            border-top: 3px solid #667eea;
        }

        .resumen-container {
            background: white;
            padding: 25px;
            border-radius: 12px;
            margin-bottom: 20px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .resumen-container h3 {
            color: #2c3e50;
            margin-bottom: 20px;
            font-size: 1.4em;
            text-align: center;
        }

        .resumen-item {
            display: flex;
            align-items: center;
            padding: 12px;
            margin-bottom: 10px;
            border-left: 4px solid #667eea;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .resumen-icono {
            font-size: 1.5em;
            margin-right: 15px;
        }

        .resumen-texto {
            font-size: 1.05em;
            color: #555;
        }

        .resumen-texto strong {
            color: #27ae60;
            font-size: 1.1em;
        }

        .grafico-container {
            margin-top: 30px;
            padding: 25px;
            background: #f8f9fa;
            border-radius: 12px;
            text-align: center;
        }

        .grafico-container h3 {
            color: #2c3e50;
            margin-bottom: 20px;
        }

        .chart-wrapper {
            max-width: 400px;
            margin: 0 auto;
        }

        .back-btn {
            margin-top: 30px;
            background: #6c757d;
        }

        .back-btn:hover {
            background: #5a6268;
        }

        .moneda {
            color: #27ae60;
            font-weight: 600;
        }

        .error {
            background: #ff6b6b;
            color: white;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🏥 Problema #6</h1>
        <p class="descripcion">
            En un hospital existen tres áreas: <strong>Ginecología, Pediatría y Traumatología</strong>.<br>
            El presupuesto anual del hospital se reparte conforme a la siguiente tabla.<br>
        </p>

        <div class="form-section">
            <form method="POST">
                <div class="form-group">
                    <label for="presupuesto">💰 Ingrese el presupuesto anual del hospital ($):</label>
                    <input type="number" id="presupuesto" name="presupuesto" min="1" step="0.01"
                           value="<?php echo isset($_POST['presupuesto']) ? htmlspecialchars($_POST['presupuesto']) : ''; ?>" 
                           placeholder="Ejemplo: 100000" required>
                </div>

                <button type="submit">📊 Calcular Distribución</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['presupuesto'])) {
            $presupuesto = floatval($_POST['presupuesto']);
            
            if ($presupuesto <= 0) {
                echo '<div class="error">⚠️ Error: El presupuesto debe ser mayor a 0</div>';
            } else {
                // Porcentajes según tabla de referencia
                $porcentajes = array(
                    'Ginecología' => 40,
                    'Traumatología' => 35,
                    'Pediatría' => 25
                );
                
                // Calcular montos
                $ginecologia = ($presupuesto * $porcentajes['Ginecología']) / 100;
                $traumatologia = ($presupuesto * $porcentajes['Traumatología']) / 100;
                $pediatria = ($presupuesto * $porcentajes['Pediatría']) / 100;
                
                echo '<div class="resultado">';
                echo '<h2>📈 Distribución del Presupuesto</h2>';
                
                // Tabla de resultados
                echo '<div class="tabla-container">';
                echo '<table>';
                echo '<thead>';
                echo '<tr>';
                echo '<th>Área</th>';
                echo '<th>Porcentaje</th>';
                echo '<th>Monto Asignado</th>';
                echo '</tr>';
                echo '</thead>';
                echo '<tbody>';
                
                echo '<tr>';
                echo '<td>🩺 Ginecología</td>';
                echo '<td>' . $porcentajes['Ginecología'] . '%</td>';
                echo '<td class="moneda">$' . number_format($ginecologia, 2, '.', ',') . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td>🔧 Traumatología</td>';
                echo '<td>' . $porcentajes['Traumatología'] . '%</td>';
                echo '<td class="moneda">$' . number_format($traumatologia, 2, '.', ',') . '</td>';
                echo '</tr>';
                
                echo '<tr>';
                echo '<td>👶 Pediatría</td>';
                echo '<td>' . $porcentajes['Pediatría'] . '%</td>';
                echo '<td class="moneda">$' . number_format($pediatria, 2, '.', ',') . '</td>';
                echo '</tr>';
                
                echo '<tr class="total-row">';
                echo '<td><strong>TOTAL</strong></td>';
                echo '<td><strong>100%</strong></td>';
                echo '<td><strong>$' . number_format($presupuesto, 2, '.', ',') . '</strong></td>';
                echo '</tr>';
                
                echo '</tbody>';
                echo '</table>';
                echo '</div>';
                
                // Resumen con iconos
                echo '<div class="resumen-container">';
                echo '<h3>Resultados del Presupuesto</h3>';
                
                echo '<div class="resumen-item">';
                echo '<span class="resumen-icono">🩺</span>';
                echo '<span class="resumen-texto">Ginecología (' . $porcentajes['Ginecología'] . '%): <strong>$' . number_format($ginecologia, 2, '.', ',') . '</strong></span>';
                echo '</div>';
                
                echo '<div class="resumen-item">';
                echo '<span class="resumen-icono">🔧</span>';
                echo '<span class="resumen-texto">Traumatología (' . $porcentajes['Traumatología'] . '%): <strong>$' . number_format($traumatologia, 2, '.', ',') . '</strong></span>';
                echo '</div>';
                
                echo '<div class="resumen-item">';
                echo '<span class="resumen-icono">👶</span>';
                echo '<span class="resumen-texto">Pediatría (' . $porcentajes['Pediatría'] . '%): <strong>$' . number_format($pediatria, 2, '.', ',') . '</strong></span>';
                echo '</div>';
                
                echo '</div>';
                
                // Gráfica de pastel (pie chart)
                echo '<div class="grafico-container">';
                echo '<h3>Distribución del presupuesto: $' . number_format($presupuesto, 2, '.', ',') . '</h3>';
                echo '<div class="chart-wrapper">';
                echo '<canvas id="pieChart"></canvas>';
                echo '</div>';
                echo '</div>';
                
                // Script para la gráfica
                $ginecologia_js = number_format($ginecologia, 2, '.', '');
                $traumatologia_js = number_format($traumatologia, 2, '.', '');
                $pediatria_js = number_format($pediatria, 2, '.', '');
                
                echo '<script>';
                echo 'const ctx = document.getElementById("pieChart");';
                echo 'new Chart(ctx, {';
                echo '  type: "pie",';
                echo '  data: {';
                echo '    labels: ["Ginecología (40%)", "Traumatología (35%)", "Pediatría (25%)"],';
                echo '    datasets: [{';
                echo '      data: [40, 35, 25],';
                echo '      backgroundColor: ["#4472C4", "#ED7D31", "#E15759"],';
                echo '      borderWidth: 2,';
                echo '      borderColor: "#fff"';
                echo '    }]';
                echo '  },';
                echo '  options: {';
                echo '    responsive: true,';
                echo '    maintainAspectRatio: true,';
                echo '    plugins: {';
                echo '      legend: {';
                echo '        position: "bottom",';
                echo '        labels: { padding: 15, font: { size: 13 } }';
                echo '      },';
                echo '      tooltip: {';
                echo '        callbacks: {';
                echo '          label: function(context) {';
                echo '            var amounts = [' . $ginecologia_js . ', ' . $traumatologia_js . ', ' . $pediatria_js . '];';
                echo '            return context.label + ": $" + amounts[context.dataIndex].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, "$&,");';
                echo '          }';
                echo '        }';
                echo '      }';
                echo '    }';
                echo '  }';
                echo '});';
                echo '</script>';
                
                echo '</div>';
            }
        }
        ?>

        <button class="back-btn" onclick="window.history.back()">← Volver al Menú</button>
    </div>
</body>
</html>