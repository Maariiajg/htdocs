document.addEventListener("DOMContentLoaded", () => {
    const btn = document.getElementById("btnPistaExtra");
    const confirmField = document.getElementById("confirm_extra");

    if (btn) {
        btn.addEventListener("click", () => {
            const ok = confirm("¿Seguro que quieres usar la pista extra? (solo 1 disponible)");
            if (ok) {
                confirmField.value = "1";
                btn.closest("form").submit();
            }
        });
    }
});
