<?php
// ============================================
// utilidades.php - Clases de utilidades
// ============================================

/**
 * Clase para validación de datos
 */
class Validador
{
    /**
     * Valida que un valor sea numérico
     *
     * @param mixed $valor
     * @return bool
     */
    public static function esNumerico($valor): bool
    {
        return is_numeric($valor);
    }
    
    /**
     * Valida que un número sea entero positivo
     *
     * @param mixed $numero
     * @return bool
     */
    public static function esEnteroPositivo($numero): bool
    {
        return self::esNumerico($numero) && $numero > 0 && floor($numero) == $numero;
    }
    
    /**
     * Valida que un número esté en un rango específico
     *
     * @param float $numero
     * @param float $min
     * @param float $max
     * @return bool
     */
    public static function validarRango($numero, $min, $max): bool
    {
        return $numero >= $min && $numero <= $max;
    }
    
    /**
     * Limpia y valida entrada de formulario
     *
     * @param string $dato
     * @return string
     */
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
    /**
     * Formatea un número con separadores de miles
     *
     * @param float $numero
     * @param int $decimales
     * @return string
     */
    public static function formatearNumero(float $numero, int $decimales = 0): string
    {
        return number_format($numero, $decimales, '.', ',');
    }
    
    /**
     * Genera un mensaje de error estilizado
     *
     * @param string $mensaje
     * @return string
     */
    public static function generarMensajeError(string $mensaje): string
    {
        return '<div style="background: #fee; border-left: 4px solid #c33; 
                padding: 15px; margin: 20px 0; border-radius: 5px; color: #c33;">
                    <strong>⚠️ Error:</strong> ' . $mensaje . '
                </div>';
    }
    
    /**
     * Genera un mensaje de éxito estilizado
     *
     * @param string $mensaje
     * @return string
     */
    public static function generarMensajeExito(string $mensaje): string
    {
        return '<div style="background: #efe; border-left: 4px solid #3c3; 
                padding: 15px; margin: 20px 0; border-radius: 5px; color: #3c3;">
                    <strong>✅ Éxito:</strong> ' . $mensaje . '
                </div>';
    }
    
    /**
     * Genera un mensaje de información estilizado
     *
     * @param string $mensaje
     * @return string
     */
    public static function generarMensajeInfo(string $mensaje): string
    {
        return '<div style="background: #e3f2fd; border-left: 4px solid #2196f3; 
                padding: 15px; margin: 20px 0; border-radius: 5px; color: #1976d2;">
                    <strong>ℹ️ Información:</strong> ' . $mensaje . '
                </div>';
    }
    
    /**
     * Calcula el tiempo de ejecución en milisegundos
     *
     * @param float $inicio
     * @param float $fin
     * @return string
     */
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
    /**
     * Calcula la suma de números del 1 al N usando ciclo for
     *
     * @param int $limite
     * @return array
     */
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
    
    /**
     * Calcula la suma de números del 1 al N usando ciclo while
     *
     * @param int $limite
     * @return array
     */
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
    
    /**
     * Calcula la suma usando la fórmula de Gauss: n(n+1)/2
     *
     * @param int $limite
     * @return array
     */
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
    
    /**
     * Calcula la suma usando range y array_sum
     *
     * @param int $limite
     * @return array
     */
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
    
