// interactividad.js
// Pequeñas mejoras UI: confirmación de pista extra (ya se usa en HTML), botón de contraste,
// y gestión de accesibilidad (aumentar contraste).

document.addEventListener('DOMContentLoaded', function () {
    // Botón de contraste (puede estar en index y otras páginas)
    var contrastBtn = document.getElementById('contrastBtn');
    if (contrastBtn) {
        contrastBtn.addEventListener('click', function(){
            document.body.classList.toggle('high-contrast');
            if (document.body.classList.contains('high-contrast')) {
                contrastBtn.textContent = 'Restablecer contraste';
            } else {
                contrastBtn.textContent = 'Aumentar contraste';
            }
        });
    }

    // Confirmación extra para botones con data-confirm (si los hubiese)
    document.querySelectorAll('[data-confirm]').forEach(function (el) {
        el.addEventListener('click', function (e) {
            var msg = el.getAttribute('data-confirm');
            if (!confirm(msg)) {
                e.preventDefault();
            }
        });
    });

    // Animación sutil para mensajes (aparecer y desaparecer)
    document.querySelectorAll('.message').forEach(function (m) {
        m.style.opacity = 0;
        setTimeout(function () {
            m.style.transition = 'opacity 400ms ease';
            m.style.opacity = 1;
        }, 50);
    });
});
