export let data=(server,datos=null)=>{
    let datas='';
    $.ajax({
        async:false,
        type:'POST',
        dataType:'json',
        url: server,
        data: datos,
        cache:false,
        processData:false,
        contentType:false,
        error:(error, status, request)=>{
            datas = error;
        },
        success:(respuesta)=>{
            datas=respuesta;
        }
    });
    return datas;
}
export let permisos=(opc)=>{
    let botones='';
    if(parseInt(opc.editar)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-success m-1 editar'><i class='fa fa-pencil-alt'></i></button>";
    }
    if(parseInt(opc.eliminar)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-danger m-1 eliminar'><i class='fa fa-trash-alt'></i></button>";
    }
    if(parseInt(opc.visual)==1){
        botones += "<button type='button' class='btn btn-sm rounded-circle btn-info m-1 visual'><i class='fa fa-eye'></i></button>";
    }
    return botones
}