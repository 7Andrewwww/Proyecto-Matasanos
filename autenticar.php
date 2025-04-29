<?php
session_start();
require "logica/Especialidad.php";
require "logica/Medico.php";
require "logica/Paciente.php";

if(isset($_POST["autenticar"])){
    $correo = $_POST["correo"];
    $clave = md5($_POST["clave"]);
    
    // Autenticar como Médico
    $medico = Medico::autenticar($correo);
    
    if($medico && $clave == $medico->getClave()) {
        $_SESSION["id"] = $medico->getId(); // Cambiado de getIdMedico() a getId()
        $_SESSION["rol"] = "medico";
        $_SESSION["nombre"] = $medico->getNombre() . " " . $medico->getApellido();
        $_SESSION["especialidad"] = $medico->getEspecialidad()->getNombre(); // Opcional
        header("Location: index.php");
        exit();
    }
    
    // Autenticar como Paciente
    $paciente = Paciente::autenticar($correo);
    
    if($paciente && $clave == $paciente->getClave()) {
        $_SESSION["id"] = $paciente->getId(); // Cambiado de getIdPaciente() a getId()
        $_SESSION["rol"] = "paciente";
        $_SESSION["nombre"] = $paciente->getNombre() . " " . $paciente->getApellido();
        header("Location: index.php");
        exit();
    }
    
    $error = "Credenciales incorrectas";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Matasanos EPS - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v6.7.2/css/all.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-4">
        <div class="row align-items-center">
            <div class="col-md-4 text-center text-md-start mb-3 mb-md-0">
                <img src="img/logo.png" alt="Logo" class="img-fluid" style="width: 150px;">
            </div>
            <div class="col-md-8 text-center text-md-start">
                <h1 class="text-primary">Matasanos EPS</h1>
                <p class="text-muted">Cuidamos tu salud y cuidamos de ti</p>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0"><i class="fas fa-user-lock me-2"></i>Autenticación</h4>
                    </div>
                    <div class="card-body">
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        
                        <form action="autenticar.php" method="post">
                            <div class="mb-3">
                                <label for="correo" class="form-label">Correo electrónico</label>
                                <input type="email" class="form-control" id="correo" name="correo" required>
                            </div>
                            <div class="mb-3">
                                <label for="clave" class="form-label">Contraseña</label>
                                <input type="password" class="form-control" id="clave" name="clave" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary" name="autenticar">
                                    <i class="fas fa-sign-in-alt me-1"></i> Ingresar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>