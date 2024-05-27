function validarYMostrarPago() {
    const cantidadPasajes = parseInt(document.getElementById('cantidad_pasajes').value);
    const asientosDisponibles = parseInt(document.getElementById('asientos_disponibles').value);

    /*if (cantidadPasajes > asientosDisponibles) {
        alert('No puede comprar más pasajesde los que hay disponibles.');
return;
}*/
const importe = parseFloat(document.getElementById('importe').value);
const totalAPagar = importe * cantidadPasajes;
document.getElementById('total_a_pagar').value = totalAPagar.toFixed(2);

document.getElementById('reservationForm').classList.remove('active');
document.getElementById('paymentForm').classList.add('active');
}
