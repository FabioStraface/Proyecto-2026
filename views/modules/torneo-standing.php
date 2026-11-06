<?php
/* ============================================================
   BLOQUE DE STANDING
   Posicionamiento: puesto + jugador + seed + W-L + % + pierde con.
   Participantes ($tpListaSimple): solo jugador y seed original.
   Buscador y 8 por pagina en los dos.
   ============================================================ */
if (!function_exists("tpFotoJugador")) 
{
    function tpFotoJugador($img)
    {
        $nombre = $img ? $img : "default.png";
        $faces = "admin/views/images/faces/".$nombre;
        if (is_file($faces)) 
        {
            return $faces;
        }

        return "views/assets/img/blog/default.png";
    }
}

$tpListaSimple = !empty($tpListaSimple);
$tpClaseCard = $tpListaSimple ? "tp-card tp-card-lista" : "tp-card";
?>
<section class="bg-[#f4f6f8] px-4 py-10 font-sans md:py-14">
    <div class="mx-auto max-w-[1100px]">
        <article class="<?= $tpClaseCard ?>">
            <div class="tp-search-wrap">
                <span class="tp-search-ico" aria-hidden="true">⌕</span>
                <input class="tp-search" id="tp-buscar" type="search" placeholder="Search players..." autocomplete="off">
            </div>
            <div class="tp-stand-head">
                <?php
                    if (!$tpListaSimple) 
                    {
                ?>
                <span></span>
                <?php
                    }
                ?>
                <span class="tp-col-player">jugador</span>
                <span class="tp-col-seed">seed</span>
                <?php
                    if (!$tpListaSimple) 
                    {
                ?>
                <span class="tp-col-num">victorias</span>
                <span class="tp-col-num">derrotas</span>
                <span class="tp-col-pct">% victorias</span>
                <span class="tp-col-lost">pierde con</span>
                <?php
                    }
                ?>
            </div>
            <ol class="tp-stand-list" id="tp-stand-list">
                <?php
                    $puesto = 1;
                    foreach ($standing as $fila) 
                    {
                        $nick = htmlspecialchars((string) $fila['usuario'], ENT_QUOTES, 'UTF-8');
                        $foto = tpFotoJugador($fila['img']);
                        $jugados = $fila['wins'] + $fila['losses'];
                        $pct = ($jugados > 0) ? number_format(($fila['wins'] / $jugados) * 100, 2, '.', '') : "0.00";
                        $lostNicks = is_array($fila['lostTo']) ? $fila['lostTo'] : array();
                ?>
                <li class="tp-stand-row" data-nick="<?= strtolower($nick) ?>">
                    <?php
                        if (!$tpListaSimple) 
                        {
                    ?>
                    <span class="tp-rank"><?= $puesto ?></span>
                    <?php
                        }
                    ?>
                    <span class="tp-player">
                        <img class="tp-avatar" src="<?= htmlspecialchars($foto, ENT_QUOTES, 'UTF-8') ?>" alt="">
                        <strong><?= $nick ?></strong>
                    </span>
                    <span class="tp-col-seed">#<?= (int) $fila['seed'] ?></span>
                    <?php
                        if (!$tpListaSimple) 
                        {
                    ?>
                    <span class="tp-col-num"><?= (int) $fila['wins'] ?></span>
                    <span class="tp-col-num"><?= (int) $fila['losses'] ?></span>
                    <span class="tp-col-pct"><?= $pct ?>%</span>
                    <span class="tp-col-lost">
                        <?php
                            foreach ($lostNicks as $iLost => $nickLost) 
                            {
                                if ($iLost > 0) 
                                {
                                    echo " - ";
                                }
                                echo htmlspecialchars((string) $nickLost, ENT_QUOTES, 'UTF-8');
                            }
                        ?>
                    </span>
                    <?php
                        }
                    ?>
                </li>
                <?php
                        $puesto++;
                    }
                ?>
            </ol>
            <nav class="tp-pager" id="tp-pager-stand" aria-label="Paginacion del standing"></nav>
        </article>
    </div>
</section>
