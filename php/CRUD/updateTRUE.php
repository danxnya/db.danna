<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id_persona'];
    $nombre = $_POST['nombre'];
    $apellido_paterno = $_POST['apellido_paterno'];
    $apellido_materno = $_POST['apellido_materno'];
    $correo = $_POST['correo'];
    $telefono = $_POST['telefono'];
    $municipio = $_POST['municipio'];
    $calle = $_POST['calle'];
    $cp = $_POST['cp'];
    $contrasena = $_POST['contrasena'];

    $config = include("config.php");
    $dsn = "pgsql:host=" . $config['db_host'] . ";port=5432;dbname=" . $config['db_name'] . ";user=" . $config['db_user'] . ";password=" . $config['db_password'];

    try {
        $conn = new PDO($dsn);
        $query = "UPDATE persona SET nombre = ?, apellido_paterno = ?, apellido_materno = ?, correo = ?, telefono = ?, municipio = ?, calle = ?, cp = ?, contrasena = ? WHERE id_persona = ?";
        $stmt = $conn->prepare($query);
        $stmt->execute([$nombre, $apellido_paterno, $apellido_materno, $correo, $telefono, $municipio, $calle, $cp, $contrasena, $id]);
        echo "Persona actualizado con éxito.";
        header("Location: /BD_Proyecto/php/CRUD/testt.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
?>
