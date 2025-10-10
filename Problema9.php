<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 9 - Potencias</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p9-encabezado">
                <h1>Problema 9: Potencias</h1>
                <p class="p9-descripcion">
                    Solicita un número (1 al 9) y genera las 15 primeras potencias del número
                </p>
            </div>

            <div class="p9-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p9-seccion-formulario">
                    <form method="POST">
                        <div class="form-group">
                            <label for="numero">Ingrese un número del 1 al 9:</label>
                            <input type="number" id="numero" name="numero" min="1" max="9" 
                                   value="<?php echo isset($_POST['numero']) ? htmlspecialchars($_POST['numero']) : ''; ?>" 
                                   required>
                        </div>

                        <div class="p9-grupo-botones">
                            <button type="submit" name="accion" value="generar" class="p9-boton-generar">
                                📊 Generar Potencias
                            </button>
                            <button type="submit" name="accion" value="imprimir" class="p9-boton-imprimir">
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
                        echo '<div class="p9-mensaje-error">⚠️ Error: El número debe estar entre 1 y 9</div>';
                    } else {
                        $accion = $_POST['accion'];
                        
                        // Si la acción es imprimir, agregar script de impresión
                        if ($accion == 'imprimir') {
                            echo '<script>window.onload = function() { window.print(); }</script>';
                        }
                        ?>

                        <div class="p9-numero-seleccionado">
                            Potencias del número: <?php echo $numero; ?>
                        </div>

                        <h2 class="p9-titulo-potencias">Las 15 primeras potencias</h2>

                        <div class="p9-grid-potencias">
                            <?php
                            // Generar las 15 potencias
                            for ($i = 1; $i <= 15; $i++) {
                                $resultado = pow($numero, $i);
                                ?>
                                <div class="p9-item-potencia">
                                    <div class="p9-formula-potencia">
                                        <?php echo $numero; ?><sup><?php echo $i; ?></sup>
                                    </div>
                                    <div class="p9-resultado-potencia">
                                        <?php echo number_format($resultado, 0, ',', '.'); ?>
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>

                        <?php
                    }
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p9-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>