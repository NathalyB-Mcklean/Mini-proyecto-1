<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 6 - Presupuesto Hospital</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p6-encabezado">
                <h1>Problema 6: Presupuesto Hospital</h1>
                <p class="p6-descripcion">
                    En un hospital existen tres áreas: Ginecología, Pediatría y Traumatología.
                    El presupuesto anual del hospital se reparte según porcentajes establecidos.
                </p>
            </div>

            <div class="p6-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p6-seccion-formulario">
                    <form method="POST">
                        <div class="form-group">
                            <label for="presupuesto">Ingrese el presupuesto anual del hospital ($)</label>
                            <div class="p6-input-contenedor">
                                <input 
                                    type="number" 
                                    id="presupuesto" 
                                    name="presupuesto" 
                                    min="1" 
                                    step="0.01"
                                    value="<?php echo isset($_POST['presupuesto']) ? htmlspecialchars($_POST['presupuesto']) : ''; ?>" 
                                    placeholder="Ejemplo: 100000" 
                                    required
                                >
                            </div>
                        </div>

                        <button type="submit" class="p6-boton-calcular">Calcular Distribución</button>
                    </form>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['presupuesto'])) {
                    $presupuesto = floatval($_POST['presupuesto']);
                    
                    if ($presupuesto <= 0) {
                        echo '<div class="mensaje-error">
                                <strong>Error:</strong> El presupuesto debe ser mayor a 0
                              </div>';
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
                        ?>

                        <div class="p6-caja-resultados">
                            <h2 class="p6-titulo-resultados">Distribución del Presupuesto</h2>
                            
                            <!-- Tabla de resultados -->
                            <div class="p6-contenedor-tabla">
                                <table class="p6-tabla">
                                    <thead>
                                        <tr>
                                            <th>Área</th>
                                            <th>Porcentaje</th>
                                            <th>Monto Asignado</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Ginecología</td>
                                            <td><?php echo $porcentajes['Ginecología']; ?>%</td>
                                            <td class="p6-moneda">$<?php echo number_format($ginecologia, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Traumatología</td>
                                            <td><?php echo $porcentajes['Traumatología']; ?>%</td>
                                            <td class="p6-moneda">$<?php echo number_format($traumatologia, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr>
                                            <td>Pediatría</td>
                                            <td><?php echo $porcentajes['Pediatría']; ?>%</td>
                                            <td class="p6-moneda">$<?php echo number_format($pediatria, 2, '.', ','); ?></td>
                                        </tr>
                                        <tr class="p6-fila-total">
                                            <td><strong>TOTAL</strong></td>
                                            <td><strong>100%</strong></td>
                                            <td><strong>$<?php echo number_format($presupuesto, 2, '.', ','); ?></strong></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- Resumen con tarjetas -->
                            <div class="p6-grid-resumen">
                                <div class="p6-tarjeta-resumen p6-tarjeta-ginecologia">
                                    <div class="p6-icono-area">🩺</div>
                                    <div class="p6-info-area">
                                        <div class="p6-nombre-area">Ginecología</div>
                                        <div class="p6-porcentaje-area"><?php echo $porcentajes['Ginecología']; ?>% del presupuesto</div>
                                        <div class="p6-monto-area">$<?php echo number_format($ginecologia, 2, '.', ','); ?></div>
                                    </div>
                                </div>

                                <div class="p6-tarjeta-resumen p6-tarjeta-traumatologia">
                                    <div class="p6-icono-area">🔧</div>
                                    <div class="p6-info-area">
                                        <div class="p6-nombre-area">Traumatología</div>
                                        <div class="p6-porcentaje-area"><?php echo $porcentajes['Traumatología']; ?>% del presupuesto</div>
                                        <div class="p6-monto-area">$<?php echo number_format($traumatologia, 2, '.', ','); ?></div>
                                    </div>
                                </div>

                                <div class="p6-tarjeta-resumen p6-tarjeta-pediatria">
                                    <div class="p6-icono-area">👶</div>
                                    <div class="p6-info-area">
                                        <div class="p6-nombre-area">Pediatría</div>
                                        <div class="p6-porcentaje-area"><?php echo $porcentajes['Pediatría']; ?>% del presupuesto</div>
                                        <div class="p6-monto-area">$<?php echo number_format($pediatria, 2, '.', ','); ?></div>
                                    </div>
                                </div>
                            </div>

                            <!-- Gráfica de pastel -->
                            <div class="p6-contenedor-grafica">
                                <h3 class="p6-titulo-grafica">
                                    Distribución del presupuesto: $<?php echo number_format($presupuesto, 2, '.', ','); ?>
                                </h3>
                                <div class="p6-envoltorio-chart">
                                    <canvas id="pieChart"></canvas>
                                </div>
                            </div>

                            <script>
                            const ctx = document.getElementById('pieChart');
                            new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Ginecología (40%)', 'Traumatología (35%)', 'Pediatría (25%)'],
                                    datasets: [{
                                        data: [40, 35, 25],
                                        backgroundColor: ['#3b82f6', '#f59e0b', '#ef4444'],
                                        borderWidth: 3,
                                        borderColor: '#fff'
                                    }]
                                },
                                options: {
                                    responsive: true,
                                    maintainAspectRatio: true,
                                    plugins: {
                                        legend: {
                                            position: 'bottom',
                                            labels: { 
                                                padding: 15, 
                                                font: { size: 13 }
                                            }
                                        },
                                        tooltip: {
                                            callbacks: {
                                                label: function(context) {
                                                    var amounts = [<?php echo number_format($ginecologia, 2, '.', ''); ?>, 
                                                                   <?php echo number_format($traumatologia, 2, '.', ''); ?>, 
                                                                   <?php echo number_format($pediatria, 2, '.', ''); ?>];
                                                    return context.label + ': $' + amounts[context.dataIndex].toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                                                }
                                            }
                                        }
                                    }
                                }
                            });
                            </script>
                        </div>

                        <?php
                    }
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p6-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>