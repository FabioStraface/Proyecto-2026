<div id="match-report-modal" class="mm-overlay" hidden>
    <div class="mm-card" role="dialog" aria-modal="true" aria-labelledby="mr-round">
        <div class="mm-head">
            <button type="button" class="mm-close js-mm-close">&times; Close</button>
            <p id="mr-round" class="mm-round">Winners Semi-Final</p>
        </div>
        <p class="mm-sub">Ultimate Singles - Bracket - Pool A1</p>
        <div class="mm-score">
            <div class="mm-player mm-player-l">
                <span class="js-mr-seed1 mm-seed-tag"></span>
                <span class="js-mr-p1 mm-name">Player 1</span>
                <span class="mm-face" data-head="p1">❔</span>
            </div>
            <span class="mm-final">vs</span>
            <div class="mm-player mm-player-r">
                <span class="mm-face" data-head="p2">❔</span>
                <span class="js-mr-p2 mm-name">Player 2</span>
                <span class="js-mr-seed2 mm-seed-tag"></span>
            </div>
        </div>
        <form id="match-report-form" class="mm-form" action="" method="post">
            <!-- Datos del combate que el JS rellena al abrir el modal -->
            <input type="hidden" name="ronda_letra" id="mr-ronda-letra" value="">
            <input type="hidden" name="pools" id="mr-pools" value="">
            <input type="hidden" name="jugador1" id="mr-jugador1" value="">
            <input type="hidden" name="jugador2" id="mr-jugador2" value="">
            <input type="hidden" name="seed1" id="mr-seed1" value="">
            <input type="hidden" name="seed2" id="mr-seed2" value="">
            <p class="mm-form-help">Elige el personaje de cada jugador y quién ha ganado cada game.</p>
            <div id="mm-report-games" class="mm-games"></div>
            <div class="mm-form-actions">
                <button type="submit" class="mm-submit">Guardar resultado</button>
            </div>
        </form>
    </div>
</div>