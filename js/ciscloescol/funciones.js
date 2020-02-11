import {data,permisos} from "../module/funciones.js";
let cargarData=()=>{
    let respuesta = data(`util/${$('#pagina').val()}/query.php`);
    switch (respuesta.estado) {
        case 1:
            let datas=respuesta.data;
            $('#tableCicloLectivo').DataTable(
            {
                destroy:true,
                data:datas,
                "order":[[2,"asc"]],
                columns:[
                    {'data':'idCicloAcad',"orderable":false,searcheble:"false",className:"text-center"},
                    {'data':'nombre_lectivo',"orderable":false,className:"text-center"},
                    {'data':'anio_lectivo',"orderable":false,searcheble:"false",className:"text-center"},
                    {'data':'estados',"orderable":false,className:"text-center"},
                    {'data':'registro',"orderable":false,className:"text-center"},
                ],
                'language':{
                'url':'lib/js/DataTables/DataTables-1.10.18/spanish.json'
                }
            }
            );
            break;
    }
}
$(document).ready(()=>{
    cargarData();

    $('#tableCicloLectivo').on('click','button.btn',function(){
        let datas = $('#tableCicloLectivo').DataTable().row($(this).closest('tr')).data();
        let formData = new FormData();
        formData.append('idCicloAcad',datas['idCicloAcad']);
        formData.append('nombre_lectivo',datas['nombre_lectivo']);
        formData.append('anio_lectivo',datas['anio_lectivo']);
        if(datas['estado']=='I'){
            formData.append('estado','A');
        }else{
            formData.append('estado','I');
        }
        let respuesta = data(`util/${$('#pagina').val()}/gestion.php`,formData);
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

    let f = new Date();
    if( f.getMonth() > 0 && f.getMonth() < 2 ){
        $('.newPlusPeriod').on('click',()=>{
            let formData = new FormData();
            formData.append('idCicloAcad',0);
            formData.append('nombre_lectivo',"Año Lectivo");
            formData.append('anio_lectivo',f.getFullYear());
            formData.append('estado',"A");
            let respuesta = data(`util/${$('#pagina').val()}/gestion.php`,formData);
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
    }else{
        $('.newPlusPeriod').prop({disabled:true});
    }
}); 