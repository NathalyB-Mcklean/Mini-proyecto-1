<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 5 - Clasificación por Edad</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p5-encabezado">
                <h1>Problema 5: Clasificación por Edad</h1>
                <p class="p5-descripcion">
                    Ingresa 5 edades para analizar y clasificar en categorías: 
                    Niño, Adolescente, Adulto y Adulto Mayor.
                </p>
            </div>
            <div class="p5-contenido">
                <?php include 'nav-problemas.php'; ?>
                <?php
                // Clase para clasificación de edades
                class AgeClassifier {
                    public static function clasificarEdad($edad) {
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

                    public static function obtenerClaseCss($clasificacion) {
                        return $clasificacion === 'Niño' ? 'nino' :
                               ($clasificacion === 'Adolescente' ? 'adolescente' :
                               ($clasificacion === 'Adulto' ? 'adulto' : 'adultomayor'));
                    }

                    public static function procesarEdades($edades) {
                        $resultados = [];
                        $estadisticas = [
                            'Niño' => 0,
                            'Adolescente' => 0,
                            'Adulto' => 0,
                            'Adulto Mayor' => 0
                        ];

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
                ?>

                <div class="p5-seccion-formulario">
                    <form method="POST">
                        <div class="form-grid">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="form-group">
                                    <label for="edad<?php echo $i; ?>">Edad <?php echo $i; ?></label>
                                    <div class="p5-input-contenedor">
                                        <input 
                                            type="number" 
                                            id="edad<?php echo $i; ?>" 
                                            name="edades[]" 
                                            min="0" 
                                            max="120" 
                                            required 
                                            placeholder="Ejemplo: 25"
                                            value="<?php echo isset($_POST['edades'][$i-1]) ? htmlspecialchars($_POST['edades'][$i-1]) : ''; ?>"
                                        >
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        
                        <button type="submit" class="p5-boton-analizar">Analizar Edades</button>
                    </form>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edades'])) {
                    $edadesIngresadas = array_map('intval', $_POST['edades']);
                    
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

                        <div class="p5-caja-resultados">
                            <h2 class="p5-titulo-resultados">Resultados del Análisis</h2>
                            
                            <!-- Estadísticas en tarjetas -->
                            <div class="p5-grid-estadisticas">
                                <?php foreach ($estadisticas as $categoria => $cantidad): ?>
                                    <div class="p5-tarjeta-estadistica p5-tarjeta-<?php echo AgeClassifier::obtenerClaseCss($categoria); ?>">
                                        <h3><?php echo $categoria; ?></h3>
                                        <div class="p5-numero-estadistica"><?php echo $cantidad; ?></div>
                                        <p class="p5-texto-estadistica"><?php echo $cantidad === 1 ? 'persona' : 'personas'; ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>

                            <!-- Gráfica de barras -->
                            <div class="p5-contenedor-grafica">
                                <h3 class="p5-titulo-grafica">Distribución por Categoría</h3>
                                <div class="p5-grafica-barras">
                                    <?php foreach ($estadisticas as $categoria => $cantidad): ?>
                                        <?php 
                                        $altura = $maxValor > 0 ? ($cantidad / $maxValor) * 100 : 0;
                                        $clase = AgeClassifier::obtenerClaseCss($categoria);
                                        ?>
                                        <div class="p5-contenedor-barra">
                                            <div class="p5-barra p5-barra-<?php echo $clase; ?>" style="height: <?php echo $altura; ?>%;">
                                                <span class="p5-valor-barra"><?php echo $cantidad; ?></span>
                                            </div>
                                            <div class="p5-etiqueta-barra"><?php echo $categoria; ?></div>
                                        </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>

                            <!-- Lista detallada de edades -->
                            <div class="p5-lista-edades">
                                <h3>Detalle de Edades Clasificadas</h3>
                                <?php 
                                $contador = 0;
                                while ($contador < count($resultados)): 
                                    $resultado = $resultados[$contador];
                                ?>
                                    <div class="p5-item-edad">
                                        <span><strong>Persona <?php echo $contador + 1; ?>:</strong> <?php echo $resultado['edad']; ?> años</span>
                                        <span class="p5-badge-categoria p5-badge-<?php echo $resultado['clase']; ?>">
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
                        echo '<div class="mensaje-error">
                                <strong>Error:</strong> Por favor, ingresa edades válidas entre 0 y 120 años.
                              </div>';
                    }
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p5-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>