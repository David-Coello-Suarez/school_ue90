import{data}from"../module/funciones.js?v=120";
let cargarData=()=>{
    let respuesta = data(`util/${$("#pagina").val()}/query.php`);
    switch (respuesta.estado) {
        case 1:
            let datas=respuesta.data;
            $("#IDListDocente").DataTable({
                destroy:true,
                data:datas,
                "order":[[2,"desc"],[1,"asc"]],
                columns:[
                    {'data':'id',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'estados',className:"text-center align-middle ",searcheble:"false"},
                    {'data':'dni',className:"text-center align-middle"},
                    {'data':'usuario',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'apellidos',className:"text-center text-capitalize align-middle","orderable":false},
                    {'data':'nombres',className:"text-center text-capitalize align-middle","orderable":false},
                    {'data':'movil',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'fijo',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'direcciones',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'mail',className:"text-center align-middle","orderable":false,searcheble:"false"},
                    {'data':'registro',className:"text-center align-middle","orderable":false,searcheble:"false"},
                ],
                'language':{
                'url':'lib/js/DataTables/DataTables-1.10.18/spanish.json'
                }
            })
            break;
        default:
            alert("Sin data para mostrar.");
            break;
    }
}
$(document).ready(()=>{
    cargarData();

    $("#IDListDocente").on('click','button.estado',function(){
        let datath=$("#IDListDocente").DataTable().row($(this).closest('tr')).data();
        let formData = new FormData();
        formData.append('id',datath['id']);
        formData.append('estado',datath['estado']=="A"?"i":"a");
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
});