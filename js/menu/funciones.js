import {data,permisos} from '../module/funciones.js?v=1';
$(document).ready(()=>{
    let datas=data(`util/${JSON.parse(localStorage.getItem('opc')).page}/query.php`);
    switch(datas.estado){
        case 1:
            let menu=datas.data;
            $('#tableMenu').DataTable(
            {
                destroy:true,
                data:menu,
                "order":[[1,"asc"]],
                columns:[
                    {'defaultContent':`${permisos(JSON.parse(localStorage.getItem('opc')))}`,"orderable":false,searcheble:"false"},
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
            $('.dataTables_wrapper').addClass('d-inline-block');
            break;
    }
    $('input:radio[name=es_menu]').change(()=>{
        if( $('input:radio[name=es_menu]:checked').val() == 'N' )
        {
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
        $('#ventana').val(date['ventana']).prop('disabled',menu);
        $('#librerias').val(date['libreria']);
        $('#orden').val(date['orden']);
        $('input:radio[name=es_menu][value='+date['es_menu']+']').prop('checked',true);
        console.log( date['es_menu'] );
    });
});