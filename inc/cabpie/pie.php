                <footer>
                    <strong>
                        Copyright  <i class="fas fa-copyright" aria-hidden="true"></i>
                        2014-2019 <a href="http://adminlte.io">AdminLte.io</a>
                    </strong>
                        All rights reserved.
                        <div class="float-right d-none d-sm-inline-block">
                            <b>Version</b> 3.0.1
                        </div>
                </footer>
            </div>
        </div>
    </body>
    <!------------ Library Js ------------>
    <? html::js("lib/js/jquery/jquery.min.js"); echo "\r\n"?>
    <? html::js("lib/js/popper/popper.min.js","text/javascript"); echo "\r\n"?>
    <? html::js("lib/css/bootstrap/js/bootstrap.min.js"); echo "\r\n"?>
    <!------------ Script Js ------------>
    <? html::js("js/cabpie/funciones.js","",$parametro["webversion"]); echo "\r\n"?>
</html>