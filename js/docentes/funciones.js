import{data,fotosImg,cedulaCoorecta,correoCorrecto}from"../module/funciones.js?v=1849";
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
                    {'data':'id',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'estados',className:"text-center align-middle  pl-1",searcheble:"false"},
                    {'data':'dni',className:"text-center align-middle pl-1"},
                    {'data':'usuario',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'contrasena',className:'text-center align-middle text-uppercase pl-1 pr-1','orderable':false,searcheble:'false'},
                    {'data':'apellidos',className:"text-center text-capitalize align-middle pl-2 pr-2","orderable":false},
                    {'data':'nombres',className:"text-center text-capitalize align-middle pl-1 pr-1","orderable":false},
                    {'data':'movil',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'fijo',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'direcciones',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'mail',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
                    {'data':'registro',className:"text-center align-middle pl-1 pr-1","orderable":false,searcheble:"false"},
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

    $(".buttones").on('click',()=>{
        $(".imgUsuario").addClass("d-none");
        $(".tomarFoto").removeClass("d-none");
        let dispositos={
            video:$("#videoCamera")[0],
            option_value:$("#selectDevice")[0],
            button_cap_img:$("#capturarImg")[0],
            canvas_img:$("#canvasImg")[0],
            lienzo_img:$(".imgUsuarios")[0],
            foto_usuario:$(".imgUsuario")[0],
            foto_sistema:$(".tomarFoto")[0]
        };
        fotosImg(dispositos);
    });

    $("#idmovil").mask("099-999-9999");
    $("#idfijo").mask("04-99-99-999");
    $("#iddni").mask("0999999999");

    $("#modalFormDocente").submit(function(e){
        let formData = new FormData();

        if( cedulaCoorecta($("#iddni"))==true && correoCorrecto($("#idcorreo"))==true ){
            formData.append("existe",$("#iddni").is(":disabled")?1:0);
            formData.append("direccion",$("#iddireccion").val());
            formData.append("apellido",$("#idapellido").val());
            formData.append("nombre",$("#idnombre").val());
            formData.append("movil",$("#idmovil").val());
            formData.append("mail",$("#idcorreo").val());
            formData.append("cedula",$("#iddni").val());
            formData.append("fijo",$("#idfijo").val());
            let respuesta = data(`util/${$('#pagina').val()}/gestion-docentes.php`,formData);
            console.log(respuesta);
        }        

        return false;
    });

});