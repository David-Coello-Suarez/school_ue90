<!Doctype HTML>
<html lang='es'>
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <? html::title($parametro['nameEmpresa']); echo "\r\n";?>
        <!---------- Library Css and FontAwesome ---------->
        <? html::css("lib/css/bootstrap/css/bootstrap.min.css"); echo "\r\n"; ?>
        <? html::css("lib/css/font-awesome/all.css"); echo "\r\n"; ?>
        <!---------- Library Css Element ---------->
        <?
            for($f=0; $f<count($varAcceso['libreria']); $f++){
                switch ($varAcceso['libreria'][$f]) {
                    case 'Datatables':
                        html::css("lib/js/DataTables/DataTables-1.10.18/css/jquery.dataTables.min.css",1); echo "\r\n";
                        break;
                }
            }
        ?>
        <!---------- Script Css ---------->
        <? html::css("css/cabpie/style.min.css",$parametro['webversion']); echo "\r\n"; ?>
        <!---------- Permisos de la App ---------->
        <input type="hidden" id="pagina" value="<? echo $pagina; ?>">
        <input type="hidden" id="editar" value="1">
        <input type="hidden" id="eliminar" value="1">
        <input type="hidden" id="visual" value="1">
        <input type="hidden" id="insertar" value="1">
    </head>
    <body>
        <div class="wrapper d-flex align-items-stretch">
            <nav class="sidebar">
                <div class="sidebar-header p-2">
                    <a href="<? echo $parametro['paginaDefault']; ?>" >
                        <h3>
                            <?php
                                $logo=explode(" ",str_replace("de","",$parametro['nameEmpresa']));
                                $arrayLogo=array();
                                $cont=0;
                                foreach ($logo as $fila) {
                                    !empty($logo[$cont])? $arrayLogo[].=$logo[$cont]:'';
                                    $cont++;
                                }
                                echo $arrayLogo[0].' '.$arrayLogo[1].'<br>'.$arrayLogo[2].' '.$arrayLogo[3];
                            ?>
                        </h3>
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="list-unstyled mb-0">
                        <?  
                            $listMenu="";
                            for($f = 0; $f<count($vectorMenu); $f++){
                                if($vectorMenu[$f]['es_menu']=='SI'){
                                    $menuActivo="";
                                    $listMenuInt='<div class="collapse subm" id="sub'.$f.'"> <ul class="list-unstyled mb-0">';
                                    for($i=0; $i<count($vectorMenu); $i++){
                                        if(
                                            $vectorMenu[$i]['es_menu']=='NO' &&
                                            $vectorMenu[$i]['idpadre']==$vectorMenu[$f]['idmenu']
                                        ){
                                            if(
                                                $pagina==$vectorMenu[$i]['ventana']
                                            ){
                                                $menuActivo.="active";
                                            }
                                            $listMenuInt.='
                                                <li class="d-block">
                                                    <a href="'.$vectorMenu[$i]['ventana'].'">
                                                        <i class="'.$vectorMenu[$i]['icono'].' mr-1" aria-hidden="true"></i>
                                                        <span>'.$vectorMenu[$i]['nombre'].'</span>
                                                    </a>
                                                </li>
                                            ';
                                        }
                                    }
                                    if(
                                        $pagina==$vectorMenu[$f]['ventana']
                                    ){
                                        $menuActivo.="active";
                                    }
                                    $listMenuInt.='</ul></div>';
                                    $listMenu.='
                                        <li class="d-block '.($vectorMenu[$f]['es_menu']=='SI'?'submenu':'').' '.$menuActivo.'">
                                            <a '.($vectorMenu[$f]['es_menu']=='SI'?'class="collapse" data-toggle="collapse"':'').' href="'.($vectorMenu[$f]['ventana']!=NULL || !empty($vectorMenu[$f]['ventana']) ? $vectorMenu[$f]['ventana']:"#sub".$f).'">
                                                <i class="'.$vectorMenu[$f]['icono'].' mr-2" aria-hidden="true"></i>
                                                <span>'.$vectorMenu[$f]['nombre'].'</span>
                                            </a>
                                            '.($vectorMenu[$f]['es_menu']=='SI'?$listMenuInt:'').'
                                        </li>
                                    ';
                                }
                            }
                            echo $listMenu;
                        ?>
                    </ul>
                </div>
            </nav>
            <div class="content">
                <nav class="navbar">
                    <button type="button" class="btn btn-sm float-left sidebar-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </button>
                    <div class="float-right mr-4">
                        <ul class="list-unstyled m-0">
                            <li class="btn-group">
                                <a href="#" class="btn btn-primary">
                                    <i class="fa fa-user mr-2" aria-hidden="true"></i>
                                    Administrador
                                </a>
                                <a href="#action" class="btn btn-primary" data-toggle="collapse" aria-expanded="false">
                                </a>
                                <div class="collapse sign-out" id="action">
                                    <ul class="list-unstyled mb-0">
                                        <li class="d-block">
                                            <a href="#">
                                                <i class="fa fa-user-circle mr-2" aria-hidden="true"></i>
                                                <span>Perfil</span>
                                            </a>
                                        </li>
                                        <li class="d-block">
                                            <a href="#">
                                                <i class="fa fa-sign-in-alt mr-2" aria-hidden="true"></i>
                                                <span>Salir</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container mt-2">