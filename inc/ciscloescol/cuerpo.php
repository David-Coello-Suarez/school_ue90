<button type="button" class="btn btn-sm mb-2 p-1 btn-outline-info newPlusPeriod">
    <i class="fa fa-plus-circle mr-1" aria-hidden="true"></i>
    <span>
        Habilitar Nuevo Periodo Lectivo
    </span>
</button>
<?
    $arrayMeses[date("n")-1];

    html::table("tableCicloLectivo",array('ID','Nombre','Periodo Lectivo','Estado','Fecha de Habilitación'));
?>