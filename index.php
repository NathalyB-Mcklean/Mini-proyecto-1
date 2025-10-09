<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Proyecto #2 - Menú Principal</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #0f2027 0%, #203a43 50%, #2c5364 100%);
            min-height: 100vh;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }

        /* Efecto de partículas de fondo */
        body::before {
            content: '';
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                radial-gradient(circle at 20% 50%, rgba(16, 185, 129, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(5, 150, 105, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 20%, rgba(34, 197, 94, 0.08) 0%, transparent 50%);
            pointer-events: none;
            z-index: 0;
        }

        .container {
            max-width: 1400px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        /* Header mejorado */
        header {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.95) 0%, rgba(5, 150, 105, 0.95) 100%);
            padding: 50px 40px;
            border-radius: 25px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4), 0 0 0 1px rgba(255, 255, 255, 0.1);
            margin-bottom: 50px;
            text-align: center;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: rotate(45deg);
            animation: shine 3s infinite;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }

        header h1 {
            color: white;
            font-size: 3.2em;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
            font-weight: 700;
            position: relative;
            z-index: 1;
        }

        header p {
            color: rgba(255, 255, 255, 0.95);
            font-size: 1.3em;
            position: relative;
            z-index: 1;
            font-weight: 500;
        }

        /* Grid de problemas */
        .problems-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
            margin-bottom: 50px;
        }

        /* Tarjetas de problemas rediseñadas */
        .problem-box {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 253, 244, 0.95) 100%);
            border-radius: 20px;
            padding: 35px 25px;
            text-align: center;
            text-decoration: none;
            color: #1f2937;
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 200px;
            position: relative;
            overflow: hidden;
            border: 2px solid rgba(16, 185, 129, 0.2);
        }

        .problem-box::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transform: translateY(100%);
            transition: transform 0.4s ease;
            z-index: 0;
        }

        .problem-box:hover::before {
            transform: translateY(0);
        }

        .problem-box:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(16, 185, 129, 0.4), 0 0 0 3px rgba(16, 185, 129, 0.3);
            border-color: transparent;
        }

        .problem-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 5px 15px rgba(16, 185, 129, 0.3);
            transition: all 0.4s ease;
            position: relative;
            z-index: 1;
        }

        .problem-box:hover .problem-icon {
            background: white;
            transform: rotate(360deg) scale(1.1);
            box-shadow: 0 8px 25px rgba(255, 255, 255, 0.3);
        }

        .problem-number {
            font-size: 2em;
            font-weight: bold;
            color: white;
            transition: all 0.4s ease;
        }

        .problem-box:hover .problem-number {
            color: #10b981;
        }

        .problem-title {
            font-size: 1.15em;
            font-weight: 700;
            line-height: 1.4;
            margin-bottom: 10px;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .problem-box:hover .problem-title {
            color: white;
        }

        .problem-description {
            font-size: 0.85em;
            color: #6b7280;
            position: relative;
            z-index: 1;
            transition: all 0.4s ease;
            opacity: 0.8;
        }

        .problem-box:hover .problem-description {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Badge de estado */
        .problem-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: white;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 0.7em;
            font-weight: 600;
            z-index: 1;
            transition: all 0.4s ease;
        }

        .problem-box:hover .problem-badge {
            background: white;
            color: #10b981;
        }

        /* Footer mejorado */
        footer {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.95) 0%, rgba(240, 253, 244, 0.95) 100%);
            padding: 35px;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            text-align: center;
            border: 1px solid rgba(16, 185, 129, 0.2);
        }

        footer p {
            color: #4b5563;
            margin: 8px 0;
            font-size: 1em;
        }

        footer .university {
            font-weight: bold;
            color: #10b981;
            font-size: 1.2em;
            margin-bottom: 12px;
        }

        footer .students {
            color: #059669;
            font-weight: 600;
            margin-top: 18px;
            font-size: 1.05em;
        }

        /* Responsive */
        @media (max-width: 768px) {
            header h1 {
                font-size: 2.2em;
            }
            
            header p {
                font-size: 1.1em;
            }

            .problems-container {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .problem-box {
                min-height: 180px;
            }
        }

        @media (max-width: 480px) {
            header {
                padding: 35px 25px;
            }
            
            header h1 {
                font-size: 1.9em;
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
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">1</div>
                </div>
                <div class="problem-title">Datos Estadísticos</div>
                <div class="problem-description">Análisis de datos</div>
            </a>

            <a href="problema2.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">2</div>
                </div>
                <div class="problem-title">Suma 1 al 1000</div>
                <div class="problem-description">Operaciones numéricas</div>
            </a>

            <a href="problema3.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">3</div>
                </div>
                <div class="problem-title">Múltiplos de 4</div>
                <div class="problem-description">Condicionales</div>
            </a>

            <a href="problema4.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">4</div>
                </div>
                <div class="problem-title">Pares e Impares</div>
                <div class="problem-description">Clasificación numérica</div>
            </a>

            <a href="problema5.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">5</div>
                </div>
                <div class="problem-title">Clasificación por Edad</div>
                <div class="problem-description">Categorización</div>
            </a>

            <a href="problema6.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">6</div>
                </div>
                <div class="problem-title">Presupuesto Hospital</div>
                <div class="problem-description">Cálculos financieros</div>
            </a>

            <a href="problema7.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">7</div>
                </div>
                <div class="problem-title">Calculadora Notas</div>
                <div class="problem-description">Sistema de calificaciones</div>
            </a>

            <a href="problema8.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">8</div>
                </div>
                <div class="problem-title">Estación del Año</div>
                <div class="problem-description">Condicionales avanzados</div>
            </a>

            <a href="problema9.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">9</div>
                </div>
                <div class="problem-title">Potencias</div>
                <div class="problem-description">Cálculos matemáticos</div>
            </a>

            <a href="problema10.php" class="problem-box">
                <span class="problem-badge">PHP</span>
                <div class="problem-icon">
                    <div class="problem-number">10</div>
                </div>
                <div class="problem-title">Sistema de Ventas</div>
                <div class="problem-description">POO y clases</div>
            </a>
        </div>

        <footer>
            <p class="university">Universidad Tecnológica de Panamá</p>
            <p>Desarrollo de Software VII</p>
            <p>Mini Proyecto #2 - 2025</p>
            <p class="students">Grupo de Estudiantes</p>
        </footer>
    </div>
</body>
</html>