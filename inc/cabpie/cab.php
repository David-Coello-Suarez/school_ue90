<!Doctype HTML>
<html lang='es'>
    <head>
        <meta charset='UTF-8' />
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <? html::title($parametro["nameEmpresa"]); echo "\r\n" ?>
        <!------------ Library Css ------------>
        <? html::css("lib/css/font-awesome/all.css"); echo "\r\n" ?>
        <? html::css("lib/css/bootstrap/css/bootstrap.min.css"); echo "\r\n" ?>
        <!------------ Script Css ------------>
        <? html::css("css/cabpie/style.min.css", $parametro["webversion"]); echo "\r\n" ?>
    </head>
    <body>
        <div class="container-fluid pl-0 pr-0" >
            <div class="sidebar-lateral">
                <div class="sidebar-header">
                    <a href="./">
                        <span class="logo-mini">
                            <?
                                $logo_min = str_replace(".","",$parametro['nameEmpresa']);
                                echo '<b>'.$logo_min[0].$logo_min[1].'</b><br>'.$logo_min[2].$logo_min[3];
                            ?>
                        </span>
                        <span class="logo-lg">
                            <? echo '<b>'.$logo_min[0].$logo_min[1].'</b>'.$logo_min[2].$logo_min[3] ?>
                        </span>
                    </a>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li>
                            <a href="#">
                                <i class="fa fa-home"></i>
                                <span>
                                    Inicio
                                </span>
                            </a>
                        </li>
                        <li class="treeview">
                            <a href="#submenu1" data-toggle="collapse" aria-expanded="true">
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
                <nav class="navbar">
                    <a href="#" class="bn sidebar-toggle" data-toggle="offcanvas" role="button"></a>
                    <div class="exit">
                        <ul class="nav navbar-nav">
                            <li class="btn-group ">
                                <a href="#" class="btn btn-primary bt">
                                    <i class="fa fa-user mr-2"></i>
                                    Administrador
                                </a>
                                <a href="#opc1" class="btn btn-primary bt" data-toggle="collapse" aria-expanded="false">
                                    <i class="fa fa-angle-double-down"></i>
                                </a>
                                <div class="collapse sub" id="opc1">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-user mr-1"></i>
                                                <span>Perfil</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
                                                <i class="fa fa-sign-in-alt"></i>
                                                <span>
                                                    Salir
                                                </span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <section class="date">
                    <?
                        $dias = array('Lunes','Martes','Miercoles','Jueves','Sábado','Domingo');
                        $mes=array('Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Agosto','Octubre','Noviembre','Diciembre');
                        echo $day=$dias[date('L')].' '.date('d').' de '.$mes[date('n')].', '.date('Y');
                    ?>
                </section>