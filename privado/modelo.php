<?php
if (!isset($_SESSION['usuario'])) {
    header('HTTP/1.0 401 Unauthorized');
    echo "No puedes acceder a esta página, <a href='../index.php'>inicia sesión </a>";
    exit();
}
$productos = [
    ['id' => 'pan', 'valor' => 'Pan'],
    ['id' => 'aceite', 'valor' => 'Aceite'],
    ['id' => 'platano', 'valor' => 'Plátano'],
    ['id' => 'arroz', 'valor' => 'Arroz'],
    ['id' => 'choclo', 'valor' => 'Choclo']
];
