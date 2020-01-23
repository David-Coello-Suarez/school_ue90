<!Doctype HTML>
<html lang='es'>
    <head>
        <meta charset='UTF-8'/>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <meta http-equiv='X-UA-Compatible' content='ie=edge'>
        <? echo html::title($parametro["nameEmpresa"]);?>
    </head>
    <body>
        <div class='container'>
            <? $arr = array("a","b","c","d");  ?>
            <? html::table("IDList",$arr) ?>