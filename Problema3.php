<?php
// ============================================
// utilidades.php - Clases de utilidades
// ============================================

/**
 * Clase para validación de datos
 */
class Validador
{
    public static function esNumerico($valor): bool
    {
        return is_numeric($valor);
    }
    
    public static function esEnteroPositivo($numero): bool
    {
        return self::esNumerico($numero) && $numero > 0 && floor($numero) == $numero;
    }
    
    public static function validarRango($numero, $min, $max): bool
    {
        return $numero >= $min && $numero <= $max;
    }
    
    public static function limpiarEntrada(string $dato): string
    {
        $dato = trim($dato);
        $dato = stripslashes($dato);
        $dato = htmlspecialchars($dato);
        return $dato;
    }
}

/**
 * Clase para utilidades generales
 */
class Utilidades
{
    public static function formatearNumero(float $numero, int $decimales = 0): string
    {
        return number_format($numero, $decimales, '.', ',');
    }
    
    public static function generarMensajeError(string $mensaje): string
    {
        return '<div class="mensaje-error">
                    <strong>Error:</strong> ' . $mensaje . '
                </div>';
    }
    
    public static function generarMensajeExito(string $mensaje): string
    {
        return '<div class="mensaje-exito">
                    <strong>Éxito:</strong> ' . $mensaje . '
                </div>';
    }
    
    public static function generarMensajeInfo(string $mensaje): string
    {
        return '<div class="mensaje-info">
                    <strong>Información:</strong> ' . $mensaje . '
                </div>';
    }
}

/**
 * Clase para calcular múltiplos
 */
class CalculadorMultiplos
{
    public static function generarMultiplosConFor(int $cantidad, int $base = 4): array
    {
        $multiplos = [];
        
        for ($i = 1; $i <= $cantidad; $i++) {
            $multiplos[] = $base * $i;
        }
        
        return $multiplos;
    }
    
    public static function generarMultiplosConWhile(int $cantidad, int $base = 4): array
    {
        $multiplos = [];
        $i = 1;
        
        while ($i <= $cantidad) {
            $multiplos[] = $base * $i;
            $i++;
        }
        
        return $multiplos;
    }
    
    public static function generarMultiplosConArray(int $cantidad, int $base = 4): array
    {
        $indices = range(1, $cantidad);
        return array_map(function($i) use ($base) {
            return $base * $i;
        }, $indices);
    }
    
    public static function calcularEstadisticas(array $multiplos): array
    {
        $suma = 0;
        $cantidad = count($multiplos);
        
        foreach ($multiplos as $multiplo) {
            $suma += $multiplo;
        }
        
        $promedio = $cantidad > 0 ? $suma / $cantidad : 0;
        $minimo = !empty($multiplos) ? $multiplos[0] : 0;
        $maximo = !empty($multiplos) ? $multiplos[$cantidad - 1] : 0;
        
        return [
            'suma' => $suma,
            'promedio' => $promedio,
            'minimo' => $minimo,
            'maximo' => $maximo,
            'cantidad' => $cantidad
        ];
    }
    
    public static function agruparPorRangos(array $multiplos, int $tamanoRango = 100): array
    {
        $grupos = [];
        
        foreach ($multiplos as $multiplo) {
            $rangoInicio = floor($multiplo / $tamanoRango) * $tamanoRango;
            $rangoFin = $rangoInicio + $tamanoRango - 1;
            $clave = "{$rangoInicio}-{$rangoFin}";
            
            if (!isset($grupos[$clave])) {
                $grupos[$clave] = [];
            }
            
            $grupos[$clave][] = $multiplo;
        }
        
        return $grupos;
    }
}

// ============================================
// Procesamiento del formulario
// ============================================

