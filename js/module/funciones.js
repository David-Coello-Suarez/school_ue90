export let data=(urls,data=null,btn=null)=>{
    let datas='',bt='';
    $.ajax({
        async:false,
        type:'POST',
        url:urls,
        dataType:'json',
        data:data!=""?data:'',
        error:(error, status, request)=>{
            console.log(error);
        },
        beforeSend:()=>{
            if(btn!=null){
                bt=$(`${btn}`)[0].textContent;
                $(`${btn}`).html(`<i class="fas fa-circle-notch fa-spin"></i>`);
            }
        },
        success:(repuesta)=>{
            datas=repuesta;
        },
        complete:()=>{
            if (btn != "") {
                $(`${btn}`).html(bt);
            }
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