<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 4 - Pares e Impares</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p4-encabezado">
                <h1>Problema 4: Suma de Pares e Impares</h1>
                <p class="p4-descripcion">
                    Calcular independientemente la suma de los números pares e impares 
                    comprendidos entre 1 y un número ingresado (máximo 200).
                </p>
            </div>

            <div class="p4-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p4-seccion-formulario">
                    <form method="POST">
                        <div class="form-group">
                            <label for="numero">Ingrese un número del 1 al 200:</label>
                            <input type="number" id="numero" name="numero" min="1" max="200" 
                                   value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>" 
                                   required>
                        </div>
                        <button type="submit" class="p4-boton-calcular">Calcular Sumas</button>
                    </form>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numero'])) {
                    $numero = (int)$_POST['numero'];
                    
                    // Validar que el número esté entre 1 y 200
                    if ($numero < 1 || $numero > 200) {
                        echo '<div class="p4-mensaje-error">⚠️ Error: El número debe estar entre 1 y 200</div>';
                    } else {
                        // Inicializar variables
                        $sumaPares = 0;
                        $sumaImpares = 0;
                        $cantidadPares = 0;
                        $cantidadImpares = 0;

                        // Calcular sumas del 1 hasta el número ingresado
                        for ($i = 1; $i <= $numero; $i++) {
                            if ($i % 2 == 0) {
                                $sumaPares += $i;
                                $cantidadPares++;
                            } else {
                                $sumaImpares += $i;
                                $cantidadImpares++;
                            }
                        }

                        // Calcular total
                        $sumaTotal = $sumaPares + $sumaImpares;

                        // Calcular altura proporcional para las barras
                        $maxSuma = max($sumaPares, $sumaImpares);
                        $alturaPares = $maxSuma > 0 ? ($sumaPares / $maxSuma) * 100 : 0;
                        $alturaImpares = $maxSuma > 0 ? ($sumaImpares / $maxSuma) * 100 : 0;

                        // Calcular promedios
                        $promedioPares = $cantidadPares > 0 ? $sumaPares / $cantidadPares : 0;
                        $promedioImpares = $cantidadImpares > 0 ? $sumaImpares / $cantidadImpares : 0;
                        ?>

                        <div class="p4-info-rango">
                            Calculando del 1 al <?php echo $numero; ?>
                        </div>

                        <!-- Tarjetas de resultados -->
                        <div class="p4-grid-resultados">
                            <div class="p4-tarjeta-resultado p4-tarjeta-pares">
                                <h2>Números Pares</h2>
                                <div class="p4-numero-grande"><?php echo number_format($sumaPares); ?></div>
                                <div class="p4-contador"><?php echo $cantidadPares; ?> números</div>
                            </div>

                            <div class="p4-tarjeta-resultado p4-tarjeta-impares">
                                <h2>Números Impares</h2>
                                <div class="p4-numero-grande"><?php echo number_format($sumaImpares); ?></div>
                                <div class="p4-contador"><?php echo $cantidadImpares; ?> números</div>
                            </div>

                            <div class="p4-tarjeta-resultado p4-tarjeta-total">
                                <h2>Suma Total</h2>
                                <div class="p4-numero-grande"><?php echo number_format($sumaTotal); ?></div>
                                <div class="p4-contador"><?php echo $numero; ?> números</div>
                            </div>
                        </div>

                        <!-- Gráfica de comparación -->
                        <div class="p4-seccion-grafica">
                            <h3 class="p4-titulo-grafica">Comparación Visual</h3>
                            <div class="p4-grafica-comparacion">
                                <div class="p4-contenedor-barra">
                                    <div class="p4-barra p4-barra-pares" style="height: <?php echo $alturaPares; ?>%;">
                                        <span class="p4-valor-barra"><?php echo number_format($sumaPares); ?></span>
                                    </div>
                                    <div class="p4-etiqueta-barra">Pares</div>
                                </div>

                                <div class="p4-contenedor-barra">
                                    <div class="p4-barra p4-barra-impares" style="height: <?php echo $alturaImpares; ?>%;">
                                        <span class="p4-valor-barra"><?php echo number_format($sumaImpares); ?></span>
                                    </div>
                                    <div class="p4-etiqueta-barra">Impares</div>
                                </div>
                            </div>
                        </div>

                        <!-- Detalles por categoría -->
                        <div class="p4-seccion-detalles">
                            <div class="p4-tarjeta-detalle p4-detalle-pares">
                                <h3>Detalles de Números Pares</h3>
                                <div class="p4-info-detalle">
                                    <p><strong>Cantidad:</strong> <?php echo $cantidadPares; ?> números</p>
                                    <p><strong>Suma total:</strong> <?php echo number_format($sumaPares); ?></p>
                                    <p><strong>Promedio:</strong> <?php echo number_format($promedioPares, 2); ?></p>
                                    <p><strong>Rango:</strong> Del 2 al <?php echo ($numero % 2 == 0) ? $numero : ($numero - 1); ?></p>
                                    <p><strong>Fórmula:</strong> n % 2 == 0</p>
                                </div>
                            </div>

                            <div class="p4-tarjeta-detalle p4-detalle-impares">
                                <h3>Detalles de Números Impares</h3>
                                <div class="p4-info-detalle">
                                    <p><strong>Cantidad:</strong> <?php echo $cantidadImpares; ?> números</p>
                                    <p><strong>Suma total:</strong> <?php echo number_format($sumaImpares); ?></p>
                                    <p><strong>Promedio:</strong> <?php echo number_format($promedioImpares, 2); ?></p>
                                    <p><strong>Rango:</strong> Del 1 al <?php echo ($numero % 2 != 0) ? $numero : ($numero - 1); ?></p>
                                    <p><strong>Fórmula:</strong> n % 2 != 0</p>
                                </div>
                            </div>
                        </div>

                        <?php
                    }
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p4-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>