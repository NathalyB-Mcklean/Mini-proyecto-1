# Mini Proyecto #1

## Índice

- [Objetivos](#objetivos)
- [Tecnologías Utilizadas](#tecnologías-utilizadas)
- [Estándares de Codificación](#estándares-de-codificación-psr-1)
- [Problemas Implementados](#problemas-implementados)
- [Estructura del Proyecto](#estructura-general-del-proyecto)
- [Estructura de Código](#estructura-general-de-cada-problema)
- [Estilos CSS](#archivo-stylecss)
- [Seguridad](#seguridad-implementada)
- [Funciones Utilizadas](#funciones-utilizadas)
- [Instrucciones de Uso](#instrucciones-de-uso)
- [Lecciones Aprendidas](#lecciones-aprendidas)
- [Navegación](#navegación-del-proyecto)
- [Referencias](#referencias-bibliográficas)
- [Información de los Desarrolladores](#información-de-los-desarrolladores)

---

## Objetivos

Construir aplicaciones web aplicando estructuras de control condicional y repetitiva, funciones matemáticas, funciones de validación, y clases con métodos estáticos para resolver problemas algorítmicos, utilizando buenas prácticas de programación siguiendo las recomendaciones de PSR-1.

---

## Tecnologías Utilizadas

| Tecnología | Descripción |
|------------|-------------|
| ![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white) | Lenguaje de programación del lado del servidor |
| ![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white) | Estructura y contenido de las páginas web |
| ![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white) | Estilos y diseño visual (`style.css`) |
| ![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white) | Framework CSS para diseño responsive |
| ![JavaScript](https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black) | Interactividad y validaciones del lado del cliente |

---

## Estándares de Codificación (PSR-1)

El proyecto implementa las siguientes convenciones:

- **Clases:** StudlyCaps (PascalCase)
  - Ejemplo: `GestorDeSesiones`, `CalculadoraEstadistica`
- **Métodos:** camelCase
  - Ejemplo: `imprimirError()`, `obtenerDatosUsuario()`
- **Variables:** camelCase
  - Ejemplo: `$notaFinal`, `$listaEstudiantes`
- **Constantes:** MAYÚSCULAS con guiones bajos
  - Ejemplo: `VERSION_APP`, `MAX_INTENTOS`

---

## Problemas Implementados

### **Problema #1: Calculadora de Datos Estadísticos (5 números)**
**Descripción:** Calcular la media, desviación estándar, el número mínimo y el máximo de los 5 primeros números positivos introducidos a partir de un formulario.

**Estructuras utilizadas:**
- Formulario HTML con validación
- Funciones matemáticas: `sqrt()`, `pow()`, `min()`, `max()`
- Arreglos para almacenar los números
- Estructuras condicionales `if`
- Ciclo `for` para iterar sobre los datos

---

### **Problema #2: Suma de Números del 1 al 1,000**
**Descripción:** Calcular la suma de los números del 1 al 1,000 (resultado esperado: 500,500).

**Estructuras utilizadas:**
- Ciclo `for` o `while`
- Acumulador para la suma
- Validación de resultados

---

### **Problema #3: Múltiplos de 4**
**Descripción:** Imprimir los N primeros múltiplos de 4, donde N es un valor introducido por teclado (4×1=4; 4×2=8; 4×3=12...).

**Estructuras utilizadas:**
- Formulario con input numérico
- Ciclo `for` para generar múltiplos
- Validación con `filter_var()` y `preg_match()`
- Manejo de desbordamiento

---

### **Problema #4: Suma de Pares e Impares (1-200)**
**Descripción:** Calcular independientemente la suma de los números pares e impares comprendidos entre 1 y 200.

**Estructuras utilizadas:**
- Ciclo `for` del 1 al 200
- Operador ternario para clasificar pares/impares
- Estructura condicional `if-else`
- Acumuladores separados

---

### **Problema #5: Clasificador de Edades**
**Descripción:** Leer la edad de 5 personas y clasificar cada una en: niño (0-12), adolescente (13-17), adulto (18-64), adulto mayor (65+). Generar estadísticas y gráficas.

**Estructuras utilizadas:**
- Formulario con múltiples inputs
- Arreglo para almacenar edades
- Estructura `switch-case` para clasificación
- Arreglo asociativo para estadísticas
- Integración de gráficas (Chart.js o similar)

---

### **Problema #6: Presupuesto Hospitalario**
**Descripción:** Calcular la distribución del presupuesto anual de un hospital en tres áreas: Ginecología (40%), Traumatología (35%) y Pediatría (25%). Integrar gráficas.

**Estructuras utilizadas:**
- Formulario para ingresar presupuesto total
- Cálculos de porcentajes
- Clase con métodos estáticos para cálculos
- Estructura condicional para validaciones
- Gráficas de distribución

---

### **Problema #7: Calculadora de Datos Estadísticos (N notas)**
**Descripción:** Pedir la cantidad de notas que desea ingresar el usuario, calcular el promedio, desviación estándar, nota mínima y máxima usando `foreach`.

**Estructuras utilizadas:**
- Formulario dinámico
- Arreglo para almacenar notas
- Ciclo `foreach` para recorrer la colección
- Funciones matemáticas: `array_sum()`, `count()`, `sqrt()`
- Validación con `htmlspecialchars()`

---

### **Problema #8: Estación del Año**
**Descripción:** Al ingresar una fecha, devolver la estación del año según rangos específicos.

**Estructuras utilizadas:**
- Formulario con input tipo `date`
- Funciones de fecha: `strtotime()`, `date()`
- Estructura `if-elseif-else` o `switch-case`
- Validación de fechas con `filter_var()`

---

### **Problema #9: Potencias de un Número**
**Descripción:** Solicitar un número (1 al 9) y generar las 15 primeras potencias del número (4¹, 4², 4³...).

**Estructuras utilizadas:**
- Formulario con input numérico
- Ciclo `for` del 1 al 15
- Función `pow()` para calcular potencias
- Operador ternario para validaciones
- Tabla HTML para mostrar resultados

---

### **Problema #10: Sistema de Ventas (Arreglo Bidimensional)**
**Descripción:** Sistema para gestionar ventas de 4 vendedores con 5 productos diferentes. Procesar información del mes, generar tabla con totales por vendedor, por producto, y totales cruzados.

**Estructuras utilizadas:**
- Arreglo bidimensional para almacenar ventas
- Ciclos `for` anidados para procesar datos
- Formulario con múltiples inputs
- Estructura `foreach` para mostrar resultados
- Cálculo de totales por filas y columnas
- Tabla HTML con formato tabular

---

## Estructura General del Proyecto

```
MINI-PROYECTO-1/
│
├── img/                          # Imágenes del proyecto
│   ├── invierno.jpg
│   ├── otoño.jpg
│   ├── primavera.jpg
│   └── verano.jpg
│
├── index.php                     # Menú principal de navegación
├── nav-problemas.php             # Navegación entre problemas
├── footer.php                    # Footer con fecha dinámica
├── style.css                     # Estilos generales del proyecto
│
├── Problema1.php                 # Calculadora estadística (5 números)
├── Problema2.php                 # Suma 1-1000
├── Problema3.php                 # Múltiplos de 4
├── Problema4.php                 # Suma pares e impares
├── Problema5.php                 # Clasificador de edades
├── Problema6.php                 # Presupuesto hospitalario
├── Problema7.php                 # Calculadora estadística (N notas)
├── Problema8.php                 # Estación del año
├── Problema9.php                 # Potencias de un número
├── Problema10.php                # Sistema de ventas
│
└── README.md                     # Este archivo
```

---

## Estructura General de Cada Problema

Cada archivo PHP sigue esta estructura:

```php
<?php
// 1. Incluir navegación
include 'nav-problemas.php';

// 2. Declaración de clases con métodos estáticos (si aplica)
class Utilidades {
    public static function validarNumero($numero) {
        // Lógica de validación
    }
}

// 3. Procesamiento del formulario (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitización de datos
    $dato = htmlspecialchars($_POST['campo']);
    
    // Validación con preg_match o filter_var
    if (filter_var($dato, FILTER_VALIDATE_INT)) {
        // Lógica del problema
        // Uso de estructuras: if, switch, for, foreach, while
    }
}
?>

<!-- 4. Formulario HTML -->
<form method="POST" action="">
    <!-- Campos del formulario -->
</form>

<!-- 5. Mostrar resultados -->
<?php if (isset($resultado)): ?>
    <!-- Visualización de datos -->
<?php endif; ?>

<!-- 6. Incluir footer -->
<?php include 'footer.php'; ?>
```

---

## Archivo `style.css`

El archivo `style.css` contiene todos los estilos visuales del proyecto:

- **Estilos del menú principal:** Diseño del index con cards
- **Estilos de navegación:** Menú entre problemas
- **Estilos de formularios:** Inputs, botones, labels
- **Estilos de tablas:** Formato tabular para resultados
- **Estilos del footer:** Footer con fecha dinámica
- **Diseño responsive:** Media queries para dispositivos móviles
- **Colores y tipografía:** Paleta de colores consistente
- **Animaciones:** Transiciones y hover effects

---

## Seguridad Implementada

### Prevención de XSS (Cross-Site Scripting)
```php
// Sanitización de entrada
$nombre = htmlspecialchars($_POST['nombre'], ENT_QUOTES, 'UTF-8');
```

### Validación de Datos
```php
// Validación con filter_var
$email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);

// Validación con preg_match
if (preg_match('/^[0-9]+$/', $_POST['numero'])) {
    // Número válido
}
```

---

## Funciones Utilizadas

### Funciones Matemáticas
- `sqrt()` - Raíz cuadrada
- `pow()` - Potencia
- `round()` - Redondeo
- `min()` - Valor mínimo
- `max()` - Valor máximo
- `abs()` - Valor absoluto

### Funciones de Arreglos
- `array_sum()` - Suma de elementos
- `count()` - Contar elementos
- `array_push()` - Agregar elemento
- `sort()` - Ordenar arreglo

### Funciones de Validación
- `htmlspecialchars()` - Prevención de XSS
- `filter_var()` - Validación y sanitización
- `preg_match()` - Validación con expresiones regulares

### Funciones de Fecha
- `date()` - Formato de fecha
- `strtotime()` - Convertir fecha a timestamp

---

## Instrucciones de Uso

1. **Clonar o descargar el repositorio**
2. **Configurar servidor local** (XAMPP, WAMP, LAMP, MAMP)
3. **Colocar archivos** en la carpeta del servidor web (ejemplo: `htdocs`)
4. **Acceder a** `http://localhost/proyecto-php/index.php`
5. **Seleccionar problema** desde el menú principal
6. **Completar formularios** y visualizar resultados

---

## Lecciones Aprendidas

1. Implementación correcta de estándares PSR-1
2. Uso efectivo de estructuras de control (if, switch, for, foreach, while)
3. Importancia de la validación y sanitización de datos
4. Organización modular del código con includes
5. Implementación de clases con métodos estáticos
6. Prevención de vulnerabilidades XSS
7. Diseño responsive con CSS
8. Manejo de arreglos bidimensionales

---

## Navegación del Proyecto

El proyecto incluye un sistema de navegación completo:

- **index.php:** Menú principal con tarjetas para cada problema
- **nav-problemas.php:** Barra de navegación entre problemas
- **footer.php:** Footer con fecha dinámica del día de ejecución
- **Función de retorno:** Enlace para volver al menú principal desde cualquier problema

```php
// Ejemplo de función de navegación
function volverAlMenu($url = 'index.php') {
    echo "<a href='$url' class='btn btn-secondary'>Volver al Menú</a>";
}
```

---

## Referencias Bibliográficas

- PHP Documentation. (2025). PHP Manual. Recuperado de: https://www.php.net/manual/es/
- PSR-1: Basic Coding Standard. PHP-FIG. Recuperado de: https://www.php-fig.org/psr/psr-1/
- OWASP Top 10. (2025). Web Application Security Risks. Recuperado de: https://owasp.org/www-project-top-ten/
- Bootstrap Documentation. (2025). Recuperado de: https://getbootstrap.com/docs/
- Medium - PHP OWASP Top 10. Recuperado de: https://medium.com/@khalidzeiter/php-owasp-top-10-essential-steps-for-keeping-your-web-application-safe-and-secure-72b5e7e55523

---

## Información de los Desarrolladores

Este laboratorio ha sido desarrollado por estudiantes de la Universidad Tecnológica de Panamá:

**Nathaly Bonilla Mcklean**
- Correo institucional: nathaly.bonilla1@utp.ac.pa
- Correo GitHub: githubmcklean@gmail.com
- Correo profesional: nbmcklean@gmail.com

**Abdiel Abrego**
- Correo institucional: abdiel.abrego1@utp.ac.pa
- Correo profesional: aabdiel200412@gmail.com

**Curso:** Ingeniería Web

**Instructora del Laboratorio:** Ing. Irina Fong

**Fecha de Ejecución:** 10 de octubre de 2025

**Fecha de Entrega:** 10 de octubre de 2025

**Última Modificación:** 10 de octubre de 2025

---

**Universidad Tecnológica de Panamá**  
*Facultad de Ingeniería de Sistemas Computacionales*  
*Campus Víctor Levis Sasso*  
*Ingeniería Web - 2025*