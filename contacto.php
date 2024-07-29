<head> 
<link rel="stylesheet" href="styles.css">
</head




<body>
    

<header>
        <h1>Librería Online</h1>
        <nav>
            <ul>
                <li><a class="btn" href="index.php">Inicio</a></li>
                <li><a class="btn" href="libros.php">Libros</a></li>
                <li><a class="btn" href="autores.php">Autores</a></li>
                <li><a class="btn" href="contacto.php">Contacto</a></li>
            </ul>
        </nav>
 </header>

 <main> 

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

// Función para almacenar la información enviada por el formulario en la tabla "contacto"
function guardarContacto($pdo, $nombre, $correo, $asunto, $comentario) {
    $stmt = $pdo->prepare('INSERT INTO contacto (nombre, correo, asunto, comentario) VALUES (?, ?, ?, ?)');
    $stmt->execute([$nombre, $correo, $asunto, $comentario]);
}

// Comprobar si se envió el formulario
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $correo = $_POST['correo'];
    $asunto = $_POST['asunto'];
    $comentario = $_POST['comentario'];

    guardarContacto($pdo, $nombre, $correo, $asunto, $comentario);

    // Mensaje de depuración
    echo "Datos guardados: Nombre: $nombre, Correo: $correo, Asunto: $asunto, Comentario: $comentario";

    // Establecer un mensaje de éxito en una variable de sesión
    session_start();
    $_SESSION['mensaje'] = '¡Guardado correctamente!';

    // Redirigir a la página de contacto para evitar que se vuelva a enviar el formulario al actualizar la página
    header('Location: contacto.php');
    exit();
}

?>




<section class="fade-in">
    <h2>Formulario de Contacto</h2>
    <?php
    // Mostrar el mensaje de éxito si existe
    session_start();
    if (isset($_SESSION['mensaje'])) {
        echo '<p style="color: green;">' . $_SESSION['mensaje'] . '</p>';
        unset($_SESSION['mensaje']); // Limpiar el mensaje para que no se muestre nuevamente al actualizar la página
    }
    ?>
    <form id="contact-form" action="contacto.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" name="nombre" id="nombre" required>

        <label for="correo">Correo:</label>
        <input type="email" name="correo" id="correo" required>

        <label for="asunto">Asunto:</label>
        <input type="text" name="asunto" id="asunto" required>

        <label for="comentario">Comentario:</label>
        <textarea name="comentario" id="comentario" rows="4" required></textarea>

        <button type="submit">Enviar</button>

    </form>

    <div id="success-message" style="display: none;">
        <p>¡Gracias por tu mensaje! Nos pondremos en contacto contigo pronto.</p>
    </div>
</section>


 </main>


    <footer>
        <p> <?php echo date('Y'); ?> Librería Online. Todos los derechos reservados.</p>
    </footer>

 </body>
