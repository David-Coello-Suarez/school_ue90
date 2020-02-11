<?
    class html
    {
        /* funcion para el tutilo de la pagina*/
        public static function title($x,$y=NULL)
        {
            return print_r("<title>$x".( $y==NULL ? '': " | $y" )."</title>");
        }

        /* funcion para agregar los links css*/
        public static function css($css,$webversion=NULL)
        {
            return print_r("<link type='text/css' rel='stylesheet' href='".$css.($webversion!=NULL?"?v=$webversion":"")."' />");
        }
        
        /* funcion para agregar los scripts js*/
        public static function js($js,$type=NULL,$webversion=NULL)
        {
            return print_r("<script type='".($type!=NULL?"text/javascript":"module")."' src='".$js.( $webversion != NULL ? "?v=$webversion":"" )."'></script>");
        }
        
        /* funcion para agregar inputs*/
        public static function input($prop=array())
        {
            $inputs="
                <div class='form-group'>
                    <label for='".strtolower($prop[0])."'>".$prop[2]."</label>
                    <input type='".$prop[1]."' ".($prop[1]=='number'?'min="0" max="'.$prop[3].'" placeholder="1"':' placeholder="'.$prop[4].'"')." class='form-control ".$prop[5]."' id='".strtolower($prop[0])."' name='".strtolower($prop[0])."' aria-describedby='help".ucfirst($prop[0])."' ".($prop[7]!=NULL?$prop[7]:'')." />
                    <small id='help".ucfirst($prop[0])."' class='text-muted'>".$prop[6]."</small>
                </div>
            "; 
            return $inputs;
        }

        public static function textarea($prop=array()){
            $textarea="
                <div class='form-group'>
                    <label for='".strtolower($prop[0])."'>".$prop[1]."</label>
                    <textarea row='3' cols='10' class='form-control ".$prop[2]."' name='".strtolower($prop[0])."' id='".strtolower($prop[0])."' aria-describedby='help".ucfirst($prop[0])."' placeholder='".ucfirst($prop[3])."'></textarea>
                    <small id='help".ucfirst($prop[0])."' class='text-muted'>".$prop[4]."</small>
                </div>
            ";
            return $textarea;
        }

        public static function select($id,$label,$arreglo=array(),$optVal=array(),$textAyuda=NULL,$class='form-control-sm')
        {
            $select="<div class='form-group'>";
            $select.="<label for='".strtolower($id)."'>$label</label>";
            $select.="<select name='".strtolower($id)."' id='".strtolower($id)."' class='form-control ".$class."' aria-describedby='help".ucfirst($id)."'>";
            foreach($arreglo as $fila=>$i){
                $select.="<option value='".$arreglo[$fila][$optVal[0]]."'>".$arreglo[$fila][$optVal[1]]."</option>";
            }
            $select.="</select>";
            $select.="<small id='help".ucfirst($id)."' class='text-muted'>$textAyuda</small>";
            $select.="</div>";
            return $select;
        }

        public static function table($id=NULL,$th=array(),$class=NULL)
        {
            $table = "<table id='".($id!=NULL?"$id":"")."' class='table ".($class!=NULL?"$class":"")."' width='100%'>";
            $table .= '<thead>';
            foreach($th as $fila )
            {
                $table .= "<th>$fila</th>";
            }
            $table .= '</thead>';
            $table .= "</table>";
            return print_r($table);
        }

        public static function modal($id,$title=NULL,$detalles=NULL,$tamaño=NULL)
        {
            $buscar=strpos($detalles,'form');
            print_r('
            <div class="modal fade pl-0 pr-0" id="modal'.ucfirst($id).'" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                <div class="modal-dialog '.$tamaño.'" role="document" '.($buscar>0?"style='max-width: 1100px;'":"").'>
                    <div class="modal-content">
                        <div class="modal-header p-2">
                            <h5 class="modal-title">'.($title).'</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                        </div>
                        '.($buscar>0?"<form id='form".ucfirst($id)."' role='form'>":"").'
                        <div class="modal-body p-2">
                            '.($detalles).'
                        </div>
                        <div class="modal-footer p-2">
                        '.($buscar>0?"<button type=\"submit\" class=\"btn btn-sm btn-success\"><i class=\"fa fa-save mr-1\"></i> Guardar</button>":"").'
                            <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><span aria-hidden="true" class="mr-1">&times;</span> Cerrar</button>                            
                        </div>
                        '.($buscar>0?"</form>":"").'
                    </div>
                </div>
            </div>');
        }

        public static function radioCheckbox($prop=array())
        {
            $radioCheckbox=" <div class='col p-sm-0 text-center'> <div class='h5'>".ucfirst($prop[0])."</div>";
            for($i=0; $i<count($prop[3]); $i++){
                $radioCheckbox.="
                    <div class='form-check form-check-inline'>
                        <label class='form-check-label'>
                            <input type='".$prop[1]."' class='form-check-input' name='".strtolower($prop[2])."' id='".strtolower($prop[2]).$i."' ".($i==0?'checked':'')." value='".substr(strtoupper($prop[3][$i]),0,1)."' /> ".ucfirst($prop[3][$i])."
                        </label>
                    </div>
                ";
            }
            $radioCheckbox.="</div>";
            return $radioCheckbox;

        }
    }
?>