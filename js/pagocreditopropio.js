var cuenta = "";
var credito = "";
var monto = 0.00;
var moneda = "";

// Función para establecer la cuenta origen de la operación
// origen : Cuenta origen de la operación
function agregarOrigen(origen) {
    var elementoAnterior = $("#" + cuenta + "1");
    if (elementoAnterior != null) {
        elementoAnterior.removeClass("w3-gray");
        elementoAnterior.removeClass("negrita");
    }
    cuenta = origen;    
    $("#" + cuenta + "1").addClass("w3-gray")
    $("#" + cuenta + "1").addClass("negrita")
    mostrarMensaje();
}

// Función para establecer el destino de la operación
// destino : Crédito de la operación
// monedaDestino : Moneda del crédito
function agregarDestino(destino, monedaDestino) {
    var elementoAnterior = $("#" + credito + "2");
    if (elementoAnterior != null) {
        elementoAnterior.removeClass("w3-gray");
        elementoAnterior.removeClass("negrita");
    }
    credito = destino;
    moneda = monedaDestino;
    $("#" + credito + "2").addClass("w3-gray");
    $("#" + credito + "2").addClass("negrita");
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

    if (cuenta != "" && credito != "" && monto > 0) {
        $("#previa").html("<h5>Pago desde la cuenta " + cuenta + " hacia el crédito " + credito + " por el monto de " + moneda + " " + monto + "</h5>");
        botonProcesar.css("display", "block");
    } else {
        botonProcesar.css("display", "none");
    }
}

// Función para el envío de la operación a logica/pagocreditopropio.php
function transferir() {
    if (confirm("¿Está seguro de realizar esta operación?")) { 
        $.ajax({
            type: "POST",
            url: "./logica/pagocreditopropio.php",
            data: { "cuenta" : cuenta, "credito" : credito, "monto" : monto, "moneda" : moneda},
            success: function(resultado){
                // https://developer.mozilla.org/en-US/docs/Web/JavaScript
                var obj = JSON.parse( resultado ); 
                if (obj['error'] != "" && obj['error'] != null) {
                    alert(obj['error']);    
                }else{
                    // https://api.jquery.com/category/forms/
                    var form = $('<form action="./operacionresultado.php" method="post">' +
                    '<input type="text" name="productoOrigen" value="' + cuenta + '" />' +
                    '<input type="text" name="productoDestino" value="' + credito + '" />' +
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