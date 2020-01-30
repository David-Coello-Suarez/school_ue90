<!Doctype HTML>
<html lang='es'>
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <? html::title($parametro['nameMini']); echo "\r\n" ?>
        <!------------ Library Css ------------>
        <? html::css('lib/css/bootstrap/css/bootstrap.min.css'); echo "\r\n" ?>
        <? html::css('lib/css/font-awesome/all.css'); echo "\r\n" ?>
        <!------------ Script Css ------------->
        <? html::css('css/cabpie/style.min.css',$parametro['webversion']); ?>
    </head>
    <body>
        <div class='container-fluid'>
            <header class="main-header">
                <a href="./" class="logo">
                    <span class="logo-lg">
                        <?
                            $logo=str_replace(".","",$parametro['nameMini']);
                            echo '<b>'.$logo[0].$logo[1].'</b>'.$logo[2].$logo[3];
                        ?>
                    </span>
                    <span class="logo_mini">
                        <?
                            echo '<b>'.$logo[0].$logo[1].'</b>'.$logo[2].$logo[3];
                        ?>
                    </span>
                </a>
                <nav class="navbar">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button"></a>
                    <div class="float-right">
                        <ul class="nav navbar-nav">
                            <li class="btn-group">
                                <a href="#" class="btn btn-primary">Administrador</a>
                                <a href="#exit" class="btn btn-primary" data-toggle="collapse" aria-expanded="false"></a>
                                <div class="collapse exit" id="exit" style="">
                                    <ul>
                                        <li>
                                            <a href="#">
                                                <span>
                                                    Perfil
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#">
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
            </header>
            <aside class="main-sidebar">
                <ul class="menu">
                    <li>
                        <a href="#">
                            <i class="fa fa-home" aria-hidden="true"></i>
                            <span>
                                Inicio
                            </span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="#submenu1" aria-expanded="false" data-toggle="collapse">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                            <span>
                                Configuración
                            </span>
                        </a>
                        <div class="collapse submenu" id="submenu1">
                            <ul>
                                <li>
                                    <a href="#">
                                        <i class="fa fa-cogs" aria-hidden="true"></i>
                                        <span>
                                            Dashboard 1
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </aside>
            <footer>
                <strong>
                    Copyright <i class="fa fa-copyright" aria-hidden="true"></i>
                    2014-2019 <a href="http://adminlte.io">AdminLte.oi</a>
                </strong>
                All rights reserved.
                <div class="float-right d-none d-sm-inline-block">
                    <b>Version:</b> 3.0.1
                </div>
            </footer>
        </div>
    </body>
    <!------------ Library Js ------------>
    <? html::js('lib/js/jquery/jquery.min.js'); echo "\r\n" ?>
    <? html::js('lib/js/popper/popper.min.js','text'); echo "\r\n" ?>
    <? html::js('lib/css/bootstrap/js/bootstrap.min.js'); echo "\r\n" ?>
    <!------------ Script Js ------------>
    <? html::js("js/cabpie/funciones.js","",$parametro["webversion"]); echo "\r\n"?>
</html>