<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Trabajador</title>
    <!-- Bootstrap CSS para mejorar el estilo -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/BD_Proyecto/css/login.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Eliminar Trabajador</h1>
        <form action="deleteWorker.php" method="post">
            <div class="form-group">
                <label for="id">ID a borrar:</label>
                <input type="number" class="form-control" name="id" id="id" required>
            </div>
            <button type="submit" class="btn btn-danger">Eliminar Trabajador</button>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Conexión a la base de datos PostgreSQL
            $config = include("config.php");
            $dsn = "pgsql:host=" . $config['db_host'] . ";port=5432;dbname=" . $config['db_name'] . ";user=" . $config['db_user'] . ";password=" . $config['db_password'];

            try {
                $conn = new PDO($dsn);
                $id = $_POST['id'];
                $query = "DELETE FROM trabajador_area WHERE id_trabajador = ?";
                $query2 = "DELETE FROM trabajador WHERE id_trabajador = ?";
                
                $stmt = $conn->prepare($query);
                $stmt->execute([$id]);
                $stmt2 = $conn->prepare($query2);
                $stmt2->execute([$id]);

                echo '<div class="alert alert-success" role="alert">Trabajador eliminado con éxito.</div>';
                header("refresh:3;url=testt.php"); // Redireccionar después de 3 segundos a la página principal
            } catch (PDOException $e) {
                echo '<div class="alert alert-danger" role="alert">' . $e->getMessage() . '</div>';
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
