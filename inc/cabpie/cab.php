<!Doctype HTML>
<html lang='es'>
    <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <? html::title($parametro["nameEmpresa"]); echo "\r\n" ?>
        <!------------ Library Css ------------>
        <? html::css("lib/css/bootstrap/css/bootstrap.min.css"); echo "\r\n" ?>
        <? html::css("lib/css/font-awesome/all.css"); echo "\r\n" ?>
        <!------------ Script Css ------------>
        <? html::css("css/cabpie/style.min.css", $parametro["webversion"]); echo "\r\n" ?>
    </head>
    <body>
        <div class="container-fluid pl-0 pr-0" >
            <div class="sidebar-lateral">
                <div class="sidebar-header">
                    <a href="./">
                        <span class="logo-lg">                            
                            <? echo $logo = str_replace(".","",$parametro['nameEmpresa']) ?>
                        </span>
                        <span class="logo-mini">
                            <?
                                $logo_min = str_replace("","",$logo);
                                echo $logo_min[0].$logo_min[1].'<br>'.$logo_min[2].$logo_min[3];
                            ?>
                        </span>
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-home">

                                </i>
                                <span>
                                    Inicio
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#submenu1" data-toggle="collapse" aria-expanded="false">
                                <i class="fa fa-cogs"></i>
                                <span>
                                    Configuración
                                </span>
                            </a>
                            <div class="collapse" id="submenu1">
                                <ul>
                                    <li>
                                        <a href="#">
                                            <span>
                                                Dashboard 1
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="#">
                                <i class="fa fa-home">

                                </i>
                                <span>
                                    Inicio
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="sidebar-content">
                Hola desde mongolia
            </div>