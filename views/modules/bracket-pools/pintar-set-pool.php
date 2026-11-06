<?php
/* ============================================================
   PINTA UN SET DE POOL QUE VIENE DE OTROS SETS
   Igual que en 32: si hay los dos jugadores, creo el preliminar
   y leo el resumen. Si falta uno, la caja enseña el texto de espera
   y al que ya ha llegado.
   Variables: $setLetra, $setCol, $setRow, $setSpan, $setRonda,
   $setEspera1, $setEspera2, $setSlot1, $setSlot2, $setTop16
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
$cajaTop16 = !empty($setTop16);
$cajaResumen = array("reportado" => false);

if (!empty($cajaId1) && !empty($cajaId2)) 
{
    $eliminatoria->ctrCrearPartidaPreliminar($cajaId1, $cajaId2, $_GET['id'], $cajaLetra, $_GET['pool']);
    $cajaResumen = $eliminatoria->ctrSacarResumenSet($_GET['id'], $cajaLetra, $_GET['pool']);
}

include(__DIR__ . "/caja-enfrentamiento.php");
unset($setLetra, $setCol, $setRow, $setSpan, $setRonda, $setEspera1, $setEspera2, $setSlot1, $setSlot2, $setTop16);
?>
