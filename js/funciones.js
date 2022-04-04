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
            var param3 = document.getElementById('espacio');
            var param3 = param3.options[param3.selectedIndex].value;
            connection.onreadystatechange = response_1;
            connection.open('POST', 'resource/funciones.php');
            connection.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            connection.send("param3=" + param3 + "&param4=" + arrayDeCadenas[5]);
        }
    });
}
function response_1() {
    if (connection.readyState == 4) {
        //document.getElementById("barcode").innerHTML = this.responseText;
        var aux = this.responseText;
        if (aux == "1") {
            Swal.fire('Registro de Entrada Insertado', 'Has clic en aceptar', 'success');
            var x = document.getElementById("myDIV");
            x.style.display = "none";
            //alert("si"); 
        } else if (aux == "2") {
            Swal.fire('Debes marcar la Salida', 'Has clic en aceptar', 'success');
            var x = document.getElementById("myDIV");
            x.style.display = "none";
            //alert("si"); 
        } else if (aux == "3") {
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Usuario no registrado'});
            var x = document.getElementById("myDIV");
            x.style.display = "none";
            //alert("si"); 
        } else {
            //alert("no");
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Oh no! ocurrio un Error'});
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
        //document.getElementById("barcode").innerHTML = this.responseText;
        var aux = this.responseText;
        if (aux == "1") {
            Swal.fire('Se ha registrado tu salida', 'Has clic en aceptar', 'success');
            //alert("si"); 
        } else if (aux == "2") {
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Debes marcar una Entrada'});
            //alert("si"); 
        } else if (aux == "3") {
            Swal.fire({icon: 'error', title: 'Oops...', text: '¡No existe el registro!'});
            var x = document.getElementById("myDIV");
            x.style.display = "none";
        } else {
            //alert("no");
            Swal.fire({icon: 'error', title: 'Oops...', text: 'Oh no! ocurrio un Error'});
        }
    }
}