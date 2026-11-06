<?php
/* ============================================================
   SEGUNDO NAVBAR DEL TORNEO
   Va debajo del bloque azul. Pools, Top 16, Participantes
   y Posicionamiento (este ultimo solo si estado = true).
   ============================================================ */
$idNavTorneo = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$rutaNav = isset($_GET['ruta']) ? $_GET['ruta'] : "";
$torneoCerradoNav = !empty($valor['estado']);

$clasePools = ($rutaNav == "torneo-resumen" || $rutaNav == "bracket-pools") ? "tnav-link tnav-on" : "tnav-link";
$claseTop16 = ($rutaNav == "bracket-final") ? "tnav-link tnav-on" : "tnav-link";
$clasePart = ($rutaNav == "torneo-participantes") ? "tnav-link tnav-on" : "tnav-link";
$clasePos = ($rutaNav == "torneo-posicionamiento") ? "tnav-link tnav-on" : "tnav-link";
?>
<nav class="tnav" aria-label="Navegacion del torneo">
    <a class="<?= $clasePools ?>" href="torneo-resumen&id=<?= $idNavTorneo ?>">Pools</a>
    <a class="<?= $claseTop16 ?>" href="bracket-final&id=<?= $idNavTorneo ?>">Bracket Top 16</a>
    <a class="<?= $clasePart ?>" href="torneo-participantes&id=<?= $idNavTorneo ?>">Participantes</a>
    <?php
        if ($torneoCerradoNav) 
        {
    ?>
    <a class="<?= $clasePos ?>" href="torneo-posicionamiento&id=<?= $idNavTorneo ?>">Posicionamiento</a>
    <?php
        }
    ?>
</nav>
