<?php
session_start();

// Si el usario está ya autenticado, ¿qué hace aquí, en la página de registro?
// Lo mandamos a la página index.php
if (isset($_SESSION['usuario'])) {
    header('location: index.php', true, 302);
    exit();
}

require 'lib/gestionUsuarios.php';

// Si hay POST validamos y registramos al usuario si todo fue bien.
if ($_POST) {
    $errores = registroUsuario($_POST['usuario'], $_POST['clave'], $_POST['repite_clave']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro de usuarios</title>
</head>
<body>
    <header>
        <h1>Sistema de autenticación</h1>
    </header>

    <nav>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="pagina_publica.php">Página pública</a></li>
            <li><a href='login.php'>Iniciar sesión</a></li>
            <li><strong>Regístrate</strong></li>
        </ul>
    </nav>

    <main>
        <h1>Regístrate</h1>
        <?php if (!$_POST || ($_POST && $errores)) { ?>
            <form action="registro.php" method="post">
                <p>
                    <label for="usuario">Nombre de usuario</label><br>
                    <input type="text" name="usuario" id="usuario"
                            value="<?php echo $_POST && isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>">
                    <?php
                    if (isset($errores) && isset($errores['usuario'])) {
                        echo "<p>{$errores['usuario']}</p>";
                    }
                    ?>
                </p>
                <p>
                    <label for="clave">Contraseña</label><br>
                    <input type="password" name="clave" id="clave">
                    <?php
                    if (isset($errores) && isset($errores['clave'])) {
                        echo "<p>{$errores['clave']}</p>";
                    }
                    ?>
                </p>
                <p>
                    <label for="repite_clave">Repite la contraseña</label><br>
                    <input type="password" name="repite_clave" id="repite_clave">
                </p>
                <p>
                    <input type="submit" value="Registrarse">
                </p>
            </form>
        <?php } else { ?>
            <p>Te has registrado correctamente, ya puedes <a href='login.php'>Iniciar sesión</a>.</p>
        <?php } ?>
    </main>

    <footer>
        <small>&copy; sitio web</small>
    </footer>
</body>
</html>
