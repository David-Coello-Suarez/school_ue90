        </div>
    </body>
    <!------------ Library Js ------------>
    <? html::js("lib/js/jquery/jquery.min.js"); echo "\r\n"?>
    <? html::js("lib/js/popper/popper.min.js","text/javascript"); echo "\r\n"?>
    <? html::js("lib/css/bootstrap/js/bootstrap.min.js"); echo "\r\n"?>
    <!------------ Script Js ------------>
    <? html::js("js/cabpie/funciones.js","",$parametro["webversion"]); echo "\r\n"?>
</html>