<button type="button" class="btn btn-sm btn-outline-info mb-2" data-toggle="modal" data-target="#modalFormDocente">
    <i class="fa fa-user-plus mr-2" aria-hidden="true"></i>
    <span>Agregar Nuevo Usuario</span>
</button>
<?
    "@".strtolower(str_replace(".","",$parametro['nameMini'])).".com";
    $formulario ="
        <!-- <form  role='form'> -->
            <div class='row'>
                <div class='align-self-center col-md-3 img-usuario text-center'>
                    <div class='tomarFoto d-none'>
                        <video id='videoCamera' class='w-100 rounded'></video>
                        <canvas id='canvasImg' class='w-100 rounded d-none'></canvas>
                        <div class='d-flex'>
                            <select id='selectDevice' class='form-control form-control-sm mr-2 btn-outline-primary'></select>
                            <button type='button' class='btn btn-outline-primary btn-sm' id='capturarImg' style='width: 65%!important'>
                                <i class='fa fa-camera fa-1x mr-1' aria-hidden='true'></i>
                                <span>Capturar</span>
                            </button>
                        </div>
                    </div>
                    <div class='imgUsuario mt-2'>
                        <button type='button' class='buttones p-2 btn position-absolute'>
                            <i class='fa fa-camera text-black-50' aria-hidden='true'></i>
                        </button>
                        <img src='img/system/user.jpg' alt='Foto del usuario' class='img-fluid imgUsuarios w-75 rounded'>
                    </div>
                </div>
                <div class='col-md-9'>
                    <div class='row'>
                        <div class='col-md'>
                            <h5 class='text-center'>Datos Principaales</h5>
                            <div class='row'>
                                <div class='col-sm'>
                                    ".
                                        html::input(array("idDni","text","Cédula de Identidad (*)","","Ej. 09999999999","form-control-sm","Cédula de identidad del docente","pattern='[0-9]{10}' required"))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array("idApellido","text","Apellidos del Docente (*)","","Apellidos","form-control-sm text-capitalize","Apellidos del docente","required"))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array("idNombre","text","Nombres del docente (*)","","Nombres","form-control-sm text-capitalize","Nombres del docente","required"))
                                    ."
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='row'>
                        <div class='col-md'>
                            <h5 class='text-center'>Datos Secundarios</h5>
                            <div class='row'>
                                <div class='col-sm'>
                                    ".
                                        html::input(array('idMovil','tel','Telefono Móvil (*)','','099-999-9999','form-control-sm','Ej.: 099-999-999','pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}" required'))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array('idFijo','text','Telefono Fijo','','99-99-999','form-control-sm','Ej. 22-22-222','pattern="[0-9]{2}-[0-9]{2}-[0-9]{2}-[0-9]{3}" required'))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array('idCorreo','email','Correo Eléctronico','','usuario@ejemplo.com','form-control-sm','Correo electrónico del docente',"required"))
                                    ."
                                </div>
                            </div>
                           <div class='row'>
                                <div class='col-md'>
                                ".
                                    html::textarea(array("idDireccion","Dirección Domiciliaria","form-control-sm ","Dirección Domiciliaria del postulante","Dirección del docente","pattern='[a-zA-Z0-9_]' required" ))
                                ."
                                </div>
                           </div>  
                        </div>
                    </div>
                </div>
            </div>
        <!-- </form> -->
    ";
    html::table("IDListDocente",array("ID","Gestión","Cédula","Usuario","Cambio contraseña","Apellidos","Nombres","Móvil","Fijo","Dirección","Correo Electronico","Fecha Registro"),"table-responsive");
    html::modal("formDocente","Nuevo Docente",$formulario);
?>