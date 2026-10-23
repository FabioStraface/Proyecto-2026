<?php include("cabecera.php"); ?>

<!-- START SECTION TOP -->
    <section class="section-top" style="background-image: url(views/assets/img/bg/section-top.png);background-size:cover; background-position: center center;">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-xs-12 text-center">
                <div class="section-top-title">
                    <h1>Bracket Pools</h1>		
                </div>
                </div><!--- END COL -->				  
            </div><!--- END ROW -->
        </div><!--- END CONTAINER -->
    </section>
    <!-- END SECTION TOP -->

<?php
    $torneo = new TorneoController();
    $Asistentes = $torneo->ctrSacarTotalAsistentes($_GET['id']); //Esto saca todos los usuarios apuntados a este torneo
    $valor = $torneo->ctrSacarTorneo($_GET['id']); //Saca todos los datos del torneo correspondiente

    // Fechas actuales y del torneo
    $fechaActual = date("d/m/Y");
    $fechaInicio = date("d/m/Y", strtotime($valor['fecha_inicio']));
    $fechaFinal = date("d/m/Y", strtotime($valor['fecha_fin']));

    //Pools
    $pools = $torneo->ctrSacarPools($_GET['id']);
?>

<section class="bg-[#f4f6f8] px-4 py-10 font-sans md:py-14">
    <div class="mx-auto max-w-[1100px] space-y-6">
        <!-- POOLS -->
        <article class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 px-5 py-5 sm:flex-row sm:items-start sm:justify-between sm:px-6">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="m-0 font-sans text-[22px] leading-tight font-bold text-gray-900">Bracket Pools</h2>
                        <?php
                            if ($fechaInicio > $fechaActual) 
                            {
                        ?>
                        <span class="rounded bg-gray-500 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white uppercase">Sin iniciar</span>
                        <?php
                            }
                            elseif ($fechaFinal < $fechaActual) 
                            {
                        ?>
                        <span class="rounded bg-gray-500 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white uppercase">Completado</span>
                        <?php
                            }
                            else 
                            {
                        ?>
                        <span class="rounded bg-gray-500 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white uppercase">En curso</span>
                        <?php
                            }
                        ?>
                    </div>
                    <?php
                        if ($valor['max_entrant'] == 32) 
                        {
                    ?>
                    <p class="mt-1.5 text-sm font-normal text-gray-500"><?= $Asistentes ?> Asistentes · 4 pools · Doble Eliminación · 4/Pool de Top 8</p>                    
                    <?php
                        }
                        elseif ($valor['max_entrant'] == 64) 
                        {
                    ?>
                    <p class="mt-1.5 text-sm font-normal text-gray-500"><?= $Asistentes ?> Asistentes · 4 pools · Doble Eliminación · 4/Pool de Top 16</p>                    
                    <?php
                        }
                        else 
                        {
                    ?>
                    <p class="mt-1.5 text-sm font-normal text-gray-500"><?= $Asistentes ?> Asistentes · 8 pools · Doble Eliminación · 8/Pool de Top 16</p>                                        
                    <?php
                        }
                    ?>
                </div>
                <a href="bracket-pools" class="shrink-0 text-sm font-medium whitespace-nowrap !text-[#3b82f6] no-underline hover:!text-[#2563eb] hover:underline">Ver las 4 pools</a>
            </div>
            
            <ul class="m-0 list-none divide-y divide-gray-200 border-t border-gray-200 p-0">
                <?php
                    /*foreach ($pools as $key => $pool) 
                    {*/
                ?>
                <li class="m-0">
                    <a href="bracket-pools&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                        <div class="min-w-[120px]">
                            <strong class="block text-base font-semibold">Pool A1</strong>
                            <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                        </div>
                        <div class="pool-player-list">
                            <span class="pool-player">
                                <span>GameOverGlitch</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>Aleloco8</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>PlatiniumK</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>LREX D-Stunk</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-muted shrink-0 text-sm font-normal">+4 más</span>
                        </div>
                    </a>
                </li>
                <?php
                    //}
                ?>
                <li class="m-0">
                    <a href="bracket-pools&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                        <div class="min-w-[120px]">
                            <strong class="block text-base font-semibold">Pool A1</strong>
                            <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                        </div>
                        <div class="pool-player-list">
                            <span class="pool-player">
                                <span>GameOverGlitch</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>Aleloco8</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>PlatiniumK</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-player">
                                <span>LREX D-Stunk</span>
                                <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="pool-muted shrink-0 text-sm font-normal">+4 más</span>
                        </div>
                    </a>
                </li>
                <li class="m-0">
                    <a href="bracket-pools&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold">Pool A2</strong>
                        <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                    </div>
                    <div class="pool-player-list">
                        <span class="pool-player">
                            <span>Manolo</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>M&amp;Ms Andalus</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>PTK/L3 Bruh normaloso</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>Matt_Odyssey</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-muted shrink-0 text-sm font-normal">+5 more</span>
                    </div>
                    </a>
                </li>
                <li class="m-0">
                    <a href="bracket-pools&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold">Pool B1</strong>
                        <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                    </div>
                    <div class="pool-player-list">
                        <span class="pool-player">
                            <span>FabioStraface</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>Fen</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>Spark~</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>MW Fnandix</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-muted shrink-0 text-sm font-normal">+5 more</span>
                    </div>
                    </a>
                </li>
                <li class="m-0">
                    <a href="bracket-pools&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold">Pool B2</strong>
                        <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                    </div>
                    <div class="pool-player-list">
                        <span class="pool-player">
                            <span>KK avioneta</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>VTG Shirogane</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>PTK HitokiriHimura99</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>MSHN Pinaperson</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-muted shrink-0 text-sm font-normal">+6 more</span>
                    </div>
                    </a>
                </li>
            </ul>
        </article>
        <!-- TOP 8 -->
        <article class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">
            <div class="flex flex-col gap-3 px-5 py-5 sm:flex-row sm:items-start sm:justify-between sm:px-6">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="m-0 font-sans text-[22px] leading-tight font-bold text-gray-900">Top 16</h2>
                        <span class="rounded bg-gray-500 px-2 py-0.5 text-[10px] font-bold tracking-wide text-white uppercase">Complete</span>
                    </div>
                    <p class="mt-1.5 text-sm font-normal text-gray-500">16 entrants · 1 pools · Double Elimination</p>
                </div>
                <a href="bracket-final" class="shrink-0 text-sm font-medium whitespace-nowrap !text-[#3b82f6] no-underline hover:!text-[#2563eb] hover:underline">View All 1 pools</a>
            </div>

            <ul class="m-0 list-none divide-y divide-gray-200 border-t border-gray-200 p-0">
                <li class="m-0">
                    <a href="bracket-final&id=<?= $_GET['id'] ?>" class="pool-card-link flex flex-col gap-3 px-5 py-4 font-sans no-underline hover:bg-gray-50 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold">Pool 1</strong>
                        <span class="pool-muted mt-0.5 block text-sm font-normal">Complete</span>
                    </div>
                    <div class="pool-player-list">
                        <span class="pool-player">
                            <span>Manolo</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>KK avioneta</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>FabioStraface</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-player">
                            <span>VTG Shirogane</span>
                            <span class="pool-check inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a]"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="pool-muted shrink-0 text-sm font-normal">+12 more</span>
                    </div>
                    </a>
                </li>
            </ul>
        </article>

    </div>
</section>
