var cuentaOrigen = '';
var cuentaDestino = '';
var monto = 0.00;
var moneda = '';

// Función para establecer la cuenta origen de la operación
// origen : Cuenta origen de la operación
// monedaOrigen : Moneda de la cuenta origen
async function agregarOrigen(origen, monedaOrigen) {
    var elementoAnterior = document.getElementById(cuentaOrigen + '1');
    if (elementoAnterior != null) {
        elementoAnterior.classList.remove('w3-gray');
    }
    cuentaOrigen = origen;
    moneda = monedaOrigen;
    document.getElementById(cuentaOrigen + '1').classList.add('w3-gray');
    mostrarMensaje();
}

// Función para establecer el destino de la operación
// destino : Cuenta destino de la operación
async function agregarDestino(destino) {
    var elementoAnterior = document.getElementById(cuentaDestino + '2');
    if (elementoAnterior != null) {
        elementoAnterior.classList.remove('w3-gray');
    }
    cuentaDestino = destino;
    document.getElementById(cuentaDestino + '2').classList.add('w3-gray');
    mostrarMensaje();
}

// Función para establecer el monto de la operación
// montoOperacion : Monto de la operación en base a la cuenta origen
async function agregarMonto(montoOperacion) {
    debugger;
    monto = montoOperacion;
    mostrarMensaje();
}

// Función para mostrar u ocultar el botón y el mensaje previo de la operación
function mostrarMensaje() {
    var botonProcesar = document.getElementById("procesar"); 

    if (cuentaOrigen != '' && cuentaDestino != '' && monto > 0) {
        document.getElementById("previa").innerHTML = "<h5>Transferencia desde la cuenta " + cuentaOrigen + " hacia la cuenta " + cuentaDestino + " por el monto de " + moneda + " " + monto + "</h5>";
        botonProcesar.style.display = "block";
    }else{
        botonProcesar.style.display = "none";
    }
}

// Función para el envío de la operación a logica/transferenciapropia.php
function transferir() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) { 
            alert("Resultado de la operación: " + this.responseText);
        }
    };
    xhttp.open("POST", "./logica/transferenciapropia.php", true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send("cuentaOrigen="+cuentaOrigen+"&cuentaDestino="+cuentaDestino+"&monto="+monto+"&moneda="+moneda);
}