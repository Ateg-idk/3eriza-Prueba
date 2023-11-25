
document.addEventListener("DOMContentLoaded", function () {
    // Ejemplo de interacción con el backend usando AJAX
    const url = "ajax/fetch_data.php";

    fetch(url)
        .then(response => response.json())
        .then(data => {
            // Procesar los datos recibidos del backend
            console.log(data);
        })
        .catch(error => console.error('Error al obtener datos del servidor:', error));
});

  


