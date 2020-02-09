                </div>
            </div>       
        </div>
    </body>
    <!---------- Library Jquery, Pooppers and Bootstrap ---------->
    <? html::js("lib/js/jquery/jquery-3.3.1.min.js",""); echo "\r\n"?>
    <? html::js("lib/js/popper/popper.min.js","text"); echo "\r\n"?>
    <? html::js("lib/css/bootstrap/js/bootstrap.min.js"); echo "\r\n"?>
    <!---------- Library Javascript ---------->
    <?
        for($f=0; $f<count($varAcceso['libreria']); $f++){
            switch ($varAcceso['libreria'][$f]) {
                case 'Datatables':
                    html::js("lib/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"); echo "\r\n";
                    break;
            }
        }
    ?>
    <!---------- Script JS ---------->
    <? html::js("js/cabpie/funciones.min.js","",$parametro['webversion']); echo "\r\n"?>
    <? html::js("js/$pagina/funciones.js","",$parametro['webversion']); echo "\r\n"?>
</html>