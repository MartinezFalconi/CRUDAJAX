window.onload = function() {
    modal = document.getElementById('update');
    read();
}

function objetoAjax() {
    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    return xmlhttp;
}

/* Muestra todos los registros de la base de datos (sin filtrar y filtrados) */
function read() {
    var section = document.getElementById('section-3');
    //var buscador = document.getElementById('searchPokemon').value;
    var ajax = new objetoAjax();
    //var token = document.getElementById('token').getAttribute('content');
    // Busca la ruta read y que sea asyncrono
    ajax.open('GET', 'read', true);
    //var datasend = new FormData();
    //datasend.append('filtro', buscador);
    //datasend.append('_token', token);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            var tabla = '';
            tabla += '<div>';
            tabla += '<table class="table table-bordered">';
            tabla += '<tr>';
            tabla += '<th>ID</th>';
            tabla += '<th>Nombre</th>';
            tabla += '<th>Descripcion</th>';
            tabla += '<th>Acciones</th>';
            tabla += '</tr>';
            for (let i = 0; i < respuesta.length; i++) {
                tabla += '<tr>';
                tabla += '<td>' + respuesta[i].id + '</td>';
                tabla += '<td>' + respuesta[i].name + '</td>';
                tabla += '<td>' + respuesta[i].description + '</td>';
                tabla += '<td>';
                tabla += '<button class="btn btn-danger" onclick="deleteTitulo(' + respuesta[i].id + ')">Eliminar</button>';
                tabla += '<button class="btn btn-primary" onclick="openModal(' + respuesta[i].id + ',&#039;' + respuesta[i].name + '&#039;,&#039;' + respuesta[i].description + '&#039;)">Actualizar</button>';
                tabla += '</td>';
                tabla += '</tr>';
            }
            tabla += '</table>';
            tabla += '</div>';
            section.innerHTML = tabla;
        }
    }
    ajax.send();

}

function deleteTitulo(id_titulo) {
    var ajax = new objetoAjax();
    var token = document.getElementById('token').getAttribute('content');
    ajax.open('POST', 'deleteTitulo', true);
    var datos = new FormData();
    datos.append('id_titulo', id_titulo);
    datos.append('_token', token);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            // if (respuesta.resultado == 'OK') {
            //     alert('ok');
            // } else {
            //     alert('nok');
            // }
        }
        read();
    }
    ajax.send(datos);
}

function createTitulo() {

    var ajax = new objetoAjax();
    var name = document.getElementById('name').value;
    var description = document.getElementById('description').value;
    var token = document.getElementById('token').getAttribute('content');
    ajax.open('POST', 'createTitulo', true);
    var datos = new FormData();
    datos.append('name', name);
    datos.append('description', description);
    datos.append('_token', token);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            // if (respuesta.resultado == 'OK') {
            //     alert('ok');
            // } else {
            //     alert('nok');
            // }
        }
        read();
    }
    ajax.send(datos);
}

function updateTitulo() {
    var ajax = new objetoAjax();
    var num = document.getElementById('id_titulo').value;
    var name = document.getElementById('name1').value;
    var description = document.getElementById('description1').value;
    var token = document.getElementById('token').getAttribute('content');
    ajax.open('POST', 'updateTitulo', true);
    var datos = new FormData();
    datos.append('id_titulo', num);
    datos.append('name', name);
    datos.append('description', description);
    datos.append('_token', token);
    ajax.onreadystatechange = function() {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var respuesta = JSON.parse(ajax.responseText);
            // var tabla = '';
            // mensaje.innerHTML = 'Pokemon ' + num + ' agregado a favorito';

            // if (respuesta.resultado == 'OK') {
            //     mensaje.innerHTML = 'Pokemon ' + num + ' registrado';
            // } else {
            //     mensaje.innerHTML = 'Ha ocurrido un error.' + respuesta.resultado;
            // }
            closeModal();
            read();
        }
    }
    ajax.send(datos);
}

function openModal(num, name, description) {
    modal.style.display = "block";
    document.getElementById('id_titulo').value = num;
    document.getElementById('name1').value = name;
    document.getElementById('description1').value = description;
}

function closeModal() {
    modal.style.display = "none";
}