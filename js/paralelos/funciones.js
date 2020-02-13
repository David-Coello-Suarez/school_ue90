import{data}from"../module/funciones.js?v=234";
let cargarData=()=>{
    let respuesta = data(`util/${$('#pagina').val()}/query.php`);
    switch (respuesta.estado) {
        case 1:
            let datas = respuesta.data;
            $("#IDParalelos").DataTable(
                {
                    destroy:true,
                    data:datas,
                    // "order":[[1,"asc"]],
                    'lengthMenu':[[7,14,28,-1],[7,14,28,'Todos'] ],
                    columns:[
                        {'data':'id',className:'text-center'},
                        {'data':'paralelo',className:'text-center',"orderable":false,searchable:false},
                        {'data':'estados',className:'text-center'},
                        {'data':'registro',className:'text-center',"orderable":false,searchable:false}
                    ],
                    'language':{
                    'url':'lib/js/DataTables/DataTables-1.10.18/spanish.json'
                    }  
                }
            );
            break;
        case 2:
            $("#modalMensaje .modal-title").html("Advertencia");
            $("#modalMensaje .modal-header").addClass("bg-warning");
            $("#modalMensaje .modal-body").html(respuesta.mensaje).addClass("text-center");
            $("#modalMensaje").modal("show");
            break;
    }
}
$(document).ready(()=>{
    cargarData();

    $('#IDParalelos').on('click','button.btn',function(){
        let datas = $('#IDParalelos').DataTable().row($(this).closest('tr')).data();
        let formData = new FormData();
        formData.append('id',datas['id']);
        datas['estado']=='A'?formData.append('estado','i'):formData.append('estado','a');
        let respuesta=data(`util/${$('#pagina').val()}/gestion.php`,formData);
        switch (respuesta.estado) {
            case 1:
                cargarData();
                break;
            case 2:
                $("#modalMensaje .modal-title").html("Advertencia");
                $("#modalMensaje .modal-header").addClass("bg-warning");
                $("#modalMensaje .modal-body").html(respuesta.mensaje).addClass("text-center");
                $("#modalMensaje").modal("show");
                break;
        }
    });
});