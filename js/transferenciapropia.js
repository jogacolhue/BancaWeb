var cuentaOrigen = '';
var cuentaDestino = '';
var monto = 0.00;
var moneda = '';

async function agregarOrigen(e, f) {
    var elementoAnterior = document.getElementById(cuentaOrigen + '1');
    if (elementoAnterior != null) {
        elementoAnterior.classList.remove('w3-gray');
    }
    cuentaOrigen = e;
    moneda = f;
    document.getElementById(cuentaOrigen + '1').classList.add('w3-gray');
    mostratMensaje();
}

async function agregarDestino(e) {
    var elementoAnterior = document.getElementById(cuentaDestino + '2');
    if (elementoAnterior != null) {
        elementoAnterior.classList.remove('w3-gray');
    }
    cuentaDestino = e;
    document.getElementById(cuentaDestino + '2').classList.add('w3-gray');
    mostratMensaje();
}

async function agregarMonto(e) {
    monto = e;
    mostratMensaje();
}

function mostratMensaje() {
    var botonProcesar = document.getElementById("procesar"); 

    if (cuentaOrigen != '' && cuentaDestino != '' && monto > 0) {
        document.getElementById("previa").innerHTML = "<h5>Transferencia desde la cuenta " + cuentaOrigen + " hacia la cuenta " + cuentaDestino + " por el monto de " + moneda + " " + monto + "</h5>";
        botonProcesar.style.display = "block";
    }else{
        botonProcesar.style.display = "none";
    }
}

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