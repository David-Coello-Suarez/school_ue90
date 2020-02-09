<button type="button" class="btn btn-sm btn-outline-info mb-3" data-toggle="modal" data-target="#modalMenu">
    <span>
        <i class="fa fa-list mr-1" aria-hidden="true"></i>    Agregar Menú
    </span>
</button>
<?  
    $th=array('Gestión','ID','ID Padre','Nombre','Menú Principal','Librerias','Orden','Estado','Ventana','Icono');
    html::table('tableMenu',$th,'table-responsive-sm text-center'); 
    $json=array(
        ["nombre"=>"david","iso"=>"da","edad"=>12],
        ["nombre"=>"fernando","iso"=>"fe","edad"=>15],
        ["nombre"=>"coello","iso"=>"co","edad"=>13],
        ["nombre"=>"suarez","iso"=>"su","edad"=>14]
    );
    $search=array("edad","nombre");
    $formulario='
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        '.
                        html::input(array('idmenu','number','ID Menú principal',$parametro['numMaxMenu'],'Ej. ID Menú 2','form-control-sm','Configura esta opción si eres desarrollador','disabled',"0")).
                        html::input(array('nombre','text','Nombre del Menú','','Eje. Plantilla A','form-control-sm','Nombre del Menú Principal','')).
                        html::select("listIcons",'Lista de Iconos',$json,$search,"Selección de Iconos")
                        .'
                    </div>
                    <div class="col-md-4">
                        '.
                            html::input(array("idpadre","number","ID Padre",$parametro['numMaxMenu'],"Eje. ID Padre 2","form-control-sm","Menú Principal al que pertenecera este submenu",'')).
                            html::input(array('ventana','text','Nombre de la ventana','','Eje. Plantilla de Configuración','form-control-sm','Nombre de la ventana','disabled')).
                            html::textarea(array("Librerias","Librerias que se va a utilizar","form-control-sm","Eje. Libreria A, Libreria B, Etc","Configura esta opción si eres desarrollador",''))
                        .'
                    </div>
                    <div class="col-md-4">
                        '.
                            html::input(array('orden','number','Orden',$parametro['numMaxMenu'],'Eje. Orden 3','form-control-sm','Esta opción sirve para mostrar el orden del submenu',''))
                            
                            .'
                        <div class="row ml-0 mt-4">
                            '.
                                html::radioCheckbox(array('Estado','radio','estado',array('Activo','Inactivo'))).
                                html::radioCheckbox(array("Es Menú","radio",'es_menu',array("Si","No")))
                            .'
                        </div>
                    </div>
                </div>
            </div>
    ';
    html::modal('modalMenu','Nuevo Menú',$formulario,'modal-dialog-centered');
?>