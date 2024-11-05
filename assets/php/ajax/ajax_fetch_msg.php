<?php
include '../db.php';

$diaatual = '0/0';
while ($linha = mysqli_fetch_array($consulta_msg)) {
    $dia = date('d/m', strtotime($linha['dia']));

    if ($diaatual != $dia) {
?>
        <div class="dia"><?= $dia ?></div>
    <?php
        $diaatual = $dia;
    }
    if ($linha['id_user2'] == $_SESSION['id_user']) {
    ?>
        <div class="msg1">
            <div>
                <?= $linha['msg'] ?>
                <span class="inv">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
            </div>
            <div class="horas">
                <?= date('H:i', strtotime($linha['hora'])) ?>
            </div>
        </div>
    <?php
    } else {
    ?>
        <div class="msg2">
            <div>
                <input hidden class="msg-id" type="number" value="<?=$linha['id_msg']?>">
                <?= $linha['msg'] ?>
                <span class="inv">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</span>
            </div>          
            <div class="horas">
                <?= date('H:i', strtotime($linha['hora'])) ?>
            </div>
            <?php if ($linha['visto'] == 1) { ?>
                <i class="visto fa-solid fa-check"></i>
            <?php } ?>
        </div>
<?php
    }
}
