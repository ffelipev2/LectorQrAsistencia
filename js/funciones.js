function marcarEntrada() {
    Swal.fire({
        title: "Registro de Entrada",
        text: "Acerca tu Tarjeta al lector",
        input: 'text',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            //console.log("Result: " + result.value);
            var nric = result.value;
            var arrayDeCadenas = nric.replaceAll('?', '/')
            var arrayDeCadenas = arrayDeCadenas.replaceAll('=', '/')
            var arrayDeCadenas = arrayDeCadenas.replaceAll('&', '/')
            var arrayDeCadenas = arrayDeCadenas.split('/');
            //document.getElementById("barcode").innerHTML = arrayDeCadenas[5];
            if (window.XMLHttpRequest) {
                connection = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                connection = new ActiveXObject("Microsoft.XMLHTTP");
            }
            connection.onreadystatechange = response_1;
            connection.open('POST', 'resource/funciones.php');
            connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            connection.send("param1=" + arrayDeCadenas[5]);
        }
    });
}
function response_1() {
    if (connection.readyState == 4) {
        //document.getElementById("barcode").innerHTML = this.responseText;
        var aux = this.responseText;
        if (aux == "1") {
            Swal.fire('Good job!', 'You clicked the button!', 'success');
        }else{
            Swal.fire('Bad job!', 'You clicked the button!', 'success');
        }

    }
}

function marcarSalida() {
    Swal.fire({
        title: "Registro de Salida",
        text: "Acerca tu Tarjeta al lector",
        input: 'text',
        showCancelButton: true
    }).then((result) => {
        if (result.value) {
            //console.log("Result: " + result.value);
            var nric = result.value;
            var arrayDeCadenas = nric.replaceAll('?', '/')
            var arrayDeCadenas = arrayDeCadenas.replaceAll('=', '/')
            var arrayDeCadenas = arrayDeCadenas.replaceAll('&', '/')
            var arrayDeCadenas = arrayDeCadenas.split('/');
            //document.getElementById("barcode").innerHTML = arrayDeCadenas[5];
            if (window.XMLHttpRequest) {
                connection = new XMLHttpRequest();
            } else if (window.ActiveXObject) {
                connection = new ActiveXObject("Microsoft.XMLHTTP");
            }
            connection.onreadystatechange = response_2;
            connection.open('POST', 'resource/funciones.php');
            connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            connection.send("param2=" + arrayDeCadenas[5]);
        }
    });
}
function response_2() {
    if (connection.readyState == 4) {
        document.getElementById("barcode").innerHTML = this.responseText;
    }
}