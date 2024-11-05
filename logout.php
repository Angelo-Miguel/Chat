<?php
session_start();
session_destroy();

if (!file_exists('C:\xampp\tmp')) {
    mkdir('C:\xampp\tmp', 0777, true);
    echo "<script>console.log('Pasta criada.')</script>";
} else {
    echo "<script>console.log('Pasta já existe.')</script>";
}
header('Location: index.php');
