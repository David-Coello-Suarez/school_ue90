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
                    {'defaultContent':`${permisos(JSON.parse(localStorage.getItem('opc')))}`,"orderable":false},
                    {'data':'idmenu'},
                    {'data':'idpadre',"orderable":false},
                    {'data':'nombre',"orderable":false},
                    {'data':'libreria',"orderable":false},
                    {'data':'orden',"orderable":false},
                    {'data':'estado',"orderable":false},
                    {'data':'ventana',"orderable":false},
                    {'data':'icono',"orderable":false}
                ],
                'language':{
                'url':'lib/js/DataTables/DataTables-1.10.18/spanish.json'
                }  
            }
            );
            $('.dataTables_wrapper').addClass('d-inline-block');
            break;
    }
});