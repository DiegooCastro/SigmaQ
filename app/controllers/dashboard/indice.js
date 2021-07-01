const API_ADMINS = '../../app/api/dashboard/usuarios.php?action=readAll';
const API_CLIENTES = '../../app/api/dashboard/clientes.php?action=readAll';
const API_INDICES = '../../app/api/dashboard/indiceEntrega.php?action=';


// Función manejadora de eventos, para ejecutar justo cuando termine de cardar.
document.addEventListener('DOMContentLoaded', () => {
    // Se manda a llamar la funcion para llenar la tabla con la API de parametro
    readRows(API_INDICES);
})

// Función para llenar la tabla con los datos de los registros. Se usa en la función readRows()
const fillTable = dataset => {
    $('#warning-message').empty();
    $('#tbody-rows').empty();
    let content = ''
    if(dataset == [].length) {
        //console.log(dataset)
        content+=`<h4>No hay índices registrados</h4>`
        document.getElementById('warning-message').innerHTML = content
    } else {
        //Se agregan los titulos de las columnas
        content += `
            <thead class="thead-dark">
                <tr>
                    <th>Cliente</th>
                    <th>Organizacion</th>
                    <th>Indice</th>
                    <th>Compromisos</th>
                    <th>Cumplidos</th>
                    <th>No Cumplidos</th>
                    <th>No Considerados</th>
                    <th>% incum no entregados</th>
                    <th>% incum por fecha</th>
                    <th>% incum por calidad</th>
                    <th>% incum por cantidad</th>
                    <th>Opciones</th>
                </tr>
            </thead>
        `


        dataset.map( row => {

            let toggleEnabledIcon = '';
            let iconToolTip = '';
            let metodo = '';

            if(row.estado) {
                //Cuando el registro esté habilitado
                iconToolTip = 'Deshabilitar'
                toggleEnabledIcon = 'block'
                metodo = 'openDeleteDialog';

            } else {
                iconToolTip = 'Habilitar'
                toggleEnabledIcon = 'check_circle_outline'
                metodo = 'openActivateDialog';
            }

            content+= `
                <tr>
                    <td>${row.usuario}</th>
                    <td>${row.organizacion}</th>
                    <td>${row.indice}</th>
                    <td>${row.totalcompromiso}</th>
                    <td>${row.cumplidos}</th>
                    <td>${row.nocumplidos}</th>
                    <td>${row.noconsiderados}</th>
                    <td>${row.incumnoentregados}</th>
                    <td>${row.incumporfecha}</th>
                    <td>${row.incumporcalidad}</th>
                    <td>${row.incumporcantidad}</th>
                    <td>
                        <a href="#" onclick="openUpdateDialog(${row.idindice})" class="edit"><i class="material-icons" data-toggle="tooltip" title="Editar">&#xE254;</i></a>
                        <a href="#" onclick="${metodo}(${row.idindice})" class="delete"><i class="material-icons" data-toggle="tooltip" title="${iconToolTip}">${toggleEnabledIcon}</i></a>
                    </td>
                </tr>
            `
        })
        //Se agrega el contenido a la tabla mediante su id
        document.getElementById('tbody-rows').innerHTML = content;
    }
}

const saveData = () => {
    // Se define atributo que almacenara la accion a realizar
    let action = '';
    // Se comprara el valor del input id 
    if (document.getElementById('idindice').value) {
        action = 'update'; // En caso que exista se actualiza 
    } else {
        action = 'create'; // En caso que no se crea 
    }
    // Ejecutamos la funcion saveRow de components y enviamos como parametro la API la accion a realizar el form para obtener los datos y el modal
    saveRow(API_INDICES, action, 'save-form', 'modal-form');
    // Se manda a llamar la funcion para llenar la tabla con la API de parametro
    readRows(API_INDICES);
}


