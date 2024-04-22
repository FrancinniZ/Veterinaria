<?php
session_start();

// Verifica si el usuario está logueado y es un admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Si no es admin o no está logueado, redirige al login
    header('Location: login.php');
    exit;
}

// Definir las credenciales de la base de datos
$host = 'localhost';
$db   = 'proyecto';
$user = 'fabri'; 
$pass = 'password'; 
$charset = 'utf8mb4';

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);

    // Consulta SQL para seleccionar las citas programadas
    $stmt = $pdo->query("SELECT * FROM citas");

} catch (\PDOException $e) {
    // En caso de error, muestra un mensaje de error
    echo "Error: " . $e->getMessage();
    exit;
}
?>
<?php
// Consulta SQL para obtener el conteo de adopciones por mes
$stmtAdopciones = $pdo->query("SELECT MONTH(fecha_adopcion) AS mes, COUNT(*) AS cantidad FROM adopciones GROUP BY MONTH(fecha_adopcion)");

// Consulta SQL para obtener el conteo de emergencias por mes
$stmtEmergencias = $pdo->query("SELECT MONTH(fecha_emergencia) AS mes, COUNT(*) AS cantidad FROM emergencias GROUP BY MONTH(fecha_emergencia)");

//Consulta SQL para obtener el conteo de citas por mes
$stmCitas = $pdo->query("SELECT MONTH(fecha_hora) AS mes, COUNT(*) AS cantidad FROM citas GROUP BY MONTH(fecha_hora)");

// Inicializar arrays para almacenar los datos de adopciones y emergencias por mes
$adopcionesPorMes = [];
$emergenciasPorMes = [];
$citasPorMes = [];


//Llenar array con los datos de las citas
while($row = $stmCitas->fetch()){
    $citasPorMes[$row['mes']] = $row['cantidad'];
}

// Llenar arrays con los datos de adopciones
while ($row = $stmtAdopciones->fetch()) {
    $adopcionesPorMes[$row['mes']] = $row['cantidad'];
}

// Llenar arrays con los datos de emergencias
while ($row = $stmtEmergencias->fetch()) {
    $emergenciasPorMes[$row['mes']] = $row['cantidad'];
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Importar Chart.js -->
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav ms-auto">
                <a class="nav-link" href="../php/logout.php">Cerrar Sesión</a>
            </div>
        </div>
    </div>
</nav>

<h1 class="mt-4">Bienvenido al Dashboard, Administrador</h1>
<p>Este es el panel de control. Aquí puedes gestionar la aplicación.</p>

<!-- Sección para crear citas -->
<section>
    <h2>Crear Cita</h2>
    <form action="../php/ruta_para_procesar_cita.php" method="post">
        <div class="form-group">
            <label for="nombre_cliente">Nombre del Cliente</label>
            <input type="text" class="form-control" id="nombre_cliente" name="nombre_cliente" placeholder="Nombre del Cliente" required>
        </div>
        <div class="form-group">
            <label for="nombre_mascota">Nombre de la Mascota</label>
            <input type="text" class="form-control" id="nombre_mascota" name="nombre_mascota" placeholder="Nombre de la Mascota" required>
        </div>
        <div class="form-group">
            <label for="fecha_hora">Fecha y Hora</label>
            <input type="datetime-local" class="form-control" id="fecha_hora" name="fecha_hora" required>
        </div>
        <div class="form-group">
            <label for="servicio">Servicio Requerido</label>
            <input type="text" class="form-control" id="servicio" name="servicio" placeholder="Servicio Requerido" required>
        </div>
        <button type="submit" class="btn btn-primary">Agregar Cita</button>
    </form>
</section>

<!-- Sección para ver las citas existentes -->
<section class="mt-4">
    <h2>Citas Programadas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID Cita</th>
                <th>Cliente</th>
                <th>Mascota</th>
                <th>Fecha y Hora</th>
                <th>Servicio</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre las filas de la consulta y mostrar los datos en la tabla
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['id_cita'] . "</td>";
                echo "<td>" . $row['nombre_cliente'] . "</td>";
                echo "<td>" . $row['nombre_mascota'] . "</td>";
                echo "<td>" . $row['fecha_hora'] . "</td>";
                echo "<td>" . $row['servicio'] . "</td>";
                echo "<td>" . $row['estado_cita'] . "</td>"; // Agregar la columna de estado
                echo "<td><a href='#' class='editar-cita' data-id='" . $row['id_cita'] . "' data-nombre='" . $row['nombre_cliente'] . "' data-mascota='" . $row['nombre_mascota'] . "' data-fecha='" . $row['fecha_hora'] . "' data-servicio='" . $row['servicio'] . "' data-estado='" . $row['estado_cita'] . "' data-bs-toggle='modal' data-bs-target='#editarCitaModal'>Editar</a> | <a href='../php/eliminar_cita.php?id=" . $row['id_cita'] . "'>Eliminar</a></td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>
<?php
// Verifica si el usuario está logueado y es un admin
if (!isset($_SESSION['user_id']) || $_SESSION['rol'] !== 'admin') {
    // Si no es admin o no está logueado, redirige al login
    header('Location: login.php');
    exit;
}

// Definir las credenciales de la base de datos
$host = 'localhost';
$db   = 'proyecto';
$user = 'fabri'; 
$pass = 'password'; 
$charset = 'utf8mb4';

// Opciones de PDO
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    // Conexión a la base de datos
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=$charset", $user, $pass, $options);

    // Consulta SQL para seleccionar las emergencias caninas
    $stmt = $pdo->query("SELECT * FROM emergencias");

} catch (\PDOException $e) {
    // En caso de error, muestra un mensaje de error
    echo "Error: " . $e->getMessage();
    exit;
}
?>

