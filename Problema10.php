<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 10 - Sistema de Ventas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p10-encabezado">
                <h1>Problema 10: Sistema de Ventas</h1>
                <div class="p10-descripcion">
                    <strong>Sistema de Ventas con Arreglo Bidimensional</strong><br><br>
                    Una empresa tiene cuatro vendedores (1 al 4) que venden cinco productos diferentes (1 al 5).
                    Una vez al día, cada empleado pasa en una nota para cada tipo diferente de producto vendido.
                    Cada hoja contiene lo siguiente:<br><br>
                    a) El número del vendedor<br>
                    b) El número de producto<br>
                    c) El valor total en dólares de ese producto vendido ese día<br><br>
                    El sistema procesa todas las ventas del mes y muestra los resultados en formato tabular.
                </div>
            </div>

            <div class="p10-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p10-seccion-formulario">
                    <h3>Ingresar ventas del Mes</h3>
                    <div class="p10-info-box">
                        <strong>Instrucciones:</strong> Ingrese el valor total de ventas para cada producto por vendedor durante el mes.
                        Deje en 0 si no hubo ventas de ese producto.
                    </div>

                    <form method="POST">
                        <?php
                        // Generar formulario para 4 vendedores
                        for ($v = 1; $v <= 4; $v++) {
                            echo '<div class="p10-vendedor-section">';
                            echo '<div class="p10-vendedor-header"> Vendedor ' . $v . '</div>';
                            echo '<div class="p10-producto-grid">';
                            
                            for ($p = 1; $p <= 5; $p++) {
                                $valor = '';
                                if (isset($_POST['venta'][$v][$p])) {
                                    $valor = htmlspecialchars($_POST['venta'][$v][$p]);
                                }
                                
                                echo '<div class="p10-producto-item">';
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

                        <button type="submit" class="p10-boton-procesar">📈 Procesar Ventas del Mes</button>
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
                    ?>

                    <h2 class="p10-titulo-reporte">📊 Reporte de Ventas del Mes</h2>
                    
                    <!-- Tabla de resultados -->
                    <div class="p10-tabla-container">
                        <table>
                            <thead>
                                <tr>
                                    <th>Vendedor</th>
                                    <th>Producto 1</th>
                                    <th>Producto 2</th>
                                    <th>Producto 3</th>
                                    <th>Producto 4</th>
                                    <th>Producto 5</th>
                                    <th class="p10-total-col">Total Vendedor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // Filas de vendedores
                                for ($v = 1; $v <= 4; $v++) {
                                    echo '<tr>';
                                    echo '<td class="p10-vendedor-col">👤 Vendedor ' . $v . '</td>';
                                    
                                    for ($p = 1; $p <= 5; $p++) {
                                        echo '<td>$' . number_format($ventas[$v][$p], 2, '.', ',') . '</td>';
                                    }
                                    
                                    echo '<td class="p10-total-col">$' . number_format($totalesVendedor[$v], 2, '.', ',') . '</td>';
                                    echo '</tr>';
                                }
                                
                                // Fila de totales
                                echo '<tr class="p10-total-row">';
                                echo '<td><strong>TOTAL POR PRODUCTO</strong></td>';
                                
                                for ($p = 1; $p <= 5; $p++) {
                                    echo '<td><strong>$' . number_format($totalesProducto[$p], 2, '.', ',') . '</strong></td>';
                                }
                                
                                echo '<td><strong>$' . number_format($totalGeneral, 2, '.', ',') . '</strong></td>';
                                echo '</tr>';
                                ?>
                            </tbody>
                        </table>
                    </div>
                    
                    <!-- Resumen adicional -->
                    <div class="p10-resumen-ejecutivo">
                        <div class="p10-resumen-item">
                            <strong>📈 Resumen Ejecutivo:</strong>
                        </div>
                        <div class="p10-resumen-item">
                            Total de ventas del mes: <span class="p10-moneda">$<?php echo number_format($totalGeneral, 2, '.', ','); ?></span>
                        </div>
                        
                        <?php
                        // Mejor vendedor
                        $mejorVendedor = 1;
                        $maxVenta = $totalesVendedor[1];
                        for ($v = 2; $v <= 4; $v++) {
                            if ($totalesVendedor[$v] > $maxVenta) {
                                $maxVenta = $totalesVendedor[$v];
                                $mejorVendedor = $v;
                            }
                        }
                        ?>
                        <div class="p10-resumen-item">
                            Mejor vendedor: <strong>Vendedor <?php echo $mejorVendedor; ?></strong> con <span class="p10-moneda">$<?php echo number_format($maxVenta, 2, '.', ','); ?></span>
                        </div>
                        
                        <?php
                        // Producto más vendido
                        $mejorProducto = 1;
                        $maxProducto = $totalesProducto[1];
                        for ($p = 2; $p <= 5; $p++) {
                            if ($totalesProducto[$p] > $maxProducto) {
                                $maxProducto = $totalesProducto[$p];
                                $mejorProducto = $p;
                            }
                        }
                        ?>
                        <div class="p10-resumen-item">
                            Producto más vendido: <strong>Producto <?php echo $mejorProducto; ?></strong> con <span class="p10-moneda">$<?php echo number_format($maxProducto, 2, '.', ','); ?></span>
                        </div>
                    </div>

                    <?php
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p10-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>