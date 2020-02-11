import {data,permisos} from '../module/funciones.js?v=25';
let cargarData =()=>{
    let datas=data(`util/${$('#pagina').val()}/query.php`);
    switch(datas.estado){
        case 1:
            let menu=datas.data;
            $('#tableMenu').DataTable(
            {
                destroy:true,
                data:menu,
                "order":[[1,"asc"]],
                columns:[
                    {'defaultContent':`${permisos(JSON.parse(localStorage.getItem($('#logoMini').val())))}`,"orderable":false,searcheble:"false"},
                    {'data':'idmenu',searcheble:"false"},
                    {'data':'idpadre',"orderable":false,searcheble:"false"},
                    {'data':'nombre',"orderable":false},
                    {'data':'es_menu',"orderable":false},
                    {'data':'librerias',"orderable":false,searcheble:"false",className:"text-capitalize"},
                    {'data':'orden',"orderable":false,searcheble:"false"},
                    {'data':'estado',"orderable":false},
                    {'data':'ventana',"orderable":false},
                    {'data':'icono',"orderable":false,searcheble:"false"}
                ],
                'language':{
                'url':'lib/js/DataTables/DataTables-1.10.18/spanish.json'
                }  
            }
            );
            break;
    }
    return false;
}

$(document).ready(function(){
    cargarData();



    $('#tableMenu').on('click','.editar',function(){
        let date = $('#tableMenu').DataTable().row( $(this).closest('tr') ).data();
        $('#idmenu').val(date['idmenu']);
        $('#idpadre').val(date['idpadre']);
        $('#nombre').val(date['nombre']);
        $('#ventana').val(date['ventana']); //Valor vacio
        $('#librerias').val(date['libreria']);
        $('#orden').val(date['orden']);
        $('input:radio[name=es_menu][value='+date['es_menu'].substring(0,1)+']').prop({checked:true});
        $('input:radio[name=estado][value='+date['estado'].substring(0,1)+']').prop({checked:true});
        $('#listicons option[value="'+date["listIcon"]+'"]').prop({selected:true});

        console.log(date['orden']);

        $('#modalMenu').modal('show');
    });

    $("#idmenu").prop({value:'0'});

    $("#formMenu").submit(function(){
        
        let formData=new FormData();
        formData.append('idmenu',$("#idmenu").val());
        formData.append('idpadre',$("#idpadre").val());
        formData.append('nombre',$("#nombre").val());
        formData.append('ventana',$("#ventana").val());
        formData.append('librerias',$("#librerias").val().replace(/\s/gmi,""));
        formData.append('orden',$("#orden").val());
        formData.append('es_menu',$('input:radio[name=es_menu]:checked').val().substring(0,1));
        formData.append('estado',$('input:radio[name=estado]:checked').val().substring(0,1));
        formData.append('listicons',$("#listicons option:selected").val());
        
        console.log($('#orden').val());

        let respuesta=data(`util/${$('#pagina').val()}/gestion.php`,formData);
        switch (respuesta.estado) {
            case 1:
                $('#modalMenu').modal('hide');
                setTimeout(()=>{
                    $('#modalMensaje .modal-body').html(respuesta.mensaje).addClass('text-center');
                    $('#modalMensaje .modal-title').html('Éxito')
                    $('#modalMensaje .modal-header').addClass('bg-success');
                    $('#modalMensaje').modal('show');
                },500);
                cargarData();
                break;
            case 2:
                $('#modalMenu').modal('hide');
                setTimeout(()=>{
                    $('#modalMensaje .modal-body').html(respuesta.mensaje).addClass('text-center');
                    $('#modalMensaje .modal-title').html('Advertencia')
                    $('#modalMensaje .modal-header').addClass('bg-warning');
                    $('#modalMensaje').modal('show');
                },500);
                break;
        }
        return false;
    });
});