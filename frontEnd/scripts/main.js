document.addEventListener("DOMContentLoaded", function() {
    const formFiltroReservas = document.querySelector('#filtroReservas');
    if (formFiltroReservas) {
        formFiltroReservas.addEventListener('submit', function(buscaReserva) {
            buscaReserva.preventDefault();
            document.querySelector('#listado-reservas').innerHTML = "<p>Buscando reservas...</p>";
            const params = new URLSearchParams(new FormData(formFiltroReservas)).toString();
            const urlReservas = formFiltroReservas.action + '?' + params;
            fetch(urlReservas, { method: "GET" })
                .then(respuesta => {
                    console.log('Estado de la respuesta:', respuesta.status);  // Verifica el estado de la respuesta
                    if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                    return respuesta.json();
                })
                .then(datos => {
                    console.log('Datos recibidos:', datos);  // Verifica los datos recibidos
                    if (datos.error) throw new Error(datos.error);  // Manejar error desde el servidor
                    if (!Array.isArray(datos.reservas)) throw new Error('Datos no son un array');
                    mostrarReservas(datos.reservas);
                })
                .catch(error => {
                    console.log(error);
                    document.querySelector('#listado-reservas').innerHTML = "<p>Error: " + error.message + "</p>";
                });
        });
    }
});

function mostrarReservas(reservas) {
    let res = "<table><tr><th>ID</th><th>Cliente</th><th>Fecha Inicio</th><th>Fecha Fin</th><th>Estado</th></tr>";
    if (reservas.length === 0) {
        res += "<tr><td colspan='5'>No se encontraron reservas</td></tr>";
    } else {
        reservas.forEach(reserva => {
            res += "<tr><td>" + reserva.id + "</td><td>" + reserva.clienteNombre + "</td><td>" + reserva.fechaInicio + "</td><td>" + reserva.fechaFin + "</td><td>" + reserva.estado + "</td></tr>";
        });
    }
    res += "</table>";
    document.querySelector('#listado-reservas').innerHTML = res;
}

document.addEventListener("DOMContentLoaded", function() {
    const formFiltroHabitaciones = document.querySelector('#filtroHabitaciones');
    if (formFiltroHabitaciones) {
        formFiltroHabitaciones.addEventListener('submit', function(buscaHabitacion) {
            buscaHabitacion.preventDefault();
            document.querySelector('#listado-habitaciones').innerHTML = "<p>Buscando habitaciones...</p>";
            const params = new URLSearchParams(new FormData(formFiltroHabitaciones)).toString();
            const urlHabitaciones = formFiltroHabitaciones.action + '?' + params;
            fetch(urlHabitaciones, { method: "GET" })
                .then(respuesta => {
                    console.log('Estado de la respuesta:', respuesta.status);  // Verifica el estado de la respuesta
                    if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                    return respuesta.json();
                })
                .then(datos => {
                    console.log('Datos recibidos:', datos);  // Verifica los datos recibidos
                    if (datos.error) throw new Error(datos.error);  // Manejar error desde el servidor
                    if (!Array.isArray(datos.habitaciones)) throw new Error('Datos no son un array');
                    mostrarHabitaciones(datos.habitaciones);
                })
                .catch(error => {
                    console.log(error);
                    document.querySelector('#listado-habitaciones').innerHTML = "<p>Error: " + error.message + "</p>";
                });
        });
    }
});

function mostrarHabitaciones(habitaciones) {
    let res = "<table><tr><th>ID</th><th>Número</th><th>Tipo</th><th>Estado</th></tr>";
    if (habitaciones.length === 0) {
        res += "<tr><td colspan='4'>No se encontraron habitaciones</td></tr>";
    } else {
        habitaciones.forEach(habitacion => {
            res += "<tr><td>" + habitacion.id + "</td><td>" + habitacion.numero + "</td><td>" + habitacion.tipo + "</td><td>" + habitacion.estado + "</td></tr>";
        });
    }
    res += "</table>";
    document.querySelector('#listado-habitaciones').innerHTML = res;
}

    

// Manejar formulario de filtro de clientes
const formFiltroClientes = document.querySelector('#filtroClientes');
if (formFiltroClientes) {
    formFiltroClientes.addEventListener('submit', function(buscaCliente) {
        buscaCliente.preventDefault();
        document.querySelector('#listado-clientes').innerHTML = "<p>Buscando clientes...</p>";
        const params = new URLSearchParams(new FormData(formFiltroClientes)).toString();
        const urlClientes = formFiltroClientes.action + '?' + params;
        fetch(urlClientes, { method: "GET" })
            .then(respuesta => {
                console.log('Estado de la respuesta:', respuesta.status);  // Verifica el estado de la respuesta
                if (!respuesta.ok) throw new Error('Error en la respuesta de la red');
                return respuesta.json();
            })
            .then(datos => {
                console.log('Datos recibidos:', datos);  // Verifica los datos recibidos
                if (datos.error) throw new Error(datos.error);  // Manejar error desde el servidor
                if (!Array.isArray(datos.clientes)) throw new Error('Datos no son un array');
                mostrarClientes(datos.clientes);
            })
            .catch(error => {
                console.log(error);
                document.querySelector('#listado-clientes').innerHTML = "<p>Error: " + error.message + "</p>";
            });
    });
}

function mostrarClientes(clientes) {
    let res = "<table><tr><th>ID</th><th>Nombre</th><th>Teléfono</th><th>Email</th></tr>";
    if (clientes.length === 0) {
        res += "<tr><td colspan='4'>No se encontraron clientes</td></tr>";
    } else {
        clientes.forEach(cliente => {
            res += "<tr><td>" + cliente.id + "</td><td>" + cliente.nombre + "</td><td>" + cliente.telefono + "</td><td>" + cliente.email + "</td></tr>";
        });
    }
    res += "</table>";
    document.querySelector('#listado-clientes').innerHTML = res;
}