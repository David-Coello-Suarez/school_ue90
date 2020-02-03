                </div>
            </div>       
        </div>
    </body>
    <!---------- Library Jquery, Pooppers and Bootstrap ---------->
    <? html::js("lib/js/jquery/jquery.min.js"); echo "\r\n"?>
    <? html::js("lib/js/popper/popper.min.js","text"); echo "\r\n"?>
    <? html::js("lib/css/bootstrap/js/bootstrap.min.js"); echo "\r\n"?>
    <!---------- Script JS ---------->
    <? html::js("js/cabpie/funciones.min.js","",$parametro['webversion']); echo "\r\n"?>
</html>