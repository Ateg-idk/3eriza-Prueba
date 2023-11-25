// Lógica para mostrar u ocultar campos según el tipo de documento seleccionado
document.getElementById('tipo_documento').addEventListener('change', function () {
    var tipoDocumento = this.value;
    var campoNumeroSN = document.getElementById('campo_numero_sn');
    var campoActivacionInmediata = document.getElementById('campo_activacion_inmediata');

    // Mostrar u ocultar campos según el tipo de documento
    switch (tipoDocumento) {
        case 'DNI':
            campoNumeroSN.style.display = 'block';
            campoActivacionInmediata.style.display = 'none';
            break;
        case 'C.E.':
            campoNumeroSN.style.display = 'none';
            campoActivacionInmediata.style.display = 'block';
            break;
        case 'RUC':
        case 'PASAPORTE':
            campoNumeroSN.style.display = 'none';
            campoActivacionInmediata.style.display = 'none';
            break;
    }
});

document.getElementById('nivel1').addEventListener('change', function () {
    var nivel1Value = this.value;
    var nivel2Select = document.getElementById('nivel2');
    var nivel3Select = document.getElementById('nivel3');

    nivel2Select.innerHTML = '<option value="SELECCIONE">[Seleccione]</option>';
    nivel3Select.innerHTML = '<option value="SELECCIONE">[Seleccione]</option>';

   

    if (nivel1Value === 'Contacto Efectivo') {
        agregarOpcionNivel2(nivel2Select, 'Venta', 'Venta');
        agregarOpcionNivel2(nivel2Select, 'Agendado', 'Agendado');
        agregarOpcionNivel3(nivel3Select, 'Acepta upgrade', 'Acepta upgrade');
        agregarOpcionNivel3(nivel3Select, 'Renovación de equipo', 'Renovación de equipo');
        agregarOpcionNivel3(nivel3Select, 'Acepta upgrade + Renovación de equipo', 'Acepta upgrade + Renovación de equipo');
        agregarOpcionNivel3(nivel3Select, 'Cliente interesado', 'Cliente interesado');
    } else if (nivel1Value === 'Contacto No Efectivo') {
        agregarOpcionNivel2(nivel2Select, 'No Venta', 'No Venta');
        agregarOpcionNivel2(nivel2Select, 'No Llamar', 'No Llamar');
        agregarOpcionNivel2(nivel2Select, 'Llamada Vicio', 'Llamada Vicio');
        agregarOpcionNivel3(nivel3Select, 'Corta llamada', 'Corta llamada');
        agregarOpcionNivel3(nivel3Select, 'Plan muy caro', 'Plan muy caro');
        agregarOpcionNivel3(nivel3Select, 'Cliente no desea recibir llamadas', 'Cliente no desea recibir llamadas');
        agregarOpcionNivel3(nivel3Select, 'Llamada vacía', 'Llamada vacía');
    }

    // Desencadenar el evento change en el nivel2
    var event = new Event('change');
    document.getElementById('nivel2').dispatchEvent(event);
});

document.getElementById('nivel2').addEventListener('change', function () {
    var nivel1Value = document.getElementById('nivel1').value;
    var nivel2Value = this.value;
    var nivel3Select = document.getElementById('nivel3');

    nivel3Select.innerHTML = '<option value="SELECCIONE">[Seleccione]</option>';

    if (nivel1Value === 'Contacto Efectivo') {
        switch (nivel2Value) {
            case 'Venta':
                agregarOpcionNivel3(nivel3Select, 'Acepta upgrade', 'Acepta upgrade');
                break;
            case 'Agendado':
                agregarOpcionNivel3(nivel3Select, 'Renovación de equipo', 'Renovación de equipo');
                agregarOpcionNivel3(nivel3Select, 'Acepta upgrade + Renovación de equipo', 'Acepta upgrade + Renovación de equipo');
                agregarOpcionNivel3(nivel3Select, 'Cliente interesado', 'Cliente interesado');
                break;
        }
    } else if (nivel1Value === 'Contacto No Efectivo') {
        switch (nivel2Value) {
            case 'No Venta':
                agregarOpcionNivel3(nivel3Select, 'Corta Llamada', 'Corta llamada');
                agregarOpcionNivel3(nivel3Select, 'Plan muy caro', 'Plan muy caro');
                agregarOpcionNivel3(nivel3Select, 'Buzón', 'Buzón');
                break;
            case 'No Llamar':
                agregarOpcionNivel3(nivel3Select, 'Cliente no desea recibir llamadas', 'Cliente no desea recibir llamadas');
                break;
            case 'Llamada Vicio':
                agregarOpcionNivel3(nivel3Select, 'Llamada vacía', 'Llamada vacía');
                break;
        }
    }
});

function agregarOpcionNivel2(selectElement, value, text) {
    var option = document.createElement('option');
    option.value = value;
    option.text = text;
    selectElement.add(option);
}

function agregarOpcionNivel3(selectElement, value, text) {
    var option = document.createElement('option');
    option.value = value;
    option.text = text;
    selectElement.add(option);
}
