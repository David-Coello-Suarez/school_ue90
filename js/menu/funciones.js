import {data,permisos} from '../module/funciones.js?v=19';
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
                    {'data':'libreria',"orderable":false,searcheble:"false"},
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
}

$(document).ready(function(){
    cargarData();

    $('input:radio[name=es_menu]').change(()=>{
        if( $('input:radio[name=es_menu]:checked').val() == 'NO' ){
            $('#ventana').prop('disabled',false);
        }else{
            $('#ventana').prop('disabled',true);
        }
    });

    $('#tableMenu').on('click','.editar',function(){
        let date = $('#tableMenu').DataTable().row( $(this).closest('tr') ).data();
        let menu=date['es_menu']=='NO'?false:true;
        $('#idmenu').val(date['idmenu']);
        $('#idpadre').val(date['idpadre']);
        $('#nombre').val(date['nombre']);
        $('#ventana').val(date['ventana']).prop({disabled:menu}); //Valor vacio
        $('#librerias').val(date['libreria']);
        $('#orden').val(date['orden']);
        $('input:radio[name=es_menu][value='+date['es_menu'].substring(0,1)+']').prop({checked:true});
        $('input:radio[name=estado][value='+date['estado'].substring(0,1)+']').prop({checked:true});
        $('#listicons option[value="'+date["listIcon"]+'"]').prop({selected:true});
    });

    $("#formModalMenu").submit(function(e){
        e.preventDefault();
        
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

        //let estado=data(`util/${$('#pagina').val()}/gestion.php`,formData);

        return false;
    });
});