$(document).ready(()=>{
    $('.sidebar-toggle').click(()=>{
        $('.sidebar').toggleClass('active');
    });   
    let page=$('#pagina').val(),
    editar=$('#editar').val(),  
    eliminar=$('#eliminar').val(),
    visual=$('#visual').val(),
    insertar=$('#insertar').val(),
    opc={page:page,editar:editar,eliminar:eliminar,visual:visual,insertar:insertar};
    localStorage.setItem('opc',JSON.stringify(opc));
});