<?php
include './db.php';

$diaatual = '0/0';
while ($linha = mysqli_fetch_array($consulta_msg)) {
    $dia = date('d/m', strtotime($linha['dia']));

    if ($diaatual != $dia) {
        echo "<div class='dia'>" . $dia . "</div>";
        $diaatual = $dia;
    }
    if ($linha['id_user2'] == $_SESSION['id_user']) {
        echo "<div class='msg1'>";
        echo "<div>" . $linha['msg'] . "<span class='inv'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></div>";
        echo "<div class='horas'>" . date('H:i', strtotime($linha['hora'])) . "</div>";
        echo "</div>";
    } else {
        echo "<div class='msg2'>";
        echo "<div>" . $linha['msg'] . "<span class='inv'>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span></div>";
        echo "<div class='horas'>" . date('H:i', strtotime($linha['hora'])) . "</div>";
        echo "</div>";
    }
}
