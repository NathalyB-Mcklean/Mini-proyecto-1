<style>
    /* Estilos para el navegador de problemas */
    .p-nav {
        background: linear-gradient(135deg, #059669 0%, #047857 100%);
        padding: 12px 20px;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 4px 15px rgba(5, 150, 105, 0.3);
    }


    .p-nav-grid {
        display: grid;
        grid-template-columns: repeat(10, 1fr);
        gap: 8px;
        max-width: 900px;
        margin: 0 auto;
    }

    .p-nav-link {
        background: rgba(255, 255, 255, 0.15);
        color: white;
        text-decoration: none;
        padding: 10px 12px;
        border-radius: 8px;
        text-align: center;
        font-weight: 600;
        font-size: 0.95em;
        transition: all 0.3s ease;
        border: 2px solid transparent;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .p-nav-link:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .p-nav-link.active {
        background: white;
        color: #059669;
        border-color: white;
        font-weight: 700;
    }

    .p-nav-link.active:hover {
        background: #f0fdf4;
        color: #047857;
    }

    @media (max-width: 968px) {
        .p-nav-grid {
            grid-template-columns: repeat(10, 1fr);
            gap: 6px;
        }

        .p-nav-link {
            padding: 8px 6px;
            font-size: 0.85em;
        }
    }

    @media (max-width: 768px) {
        .p-nav-grid {
            grid-template-columns: repeat(5, 1fr);
            gap: 8px;
        }

        .p-nav-link {
            padding: 10px 8px;
            font-size: 0.9em;
        }
    }

    @media (max-width: 480px) {
        .p-nav-grid {
            grid-template-columns: repeat(5, 1fr);
            gap: 6px;
        }

        .p-nav-link {
            padding: 8px 5px;
            font-size: 0.85em;
        }
    }
</style>

<?php
// Detectar el problema actual basado en el nombre del archivo
$archivoActual = basename($_SERVER['PHP_SELF']);
$problemaActual = 0;

// Extraer el número del problema del nombre del archivo
if (preg_match('/Problema(\d+)\.php/', $archivoActual, $matches)) {
    $problemaActual = (int)$matches[1];
}
?>

<nav class="p-nav">
    <div class="p-nav-grid">
        <?php for ($i = 1; $i <= 10; $i++): ?>
            <a href="Problema<?php echo $i; ?>.php" 
               class="p-nav-link <?php echo ($i === $problemaActual) ? 'active' : ''; ?>">
                #<?php echo $i; ?>
            </a>
        <?php endfor; ?>
    </div>
</nav>