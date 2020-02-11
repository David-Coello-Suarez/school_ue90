import{data}from"../module/funciones.js";
let cargarData=()=>{
    let respuesta = data(`util/${$('#pagina').val()}/query.php`);
    switch (respuesta.estado) {
        case 1:
            console.log( respuesta.data );
            break;
        case 2:
            $("#modalMensaje .modal-title").html("Advertencia");
            $("#modalMensaje .modal-header").addClass("bg-warning");
            $("#modalMensaje .modal-body").html(respuesta.mensaje).addClass("text-center");
            $("#modalMensaje").modal("show");
            break;
    }
}