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
            html +=
                '<div class="mm-game mm-game-report" data-game="' + i + '">' +
                '<div class="mm-side mm-side-l">' +
                '<select name="game' + i + '_p1_char" class="mm-char" data-face="g' + i + '-p1" required>' + opts + "</select>" +
                '<label class="mm-pick">' +
                '<input type="radio" name="game' + i + '" value="p1" required>' +
                '<span class="mm-face" data-face="g' + i + '-p1">❔</span>' +
                '<span class="js-mr-p1">Player 1</span>' +
                "</label>" +
                "</div>" +
                '<div class="mm-g-mid">Game ' + i + "</div>" +
                '<div class="mm-side mm-side-r">' +
                '<select name="game' + i + '_p2_char" class="mm-char" data-face="g' + i + '-p2" required>' + opts + "</select>" +
                '<label class="mm-pick">' +
                '<input type="radio" name="game' + i + '" value="p2">' +
                '<span class="js-mr-p2">Player 2</span>' +
                '<span class="mm-face" data-face="g' + i + '-p2">❔</span>' +
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
        resultModal.querySelector(".js-mm-s1").textContent = link.getAttribute("data-s1") || "0";
        resultModal.querySelector(".js-mm-s2").textContent = link.getAttribute("data-s2") || "0";
        openOverlay(resultModal);
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
        if (reportForm) reportForm.reset();
        actualizarGames();
        reportModal.querySelectorAll(".mm-face[data-face], .mm-face[data-head]").forEach(function(face) {
            face.textContent = "❔";
        });
        openOverlay(reportModal);
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
})();