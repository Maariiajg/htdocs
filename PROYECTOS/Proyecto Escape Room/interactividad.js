//confirmar y mostrar pista extra

document.addEventListener('DOMContentLoaded', () => {

    const btnPista = document.getElementById('btnPistaExtra');
    const confirmInput = document.getElementById('confirm_extra');
    const form = document.querySelector('.form-challenge');

    if (btnPista) {
        btnPista.addEventListener('click', () => {

            // Confirmación opcional
            const ok = confirm("¿Seguro que quieres usar la pista extra? Solo hay 1 disponible.");
            if (!ok) return;

            // Marcamos que el usuario confirmó
            confirmInput.value = "1";

            // Añadimos el campo oculto que PHP espera
            let hidden = document.createElement('input');
            hidden.type = 'hidden';
            hidden.name = 'pedir_pista_extra';
            hidden.value = '1';
            form.appendChild(hidden);

            // Enviamos el formulario
            form.submit();
        });
    }
});


