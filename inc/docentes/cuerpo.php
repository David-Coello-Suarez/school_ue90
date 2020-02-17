<button type="button" class="btn btn-sm btn-outline-info mb-2" data-toggle="modal" data-target="#modalFormDocente">
    <i class="fa fa-user-plus mr-2" aria-hidden="true"></i>
    <span>Agregar Nuevo Usuario</span>
</button>
<?
    "@".strtolower(str_replace(".","",$parametro['nameMini'])).".com";
    $formulario ="
        <!-- <form  role='form'> -->
            <div class='row'>
                <div class='col-md-3 text-center img-usuario'>
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
                                        html::input(array("idDni","text","Cédula de Identidad (*)","","Ej. 09999999999","form-control-sm","Cédula de identidad del docente","required"))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array("idApellido","text","Apellidos del Docente (*)","","Apellidos","form-control-sm","Apellidos del docente","required"))
                                    ."
                                </div>
                                <div class='col-sm'>
                                    ".
                                        html::input(array("idNombre","text","Nombres del docente (*)","","Nombres","form-control-sm","Nombres del docente","required"))
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
                                    html::input(array('idMovil','text','Telefono Móvil (*)','','Móvil / Celular (099999999)','form-control-sm','Telefono móvil del docente','required'))
                                ."
                            </div>
                            <div class='col-sm'>
                                ".
                                    html::input(array('idFijo','text','Telefono Fijo','','Fijo / Convencional','form-control-sm','Telefono fijo del docente',''))
                                ."
                            </div>
                            <div class='col-sm'>
                                ".
                                    html::input(array('idCorreo','email','Correo Eléctronico','','usuario@ejemplo.com','form-control-sm','Correo electrónico del docente'))
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
<!--
<form id='formDocente' role='form'>
    <div class='row'>
        <div class='col-md-3 text-center img-usuario'>
            <div class="tomarFoto d-none mt-2">
                <video id="videoCamera" class="w-100 rounded"></video>
                <canvas id="canvasImg" class="w-100 rounded d-none"></canvas>
                <div class="d-flex">
                    <select id="selectDevice" class="form-control form-control-sm mr-2 btn-outline-primary"></select>
                    <button type="button" class="btn btn-outline-primary btn-sm" id="capturarImg" style="width: 60%!important">
                        <i class="fa fa-camera fa-1x mr-1" aria-hidden="true"></i>
                        <span>Capturar</span>
                    </button>
                </div>
            </div>
            <div class="imgUsuario mt-2">
                <button type="button" class="button p-2 btn">
                    <i class="fa fa-camera text-black-50" aria-hidden="true"></i>
                </button>
                <img src="img/system/user.jpg" alt="Foto del usuario" class="img-fluid imgUsuarios w-75 rounded">
            </div>
        </div>
        <div class="col-md-9">            
            <div class="row">
                <div class="col-md">
                    <h5 class="text-center">Datos Principales</h5>
                    <div class="row">
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idDni","text","Cédula de Identidad (*)","","Ej. 09999999999","form-control-sm","Cédula de identidad del docente","required")) );
                            ?>
                        </div>
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idApellido","text","Apellidos del Docente (*)","","Apellidos","form-control-sm","Apellidos del docente","required")));
                            ?>
                        </div>
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idNombre","text","Nombres del docente (*)","","Nombres","form-control-sm","Nombres del docente","required")));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <h5 class="text-center">Datos Secundarios</h5>
                    <div class="row">
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idMovil","text","Telefono Móvil (*)","","Móvil / Celular (099999999)","form-control-sm","Telefono móvil del docente","required")));
                            ?>
                        </div>
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idFijo","text","Telefono Fijo","","Fijo / Convencional","form-control-sm","Telefono fijo del docente","")));
                            ?>
                        </div>
                        <div class="col-sm">
                            <?
                                print_r(html::input(array("idCorreo","email","Correo Eléctronico","","usuario@ejemplo.com","form-control-sm","Correo electrónico del docente")));
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form> -->
