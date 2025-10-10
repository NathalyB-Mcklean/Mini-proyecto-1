<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 7 - Calculadora Estadística de Notas</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p7-encabezado">
                <h1>Problema 7: Calculadora Estadística de Notas</h1>
                <p class="p7-descripcion">
                    Análisis completo de calificaciones con estadísticas detalladas
                </p>
            </div>

            <div class="p7-contenido">
                <?php include 'nav-problemas.php'; ?>
                <?php
                // Clase para cálculos estadísticos
                class StatisticsCalculator {
                    private $notas;
                    private $notaAprobatoria;

                    public function __construct($notas, $notaAprobatoria = 61) {
                        $this->notas = $notas;
                        $this->notaAprobatoria = $notaAprobatoria;
                    }

                    public static function calcularPromedio($notas) {
                        $suma = 0;
                        $cantidad = 0;

                        foreach ($notas as $nota) {
                            $suma += $nota;
                            $cantidad++;
                        }

                        return $cantidad > 0 ? $suma / $cantidad : 0;
                    }

                    public static function encontrarMinima($notas) {
                        $minima = null;

                        foreach ($notas as $nota) {
                            $minima = ($minima === null || $nota < $minima) ? $nota : $minima;
                        }

                        return $minima;
                    }

                    public static function encontrarMaxima($notas) {
                        $maxima = null;

                        foreach ($notas as $nota) {
                            $maxima = ($maxima === null || $nota > $maxima) ? $nota : $maxima;
                        }

                        return $maxima;
                    }

                    public static function calcularDesviacionEstandar($notas) {
                        $promedio = self::calcularPromedio($notas);
                        $sumaCuadrados = 0;
                        $cantidad = 0;

                        foreach ($notas as $nota) {
                            $diferencia = $nota - $promedio;
                            $sumaCuadrados += $diferencia * $diferencia;
                            $cantidad++;
                        }

                        return $cantidad > 0 ? sqrt($sumaCuadrados / $cantidad) : 0;
                    }

                    public function clasificarNotas() {
                        $aprobados = 0;
                        $reprobados = 0;
                        $notasClasificadas = [];

                        foreach ($this->notas as $index => $nota) {
                            $estado = $nota >= $this->notaAprobatoria ? 'Aprobado' : 'Reprobado';
                            
                            switch ($estado) {
                                case 'Aprobado':
                                    $aprobados++;
                                    break;
                                case 'Reprobado':
                                    $reprobados++;
                                    break;
                            }

                            $notasClasificadas[] = [
                                'numero' => $index + 1,
                                'nota' => $nota,
                                'estado' => $estado
                            ];
                        }

                        return [
                            'clasificadas' => $notasClasificadas,
                            'aprobados' => $aprobados,
                            'reprobados' => $reprobados
                        ];
                    }

                    public function obtenerDistribucion() {
                        $rangos = [
                            '0-60' => 0,
                            '61-70' => 0,
                            '71-80' => 0,
                            '81-90' => 0,
                            '91-100' => 0
                        ];

                        foreach ($this->notas as $nota) {
                            if ($nota < 61) {
                                $rangos['0-60']++;
                            } elseif ($nota < 71) {
                                $rangos['61-70']++;
                            } elseif ($nota < 81) {
                                $rangos['71-80']++;
                            } elseif ($nota < 91) {
                                $rangos['81-90']++;
                            } else {
                                $rangos['91-100']++;
                            }
                        }

                        return $rangos;
                    }

                    public function calcularEstadisticas() {
                        $clasificacion = $this->clasificarNotas();
                        $distribucion = $this->obtenerDistribucion();

                        return [
                            'promedio' => self::calcularPromedio($this->notas),
                            'minima' => self::encontrarMinima($this->notas),
                            'maxima' => self::encontrarMaxima($this->notas),
                            'desviacion' => self::calcularDesviacionEstandar($this->notas),
                            'cantidad' => count($this->notas),
                            'aprobados' => $clasificacion['aprobados'],
                            'reprobados' => $clasificacion['reprobados'],
                            'clasificadas' => $clasificacion['clasificadas'],
                            'distribucion' => $distribucion,
                            'porcentajeAprobados' => (count($this->notas) > 0) ? 
                                ($clasificacion['aprobados'] / count($this->notas)) * 100 : 0
                        ];
                    }
                }
                ?>

                <div class="p7-seccion-formulario">
                    <form method="POST">
                        <div class="form-group">
                            <label for="notas">Ingresa las Notas</label>
                            <textarea 
                                id="notas" 
                                name="notas" 
                                placeholder="Ingresa las notas separadas por comas, espacios o saltos de línea&#10;Ejemplo: 85, 92, 78, 95, 88"
                                required><?php echo isset($_POST['notas']) ? htmlspecialchars($_POST['notas']) : ''; ?></textarea>
                            <div class="p7-hint">Puedes ingresar las notas separadas por comas, espacios o saltos de línea</div>
                        </div>

                        <button type="submit" class="p7-boton-calcular">Calcular Estadísticas</button>
                    </form>
                </div>

                <?php
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['notas'])) {
                    $notasInput = $_POST['notas'];
                    $notaAprobatoria = 61;

                    $notasArray = preg_split('/[\s,]+/', trim($notasInput));
                    $notasArray = array_filter($notasArray, function($valor) {
                        return $valor !== '';
                    });

                    $notas = array_map('floatval', $notasArray);

                    if (count($notas) > 0) {
                        $calculadora = new StatisticsCalculator($notas, $notaAprobatoria);
                        $stats = $calculadora->calcularEstadisticas();
                        $maxDistribucion = max($stats['distribucion']);
                        ?>

                        <!-- Tarjetas de estadísticas principales -->
                        <div class="p7-grid-estadisticas">
                            <div class="p7-tarjeta-estadistica p7-tarjeta-promedio">
                                <h3>Promedio</h3>
                                <div class="p7-valor-estadistica"><?php echo number_format($stats['promedio'], 2); ?></div>
                                <div class="p7-subtitulo-estadistica"><?php echo $stats['cantidad']; ?> notas analizadas</div>
                            </div>

                            <div class="p7-tarjeta-estadistica p7-tarjeta-desviacion">
                                <h3>Desviación Estándar</h3>
                                <div class="p7-valor-estadistica"><?php echo number_format($stats['desviacion'], 2); ?></div>
                                <div class="p7-subtitulo-estadistica">Dispersión de datos</div>
                            </div>

                            <div class="p7-tarjeta-estadistica p7-tarjeta-minima">
                                <h3>Nota Mínima</h3>
                                <div class="p7-valor-estadistica"><?php echo number_format($stats['minima'], 2); ?></div>
                                <div class="p7-subtitulo-estadistica">Calificación más baja</div>
                            </div>

                            <div class="p7-tarjeta-estadistica p7-tarjeta-maxima">
                                <h3>Nota Máxima</h3>
                                <div class="p7-valor-estadistica"><?php echo number_format($stats['maxima'], 2); ?></div>
                                <div class="p7-subtitulo-estadistica">Calificación más alta</div>
                            </div>
                        </div>

                        <!-- Gráfica de distribución -->
                        <div class="p7-seccion-grafica">
                            <h3 class="p7-titulo-grafica">Distribución de Notas por Rangos</h3>
                            <div class="p7-grafica-distribucion">
                                <?php 
                                $colores = [
                                    '0-60' => 'linear-gradient(to top, #ef4444, #f87171)',
                                    '61-70' => 'linear-gradient(to top, #f59e0b, #fbbf24)',
                                    '71-80' => 'linear-gradient(to top, #eab308, #facc15)',
                                    '81-90' => 'linear-gradient(to top, #84cc16, #a3e635)',
                                    '91-100' => 'linear-gradient(to top, #10b981, #34d399)'
                                ];

                                foreach ($stats['distribucion'] as $rango => $cantidad): 
                                    $altura = $maxDistribucion > 0 ? ($cantidad / $maxDistribucion) * 100 : 0;
                                ?>
                                    <div class="p7-contenedor-barra">
                                        <div class="p7-barra" style="height: <?php echo $altura; ?>%; background: <?php echo $colores[$rango]; ?>;">
                                            <span class="p7-valor-barra"><?php echo $cantidad; ?></span>
                                        </div>
                                        <div class="p7-etiqueta-barra"><?php echo $rango; ?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>

                        <!-- Sección de análisis -->
                        <div class="p7-seccion-analisis">
                            <div class="p7-tarjeta-analisis">
                                <h3>Aprobación</h3>
                                <div class="p7-item-analisis">
                                    <span>Aprobados:</span>
                                    <strong style="color: #10b981;"><?php echo $stats['aprobados']; ?></strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Reprobados:</span>
                                    <strong style="color: #ef4444;"><?php echo $stats['reprobados']; ?></strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Porcentaje Aprobación:</span>
                                    <strong style="color: #3b82f6;"><?php echo number_format($stats['porcentajeAprobados'], 1); ?>%</strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Nota Aprobatoria:</span>
                                    <strong><?php echo number_format($notaAprobatoria, 2); ?></strong>
                                </div>
                            </div>

                            <div class="p7-tarjeta-analisis">
                                <h3>Análisis Adicional</h3>
                                <div class="p7-item-analisis">
                                    <span>Rango:</span>
                                    <strong><?php echo number_format($stats['maxima'] - $stats['minima'], 2); ?></strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Mediana:</span>
                                    <strong>
                                        <?php 
                                        $notasOrdenadas = $notas;
                                        sort($notasOrdenadas);
                                        $mediana = count($notasOrdenadas) % 2 === 0 
                                            ? ($notasOrdenadas[count($notasOrdenadas)/2 - 1] + $notasOrdenadas[count($notasOrdenadas)/2]) / 2
                                            : $notasOrdenadas[floor(count($notasOrdenadas)/2)];
                                        echo number_format($mediana, 2);
                                        ?>
                                    </strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Suma Total:</span>
                                    <strong><?php echo number_format(array_sum($notas), 2); ?></strong>
                                </div>
                                <div class="p7-item-analisis">
                                    <span>Coeficiente de Variación:</span>
                                    <strong>
                                        <?php 
                                        $cv = $stats['promedio'] > 0 ? ($stats['desviacion'] / $stats['promedio']) * 100 : 0;
                                        echo number_format($cv, 2) . '%';
                                        ?>
                                    </strong>
                                </div>
                            </div>
                        </div>

                        <!-- Lista de notas clasificadas -->
                        <div class="p7-lista-notas">
                            <h3>Detalle de Todas las Notas</h3>
                            <?php foreach ($stats['clasificadas'] as $nota): ?>
                                <div class="p7-item-nota">
                                    <span><strong>Nota #<?php echo $nota['numero']; ?>:</strong> <?php echo number_format($nota['nota'], 2); ?></span>
                                    <span class="p7-badge-estado p7-badge-<?php echo strtolower($nota['estado']); ?>">
                                        <?php echo $nota['estado']; ?>
                                    </span>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <?php
                    } else {
                        echo '<div class="mensaje-error">
                                <strong>Error:</strong> Por favor, ingresa al menos una nota válida.
                              </div>';
                    }
                }
                ?>

                <div style="text-align: center;">
                    <a href="index.php" class="p7-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>

    <?php require_once 'footer.php'; ?>
</body>
</html>