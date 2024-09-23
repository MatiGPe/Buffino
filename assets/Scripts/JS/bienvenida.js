// assets/Scripts/JS/bienvenida.js

// Función de búsqueda de recetas
function buscarReceta() {
    const input = document.getElementById('buscador').value.toLowerCase();
    const cards = document.querySelectorAll('.card');
    cards.forEach(card => {
        const title = card.querySelector('.card-title').innerText.toLowerCase();
        if (title.includes(input)) {
            card.style.display = '';
        } else {
            card.style.display = 'none';
        }
    });
}