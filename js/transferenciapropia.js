var cuentaOrigen = "";
var cuentaDestino = "";
var monto = 0.00;
var moneda = "";

// Función para establecer la cuenta origen de la operación
// origen : Cuenta origen de la operación
// monedaOrigen : Moneda de la cuenta origen
function agregarOrigen(origen, monedaOrigen) {
    var elementoAnterior = $("#" + cuentaOrigen + "1");
    if (elementoAnterior != null) {
        elementoAnterior.removeClass("w3-gray");
        elementoAnterior.removeClass("negrita");
    }
    cuentaOrigen = origen;
    moneda = monedaOrigen;
    $("#" + cuentaOrigen + "1").addClass("w3-gray");
    $("#" + cuentaOrigen + "1").addClass("negrita");
    mostrarMensaje();
}

// Función para establecer el destino de la operación
// destino : Cuenta destino de la operación
function agregarDestino(destino) {
    var elementoAnterior = $("#" + cuentaDestino + "2");
    if (elementoAnterior != null) {
        elementoAnterior.removeClass("w3-gray");
        elementoAnterior.removeClass("negrita");
    }
    cuentaDestino = destino;
    $("#" + cuentaDestino + "2").addClass("w3-gray");
    $("#" + cuentaDestino + "2").addClass("negrita");
    mostrarMensaje();
}

// Función para establecer el monto de la operación
// montoOperacion : Monto de la operación en base a la cuenta origen
function agregarMonto(montoOperacion) {
    monto = montoOperacion;
    mostrarMensaje();
}

// Función para mostrar u ocultar el botón y el mensaje previo de la operación
function mostrarMensaje() {
    var botonProcesar = $("#procesar");

    if (cuentaOrigen != "" && cuentaDestino != "" && monto > 0) {
        $("#previa").html("<h5>Transferencia desde la cuenta " + cuentaOrigen + " hacia la cuenta " + cuentaDestino + " por el monto de " + moneda + " " + monto + "</h5>");
        botonProcesar.css("display", "block");
    } else {
        botonProcesar.css("display", "none");
    }
}

// Función para el envío de la operación a logica/transferenciapropia.php
function transferir() {
    if (confirm("¿Está seguro de realizar esta operación?")) { 
        $.ajax({
            type: "POST",
            url: "./logica/transferenciapropia.php",
            data: { "cuentaOrigen" : cuentaOrigen, "cuentaDestino" : cuentaDestino, "monto" : monto, "moneda" : moneda},
            success: function(resultado){
                // https://developer.mozilla.org/en-US/docs/Web/JavaScript
                var obj = JSON.parse( resultado ); 
                if (obj['error'] != "" && obj['error'] != null) {
                    alert(obj['error']);    
                }else{
                    // https://api.jquery.com/category/forms/
                    var form = $('<form action="./operacionresultado.php" method="post">' +
                    '<input type="text" name="productoOrigen" value="' + cuentaOrigen + '" />' +
                    '<input type="text" name="productoDestino" value="' + cuentaDestino + '" />' +
                    '<input type="text" name="monto" value="' + monto + '" />' +
                    '<input type="text" name="moneda" value="' + moneda + '" />' +
                    '</form>');
                    $('body').append(form);
                    form.submit();
                }                
            }
          });
    }
}