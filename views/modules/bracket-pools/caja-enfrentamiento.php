<?php
/* ============================================================
   CAJA DE ENFRENTAMIENTO DEL CUADRO
   Variables que espera:
   - $cajaLetra, $cajaCol, $cajaRow, $cajaSpan
   - $cajaRondaNombre
   - $cajaEspera1, $cajaEspera2  (textos si aún no hay jugadores)
   - $cajaId1, $cajaId2, $cajaNom1, $cajaNom2, $cajaSeed1, $cajaSeed2
   - $cajaResumen  (resultado de ctrSacarResumenSet)
   - $cajaTop16    (true para pintar la línea + Top 16)
   - $cajaTop16Href, $cajaPools
   - $cajaFeed1, $cajaFeed2 (pills de origen, opcional)
   ============================================================ */

$cajaHay1 = !empty($cajaId1);
$cajaHay2 = !empty($cajaId2);
$cajaListos = $cajaHay1 && $cajaHay2;
$cajaReportado = $cajaListos && !empty($cajaResumen['reportado']);
$cajaNom1Safe = htmlspecialchars((string) $cajaNom1, ENT_QUOTES, 'UTF-8');
$cajaNom2Safe = htmlspecialchars((string) $cajaNom2, ENT_QUOTES, 'UTF-8');
$cajaEspera1Safe = htmlspecialchars((string) $cajaEspera1, ENT_QUOTES, 'UTF-8');
$cajaEspera2Safe = htmlspecialchars((string) $cajaEspera2, ENT_QUOTES, 'UTF-8');

/* Pool del set: en pools 1-4, en la final 0 */
if (!isset($cajaPools)) 
{
    $cajaPools = isset($_GET['pool']) ? (int) $_GET['pool'] : 0;
}

/* Enlace Top 16: bracket final con el torneo y la pool de origen */
if (!isset($cajaTop16Href)) 
{
    $poolEnlace = isset($_GET['pool']) ? (int) $_GET['pool'] : 1;
    $cajaTop16Href = "bracket-final&id=".(int) $_GET['id']."&pool=".$poolEnlace;
}

/* Pills a la izquierda: de qué bracket viene cada lado.
   Cada pill es un enlace a su pool (A1=1, A2=2, B1=3, B2=4). */
