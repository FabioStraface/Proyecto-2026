<?php
/* ============================================================
   PREPARO TODOS LOS SETS DE LA FINAL ANTES DE PINTAR
   Así G, H y W ya tienen datos aunque en el HTML
   winners se pinte antes que losers.
   pools = 0 = bracket final (no es pool 1-4).
   ============================================================ */

$idTorneoFinal = $_GET['id'];
$finalRes = array();
$poolRes = array();

/* 32: E/F winners e I/J losers. 64: M/N winners y AB/AC losers */
$datosTorneoFinal = $torneo->ctrSacarTorneo($idTorneoFinal);
$letrasSalidaPool = array("E" => "E", "F" => "F", "I" => "I", "J" => "J");
if (!empty($datosTorneoFinal['max_entrant']) && (int) $datosTorneoFinal['max_entrant'] == 64) 
{
    $letrasSalidaPool = array("E" => "M", "F" => "N", "I" => "AB", "J" => "AC");
}

for ($p = 1; $p <= 4; $p++) 
{
    $poolRes[$p] = array(
        "E" => $eliminatoria->ctrSacarResumenSet($idTorneoFinal, $letrasSalidaPool["E"], $p),
        "F" => $eliminatoria->ctrSacarResumenSet($idTorneoFinal, $letrasSalidaPool["F"], $p),
        "I" => $eliminatoria->ctrSacarResumenSet($idTorneoFinal, $letrasSalidaPool["I"], $p),
        "J" => $eliminatoria->ctrSacarResumenSet($idTorneoFinal, $letrasSalidaPool["J"], $p)
    );
}

/* Guardo un set de la final si ya hay dos jugadores */
function asegurarSetFinal($letra, $slot1, $slot2, $eliminatoria, $idTorneoFinal, &$finalRes)
{
    if (!empty($slot1['id']) && !empty($slot2['id'])) 
    {
        $eliminatoria->ctrCrearPartidaPreliminar($slot1['id'], $slot2['id'], $idTorneoFinal, $letra, 0);
    }
    $finalRes[$letra] = $eliminatoria->ctrSacarResumenSet($idTorneoFinal, $letra, 0);
}

/* QF winners: dos clasificados de la misma pool */
asegurarSetFinal("A",
    $eliminatoria->ctrCargarSlot($poolRes[1]['E'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[1]['F'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("B",
    $eliminatoria->ctrCargarSlot($poolRes[4]['E'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[4]['F'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("C",
    $eliminatoria->ctrCargarSlot($poolRes[2]['E'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[2]['F'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("D",
    $eliminatoria->ctrCargarSlot($poolRes[3]['E'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[3]['F'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers R1: cruce de pools de la imagen */
asegurarSetFinal("J",
    $eliminatoria->ctrCargarSlot($poolRes[4]['I'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[2]['I'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("K",
    $eliminatoria->ctrCargarSlot($poolRes[1]['I'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[3]['I'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("L",
    $eliminatoria->ctrCargarSlot($poolRes[3]['J'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[1]['J'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("M",
    $eliminatoria->ctrCargarSlot($poolRes[2]['J'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($poolRes[4]['J'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Winners SF */
asegurarSetFinal("E",
    $eliminatoria->ctrCargarSlot($finalRes['A'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['B'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("F",
    $eliminatoria->ctrCargarSlot($finalRes['C'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['D'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers R2 */
asegurarSetFinal("N",
    $eliminatoria->ctrCargarSlot($finalRes['D'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['J'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("O",
    $eliminatoria->ctrCargarSlot($finalRes['C'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['K'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("P",
    $eliminatoria->ctrCargarSlot($finalRes['B'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['L'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("Q",
    $eliminatoria->ctrCargarSlot($finalRes['A'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['M'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers R3 */
asegurarSetFinal("R",
    $eliminatoria->ctrCargarSlot($finalRes['N'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['O'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("S",
    $eliminatoria->ctrCargarSlot($finalRes['P'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['Q'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers QF */
asegurarSetFinal("T",
    $eliminatoria->ctrCargarSlot($finalRes['E'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['R'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);
asegurarSetFinal("U",
    $eliminatoria->ctrCargarSlot($finalRes['F'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['S'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers SF */
asegurarSetFinal("V",
    $eliminatoria->ctrCargarSlot($finalRes['T'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['U'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Winners Final */
asegurarSetFinal("G",
    $eliminatoria->ctrCargarSlot($finalRes['E'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['F'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Losers Final */
asegurarSetFinal("W",
    $eliminatoria->ctrCargarSlot($finalRes['G'], "perdedor", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['V'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* Grand Final */
asegurarSetFinal("H",
    $eliminatoria->ctrCargarSlot($finalRes['G'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria->ctrCargarSlot($finalRes['W'], "ganador", $usuario, $torneo, $idTorneoFinal),
    $eliminatoria, $idTorneoFinal, $finalRes);

/* ============================================================
   GRAND FINAL RESET (X)
   Solo si H ya esta reportado y gano el que venia de W
   (el ganador de H no es el ganador de G).
   ============================================================ */
$hayResetGrandFinal = !empty($finalRes['H']['reportado'])
    && !empty($finalRes['G']['ganador'])
    && $finalRes['H']['ganador'] != $finalRes['G']['ganador'];

if ($hayResetGrandFinal) 
{
    asegurarSetFinal("X",
        $eliminatoria->ctrCargarSlot($finalRes['G'], "ganador", $usuario, $torneo, $idTorneoFinal),
        $eliminatoria->ctrCargarSlot($finalRes['W'], "ganador", $usuario, $torneo, $idTorneoFinal),
        $eliminatoria, $idTorneoFinal, $finalRes);
}
else 
{
    $finalRes['X'] = array("reportado" => false);
}
?>
