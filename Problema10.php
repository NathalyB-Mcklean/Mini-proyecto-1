<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Ventas - Problema #10</title>
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
            max-width: 1200px;
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
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 30px;
            border-left: 4px solid #667eea;
            line-height: 1.6;
            color: #555;
        }

        .descripcion strong {
            color: #2c3e50;
        }

        .form-section {
            background: #f8f9fa;
            padding: 30px;
            border-radius: 12px;
            margin-bottom: 30px;
        }

        .form-section h3 {
            color: #667eea;
            margin-bottom: 20px;
            font-size: 1.3em;
        }

        .vendedor-section {
            background: white;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
            border: 2px solid #e0e0e0;
        }

        .vendedor-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 20px;
            border-radius: 8px;
            margin-bottom: 15px;
            font-weight: 600;
            font-size: 1.1em;
        }

        .producto-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
            gap: 15px;
        }

        .producto-item {
            display: flex;
            flex-direction: column;
        }

        .producto-item label {
            color: #2c3e50;
            font-weight: 600;
            margin-bottom: 5px;
            font-size: 0.95em;
        }

        .producto-item input {
            padding: 10px;
            border: 2px solid #ddd;
            border-radius: 6px;
            font-size: 1em;
            transition: all 0.3s;
        }

        .producto-item input:focus {
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
            margin-top: 20px;
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
            text-align: center;
            font-weight: 600;
            font-size: 1em;
        }

        td {
            padding: 12px;
            border-bottom: 1px solid #f0f0f0;
            text-align: center;
            font-size: 0.95em;
        }

        tbody tr:hover {
            background: #f8f9fa;
        }

        .vendedor-col {
            text-align: left;
            font-weight: 600;
            color: #2c3e50;
        }

        .total-row {
            background: #e8eaf6 !important;
            font-weight: bold;
        }

        .total-row td {
            color: #667eea;
            border-top: 3px solid #667eea;
            font-size: 1.05em;
        }

        .total-col {
            background: #f0f4ff !important;
            font-weight: 600;
            color: #667eea;
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

        .info-box {
            background: #e3f2fd;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-left: 4px solid #2196f3;
        }

        .info-box strong {
            color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>📊 Problema #10</h1>
        <div class="descripcion">
            <strong>Sistema de Ventas con Arreglo Bidimensional</strong><br><br>
            Una empresa tiene cuatro vendedores (1 al 4) que venden cinco productos diferentes (1 al 5).
            Una vez al día, cada empleado pasa en una nota para cada tipo diferente de producto vendido.
            Cada hoja contiene lo siguiente:<br><br>
            a) El número del vendedor<br>
            b) El número de producto<br>
            c) El valor total en dólares de ese producto vendido ese día<br><br>
            El sistema procesa todas las ventas del mes y muestra los resultados en formato tabular.
        </div>

        <div class="form-section">
            <h3>💼 Ingresar Ventas del Mes</h3>
            <div class="info-box">
                <strong>Instrucciones:</strong> Ingrese el valor total de ventas para cada producto por vendedor durante el mes.
                Deje en 0 si no hubo ventas de ese producto.
            </div>

            <form method="POST">
                <?php
                // Generar formulario para 4 vendedores
                for ($v = 1; $v <= 4; $v++) {
                    echo '<div class="vendedor-section">';
                    echo '<div class="vendedor-header">👤 Vendedor ' . $v . '</div>';
                    echo '<div class="producto-grid">';
                    
                    for ($p = 1; $p <= 5; $p++) {
                        $valor = '';
                        if (isset($_POST['venta'][$v][$p])) {
                            $valor = htmlspecialchars($_POST['venta'][$v][$p]);
                        }
                        
                        echo '<div class="producto-item">';
                        echo '<label>Producto ' . $p . '</label>';
                        echo '<input type="number" name="venta[' . $v . '][' . $p . ']" 
                                     min="0" step="0.01" value="' . $valor . '" 
                                     placeholder="$0.00" required>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
                ?>

                <button type="submit">📈 Procesar Ventas del Mes</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['venta'])) {
            // Inicializar arreglo bidimensional de ventas
            $ventas = array();
            
            // Leer datos del formulario
            for ($v = 1; $v <= 4; $v++) {
                for ($p = 1; $p <= 5; $p++) {
                    $ventas[$v][$p] = floatval($_POST['venta'][$v][$p]);
                }
            }
            
            // Calcular totales por vendedor
            $totalesVendedor = array();
            for ($v = 1; $v <= 4; $v++) {
                $total = 0;
                for ($p = 1; $p <= 5; $p++) {
                    $total += $ventas[$v][$p];
                }
                $totalesVendedor[$v] = $total;
            }
            
            // Calcular totales por producto
            $totalesProducto = array();
            for ($p = 1; $p <= 5; $p++) {
                $total = 0;
                for ($v = 1; $v <= 4; $v++) {
                    $total += $ventas[$v][$p];
                }
                $totalesProducto[$p] = $total;
            }
            
            // Calcular total general
            $totalGeneral = 0;
            for ($v = 1; $v <= 4; $v++) {
                $totalGeneral += $totalesVendedor[$v];
            }
            
            echo '<div class="resultado">';
            echo '<h2>📊 Reporte de Ventas del Mes</h2>';
            
            // Tabla de resultados
            echo '<div class="tabla-container">';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>Vendedor</th>';
            echo '<th>Producto 1</th>';
            echo '<th>Producto 2</th>';
            echo '<th>Producto 3</th>';
            echo '<th>Producto 4</th>';
            echo '<th>Producto 5</th>';
            echo '<th class="total-col">Total Vendedor</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            
            // Filas de vendedores
            for ($v = 1; $v <= 4; $v++) {
                echo '<tr>';
                echo '<td class="vendedor-col">👤 Vendedor ' . $v . '</td>';
                
                for ($p = 1; $p <= 5; $p++) {
                    echo '<td>$' . number_format($ventas[$v][$p], 2, '.', ',') . '</td>';
                }
                
                echo '<td class="total-col moneda">$' . number_format($totalesVendedor[$v], 2, '.', ',') . '</td>';
                echo '</tr>';
            }
            
            // Fila de totales
            echo '<tr class="total-row">';
            echo '<td><strong>TOTAL POR PRODUCTO</strong></td>';
            
            for ($p = 1; $p <= 5; $p++) {
                echo '<td><strong>$' . number_format($totalesProducto[$p], 2, '.', ',') . '</strong></td>';
            }
            
            echo '<td><strong>$' . number_format($totalGeneral, 2, '.', ',') . '</strong></td>';
            echo '</tr>';
            
            echo '</tbody>';
            echo '</table>';
            echo '</div>';
            
            // Resumen adicional
            echo '<div class="info-box">';
            echo '<strong>📈 Resumen Ejecutivo:</strong><br>';
            echo 'Total de ventas del mes: <strong class="moneda">$' . number_format($totalGeneral, 2, '.', ',') . '</strong><br>';
            
            // Mejor vendedor
            $mejorVendedor = 1;
            $maxVenta = $totalesVendedor[1];
            for ($v = 2; $v <= 4; $v++) {
                if ($totalesVendedor[$v] > $maxVenta) {
                    $maxVenta = $totalesVendedor[$v];
                    $mejorVendedor = $v;
                }
            }
            echo 'Mejor vendedor: <strong>Vendedor ' . $mejorVendedor . '</strong> con $' . number_format($maxVenta, 2, '.', ',') . '<br>';
            
            // Producto más vendido
            $mejorProducto = 1;
            $maxProducto = $totalesProducto[1];
            for ($p = 2; $p <= 5; $p++) {
                if ($totalesProducto[$p] > $maxProducto) {
                    $maxProducto = $totalesProducto[$p];
                    $mejorProducto = $p;
                }
            }
            echo 'Producto más vendido: <strong>Producto ' . $mejorProducto . '</strong> con $' . number_format($maxProducto, 2, '.', ',');
            echo '</div>';
            
            echo '</div>';
        }
        ?>

        <button class="back-btn" onclick="window.history.back()">← Volver al Menú</button>
    </div>
</body>
</html>