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
     * Valida que un número sea positivo
     *
     * @param float $numero
     * @return bool
     */
    public static function esPositivo($numero): bool
    {
        return self::esNumerico($numero) && $numero > 0;
    }
    
    /**
     * Valida que un arreglo tenga una cantidad específica de elementos
     *
     * @param array $arreglo
     * @param int $cantidad
     * @return bool
     */
    public static function validarCantidadElementos(array $arreglo, int $cantidad): bool
    {
        return count($arreglo) === $cantidad;
    }
    
    /**
     * Valida que todos los elementos de un arreglo sean numéricos
     *
     * @param array $arreglo
     * @return bool
     */
    public static function validarArregloNumerico(array $arreglo): bool
    {
        foreach ($arreglo as $elemento) {
            if (!self::esNumerico($elemento)) {
                return false;
            }
        }
        return true;
    }
    
    /**
     * Valida que todos los números sean positivos
     *
     * @param array $numeros
     * @return bool
     */
    public static function validarNumerosPositivos(array $numeros): bool
    {
        foreach ($numeros as $numero) {
            if (!self::esPositivo($numero)) {
                return false;
            }
        }
        return true;
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
     * Formatea un número con decimales
     *
     * @param float $numero
     * @param int $decimales
     * @return string
     */
    public static function formatearNumero(float $numero, int $decimales = 2): string
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
}

/**
 * Clase para calcular estadísticos básicos
 */
class EstadisticosBasicos
{
    /**
     * Calcula la media aritmética
     *
     * @param array $numeros
     * @return float
     */
    public static function calcularMedia(array $numeros): float
    {
        $suma = 0;
        $cantidad = count($numeros);
        
        foreach ($numeros as $numero) {
            $suma += $numero;
        }
        
        return $cantidad > 0 ? $suma / $cantidad : 0;
    }
    
    /**
     * Calcula la desviación estándar
     *
     * @param array $numeros
     * @return float
     */
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
    
    /**
     * Encuentra el valor mínimo
     *
     * @param array $numeros
     * @return float|null
     */
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
    
    /**
     * Encuentra el valor máximo
     *
     * @param array $numeros
     * @return float|null
     */
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
// Función para generar footer
// ============================================
function generarFooter() {
    $fechaActual = date('d/m/Y H:i:s');
    $anio = date('Y');
    
    return "
    <footer style='background: #2d3748; color: white; text-align: center; 
                   padding: 20px; margin-top: 40px;'>
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
            max-width: 800px;
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
        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-bottom: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #333;
            font-weight: 600;
        }
        input[type="number"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 8px;
            font-size: 16px;
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
            margin-top: 10px;
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
        .resultado-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 20px;
            margin: 10px 0;
            background: white;
            border-radius: 8px;
            border-left: 5px solid #667eea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
            transition: transform 0.2s;
        }
        .resultado-item:hover {
            transform: translateX(5px);
        }
        .resultado-label {
            font-weight: 600;
            color: #333;
            font-size: 1.05em;
        }
        .resultado-valor {
            color: #667eea;
            font-weight: 700;
            font-size: 1.2em;
        }
        .numeros-badge {
            display: inline-block;
            padding: 8px 15px;
            background: #667eea;
            color: white;
            border-radius: 20px;
            margin: 0 5px;
            font-weight: 600;
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
        <h1>📊 Problema 1: Estadísticos Básicos</h1>
        <p class="descripcion">
            Ingresa 5 números positivos para calcular su <strong>media aritmética</strong>, 
            <strong>desviación estándar</strong>, <strong>valor mínimo</strong> y <strong>valor máximo</strong>.
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
            <div class="form-grid">
                <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="form-group">
                        <label for="numero<?php echo $i; ?>">
                            Número <?php echo $i; ?>:
                        </label>
                        <input 
                            type="number" 
                            id="numero<?php echo $i; ?>" 
                            name="numero<?php echo $i; ?>" 
                            placeholder="Ej: <?php echo rand(10, 100); ?>"
                            value="<?php echo isset($_POST["numero{$i}"]) ? htmlspecialchars($_POST["numero{$i}"]) : ''; ?>"
                            required
                        >
                    </div>
                <?php endfor; ?>
            </div>
            
            <button type="submit">🔍 Calcular Estadísticos</button>
        </form>
        
        <?php if ($resultados !== null): ?>
            <div class="resultados">
                <h2>✨ Resultados Calculados</h2>
                
                <div class="resultado-item">
                    <span class="resultado-label">📝 Números ingresados:</span>
                    <div>
                        <?php foreach ($resultados['numeros'] as $num): ?>
                            <span class="numeros-badge"><?php echo $num; ?></span>
                        <?php endforeach; ?>
                    </div>
                </div>
                
                <div class="resultado-item">
                    <span class="resultado-label">📊 Media Aritmética:</span>
                    <span class="resultado-valor"><?php echo Utilidades::formatearNumero($resultados['media']); ?></span>
                </div>
                
                <div class="resultado-item">
                    <span class="resultado-label">📈 Desviación Estándar:</span>
                    <span class="resultado-valor"><?php echo Utilidades::formatearNumero($resultados['desviacionEstandar']); ?></span>
                </div>
                
                <div class="resultado-item">
                    <span class="resultado-label">⬇️ Valor Mínimo:</span>
                    <span class="resultado-valor"><?php echo Utilidades::formatearNumero($resultados['minimo']); ?></span>
                </div>
                
                <div class="resultado-item">
                    <span class="resultado-label">⬆️ Valor Máximo:</span>
                    <span class="resultado-valor"><?php echo Utilidades::formatearNumero($resultados['maximo']); ?></span>
                </div>
                
                <?php echo Utilidades::generarMensajeExito('Cálculos realizados correctamente'); ?>
            </div>
        <?php endif; ?>
    </div>
    
    <?php echo generarFooter(); ?>
</body>
</html>