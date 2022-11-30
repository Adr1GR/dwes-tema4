<?php
session_start();
require './modelo.php';
if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No tienes permiso para acceder a esta página"; 
    echo "<a href='../index.php'>inicia sesión </a>";
    exit();
}
function exists(array $a, string $id)
{
    if ($a["$id"] == $id) {
    }
}
if ($_POST && isset($_POST['producto']) && isset($_POST['cantidad'])) {

    $prodname = htmlspecialchars(trim($_POST['producto']));
    $cantidad = (int)htmlspecialchars(trim($_POST['cantidad']));
    $valido = false;
    foreach ($productos as $producto) {
        if ($producto['id'] == $prodname) {
            $valido = true;
        }
    }
    if ($valido) {
        $options = array(
            'options' => array(
                'min_range' => 1,
            )
        );
        if (filter_var($cantidad, FILTER_VALIDATE_INT, $options) == false) {
            echo "<h1>Error: la cantidad debe ser un número entero mayor o igual que 1.</h1>";
        } else {
            isset($_SESSION['carrito'][$prodname]) ? $_SESSION['carrito'][$prodname] += $cantidad : $_SESSION['carrito'][$prodname] = $cantidad;
        }
    }
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
            <li><strong>Tienda</strong></li>
            <li><a href='carrito.php'>Carrito</a></li>
            <li><a href="logout.php">Cerrar sesión (<?php echo $_SESSION['usuario'] ?>)</a></li>
        </ul>
    </nav>

    <main>
        <section>
            <form action="" method="post">
                <p>
                    <label for="producto">Elige un producto</label>
                    <select name="producto" id="producto">
                        <?php
                        foreach ($productos as $producto) {
                            echo "<option value='{$producto['id']}'>{$producto['valor']}</option>";
                        }
                        ?>
                    </select>
                </p>
                <p>
                    <label for="cantidad">Elige la cantidad</label>
                    <input type="number" name="cantidad" id="cantidad">
                </p>
                <p>
                    <input type="submit" value="Añadir al carrito">
                </p>
            </form>
        </section>
    </main>

    <footer>
        <small><em>&copy; El SuperCarrito de la compra</em></small>
    </footer>
</body>

</html>
