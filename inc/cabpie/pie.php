                </div>
            </div>       
        </div>
    </body>
    <!---------- Library Jquery, Pooppers and Bootstrap ---------->
    <? html::js("https://code.jquery.com/jquery-3.4.1.min.js",""); echo "\r\n"?>
    <? html::js("https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js","text"); echo "\r\n"?>
    <? html::js("https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"); echo "\r\n"?>
    <!---------- Library Javascript ---------->
    <?
        for($f=0; $f<count($varAcceso['libreria']); $f++){
            switch ($varAcceso['libreria'][$f]) {
                case 'datatables':
                    html::js("lib/js/DataTables/DataTables-1.10.18/js/jquery.dataTables.min.js"); echo "\r\n";
                    break;
                case 'mask':
                    html::js("https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"); echo "\r\n";
                    break;
            }
        }
    ?>
    <!---------- Script JS ---------->
    <? html::js("js/cabpie/funciones.min.js","",$parametro['webversion']); echo "\r\n"?>
    <? html::js("js/$pagina/funciones.js","",$parametro['webversion']); echo "\r\n"?>
</html>