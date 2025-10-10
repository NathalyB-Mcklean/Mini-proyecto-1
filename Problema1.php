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
    
    public static function esPositivo($numero): bool
    {
        return self::esNumerico($numero) && $numero > 0;
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
    public static function formatearNumero(float $numero, int $decimales = 2): string
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
}

/**
 * Clase para calcular estadísticos básicos
 */
class EstadisticosBasicos
{
    public static function calcularMedia(array $numeros): float
    {
        $suma = 0;
        $cantidad = count($numeros);
        
        foreach ($numeros as $numero) {
            $suma += $numero;
        }
        
        return $cantidad > 0 ? $suma / $cantidad : 0;
    }
    
    public static function calcularDesviacionEstandar(array $numeros): float
    {
        $media = self::calcularMedia($numeros);
        $sumaCuadrados = 0;
        $cantidad = count($numeros);
        
        foreach ($numeros as $numero) {
            $sumaCuadrados += pow($numero - $media, 2);
        }
        
        return $cantidad > 0 ? sqrt($sumaCuadrados / $cantidad) : 0;
    }
    
    public static function encontrarMinimo(array $numeros): ?float
    {
        if (empty($numeros)) {
            return null;
        }
        
        $minimo = $numeros[0];
        
        for ($i = 1; $i < count($numeros); $i++) {
            $minimo = $numeros[$i] < $minimo ? $numeros[$i] : $minimo;
        }
        
        return $minimo;
    }
    
    public static function encontrarMaximo(array $numeros): ?float
    {
        if (empty($numeros)) {
            return null;
        }
        
        $maximo = $numeros[0];
        
        for ($i = 1; $i < count($numeros); $i++) {
            $maximo = $numeros[$i] > $maximo ? $numeros[$i] : $maximo;
        }
        
        return $maximo;
    }
}

// ============================================
// Procesamiento del formulario
// ============================================

$errores = [];
$resultados = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $numeros = [];
    
    // Recopilar y validar los 5 números
    for ($i = 1; $i <= 5; $i++) {
        $numero = $_POST["numero{$i}"] ?? '';
        $numero = Validador::limpiarEntrada($numero);
        
        if (empty($numero)) {
            $errores[] = "El número {$i} es requerido.";
        } elseif (!Validador::esNumerico($numero)) {
            $errores[] = "El número {$i} debe ser numérico.";
        } elseif (!Validador::esPositivo($numero)) {
            $errores[] = "El número {$i} debe ser positivo (mayor que 0).";
        } else {
            $numeros[] = floatval($numero);
        }
    }
    
    // Si no hay errores, calcular estadísticos
    if (empty($errores) && count($numeros) === 5) {
        $resultados = [
            'numeros' => $numeros,
            'media' => EstadisticosBasicos::calcularMedia($numeros),
            'desviacionEstandar' => EstadisticosBasicos::calcularDesviacionEstandar($numeros),
            'minimo' => EstadisticosBasicos::encontrarMinimo($numeros),
            'maximo' => EstadisticosBasicos::encontrarMaximo($numeros)
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 1 - Estadísticos Básicos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p1-encabezado">
                <h1>Problema 1: Estadísticos Básicos</h1>
                <p class="p1-descripcion">
                    Ingresa 5 números positivos para calcular su media aritmética, 
                    desviación estándar, valor mínimo y valor máximo.
                </p>
            </div>
            
            <div class="p1-contenido">
                <?php include 'nav-problemas.php'; ?>
                <?php
                // Mostrar errores si existen
                if (!empty($errores)) {
                    foreach ($errores as $error) {
                        echo Utilidades::generarMensajeError($error);
                    }
                }
                ?>
                
                <div class="p1-seccion-formulario">
                    <h2>Ingresa los Números</h2>
                    <form method="POST" action="">
                        <div class="form-grid">
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <div class="form-group">
                                    <label for="numero<?php echo $i; ?>">
                                        Número <?php echo $i; ?>
                                    </label>
                                    <div class="p1-input-contenedor">
                                        <input 
                                            type="number" 
                                            id="numero<?php echo $i; ?>" 
                                            name="numero<?php echo $i; ?>" 
                                            placeholder="Ejemplo: <?php echo rand(10, 100); ?>"
                                            value="<?php echo isset($_POST["numero{$i}"]) ? htmlspecialchars($_POST["numero{$i}"]) : ''; ?>"
                                            step="0.01"
                                            required
                                        >
                                    </div>
                                </div>
                            <?php endfor; ?>
                        </div>
                        
                        <button type="submit" class="p1-boton-enviar">Calcular Estadísticos</button>
                    </form>
                </div>
                
                <?php if ($resultados !== null): ?>
                    <div class="p1-caja-resultados">
                        <div class="p1-encabezado-resultados">
                            <h2>Resultados Calculados</h2>
                            <div class="p1-lista-numeros">
                                <?php foreach ($resultados['numeros'] as $num): ?>
                                    <span class="p1-etiqueta-numero"><?php echo $num; ?></span>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        
                        <div class="p1-grid-estadisticas">
                            <div class="p1-tarjeta-estadistica">
                                <div class="p1-etiqueta-estadistica">Media Aritmética</div>
                                <div class="p1-valor-estadistica">
                                    <?php echo Utilidades::formatearNumero($resultados['media']); ?>
                                </div>
                            </div>
                            
                            <div class="p1-tarjeta-estadistica">
                                <div class="p1-etiqueta-estadistica">Desviación Estándar</div>
                                <div class="p1-valor-estadistica">
                                    <?php echo Utilidades::formatearNumero($resultados['desviacionEstandar']); ?>
                                </div>
                            </div>
                            
                            <div class="p1-tarjeta-estadistica p1-tarjeta-minimo">
                                <div class="p1-etiqueta-estadistica">Valor Mínimo</div>
                                <div class="p1-valor-estadistica">
                                    <?php echo Utilidades::formatearNumero($resultados['minimo']); ?>
                                </div>
                            </div>
                            
                            <div class="p1-tarjeta-estadistica p1-tarjeta-maximo">
                                <div class="p1-etiqueta-estadistica">Valor Máximo</div>
                                <div class="p1-valor-estadistica">
                                    <?php echo Utilidades::formatearNumero($resultados['maximo']); ?>
                                </div>
                            </div>
                        </div>
                        
                        <?php echo Utilidades::generarMensajeExito('Cálculos realizados correctamente'); ?>
                    </div>
                <?php endif; ?>
                
                <div style="text-align: center;">
                    <a href="index.php" class="p1-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once 'footer.php'; ?>
</body>
</html>