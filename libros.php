<?php
$servername = 'sql307.infinityfree.com';
$username = 'if0_36989115';
$password = 'VnYGOxCbrrg';
$dbname = 'if0_36989115_dblibreria';


try {
    $pdo = new PDO("mysql:host=$servername;dbname=$dbname;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo 'Error de conexión: ' . $e->getMessage();
}

// Consulta para obtener la lista de libros
$stmt = $pdo->query('SELECT DISTINCT titulo, fecha_pub AS fecha_publicacion, tipo AS genero, precio FROM titulos;');
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include 'index.php'; ?>       
<!-- Contenido específico de la página libros -->

