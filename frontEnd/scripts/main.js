document.addEventListener("DOMContentLoaded", function() {
    console.log("DOM completamente cargado");
    const formFiltroReservas = document.querySelector('#filtroReservas');
    if (formFiltroReservas) {
        formFiltroReservas.addEventListener('submit', function(buscaReserva) {
            buscaReserva.preventDefault();
            document.querySelector('#listado-reservas').innerHTML = "<p>Buscando reservas...</p>";
            const params = new URLSearchParams(new FormData(formFiltroReservas)).toString();
            const urlReservas = formFiltroReservas.action + '?' + params;
            fetch(urlReservas, { method: "GET" })
                .then(respuesta => {
                    if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                    return respuesta.json();
                })
                .then(datos => {
                    if (!Array.isArray(datos.reservas)) throw new Error('Datos no son un array');
                    mostrarReservas(datos.reservas);
                })
                .catch(error => {
                    document.querySelector('#listado-reservas').innerHTML = "<p>Error: " + error.message + "</p>";
                });
        });
    }

    const formFiltroHabitaciones = document.querySelector('#filtroHabitaciones');
    if (formFiltroHabitaciones) {
        formFiltroHabitaciones.addEventListener('submit', function(buscaHabitacion) {
            buscaHabitacion.preventDefault();
            document.querySelector('#listado-habitaciones').innerHTML = "<p>Buscando habitaciones...</p>";
            const params = new URLSearchParams(new FormData(formFiltroHabitaciones)).toString();
            const urlHabitaciones = formFiltroHabitaciones.action + '?' + params;
            fetch(urlHabitaciones, { method: "GET" })
                .then(respuesta => {
                    if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                    return respuesta.json();
                })
                .then(datos => {
                    if (!Array.isArray(datos.habitaciones)) throw new Error('Datos no son un array');
                    mostrarHabitaciones(datos.habitaciones);
                })
                .catch(error => {
                    document.querySelector('#listado-habitaciones').innerHTML = "<p>Error: " + error.message + "</p>";
                });
        });
    }

    const formFiltroClientes = document.querySelector('#filtroClientes');
    if (formFiltroClientes) {
        formFiltroClientes.addEventListener('submit', function(buscaCliente) {
            buscaCliente.preventDefault();
            document.querySelector('#listado-clientes').innerHTML = "<p>Buscando clientes...</p>";
            const params = new URLSearchParams(new FormData(formFiltroClientes)).toString();
            const urlClientes = formFiltroClientes.action + '?' + params;
            fetch(urlClientes, { method: "GET" })
                .then(respuesta => {
                    if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                    return respuesta.json();
                })
                .then(datos => {
                    if (!Array.isArray(datos.clientes)) throw new Error('Datos no son un array');
                    mostrarClientes(datos.clientes); // Muestra los clientes filtrados
                })
                .catch(error => {
                    document.querySelector('#listado-clientes').innerHTML = "<p>Error: " + error.message + "</p>";
                });
        });
    }

    //obtenerClientes(); // Llama a obtenerClientes después de cargar el DOM
});

function obtenerClientes() {
    fetch('../src/listado_clientes.php')
        .then(response => response.json())
        .then(responseData => {
            console.log("Respuesta completa:", responseData);

            // Asegúrate de que responseData tenga la propiedad 'clientes'
            if (responseData && Array.isArray(responseData.clientes)) {
                mostrarClientes(responseData.clientes); // Muestra todos los clientes
            } else {
                console.error("La respuesta no contiene un array de clientes:", responseData);
            }
        })
        .catch(error => console.error('Error al obtener los clientes:', error));
}

function mostrarClientes(clientes) {
    const tbody = document.getElementById('listado-clientes');
    if (tbody) {
        tbody.innerHTML = '';
        if (clientes.length === 0) {
            tbody.innerHTML = '<tr><td colspan="5">No se encontraron clientes</td></tr>';
        } else {
            clientes.forEach(cliente => {
                const row = document.createElement('tr');
                row.innerHTML = `
                    <td>${cliente.id}</td>
                    <td>${cliente.nombre}</td>
                    <td>${cliente.telefono}</td>
                    <td>${cliente.email}</td>
                    <td>
                        <a href="modificar-cliente.html?id=${cliente.id}">Modificar</a> |
                        <a href="#" onclick="eliminarCliente(${cliente.id})">Eliminar</a>
                    </td>`;
                tbody.appendChild(row);
            });
        }
    } else {
        console.error("El elemento 'listado-clientes' no se encontró en el DOM.");
    }
}

function eliminarCliente(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este cliente?")) {
        fetch('../src/eliminarCliente.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded'
            },
            body: new URLSearchParams({ id: id })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert(data.message);
                obtenerClientes(); // Actualiza la lista de clientes
            } else {
                alert("Error al eliminar el cliente: " + data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    }
}

function mostrarReservas(reservas) {
    let res = "<table><tr><th>ID</th><th>Cliente</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th></tr>";
    if (reservas.length === 0) {
        res += "<tr><td colspan='5'>No se encontraron reservas</td></tr>";
    } else {
        reservas.forEach(reserva => {
            res += `<tr><td>${reserva.id}</td><td>${reserva.clienteNombre}</td><td>${reserva.fechaInicio}</td><td>${reserva.fechaFin}</td><td>${reserva.estado}</td></tr>`;
        });
    }
    res += "</table>";
    document.querySelector('#listado-reservas').innerHTML = res;
}

function mostrarHabitaciones(habitaciones) {
    let res = "<table><tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th></tr>";
    if (habitaciones.length === 0) {
        res += "<tr><td colspan='4'>No se encontraron habitaciones</td></tr>";
    } else {
        habitaciones.forEach(habitacion => {
            res += `<tr><td>${habitacion.id}</td><td>${habitacion.numero}</td><td>${habitacion.tipo}</td><td>${habitacion.estado}</td></tr>`;
        });
    }
    res += "</table>";
    document.querySelector('#listado-habitaciones').innerHTML = res;
}

document.addEventListener("DOMContentLoaded", function() {
    obtenerClientes();
});