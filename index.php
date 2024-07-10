<?php

// Creamos la variable donde arrojaremos el resultado final...
$resultado = "";

// Verificamos si el formulario se envio con el método POST...
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtenemos el número de parciales desde el formulario y lo convertiremos a numero entero...
    $numParciales = intval($_POST['numParciales']);
    
    // Obtenemos el promedio mínimo para aprobar desde el formulario y lo convertimos a un número decimal...
    $promedioMinimo = floatval($_POST['promedioMinimo']);
    
    // Obtenemos el nombre del alumno desde el formulario, Si no se proporciona, se establece como 'Anónimo'...
    $nombreAlumno = isset($_POST['nombreAlumno']) ? $_POST['nombreAlumno'] : 'Anónimo';
    
    //  Creamos una variable para almacenar la suma de los valores de los parciales...
    $sum = 0;
    // Recorremos con el ciclo for cada parcial desde 1 hasta el número total de parciales que se proporcionaron...
    for ($i = 1; $i <= $numParciales; $i++) {
        // Obtenemos el valor de cada parcial desde el formulario y lo convertimos a un número decimal...
        $parcialValue = floatval($_POST["parcial$i"]);
        // Sumamos el valor del parcial a la variable de suma...
        $sum += $parcialValue;
        }

    // Calculamos el promedio dividiendo la suma total por el número de parciales...
    $promedio = $sum / $numParciales;
    
    // Determinamos si el promedio es mayor o igual al promedio mínimo requerido para aprobar...
    $status = $promedio >= $promedioMinimo ? "Aprobado" : "No Aprobado";

    // Construccion del mensaje de resultado basado en si el promedio es suficiente para aprobar o no...
    if ($promedio >= $promedioMinimo) {
    
        $resultado = "<h2>Resultado para $nombreAlumno</h2>";
        $resultado .= "<p>Promedio: " . number_format($promedio, 2) . "</p>";
        $resultado .= "<p>Felicidades, $nombreAlumno, ¡aprobaste! 🎉🥳🎉</p>";
        } else {
            $resultado = "<h2>Resultado para $nombreAlumno</h2>";
            $resultado .= "<p>Promedio: " . number_format($promedio, 2) . "</p>";
            $resultado .= "<p>$nombreAlumno, no lograste aprobar.</p>";
            }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculador de Promedio</title>
    <link rel="stylesheet" href="estilos.css"> <!-- Enlazamos nuestro archivo de estilos -->
</head>
<body>
    <!-- Seccion del banner con un título que se desplaza -->
    <div class="banner">
        <h1>Calculador de Promedio</h1>
    </div>
    
    <!-- Formulario para ingresar los datos del estudiante y los parciales -->
    <form id="mainForm" method="post" onsubmit="return validateForm()">
        <!-- Campo para ingresar el número de parciales -->
        <label for="numParciales">Número de parciales:</label>
        <input type="number" id="numParciales" name="numParciales" min="1" required>
        
        <!-- Campo para ingresar el promedio mínimo necesario para aprobar -->
        <label for="promedioMinimo">Promedio mínimo para aprobar:</label>
        <input type="number" id="promedioMinimo" name="promedioMinimo" min="0" max="10" step="0.01" required>
        
        <!-- Campo opcional para ingresar el nombre del alumno -->
        <label for="nombreAlumno">Nombre del alumno (opcional):</label>
        <input type="text" id="nombreAlumno" name="nombreAlumno">
        
        <!-- Botón para generar los campos de parciales dinámicamente -->
        <button type="button" onclick="generateFields()">Generar Parciales</button>
        
        <!-- Contenedor donde se agregarán los campos de parciales -->
        <div id="parcialesContainer" class="parciales-container"></div>
        
        <!-- Botón para enviar el formulario y calcular el promedio. Este botón está oculto y se muestra solo al generar los campos de parciales -->
        <button type="submit" style="display:none;" id="submitBtn">Calcular Promedio</button>
    </form>

    <!-- Sección donde se muestra el resultado del cálculo -->
    <div id="result"><?php echo $resultado; ?></div>

    <!-- Pie de página -->
    <footer>
        <div class="texto-inferior-izquierda">© Alberto Arias Flores</div>
    </footer>

    <!-- Enlazamos nuestro archivo de script (JavaScript) -->
    <script src="script.js"></script>
</body>
</html>