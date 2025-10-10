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
    
    public static function calcularTiempoEjecucion(float $inicio, float $fin): string
    {
        $tiempo = ($fin - $inicio) * 1000;
        return number_format($tiempo, 4);
    }
}

/**
 * Clase para operaciones de suma
 */
class CalculadoraSuma
{
    public static function sumaConFor(int $limite): array
    {
        $inicio = microtime(true);
        $suma = 0;
        
        for ($i = 1; $i <= $limite; $i++) {
            $suma += $i;
        }
        
        $fin = microtime(true);
        
        return [
            'metodo' => 'Ciclo FOR',
            'resultado' => $suma,
            'tiempo' => Utilidades::calcularTiempoEjecucion($inicio, $fin)
        ];
    }
    
    public static function sumaConWhile(int $limite): array
    {
        $inicio = microtime(true);
        $suma = 0;
        $i = 1;
        
        while ($i <= $limite) {
            $suma += $i;
            $i++;
        }
        
        $fin = microtime(true);
        
        return [
            'metodo' => 'Ciclo WHILE',
            'resultado' => $suma,
            'tiempo' => Utilidades::calcularTiempoEjecucion($inicio, $fin)
        ];
    }
    
    public static function sumaConFormula(int $limite): array
    {
        $inicio = microtime(true);
        
        $suma = ($limite * ($limite + 1)) / 2;
        
        $fin = microtime(true);
        
        return [
            'metodo' => 'Fórmula de Gauss',
            'resultado' => $suma,
            'tiempo' => Utilidades::calcularTiempoEjecucion($inicio, $fin)
        ];
    }
    
    public static function sumaConArray(int $limite): array
    {
        $inicio = microtime(true);
        
        $numeros = range(1, $limite);
        $suma = array_sum($numeros);
        
        $fin = microtime(true);
        
        return [
            'metodo' => 'Array Functions',
            'resultado' => $suma,
            'tiempo' => Utilidades::calcularTiempoEjecucion($inicio, $fin)
        ];
    }
    
    public static function calcularTodosLosMetodos(int $limite): array
    {
        $resultados = [
            self::sumaConFor($limite),
            self::sumaConWhile($limite),
            self::sumaConFormula($limite),
            self::sumaConArray($limite)
        ];
        
        // Encontrar el método más rápido
        $tiempoMinimo = $resultados[0]['tiempo'];
        $metodoMasRapido = $resultados[0]['metodo'];
        
        foreach ($resultados as $resultado) {
            $tiempoMinimo = $resultado['tiempo'] < $tiempoMinimo ? $resultado['tiempo'] : $tiempoMinimo;
            $metodoMasRapido = $resultado['tiempo'] == $tiempoMinimo ? $resultado['metodo'] : $metodoMasRapido;
        }
        
        return [
            'resultados' => $resultados,
            'metodoMasRapido' => $metodoMasRapido,
            'tiempoMinimo' => $tiempoMinimo
        ];
    }
}

// ============================================
// Procesamiento del formulario
// ============================================

$errores = [];
$resultados = null;
$limite = 1000;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $limiteInput = $_POST['limite'] ?? '';
    $limiteInput = Validador::limpiarEntrada($limiteInput);
    
    if (empty($limiteInput)) {
        $errores[] = "El límite es requerido.";
    } elseif (!Validador::esNumerico($limiteInput)) {
        $errores[] = "El límite debe ser un número válido.";
    } elseif (!Validador::esEnteroPositivo($limiteInput)) {
        $errores[] = "El límite debe ser un número entero positivo.";
    } elseif (!Validador::validarRango($limiteInput, 1, 1000000)) {
        $errores[] = "El límite debe estar entre 1 y 1,000,000.";
    } else {
        $limite = intval($limiteInput);
        $resultados = CalculadoraSuma::calcularTodosLosMetodos($limite);
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Problema 2 - Suma del 1 al 1000</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="problem-container">
            <div class="p2-encabezado">
                <h1>Problema 2: Suma del 1 al 1000</h1>
                <p class="p2-descripcion">
                    Calcula la suma de todos los números del 1 al límite especificado. 
                    Compara diferentes métodos de cálculo y sus tiempos de ejecución.
                </p>
            </div>
            
            <div class="p2-contenido">
                <?php include 'nav-problemas.php'; ?>
                <?php
                if (!empty($errores)) {
                    foreach ($errores as $error) {
                        echo Utilidades::generarMensajeError($error);
                    }
                }
                ?>
                
                <div class="p2-seccion-formulario">
                    <h2>Configurar Cálculo</h2>
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="limite">
                                Límite Superior (1 - 1,000,000)
                            </label>
                            <div class="p2-input-contenedor">
                                <input 
                                    type="number" 
                                    id="limite" 
                                    name="limite" 
                                    min="1"
                                    max="1000000"
                                    value="<?php echo isset($_POST['limite']) ? htmlspecialchars($_POST['limite']) : '1000'; ?>"
                                    placeholder="Ejemplo: 1000"
                                    required
                                >
                            </div>
                        </div>
                        
                        <button type="submit" class="p2-boton-calcular">Calcular con Todos los Métodos</button>
                    </form>
                </div>
                
                <?php if ($resultados !== null): ?>
                    <div class="p2-caja-resultados">
                        <h2 class="p2-titulo-resultados">Resultados de Cálculo</h2>
                        
                        <?php echo Utilidades::generarMensajeInfo("Calculando suma de 1 hasta " . Utilidades::formatearNumero($limite)); ?>
                        
                        <div class="p2-grid-metodos">
                            <?php foreach ($resultados['resultados'] as $resultado): ?>
                                <div class="p2-tarjeta-metodo <?php echo ($resultado['metodo'] === $resultados['metodoMasRapido']) ? 'p2-mas-rapido' : ''; ?>">
                                    <div class="p2-titulo-metodo">
                                        <span><?php echo $resultado['metodo']; ?></span>
                                        <?php if ($resultado['metodo'] === $resultados['metodoMasRapido']): ?>
                                            <span class="p2-badge-rapido">Más Rápido</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="p2-info-metodo">
                                        <span class="p2-label-info">Resultado:</span>
                                        <span class="p2-valor-info"><?php echo Utilidades::formatearNumero($resultado['resultado']); ?></span>
                                    </div>
                                    <div class="p2-info-metodo">
                                        <span class="p2-label-info">Tiempo:</span>
                                        <span class="p2-valor-info"><?php echo $resultado['tiempo']; ?> ms</span>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        
                        <div class="p2-resultado-final">
                            <div class="p2-titulo-final">Resultado Final</div>
                            <div class="p2-numero-final"><?php echo Utilidades::formatearNumero($resultados['resultados'][0]['resultado']); ?></div>
                            <div class="p2-info-metodo-rapido">
                                Método más eficiente: <strong><?php echo $resultados['metodoMasRapido']; ?></strong>
                                (<?php echo $resultados['tiempoMinimo']; ?> ms)
                            </div>
                        </div>
                        
                        <?php 
                        $esperado = 500500;
                        $calculado = $resultados['resultados'][0]['resultado'];
                        $esCorrecto = ($limite === 1000 && $calculado === $esperado);
                        
                        if ($esCorrecto):
                            echo Utilidades::generarMensajeExito('Verificación exitosa - El resultado para 1-1000 es correcto: 500,500');
                        endif;
                        ?>
                    </div>
                <?php endif; ?>
                
                <div style="text-align: center;">
                    <a href="index.php" class="p2-enlace-volver">Volver al Menú Principal</a>
                </div>
            </div>
        </div>
    </div>
    
    <?php require_once 'footer.php'; ?>
</body>
</html>