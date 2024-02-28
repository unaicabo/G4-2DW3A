import Toastify from 'toastify-js'
import "toastify-js/src/toastify.css";

document.getElementById('form').addEventListener('submit', async (e) => {
    e.preventDefault();
    let form = document.getElementById('form');
    let dificultad = document.getElementById('dificultad').value

    if (dificultad == 0) {
        Toastify({
            text: "Debes seleccionar una dificultad",
            duration: 3000,
            gravity: "top",
            position: "center",
            backgroundColor: "#F56565",
            stopOnFocus: true,
        }).showToast();
    } else {
        form.submit();
    }
});