    /**
     * Calcula todos los métodos y los compara
     *
     * @param int $limite
     * @return array
     */
    public static function calcularTodosLosMetodos(int $limite): array
    {
        $resultados = [
            self::sumaConFor($limite),
            self::sumaConWhile($limite),
            self::sumaConFormula($limite),
            self::sumaConArray($limite)
        ];
        
        // Encontrar el método más rápido usando operador ternario
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
// Función para generar footer
// ============================================
function generarFooter() {
    $fechaActual = date('d/m/Y H:i:s');
    $anio = date('Y');
    
    return "
    <footer style='background: #2d3748; color: white; text-align: center; 
                   padding: 20px; margin-top: 40px; border-radius: 10px;'>
        <p><strong>Sistema de Problemas PHP</strong></p>
        <p>Fecha actual: {$fechaActual}</p>
        <p>&copy; {$anio} - Todos los derechos reservados</p>
    </footer>";
}

// ============================================
// Procesamiento del formulario
// ============================================

$errores = [];
$resultados = null;
$limite = 1000; // Valor por defecto

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $limiteInput = $_POST['limite'] ?? '';
    $limiteInput = Validador::limpiarEntrada($limiteInput);
    
    // Validaciones
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
            max-width: 900px;
            margin: 0 auto;
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.3);
            padding: 40px;
        }
        h1 {
            color: #667eea;
            text-align: center;
            margin-bottom: 15px;
            font-size: 2.2em;
        }
        .descripcion {
            text-align: center;
            color: #666;
            margin-bottom: 30px;
            line-height: 1.6;
            font-size: 1.05em;
        }
        .formula-box {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
            margin-bottom: 30px;
        }
        .formula-box h3 {
            margin-bottom: 10px;
        }
        .formula {
            font-size: 1.5em;
            font-weight: bold;
            font-family: 'Courier New', monospace;
        }
        .form-group {
            margin-bottom: 25px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
            font-size: 1.1em;
        }
        input[type="number"] {
            width: 100%;
            padding: 15px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 18px;
            transition: border-color 0.3s;
        }
        input[type="number"]:focus {
            outline: none;
            border-color: #667eea;
        }
        button {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }
        button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(102, 126, 234, 0.4);
        }
        .resultados {
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            padding: 30px;
            border-radius: 12px;
            margin-top: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        .resultados h2 {
            color: #667eea;
            margin-bottom: 25px;
            text-align: center;
            font-size: 1.8em;
        }
        .metodo-card {
            background: white;
            padding: 20px;
            margin: 15px 0;
            border-radius: 10px;
            border-left: 5px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .metodo-card:hover {
            transform: translateX(5px);
        }
        .metodo-titulo {
            font-weight: 700;
            color: #667eea;
            font-size: 1.2em;
            margin-bottom: 10px;
        }
        .metodo-resultado {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 8px 0;
        }
        .metodo-label {
            color: #666;
            font-weight: 600;
        }
        .metodo-valor {
            color: #333;
            font-weight: 700;
            font-size: 1.1em;
        }
        .badge-rapido {
            display: inline-block;
            background: #4caf50;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-left: 10px;
        }
        .resultado-final {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 25px;
            border-radius: 10px;
            text-align: center;
            margin-top: 20px;
            font-size: 1.3em;
        }
        .resultado-final .numero {
            font-size: 2em;
            font-weight: 900;
            margin: 10px 0;
        }
        footer {
            background: #2d3748;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
            border-radius: 10px;
        }
        footer p {
            margin: 5px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔢 Problema 2: Suma del 1 al 1000</h1>
        <p class="descripcion">
            Calcula la suma de todos los números del 1 al 1000. 
            Compara diferentes métodos de cálculo y sus tiempos de ejecución.
        </p>
        
       
        
        <?php
        // Mostrar errores si existen
        if (!empty($errores)) {
            foreach ($errores as $error) {
                echo Utilidades::generarMensajeError($error);
            }
        }
        ?>
        
        <form method="POST" action="">
            <div class="form-group">
                <label for="limite">
                    Límite Superior (1 - 1,000,000):
                </label>
                <input 
                    type="number" 
                    id="limite" 
                    name="limite" 
                    min="1"
                    max="1000"
                    value="<?php echo isset($_POST['limite']) ? htmlspecialchars($_POST['limite']) : '1000'; ?>"
                    placeholder="ej: 1000"
                    required
                >
            </div>
            
            <button type="submit">⚡ Calcular Suma con Todos los Métodos</button>
        </form>
        
        <?php if ($resultados !== null): ?>
            <div class="resultados">
                <h2>✨ Resultados de Cálculo</h2>
                
                <?php echo Utilidades::generarMensajeInfo("Calculando suma de 1 hasta {$limite}"); ?>
                
                <?php foreach ($resultados['resultados'] as $resultado): ?>
                    <div class="metodo-card">
                        <div class="metodo-titulo">
                            🔧 <?php echo $resultado['metodo']; ?>
                            <?php if ($resultado['metodo'] === $resultados['metodoMasRapido']): ?>
                                <span class="badge-rapido">⚡ MÁS RÁPIDO</span>
                            <?php endif; ?>
                        </div>
                        <div class="metodo-resultado">
                            <span class="metodo-label">Resultado:</span>
                            <span class="metodo-valor"><?php echo Utilidades::formatearNumero($resultado['resultado']); ?></span>
                        </div>
                        <div class="metodo-resultado">
                            <span class="metodo-label">Tiempo de ejecución:</span>
                            <span class="metodo-valor"><?php echo $resultado['tiempo']; ?> ms</span>
                        </div>
                    </div>
                <?php endforeach; ?>
                
                <div class="resultado-final">
                    <div>✅ Resultado Final</div>
                    <div class="numero"><?php echo Utilidades::formatearNumero($resultados['resultados'][0]['resultado']); ?></div>
                    <div style="font-size: 0.8em; margin-top: 10px;">
                        Método más eficiente: <strong><?php echo $resultados['metodoMasRapido']; ?></strong>
                        (<?php echo $resultados['tiempoMinimo']; ?> ms)
                    </div>
                </div>
                
                <?php 
                $esperado = 500500;
                $calculado = $resultados['resultados'][0]['resultado'];
                $esCorrecto = ($limite === 1000 && $calculado === $esperado);
                
                if ($esCorrecto):
                    echo Utilidades::generarMensajeExito('¡Verificación exitosa! El resultado para 1-1000 es correcto: 500,500');
                endif;
                ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php echo generarFooter(); ?>
</body>
</html>