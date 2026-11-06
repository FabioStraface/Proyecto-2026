<?php
/* ============================================================
   PINTA UN SET DE LA BRACKET FINAL (los datos ya están en $finalRes)
   ============================================================ */
$cajaLetra = $setLetra;
$cajaCol = $setCol;
$cajaRow = $setRow;
$cajaSpan = $setSpan;
$cajaRondaNombre = $setRonda;
$cajaEspera1 = $setEspera1;
$cajaEspera2 = $setEspera2;
$cajaId1 = $setSlot1['id'];
$cajaNom1 = $setSlot1['nombre'];
$cajaSeed1 = $setSlot1['seed'];
$cajaId2 = $setSlot2['id'];
$cajaNom2 = $setSlot2['nombre'];
$cajaSeed2 = $setSlot2['seed'];
$cajaPools = 0;
$cajaTop16 = false;
$cajaResumen = isset($finalRes[$setLetra]) ? $finalRes[$setLetra] : array("reportado" => false);
if (!empty($setFeed1)) 
{
    $cajaFeed1 = $setFeed1;
    $cajaFeed2 = $setFeed2;
}
include(__DIR__ . "/../bracket-pools/caja-enfrentamiento.php");
unset($setLetra, $setCol, $setRow, $setSpan, $setRonda, $setEspera1, $setEspera2, $setSlot1, $setSlot2, $setFeed1, $setFeed2);
?>
