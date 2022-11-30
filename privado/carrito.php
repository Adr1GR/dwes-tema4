<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No puedes acceder a esta página, <a href='../index.php'>inicia sesión </a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Carrito de la compra</title>
</head>

<body>
    <header>
        <h1>SuperCarrito Shop</h1>
    </header>

    <nav>
        <ul>
            <li><a href="../index.php">Home</a></li>
            <li><a href="../pagina_publica.php">Página pública</a></li>
            <li><a href='pagina_privada.php'>Página privada</a></li>
            <li><a href='tienda.php'>Tienda</a></li>
            <li><strong>Carrito</strong></li>
            <li><a href="logout.php">Cerrar sesión (<?php echo $_SESSION['usuario'] ?>)</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <h1>Cesta de la compra</h1>
            <?php
            if (!isset($_SESSION['carrito'])) {
                echo "<p>No hay productos en el carrito de la compra</p>";
            } else {
                echo "<ul>";
                foreach ($_SESSION['carrito'] as $producto => $cantidad) {
                    echo "<li>Tienes " . $cantidad . " de " . $producto . "</li>";
                }

                echo "</ul>";
            }
            ?>
        </section>
    </main>

    <footer>
        <small><em>&copy; El SuperCarrito de la compra</em></small>
    </footer>
</body>

</html>