if (!empty($cajaFeed1) || !empty($cajaFeed2)) 
{
    $mapaFeedPool = array(
        "Bracket A1" => 1,
        "Bracket A2" => 2,
        "Bracket B1" => 3,
        "Bracket B2" => 4
    );
    $idTorneoFeed = isset($_GET['id']) ? (int) $_GET['id'] : 0;
    $feedsCaja = array($cajaFeed1, $cajaFeed2);
?>
<div class="bp-feed bp-c1 bp-r<?= (int) $cajaRow ?> bp-s<?= (int) $cajaSpan ?>">
    <?php
        foreach ($feedsCaja as $textoFeed) 
        {
            $textoFeedSafe = htmlspecialchars((string) $textoFeed, ENT_QUOTES, 'UTF-8');
            $poolFeed = isset($mapaFeedPool[$textoFeed]) ? (int) $mapaFeedPool[$textoFeed] : 0;
    ?>
    <div class="bp-feed-line">
        <?php
            if ($poolFeed > 0 && $idTorneoFeed > 0) 
            {
        ?>
        <a class="bp-pill" href="bracket-pools&id=<?= $idTorneoFeed ?>&pool=<?= $poolFeed ?>"><?= $textoFeedSafe ?></a>
        <?php
            }
            else 
            {
        ?>
        <span class="bp-pill"><?= $textoFeedSafe ?></span>
        <?php
            }
        ?>
    </div>
    <?php
        }
    ?>
</div>
<?php
}
?>
<div class="bp-cell bp-c<?= (int) $cajaCol ?> bp-r<?= (int) $cajaRow ?> bp-s<?= (int) $cajaSpan ?>"><span class="bp-tag"><?= htmlspecialchars($cajaLetra, ENT_QUOTES, 'UTF-8') ?></span>
<?php
    /* Uno o los dos todavía no han llegado: enseño al que ya avanzó */
    if (!$cajaListos) 
    {
?>
    <a href="#" class="bracket-match rounded-md border border-gray-200 bg-white shadow-sm">
        <div class="bp-row border-b border-gray-100">
            <?php if ($cajaHay1) { ?>
                <span class="bp-seed"><?= (int) $cajaSeed1 ?></span>
                <span class="bp-name font-semibold text-slate-800"><?= $cajaNom1Safe ?></span>
            <?php } else { ?>
                <span class="bp-wait"><?= $cajaEspera1Safe ?></span>
            <?php } ?>
        </div>
        <div class="bp-row">
            <?php if ($cajaHay2) { ?>
                <span class="bp-seed"><?= (int) $cajaSeed2 ?></span>
                <span class="bp-name font-semibold text-slate-800"><?= $cajaNom2Safe ?></span>
            <?php } else { ?>
                <span class="bp-wait"><?= $cajaEspera2Safe ?></span>
            <?php } ?>
        </div>
    </a>
<?php
    }
    /* Set reportado: modal de resultados + marcador de games y personaje */
    elseif ($cajaReportado) 
    {
        $wins1 = (int) $cajaResumen['wins1'];
        $wins2 = (int) $cajaResumen['wins2'];
        $icono1 = $cajaResumen['icono1'];
        $icono2 = $cajaResumen['icono2'];
        $claseNom1 = ($cajaResumen['ganador'] == $cajaId1) ? 'bp-name font-semibold text-slate-800' : 'bp-name font-medium text-gray-500';
        $claseNom2 = ($cajaResumen['ganador'] == $cajaId2) ? 'bp-name font-semibold text-slate-800' : 'bp-name font-medium text-gray-500';
        $claseSc1 = ($wins1 > $wins2) ? 'bp-sc bp-win' : 'bp-sc bp-lose';
        $claseSc2 = ($wins2 > $wins1) ? 'bp-sc bp-win' : 'bp-sc bp-lose';
        $gamesAttr = htmlspecialchars($cajaResumen['games_attr'], ENT_QUOTES, 'UTF-8');

        /* Record de sets hasta ESTE cuadro (incluido), no el total final */
        $record1 = "";
        $record2 = "";
        if (isset($eliminatoria) && isset($_GET['id'])) 
        {
            $record1 = $eliminatoria->ctrSacarRecordSets($cajaId1, $_GET['id'], $cajaLetra, $cajaPools);
            $record2 = $eliminatoria->ctrSacarRecordSets($cajaId2, $_GET['id'], $cajaLetra, $cajaPools);
        }
?>
    <a href="#match-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
        data-mode="result"
        data-round="<?= htmlspecialchars($cajaRondaNombre, ENT_QUOTES, 'UTF-8') ?>"
        data-p1="<?= $cajaNom1Safe ?>"
        data-p2="<?= $cajaNom2Safe ?>"
        data-s1="<?= $wins1 ?>"
        data-s2="<?= $wins2 ?>"
        data-seed1="<?= (int) $cajaSeed1 ?>"
        data-seed2="<?= (int) $cajaSeed2 ?>"
        data-rec1="<?= htmlspecialchars($record1, ENT_QUOTES, 'UTF-8') ?>"
        data-rec2="<?= htmlspecialchars($record2, ENT_QUOTES, 'UTF-8') ?>"
        data-ico1="<?= htmlspecialchars($icono1, ENT_QUOTES, 'UTF-8') ?>"
        data-ico2="<?= htmlspecialchars($icono2, ENT_QUOTES, 'UTF-8') ?>"
        data-games="<?= $gamesAttr ?>">
        <div class="bp-row border-b border-gray-100">
            <span class="bp-seed"><?= (int) $cajaSeed1 ?></span>
            <span class="<?= $claseNom1 ?>"><?= $cajaNom1Safe ?></span>
            <span class="bp-ico"><?= $icono1 ?></span>
            <span class="<?= $claseSc1 ?>"><?= $wins1 ?></span>
        </div>
        <div class="bp-row">
            <span class="bp-seed"><?= (int) $cajaSeed2 ?></span>
            <span class="<?= $claseNom2 ?>"><?= $cajaNom2Safe ?></span>
            <span class="bp-ico"><?= $icono2 ?></span>
            <span class="<?= $claseSc2 ?>"><?= $wins2 ?></span>
        </div>
    </a>
<?php
    }
    /* Jugadores listos pero sin reportar: formulario.
       data-char1/2 = último personaje de cada uno en este torneo. */
    else 
    {
        $ultimoChar1 = "";
        $ultimoChar2 = "";
        if (isset($eliminatoria) && isset($_GET['id'])) 
        {
            $ultimoChar1 = $eliminatoria->ctrSacarUltimoPersonaje($cajaId1, $_GET['id']);
            $ultimoChar2 = $eliminatoria->ctrSacarUltimoPersonaje($cajaId2, $_GET['id']);
        }
?>
    <a href="#match-report-modal" class="js-match-modal bracket-match rounded-md border border-gray-200 bg-white shadow-sm"
        data-mode="report"
        data-round="<?= htmlspecialchars($cajaRondaNombre, ENT_QUOTES, 'UTF-8') ?>"
        data-p1="<?= $cajaNom1Safe ?>"
        data-p2="<?= $cajaNom2Safe ?>"
        data-ronda="<?= htmlspecialchars($cajaLetra, ENT_QUOTES, 'UTF-8') ?>"
        data-pools="<?= (int) $cajaPools ?>"
        data-j1="<?= (int) $cajaId1 ?>"
        data-j2="<?= (int) $cajaId2 ?>"
        data-seed1="<?= (int) $cajaSeed1 ?>"
        data-seed2="<?= (int) $cajaSeed2 ?>"
        data-char1="<?= htmlspecialchars((string) $ultimoChar1, ENT_QUOTES, 'UTF-8') ?>"
        data-char2="<?= htmlspecialchars((string) $ultimoChar2, ENT_QUOTES, 'UTF-8') ?>">
        <div class="bp-row border-b border-gray-100">
            <span class="bp-seed"><?= (int) $cajaSeed1 ?></span>
            <span class="bp-name font-semibold text-slate-800"><?= $cajaNom1Safe ?></span>
        </div>
        <div class="bp-row">
            <span class="bp-seed"><?= (int) $cajaSeed2 ?></span>
            <span class="bp-name font-semibold text-slate-800"><?= $cajaNom2Safe ?></span>
        </div>
    </a>
<?php
    }

    if (!empty($cajaTop16)) 
    {
?>
    <span class="ml-2 w-8 shrink-0 border-t border-dashed border-gray-300"></span><a href="<?= htmlspecialchars($cajaTop16Href, ENT_QUOTES, 'UTF-8') ?>" class="bp-top">Top 16</a>
<?php
    }
?>
</div>
<?php
    /* Limpio variables para que la siguiente caja no herede valores */
    unset($cajaLetra, $cajaCol, $cajaRow, $cajaSpan, $cajaRondaNombre, $cajaEspera1, $cajaEspera2, $cajaId1, $cajaId2, $cajaNom1, $cajaNom2, $cajaSeed1, $cajaSeed2, $cajaResumen, $cajaTop16, $cajaTop16Href, $cajaPools, $cajaFeed1, $cajaFeed2);
?>
