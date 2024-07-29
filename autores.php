<?php
$servername = 'sql307.infinityfree.com';
$username = 'if0_36989115';
$password = 'VnYGOxCbrrg';
$dbname = 'if0_36989115_dblibreria';


try {
    $dsn = "mysql:host=$servername;dbname=$dbname;charset=utf8mb4";
    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    $pdo = new PDO($dsn, $username, $password, $options);
    
    // La conexión fue exitosa, pero ya no mostramos el mensaje
} catch (PDOException $e) {
    // En un entorno de producción, es mejor no mostrar detalles del error
    die('Error de conexión: ' . $e->getMessage());
}


// Consulta para obtener la lista de autores
$stmt = $pdo->query('SELECT DISTINCT apellido, pais, nombre FROM autores');
$autores = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'index.php'; ?>
<!-- Contenido específico de la página autores -->