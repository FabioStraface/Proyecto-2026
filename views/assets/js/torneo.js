(function() {
    var CHARACTERS = [
        { id: "1", name: "Fabio", icon: "😊" },
        { id: "2", name: "Mario", icon: "🍄" },
        { id: "3", name: "Jonny Bravo", icon: "😎" },
        { id: "4", name: "Agallas el perro cobarde", icon: "🐶" },
        { id: "5", name: "Superman", icon: "🦸" },
        { id: "6", name: "Spiderman", icon: "🕷️" },
        { id: "7", name: "Vinicius", icon: "⚽" }
    ];

    var resultModal = document.getElementById("match-modal");
    var reportModal = document.getElementById("match-report-modal");
    var reportForm = document.getElementById("match-report-form");
    var reportGames = document.getElementById("mm-report-games");

    function characterOptions() {
        return CHARACTERS.map(function(c) {
            return '<option value="' + c.id + '" data-icon="' + c.icon + '">' + c.icon + " " + c.name + "</option>";
        }).join("");
    }

    function characterIcon(id) {
        var found = CHARACTERS.filter(function(c) { return c.id === id; })[0];
        return found ? found.icon : "❔";
    }

    function renderReportGames() {
        if (!reportGames) return;
        var html = "";
        var opts = '<option value="">Personaje</option>' + characterOptions();
        for (var i = 1; i <= 5; i++) {
            /* Los dos lados: select, luego icono y el nombre debajo */
            html +=
                '<div class="mm-game mm-game-report" data-game="' + i + '">' +
                '<div class="mm-side mm-side-l">' +
                '<select name="game' + i + '_p1_char" class="mm-char" data-face="g' + i + '-p1" required>' + opts + "</select>" +
                '<label class="mm-pick">' +
                '<input type="radio" name="game' + i + '" value="p1" required>' +
                '<span class="mm-face" data-face="g' + i + '-p1">❔</span>' +
                '<span class="js-mr-p1 mm-pick-name">Player 1</span>' +
                "</label>" +
                "</div>" +
                '<div class="mm-g-mid">Game ' + i + "</div>" +
                '<div class="mm-side mm-side-r">' +
                '<select name="game' + i + '_p2_char" class="mm-char" data-face="g' + i + '-p2" required>' + opts + "</select>" +
                '<label class="mm-pick">' +
                '<input type="radio" name="game' + i + '" value="p2">' +
                '<span class="mm-face" data-face="g' + i + '-p2">❔</span>' +
                '<span class="js-mr-p2 mm-pick-name">Player 2</span>' +
                "</label>" +
                "</div>" +
                "</div>";
        }
        reportGames.innerHTML = html;
        reportGames.querySelectorAll(".mm-char").forEach(function(select) {
            select.addEventListener("change", function() {
                var key = select.getAttribute("data-face");
                var icon = characterIcon(select.value);
                reportGames.querySelectorAll('.mm-face[data-face="' + key + '"]').forEach(function(face) {
                    face.textContent = icon;
                });
                if (select.name.indexOf("_p1_char") !== -1) {
                    var h1 = reportModal.querySelector('.mm-face[data-head="p1"]');
                    if (h1) h1.textContent = icon;
                }
                if (select.name.indexOf("_p2_char") !== -1) {
                    var h2 = reportModal.querySelector('.mm-face[data-head="p2"]');
                    if (h2) h2.textContent = icon;
                }
            });
            select.addEventListener("click", function(e) {
                e.stopPropagation();
            });
        });
    }

    function actualizarGames() {
        if (!reportGames) return;

        var victoriasP1 = 0;
        var victoriasP2 = 0;
        var permitirSiguiente = true;

        reportGames.querySelectorAll(".mm-game-report").forEach(function(game) {

            var radioP1 = game.querySelector('input[value="p1"]');
            var radioP2 = game.querySelector('input[value="p2"]');

            var selects = game.querySelectorAll("select");

            if (!permitirSiguiente || victoriasP1 === 3 || victoriasP2 === 3) {
                game.hidden = true;

                game.querySelectorAll("input, select").forEach(function(campo) {
                    campo.disabled = true;
                    campo.required = false;
                });

                return;
            }

            game.hidden = false;

            game.querySelectorAll("input, select").forEach(function(campo) {
                campo.disabled = false;
            });

            selects.forEach(function(select) {
                select.required = true;
            });

            radioP1.required = true;

            if (radioP1.checked) {
                victoriasP1++;
            } else if (radioP2.checked) {
                victoriasP2++;
            } else {
                permitirSiguiente = false;
            }

        });

        /* Tras elegir ganador, el siguiente game hereda los personajes del anterior */
        copiarPersonajesHaciaGamesNuevos();
    }

    function copiarPersonajesHaciaGamesNuevos() {
        if (!reportGames) return;

        var ultimoP1 = "";
        var ultimoP2 = "";

        reportGames.querySelectorAll(".mm-game-report").forEach(function(game) {
            if (game.hidden) {
                return;
            }

            var selP1 = game.querySelector('select[name$="_p1_char"]');
            var selP2 = game.querySelector('select[name$="_p2_char"]');
            if (!selP1 || !selP2) {
                return;
            }

            /* Solo relleno si este game aún no tiene personaje (no piso lo que ya eligió) */
            if (!selP1.value && ultimoP1) {
                selP1.value = ultimoP1;
                selP1.dispatchEvent(new Event("change", { bubbles: true }));
            }
            if (!selP2.value && ultimoP2) {
                selP2.value = ultimoP2;
                selP2.dispatchEvent(new Event("change", { bubbles: true }));
            }

            if (selP1.value) {
                ultimoP1 = selP1.value;
            }
            if (selP2.value) {
                ultimoP2 = selP2.value;
            }
        });
    }

    function openOverlay(overlay) {
        if (!overlay) return;
        overlay.hidden = false;
        overlay.classList.add("is-open");
        document.body.style.overflow = "hidden";
    }

    function closeOverlay(overlay) {
        if (!overlay) return;
        overlay.classList.remove("is-open");
        overlay.hidden = true;
        document.body.style.overflow = "";
    }

    function closeAll() {
        closeOverlay(resultModal);
        closeOverlay(reportModal);
    }

    function fillNames(root, selector, value) {
        root.querySelectorAll(selector).forEach(function(el) {
            el.textContent = value;
        });
    }

    function fillSeed(root, selector, seed) {
        var el = root.querySelector(selector);
        if (!el) return;
        el.textContent = seed ? "#" + seed : "";
    }

    function parseResultGames(raw) {
        if (!raw) return [];
        return raw.split("|").map(function(item) {
            var bits = item.split("-");
            return {
                w: bits[0] || "p1",
                c1: characterIcon(String(bits[1] || "")),
                c2: characterIcon(String(bits[2] || ""))
            };
        }).filter(function(game) {
            return game.w === "p1" || game.w === "p2";
        });
    }

    function renderResultGames(games) {
        var box = document.getElementById("mm-result-games");
        if (!box) return;

        var html = "";
        games.forEach(function(game, index) {
            var p1Win = game.w === "p1";
            html +=
                '<div class="mm-game">' +
                '<div class="mm-g-l">' +
                '<span class="mm-face">' + (game.c1 || "❔") + "</span>" +
                '<span class="mm-w' + (p1Win ? "" : " mm-hide") + '">W</span>' +
                '<span class="mm-arr' + (p1Win ? "" : " mm-hide") + '">&#9664;</span>' +
                "</div>" +
                '<div class="mm-g-mid">Game ' + (index + 1) + "</div>" +
                '<div class="mm-g-r">' +
                '<span class="mm-arr' + (p1Win ? " mm-hide" : "") + '">&#9654;</span>' +
                '<span class="mm-w' + (p1Win ? " mm-hide" : "") + '">W</span>' +
                '<span class="mm-face">' + (game.c2 || "❔") + "</span>" +
                "</div>" +
                "</div>";
        });
        box.innerHTML = html;
    }

    function openResult(link) {

        // COMPROBAR SI EL USUARIO ESTÁ LOGUEADO
        if (!usuarioLogueado) {
            window.location.href = "login";
            return;
        }

        if (!resultModal) return;
        resultModal.querySelector(".mm-round").textContent = link.getAttribute("data-round") || "";
        fillNames(resultModal, ".js-mm-p1", link.getAttribute("data-p1") || "");
        fillNames(resultModal, ".js-mm-p2", link.getAttribute("data-p2") || "");
        fillSeed(resultModal, ".js-mm-seed1", link.getAttribute("data-seed1"));
        fillSeed(resultModal, ".js-mm-seed2", link.getAttribute("data-seed2"));

        var s1 = link.getAttribute("data-s1") || "0";
        var s2 = link.getAttribute("data-s2") || "0";
        resultModal.querySelector(".js-mm-s1").textContent = s1;
        resultModal.querySelector(".js-mm-s2").textContent = s2;

        var rec1 = resultModal.querySelector(".js-mm-rec1");
        var rec2 = resultModal.querySelector(".js-mm-rec2");
        if (rec1) rec1.textContent = link.getAttribute("data-rec1") || "";
        if (rec2) rec2.textContent = link.getAttribute("data-rec2") || "";

        var ico1 = resultModal.querySelector(".js-mm-ico1");
        var ico2 = resultModal.querySelector(".js-mm-ico2");
        if (ico1) ico1.textContent = link.getAttribute("data-ico1") || "❔";
        if (ico2) ico2.textContent = link.getAttribute("data-ico2") || "❔";

        renderResultGames(parseResultGames(link.getAttribute("data-games")));

        openOverlay(resultModal);
    }

    function setHidden(id, value) {
        var campo = document.getElementById(id);
        if (campo) campo.value = value || "";
    }

    function openReport(link) {

        // COMPROBAR SI EL USUARIO ESTÁ LOGUEADO
        if (!usuarioLogueado) {
            window.location.href = "login";
            return;
        }

        if (!reportModal) return;
        reportModal.querySelector(".mm-round").textContent = link.getAttribute("data-round") || "";
        fillNames(reportModal, ".js-mr-p1", link.getAttribute("data-p1") || "");
        fillNames(reportModal, ".js-mr-p2", link.getAttribute("data-p2") || "");
        fillSeed(reportModal, ".js-mr-seed1", link.getAttribute("data-seed1"));
        fillSeed(reportModal, ".js-mr-seed2", link.getAttribute("data-seed2"));
        if (reportForm) reportForm.reset();
        setHidden("mr-ronda-letra", link.getAttribute("data-ronda"));
        setHidden("mr-pools", link.getAttribute("data-pools"));
        setHidden("mr-jugador1", link.getAttribute("data-j1"));
        setHidden("mr-jugador2", link.getAttribute("data-j2"));
        setHidden("mr-seed1", link.getAttribute("data-seed1"));
        setHidden("mr-seed2", link.getAttribute("data-seed2"));
        actualizarGames();
        reportModal.querySelectorAll(".mm-face[data-face], .mm-face[data-head]").forEach(function(face) {
            face.textContent = "❔";
        });
        preseleccionarPersonajes(link.getAttribute("data-char1"), link.getAttribute("data-char2"));
        openOverlay(reportModal);
    }

    function preseleccionarPersonajes(char1, char2) {
        if (!reportGames) return;

        var selP1 = reportGames.querySelector('select[name="game1_p1_char"]');
        var selP2 = reportGames.querySelector('select[name="game1_p2_char"]');

        if (selP1 && char1) {
            selP1.value = char1;
            selP1.dispatchEvent(new Event("change", { bubbles: true }));
        }
        if (selP2 && char2) {
            selP2.value = char2;
            selP2.dispatchEvent(new Event("change", { bubbles: true }));
        }
    }

    renderReportGames();

    if (reportGames) {
        reportGames.addEventListener("change", function(e) {
            if (e.target.matches('input[type="radio"]')) {
                actualizarGames();
            }
        });

        actualizarGames();
    }

    document.querySelectorAll(".js-match-modal").forEach(function(link) {
        link.addEventListener("click", function(e) {
            e.preventDefault();
            if (link.getAttribute("data-mode") === "report") {
                openReport(link);
            } else {
                openResult(link);
            }
        });
    });

    document.querySelectorAll(".js-mm-close").forEach(function(btn) {
        btn.addEventListener("click", closeAll);
    });

    [resultModal, reportModal].forEach(function(overlay) {
        if (!overlay) return;
        overlay.addEventListener("click", function(e) {
            if (e.target === overlay) closeAll();
        });
    });

    document.addEventListener("keydown", function(e) {
        if (e.key === "Escape") closeAll();
    });

    if (reportForm) {
        reportForm.addEventListener("submit", function(e) {

            var victoriasP1 = 0;
            var victoriasP2 = 0;

            reportGames.querySelectorAll(".mm-game-report").forEach(function(game) {

                var ganador = game.querySelector('input[type="radio"]:checked');

                if (ganador && !game.hidden) {
                    if (ganador.value === "p1") {
                        victoriasP1++;
                    } else {
                        victoriasP2++;
                    }
                }

            });

            if (victoriasP1 !== 3 && victoriasP2 !== 3) {
                e.preventDefault();
                alert("Debes completar el enfrentamiento hasta que un jugador consiga 3 victorias.");
                return;
            }

            // Si hay 3 victorias, el POST se envía normalmente.
        });
    }

    /* ============================================================
       PARTICIPANTES: el buscador filtra el standing, 8 por pagina
       ============================================================ */
    var listaStand = document.getElementById("tp-stand-list");
    var buscadorPart = document.getElementById("tp-buscar");
    var pagerStand = document.getElementById("tp-pager-stand");
    var porPagina = 8;
    var paginaStand = 1;

    function nickPart(el) {
        return (el.getAttribute("data-nick") || "").toLowerCase();
    }

    function filtrarParticipantes() {
        if (!listaStand) {
            return;
        }

        var q = buscadorPart ? buscadorPart.value.toLowerCase().trim() : "";
        var filas = listaStand.querySelectorAll(".tp-stand-row");
        var visibles = [];
        var i;

        for (i = 0; i < filas.length; i++) {
            if (!q || nickPart(filas[i]).indexOf(q) !== -1) {
                visibles.push(filas[i]);
            }
            filas[i].classList.remove("is-on");
        }

        var totalPag = Math.max(1, Math.ceil(visibles.length / porPagina));
        if (paginaStand > totalPag) {
            paginaStand = totalPag;
        }

        var desde = (paginaStand - 1) * porPagina;
        var hasta = desde + porPagina;
        for (i = desde; i < hasta && i < visibles.length; i++) {
            visibles[i].classList.add("is-on");
        }

        pintarPager(totalPag);
    }

    function pintarPager(totalPag) {
        if (!pagerStand) {
            return;
        }

        pagerStand.innerHTML = "";
        if (totalPag <= 1) {
            return;
        }

        var n;
        for (n = 1; n <= totalPag; n++) {
            var btn = document.createElement("button");
            btn.type = "button";
            btn.className = "tp-page" + (n === paginaStand ? " is-on" : "");
            btn.textContent = n;
            btn.setAttribute("data-pag", n);
            pagerStand.appendChild(btn);
        }
    }

    if (listaStand) {
        filtrarParticipantes();

        if (buscadorPart) {
            buscadorPart.addEventListener("input", function() {
                paginaStand = 1;
                filtrarParticipantes();
            });
        }

        if (pagerStand) {
            pagerStand.addEventListener("click", function(e) {
                var btn = e.target.closest(".tp-page");
                if (!btn) {
                    return;
                }
                paginaStand = parseInt(btn.getAttribute("data-pag"), 10) || 1;
                filtrarParticipantes();
            });
        }
    }
})();