$errores = [];
$resultados = null;
$metodoSeleccionado = 'for';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cantidadInput = $_POST['cantidad'] ?? '';
    $cantidadInput = Validador::limpiarEntrada($cantidadInput);
    $metodoSeleccionado = $_POST['metodo'] ?? 'for';
    
    if (empty($cantidadInput)) {
        $errores[] = "La cantidad es requerida.";
    } elseif (!Validador::esNumerico($cantidadInput)) {
        $errores[] = "La cantidad debe ser un número válido.";
    } elseif (!Validador::esEnteroPositivo($cantidadInput)) {
        $errores[] = "La cantidad debe ser un número entero positivo.";
    } elseif (!Validador::validarRango($cantidadInput, 1, 1000)) {
        $errores[] = "La cantidad debe estar entre 1 y 1,000.";
    } else {
        $cantidad = intval($cantidadInput);
        
        switch ($metodoSeleccionado) {
            case 'while':
                $multiplos = CalculadorMultiplos::generarMultiplosConWhile($cantidad);
                $metodoNombre = 'Ciclo WHILE';
                break;
            case 'array':
                $multiplos = CalculadorMultiplos::generarMultiplosConArray($cantidad);
                $metodoNombre = 'Funciones de Array';
                break;
            case 'for':
            default:
                $multiplos = CalculadorMultiplos::generarMultiplosConFor($cantidad);
                $metodoNombre = 'Ciclo FOR';
                break;
        }
        
        $estadisticas = CalculadorMultiplos::calcularEstadisticas($multiplos);
        $grupos = CalculadorMultiplos::agruparPorRangos($multiplos);
        
        $resultados = [
            'multiplos' => $multiplos,
            'estadisticas' => $estadisticas,
            'grupos' => $grupos,
            'metodo' => $metodoNombre
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 3 - Múltiplos de 4</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p3-encabezado">
                <h1>Problema 3: Múltiplos de 4</h1>
                <p class="p3-descripcion">
                    Genera e imprime los N primeros múltiplos de 4. Visualiza los resultados, 
                    estadísticas y agrupaciones por rangos.
                </p>
            </div>
            
            <div class="p3-contenido">
                <?php include 'nav-problemas.php'; ?>
                <div class="p3-caja-formula">
                    <h3>Fórmula de Múltiplos</h3>
                    <div class="p3-formula">Múltiplo(n) = 4 × n</div>
                    <p>Donde n es la posición del múltiplo (1, 2, 3, ...)</p>
                </div>
                
                <?php
                if (!empty($errores)) {
                    foreach ($errores as $error) {
                        echo Utilidades::generarMensajeError($error);
                    }
                }
                ?>
                
                <div class="p3-seccion-formulario">
                    <form method="POST" action="">
                        <div class="form-grid">
                            <div class="form-group">
                                <label for="cantidad">
                                    Cantidad de Múltiplos (1 - 1,000)
                                </label>
                                <div class="p3-input-contenedor">
                                    <input 
                                        type="number" 
                                        id="cantidad" 
                                        name="cantidad" 
                                        min="1"
                                        max="1000"
                                        value="<?php echo isset($_POST['cantidad']) ? htmlspecialchars($_POST['cantidad']) : '25'; ?>"
                                        placeholder="Ejemplo: 25"
                                        required
                                    >
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="metodo">
                                    Método de Cálculo
                                </label>
                                <div class="p3-input-contenedor">
                                    <select id="metodo" name="metodo">
                                        <option value="for" <?php echo $metodoSeleccionado === 'for' ? 'selected' : ''; ?>>Ciclo FOR</option>
                                        <option value="while" <?php echo $metodoSeleccionado === 'while' ? 'selected' : ''; ?>>Ciclo WHILE</option>
                                        <option value="array" <?php echo $metodoSeleccionado === 'array' ? 'selected' : ''; ?>>Array Functions</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <button type="submit" class="p3-boton-generar">Generar Múltiplos de 4</button>
                    </form>
                </div>
                
                <?php if ($resultados !== null): ?>
                    <div class="p3-caja-resultados">
                        <h2 class="p3-titulo-resultados">Resultados Generados</h2>
                        
                        <div style="text-align: center;">
                            <span class="p3-badge-metodo">Método: <?php echo $resultados['metodo']; ?></span>
                        </div>
                        
                        <?php echo Utilidades::generarMensajeInfo("Se generaron {$resultados['estadisticas']['cantidad']} múltiplos de 4"); ?>
                        
                        <div class="p3-grid-estadisticas">
                            <div class="p3-tarjeta-estadistica">
                                <div class="p3-label-estadistica">Total de Múltiplos</div>
                                <div class="p3-valor-estadistica"><?php echo $resultados['estadisticas']['cantidad']; ?></div>
                            </div>
                            
                            <div class="p3-tarjeta-estadistica">
                                <div class="p3-label-estadistica">Suma Total</div>
                                <div class="p3-valor-estadistica"><?php echo Utilidades::formatearNumero($resultados['estadisticas']['suma']); ?></div>
                            </div>
                            
                            <div class="p3-tarjeta-estadistica">
                                <div class="p3-label-estadistica">Promedio</div>
                                <div class="p3-valor-estadistica"><?php echo Utilidades::formatearNumero($resultados['estadisticas']['promedio'], 2); ?></div>
                            </div>
                            
                            <div class="p3-tarjeta-estadistica">
                                <div class="p3-label-estadistica">Mínimo</div>
                                <div class="p3-valor-estadistica"><?php echo $resultados['estadisticas']['minimo']; ?></div>
                            </div>
                            
                            <div class="p3-tarjeta-estadistica">
                                <div class="p3-label-estadistica">Máximo</div>
                                <div class="p3-valor-estadistica"><?php echo $resultados['estadisticas']['maximo']; ?></div>
                            </div>
                        </div>
                        
                        <div class="p3-contenedor-multiplos">
                            <h3>Listado de Múltiplos</h3>
                            <div class="p3-grid-multiplos">
                                <?php 
                                $multiplosAMostrar = count($resultados['multiplos']) > 100 
                                    ? array_slice($resultados['multiplos'], 0, 100) 
                                    : $resultados['multiplos'];
                                
                                foreach ($multiplosAMostrar as $multiplo): 
                                ?>
                                    <div class="p3-item-multiplo"><?php echo $multiplo; ?></div>
                                <?php endforeach; ?>
                            </div>
                            
                            <?php if (count($resultados['multiplos']) > 100): ?>
                                <p style="text-align: center; margin-top: 15px; color: #6b7280;">
                                    ... y <?php echo count($resultados['multiplos']) - 100; ?> múltiplos más
                                </p>
                            <?php endif; ?>
                        </div>
                        
                        <?php if (count($resultados['grupos']) > 1): ?>
                        <div class="p3-contenedor-grupos">
                            <h3>Agrupación por Rangos</h3>
                            <?php foreach ($resultados['grupos'] as $rango => $multiplosGrupo): ?>
                                <div class="p3-item-grupo">
                                    <div class="p3-titulo-grupo">Rango: <?php echo $rango; ?></div>
                                    <div class="p3-numeros-grupo">
                                        <strong>Cantidad:</strong> <?php echo count($multiplosGrupo); ?> múltiplos<br>
                                        <strong>Números:</strong> <?php echo implode(', ', $multiplosGrupo); ?>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                        
                        <?php echo Utilidades::generarMensajeExito('Múltiplos generados exitosamente'); ?>
                    </div>
                <?php endif; ?>
                
                <div style="text-align: center;">
                    <a href="index.php" class="p3-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once 'footer.php'; ?>
</body>
</html>