<!-- Sección para ver las emergencias caninas -->
<section class="mt-4">
    <h2>Emergencias Caninas</h2>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre del Canino</th>
                <th>Contacto del Propietario</th>
                <th>Fecha de Emergencia</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Iterar sobre las filas de la consulta y mostrar los datos en la tabla
            while ($row = $stmt->fetch()) {
                echo "<tr>";
                echo "<td>" . $row['id'] . "</td>";
                echo "<td>" . $row['nombre_canino'] . "</td>";
                echo "<td>" . $row['contacto_propietario'] . "</td>";
                echo "<td>" . $row['fecha_emergencia'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>

<!-- Sección para mostrar el gráfico de barras -->
<section class="mt-4">
    <h2>Adopciones y Emergencias Caninas por Mes</h2>
    <canvas id="graficoAdopcionesEmergencias" width="800" height="400"></canvas>
</section>

<script>
// Obtener el contexto del canvas
var ctx = document.getElementById('graficoAdopcionesEmergencias').getContext('2d');

// Configurar los datos para el gráfico
var data = {
    labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
    datasets: [
        {
            label: 'Adopciones',
            backgroundColor: 'rgba(54, 162, 235, 0.5)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1,
            data: <?php echo json_encode(array_values($adopcionesPorMes)); ?>,
        },
        {
            label: 'Emergencias',
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1,
            data: <?php echo json_encode(array_values($emergenciasPorMes)); ?>,
        },
        {
            label: 'Citas',
            backgroundColor: 'rgba(75,192,192,0.5)',
            borderColor: 'rgba(75,192,192,0.5)',
            borderWidth: 1,
            data: <?php echo json_encode(array_values($citasPorMes)); ?>
        }
    ]
};

// Configurar opciones del gráfico
var options = {
    scales: {
        y: {
            beginAtZero: true
        }
    }
};

// Crear el gráfico de barras
var myBarChart = new Chart(ctx, {
    type: 'bar',
    data: data,
    options: options
});
</script>


<!-- Modal para editar cita -->
<div class="modal fade" id="editarCitaModal" tabindex="-1" aria-labelledby="editarCitaModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editarCitaModalLabel">Editar Cita</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editarCitaForm" action="../php/ruta_para_actualizar_cita.php" method="post">
                    <input type="hidden" name="id_cita" id="id_cita_edit">
                    <div class="form-group">
                        <label for="nombre_cliente_edit">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="nombre_cliente_edit" name="nombre_cliente" required>
                    </div>
                    <div class="form-group">
                        <label for="nombre_mascota_edit">Nombre de la Mascota</label>
                        <input type="text" class="form-control" id="nombre_mascota_edit" name="nombre_mascota" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_hora_edit">Fecha y Hora</label>
                        <input type="datetime-local" class="form-control" id="fecha_hora_edit" name="fecha_hora" required>
                    </div>
                    <div class="form-group">
                        <label for="servicio_edit">Servicio Requerido</label>
                        <input type="text" class="form-control" id="servicio_edit" name="servicio" required>
                    </div>
                    <div class="form-group">
                        <label for="estado_edit">Estado de la Cita</label>
                        <select class="form-control" id="estado_edit" name="estado">
                            <option value="pendiente">Pendiente</option>
                            <option value="confirmada">Confirmada</option>
                            <option value="cancelada">Cancelada</option>
                            <option value="completada">Completada</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Obtener referencias a los elementos del modal
        var idCitaInput = document.getElementById('id_cita_edit');
        var nombreClienteInput = document.getElementById('nombre_cliente_edit');
        var nombreMascotaInput = document.getElementById('nombre_mascota_edit');
        var fechaHoraInput = document.getElementById('fecha_hora_edit');
        var servicioInput = document.getElementById('servicio_edit');
        var estadoInput = document.getElementById('estado_edit');

        // Escuchar clics en los enlaces de editar cita
        var editarCitaLinks = document.getElementsByClassName('editar-cita');
        for (var i = 0; i < editarCitaLinks.length; i++) {
            editarCitaLinks[i].addEventListener('click', function (event) {
                // Obtener los datos de la cita desde los atributos data del enlace
                var idCita = this.getAttribute('data-id');
                var nombreCliente = this.getAttribute('data-nombre');
                var nombreMascota = this.getAttribute('data-mascota');
                var fechaHora = this.getAttribute('data-fecha');
                var servicio = this.getAttribute('data-servicio');
                var estado = this.getAttribute('data-estado');

                // Llenar los campos del formulario en el modal con los datos de la cita
                idCitaInput.value = idCita;
                nombreClienteInput.value = nombreCliente;
                nombreMascotaInput.value = nombreMascota;
                fechaHoraInput.value = fechaHora;
                servicioInput.value = servicio;
                estadoInput.value = estado;
            });
        }
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