function openDeleteDialog(id) {
    const data = new FormData();
    // Asignamos el valor de la data que se enviara a la API
    data.append('id', id);
    // Ejecutamos la funcion confirm delete de components y enviamos como parametro la API y la data con id del registro a eliminar
    confirmDesactivate(API_INDICES, data);
    // Se manda a llamar la funcion para llenar la tabla con la API de parametro
    readRows(API_INDICES);
}

// Función para establecer el registro a reactivar y abrir una caja de dialogo de confirmación.
function openActivateDialog(id) {
    const data = new FormData();
    // Asignamos el valor de la data que se enviara a la API
    data.append('id', id);
    // Ejecutamos la funcion confirm delete de components y enviamos como parametro la API y la data con id del registro a eliminar
    confirmActivate(API_INDICES, data);
    // Se manda a llamar la funcion para llenar la tabla con la API de parametro
    readRows(API_INDICES);
}

// Método manejador de eventos que se ejecuta cuando se envía el formulario de buscar.
document.getElementById('search-form').addEventListener('submit', function (event) {
    // Evitamos que la pagina se refresque 
    event.preventDefault();
    // Se ejecuta la funcion search rows de components y se envia como parametro la api y el form que contiene el input buscar
    searchRows(API_INDICES, 'search-form');
});

// Función para abrir el Form al momento de crear un registro
const openCreateDialog = () => {
    //Se restauran los elementos del form
    document.getElementById('save-form').reset();
    //Se abre el form
    $('#modal-form').modal('show');
    //Asignamos el titulo al modal
    document.getElementById('modal-title').textContent = 'Registrar Indice de Entrega'
    // Se llama a la function para llenar los Selects
    fillSelect(API_ADMINS, 'responsable', null);
    fillSelect(API_CLIENTES, 'cliente', null);
}

// Función para preparar el formulario al momento de modificar un registro.
function openUpdateDialog(id) {
    // Reseteamos el valor de los campos del modal
    document.getElementById('save-form').reset();
    //Se abre el form
    $('#modal-form').modal('show');
    //Asignamos el titulo al modal
    document.getElementById('modal-title').textContent = 'Registrar Indice de Entrega'
    // Asignamos el valor del parametro id al campo del id del modal
    document.getElementById('idindice').value = id;

    const data = new FormData();
    data.append('id', id);
    // Hacemos una solicitud enviando como parametro la API y el nombre del case readOne para cargar los datos de un registro
    fetch(API_INDICES + 'readOne', {
        method: 'post',
        body: data 
    }).then( request => { 
        // Luego se compara si la respuesta de la API fue satisfactoria o no
        if (request.ok) { 
            // console.log(request.text())
           return request.json()
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    // En ocurrir un error se muestra en la consola 
    }).then( response => {
        // En caso de encontrarse registros se imprimen los resultados en los inputs del modal
        if (response.status) {
            // Colocamos el nombre de los inpus y los igualamos al valor de los campos del dataset 
            document.getElementById('idindice').value = response.dataset[0].idindice;
            fillSelect(API_ADMINS, 'responsable', response.dataset[0].codigoadmin);
            fillSelect(API_CLIENTES, 'cliente', response.dataset[0].codigocliente);
            document.getElementById('organizacion').value = response.dataset[0].organizacion
            document.getElementById('indice').value = response.dataset[0].indice;
            document.getElementById('totalcompromiso').value = response.dataset[0].totalcompromiso;
            document.getElementById('cumplidos').value = response.dataset[0].cumplidos;
            document.getElementById('nocumplidos').value = response.dataset[0].nocumplidos;
            document.getElementById('noconsiderados').value = response.dataset[0].noconsiderados;
            document.getElementById('incumnoentregados').value = response.dataset[0].incumnoentregados;
            document.getElementById('incumporcalidad').value = response.dataset[0].incumporcalidad;
            document.getElementById('incumporfecha').value = response.dataset[0].incumporfecha;
            document.getElementById('incumporcantidad').value = response.dataset[0].incumporcantidad;
            } else { 
            // En caso de fallar se muestra el mensaje de error 
            sweetAlert(2, response.exception, null);
        }
    }
    ).catch(function (error) {
        console.log(error);
    });
}