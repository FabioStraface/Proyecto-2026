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
    //var_dump($Asistentes);
    $valor = $torneo->ctrSacarTorneo($_GET['id']); //Saca todos los datos del torneo correspondiente
    $fechaActual = date("d/m/Y");
    $fechaInicio = date("d/m/Y", strtotime($valor['fecha_inicio']));
    $fechaFinal = date("d/m/Y", strtotime($valor['fecha_fin']));
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
                <a href="#">
                    <li class="m-0 flex flex-col gap-3 px-5 py-4 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                        <div class="min-w-[120px]">
                            <strong class="block text-base font-semibold text-gray-900">Pool A1</strong>
                            <span class="mt-0.5 block text-sm font-normal text-gray-400">Complete</span>
                        </div>
                        <div class="flex min-w-0 flex-1 flex-wrap items-center justify-start gap-x-4 gap-y-2 md:justify-end">
                            <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="truncate">GameOverGlitch</span>
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="truncate">Aleloco8</span>
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="truncate">BH/S...</span>
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="truncate">PlatiniumK</span>
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                                <span class="truncate">LREX D-Stunk</span>
                                <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                            </span>
                            <span class="text-sm font-normal text-gray-400">+6 more</span>
                        </div>
                    </li>
                </a>
                <li class="m-0 flex flex-col gap-3 px-5 py-4 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold text-gray-900">Pool A2</strong>
                        <span class="mt-0.5 block text-sm font-normal text-gray-400">Complete</span>
                    </div>
                    <div class="flex min-w-0 flex-1 flex-wrap items-center justify-start gap-x-4 gap-y-2 md:justify-end">
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">GPIM...</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Manolo</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">M&amp;Ms Andalus</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">PTK/L3 Bruh normaloso</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Matt_Odyssey</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="text-sm font-normal text-gray-400">+5 more</span>
                    </div>
                </li>
                <li class="m-0 flex flex-col gap-3 px-5 py-4 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold text-gray-900">Pool B1</strong>
                        <span class="mt-0.5 block text-sm font-normal text-gray-400">Complete</span>
                    </div>
                    <div class="flex min-w-0 flex-1 flex-wrap items-center justify-start gap-x-4 gap-y-2 md:justify-end">
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">FULLY...</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">FabioStraface</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Fen</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Hi I'm...</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Spark~</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">MW Fnandix</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="text-sm font-normal text-gray-400">+5 more</span>
                    </div>
                </li>
                <li class="m-0 flex flex-col gap-3 px-5 py-4 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold text-gray-900">Pool B2</strong>
                        <span class="mt-0.5 block text-sm font-normal text-gray-400">Complete</span>
                    </div>
                    <div class="flex min-w-0 flex-1 flex-wrap items-center justify-start gap-x-4 gap-y-2 md:justify-end">
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">KK avioneta</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">VTG Shirogane</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">PTK HitokiriHimura99</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">MSHN Pinaperson</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="text-sm font-normal text-gray-400">+6 more</span>
                    </div>
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
                <li class="m-0 flex flex-col gap-3 px-5 py-4 md:flex-row md:items-center md:justify-between md:gap-6 md:px-6">
                    <div class="min-w-[120px]">
                        <strong class="block text-base font-semibold text-gray-900">Pool 1</strong>
                        <span class="mt-0.5 block text-sm font-normal text-gray-400">Complete</span>
                    </div>
                    <div class="flex min-w-0 flex-1 flex-wrap items-center justify-start gap-x-4 gap-y-2 md:justify-end">
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">GPIM...</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">Manolo</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">KK avioneta</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">FULLY...</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">FabioStraface</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="inline-flex max-w-[210px] items-center gap-1.5 text-sm font-semibold text-gray-800">
                            <span class="truncate">VTG Shirogane</span>
                            <span class="inline-flex h-4 w-4 shrink-0 items-center justify-center rounded-full bg-[#16a34a] text-white"><svg class="block h-2.5 w-2.5" viewBox="0 0 12 12" fill="none"><path d="M2.5 6.2L4.8 8.5L9.5 3.5" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/></svg></span>
                        </span>
                        <span class="text-sm font-normal text-gray-400">+12 more</span>
                    </div>
                </li>
            </ul>
        </article>

    </div>
</section>
