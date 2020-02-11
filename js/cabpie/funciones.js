$(document).ready(()=>{
    $('.sidebar-toggle').click(()=>{
        $('.sidebar').toggleClass('active');
        $('.content').toggleClass("active");
    });   
    let editar=$('#editar').val(),  
    eliminar=$('#eliminar').val(),
    visual=$('#visual').val(),
    insertar=$('#insertar').val(),
    opc={editar:editar,eliminar:eliminar,visual:visual,insertar:insertar};
    localStorage.setItem($('#logoMini').val(),JSON.stringify(opc));
});