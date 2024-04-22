<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Veterinaria Vetepac - Inicio</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Veterinaria Vetepac</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#emergencyModal">Emergencia</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="views/login.php">Iniciar sesión</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Modal de Emergencia -->
    <div class="modal fade" id="emergencyModal" tabindex="-1" aria-labelledby="emergencyModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="emergencyModalLabel">Emergencia Canina</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="emergencyForm">
                        <div class="mb-3">
                            <label for="petName" class="form-label">Nombre del Canino:</label>
                            <input type="text" class="form-control" id="petName" required>
                        </div>
                        <div class="mb-3">
                            <label for="ownerContact" class="form-label">Contacto del Propietario:</label>
                            <input type="text" class="form-control" id="ownerContact" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Enviar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h1>Bienvenido a Veterinaria Vetepac</h1>
        <p>El mejor cuidado para tus mascotas.</p>


        <!-- Sección de Adopciones -->
        <div class="row">
            <h2>Adopciones</h2>
            <!-- Tarjeta de adopción para un perrito -->
            <div class="col-md-3">
                <div class="card">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRgP-lSza80x010-8Qiymbco975wl0qdIsa5O5PrAOdAQ&s" class="card-img-top" alt="Perrito1">
                    <div class="card-body">
                        <h5 class="card-title">Rex</h5>
                        <p class="card-text">Edad: 2 años</p>
                        <button class="btn btn-primary adopt-btn" data-nombre="Rex" data-edad="2">Adoptar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/3/34/Perros-Bonitos-Acostados.jpg" class="card-img-top" alt="Perrito2">
                    <div class="card-body">
                        <h5 class="card-title">Bella</h5>
                        <p class="card-text">Edad: 1 año</p>
                        <button class="btn btn-primary adopt-btn" data-nombre="Bella" data-edad="1">Adoptar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://dogtlan.com/cdn/shop/collections/rocko_1.png?v=1681745782" class="card-img-top" alt="Perrito3">
                    <div class="card-body">
                        <h5 class="card-title">Max</h5>
                        <p class="card-text">Edad: 3 años</p>
                        <button class="btn btn-primary adopt-btn" data-nombre="Max" data-edad="3">Adoptar</button>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card">
                    <img src="https://cdn.wamiz.fr/article/images/ES%20PHOTOS/NOVIEMBRE2020/Diciembre/samoyedo-razas-de-perros-blancos.jpg" class="card-img-top" alt="Perrito4">
                    <div class="card-body">
                        <h5 class="card-title">Luna</h5>
                        <p class="card-text">Edad: 4 años</p>
                        <button class="btn btn-primary adopt-btn" data-nombre="Luna" data-edad="4">Adoptar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-info text-white">
            Nuestra misión
          </div>
          <div class="card-body">
            <ul class="list-unstyled">
              <li>Brindar atención veterinaria de calidad y compasiva a las mascotas de nuestra comunidad.</li>
              <li>Promover la salud y el bienestar de las mascotas a través de la medicina preventiva y la educación.</li>
              <li>Crear un ambiente cálido y acogedor para las mascotas y sus dueños.</li>
              <li>Ofrecer un servicio integral y personalizado para cada mascota.</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-success text-white">
            Nuestros servicios
          </div>
          <div class="card-body">
            <ul class="list-unstyled">
              <li>Atención médica general (exámenes físicos, vacunas, desparasitaciones)</li>
              <li>Cirugía veterinaria</li>
              <li>Diagnóstico por imágenes (radiografía, ecografía)</li>
              <li>Medicina preventiva</li>
              <li>Tienda de mascotas (alimentos, juguetes, accesorios)</li>
            </ul>
          </div>
        </div>
      </div>

      <div class="col-md-4">
        <div class="card">
          <div class="card-header bg-warning text-white">
            ¿Por qué elegirnos?
          </div>
          <div class="card-body">
            <ul class="list-unstyled">
              <li>Equipo de veterinarios y personal altamente capacitado</li>
              <li>Tecnología de punta y equipos modernos</li>
              <li>Ambiente cálido y acogedor para las mascotas y sus dueños</li>
              <li>Servicio integral y personalizado para cada mascota</li>
              <li>Compromiso con la calidad y la atención compasiva</li>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.adopt-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        const nombreMascota = btn.dataset.nombre;
        const edad = btn.dataset.edad;
        const confirmarAdopcion = confirm(`¿Quieres adoptar a ${nombreMascota}?`);
        if (confirmarAdopcion) {
            const contactoPropietario = prompt(`Ingresa tu contacto para adoptar a ${nombreMascota}:`);
            if (contactoPropietario) {
                // Guardar información en la base de datos
                console.log("Enviando solicitud POST...");
                fetch('../php/save_adopcion.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded' // Cambiado a 'application/x-www-form-urlencoded'
                    },
                    body: `nombreMascota=${nombreMascota}&edad=${edad}&contactoPropietario=${contactoPropietario}&fechaAdopcion=${new Date().toISOString().slice(0, 10)}` // Cambiado a un formato de cadena de consulta
                })
                .then(response => {
                    if (response.ok) {
                        alert(`¡Felicidades! Has adoptado a ${nombreMascota}.`);
                    } else {
                        alert('Hubo un error al procesar la adopción. Por favor, inténtalo de nuevo más tarde.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Hubo un error al procesar la adopción. Por favor, inténtalo de nuevo más tarde.');
                });
            }
        }
    });
});


    </script>
</body>
</html>
