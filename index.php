<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto #2 - Menú Principal</title>
    <style>
        /* ========================================
           Mini Proyecto #2 - Estilos Generales
           ======================================== */

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
            max-width: 1400px;
            margin: 0 auto;
        }

        /* ========================================
           Header
           ======================================== */

        header {
            background: white;
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            margin-bottom: 40px;
            text-align: center;
        }

        header h1 {
            color: #667eea;
            font-size: 2.8em;
            margin-bottom: 10px;
        }

        header p {
            color: #666;
            font-size: 1.2em;
        }

        /* ========================================
           Contenedor de Problemas
           ======================================== */

        .problems-container {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 20px;
            margin-bottom: 40px;
        }

        /* ========================================
           Boxes de Problemas
           ======================================== */

        .problem-box {
            background: white;
            border-radius: 12px;
            padding: 30px 20px;
            text-align: center;
            text-decoration: none;
            color: #333;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 180px;
        }

        .problem-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.3);
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .problem-number {
            font-size: 3em;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .problem-box:hover .problem-number {
            -webkit-text-fill-color: white;
            background: none;
        }

        .problem-title {
            font-size: 1em;
            font-weight: 600;
            line-height: 1.4;
        }

        /* ========================================
           Footer
           ======================================== */

        footer {
            background: white;
            padding: 25px;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        footer p {
            color: #666;
            margin: 5px 0;
        }

        footer .university {
            font-weight: bold;
            color: #667eea;
            font-size: 1.1em;
            margin-bottom: 10px;
        }

        footer .students {
            color: #764ba2;
            font-weight: 600;
            margin-top: 15px;
        }

        /* ========================================
           Responsive Design
           ======================================== */

        @media (max-width: 1200px) {
            .problems-container {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            header h1 {
                font-size: 2em;
            }
            
            .problems-container {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 480px) {
            .problems-container {
                grid-template-columns: 1fr;
            }
            
            header {
                padding: 25px;
            }
            
            header h1 {
                font-size: 1.8em;
            }
            
            header p {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <h1>🎯 Mini Proyecto #2</h1>
            <p>Sentencias de Control y Clases en PHP</p>
        </header>

        <div class="problems-container">
            <a href="problema1.php" class="problem-box">
                <div class="problem-number">1</div>
                <div class="problem-title">Datos Estadísticos</div>
            </a>

            <a href="problema2.php" class="problem-box">
                <div class="problem-number">2</div>
                <div class="problem-title">Suma 1 al 1000</div>
            </a>

            <a href="problema3.php" class="problem-box">
                <div class="problem-number">3</div>
                <div class="problem-title">Múltiplos de 4</div>
            </a>

            <a href="problema4.php" class="problem-box">
                <div class="problem-number">4</div>
                <div class="problem-title">Pares e Impares</div>
            </a>

            <a href="problema5.php" class="problem-box">
                <div class="problem-number">5</div>
                <div class="problem-title">Clasificación por Edad</div>
            </a>

            <a href="problema6.php" class="problem-box">
                <div class="problem-number">6</div>
                <div class="problem-title">Presupuesto Hospital</div>
            </a>

            <a href="problema7.php" class="problem-box">
                <div class="problem-number">7</div>
                <div class="problem-title">Calculadora Notas</div>
            </a>

            <a href="problema8.php" class="problem-box">
                <div class="problem-number">8</div>
                <div class="problem-title">Estación del Año</div>
            </a>

            <a href="problema9.php" class="problem-box">
                <div class="problem-number">9</div>
                <div class="problem-title">Potencias</div>
            </a>

            <a href="problema10.php" class="problem-box">
                <div class="problem-number">10</div>
                <div class="problem-title">Sistema de Ventas</div>
            </a>
        </div>

        <?php include 'footer.php'; ?>
    </div>
</body>
</html>