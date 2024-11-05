<?php
session_start();
if (isset($_GET['amigo_selecionado'])) {
    $_SESSION['amigo_selecionado'] = $_GET['amigo_selecionado'];
}
