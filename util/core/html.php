<?
    class html
    {
        /* funcion para el tutilo de la pagina*/
        public static function title($x,$y=NULL)
        {
            return "<title>$x".( $y==NULL ? '': " | $y" )."</title>";
        }

        /* funcion para agregar los links css*/
        public static function css($css)
        {
            return print_r("<link type='text/css' rel='stylesheet' href='".$css."' />");
        }
        
        /* funcion para agregar los scripts js*/
        public static function js($js,$webversion=NULL)
        {
            return print_r("<script type='module' language='javascript' src='".$js.( $webversion != NULL ? "?v=$webversion":"" )."'></script>");
        }
        
        /* funcion para agregar los scripts js*/
        public static function input($type="text",$id=NULL,$value=NULL,$clases=NULL)
        {
            return "<input type='".$type."' name='".($id!=NULL?"$id":"")."' id='".($id!=NULL?"$id":"")."' class='form-control ".($clases!=NULL?"$clases":"")."' value='".($value!=NULL?"$value":"")."' />";
        }

        public static function select($id=NULL,$option=array(),$selected=NULL,$class=NULL)
        {
            $select = "<select name='".($id!=NULL?"$id":"")."' id='".($id!=NULL?"$id":"")."' class='form-control ".($class!=NULL?" $class":"")."'>";
            $selecction="";
            foreach($option as $fila)
            {
                if($fila == $selected)
                {
                    $selecction="selected";
                }
                else
                {
                    $selecction=NULL;
                }
                $select .= "<option value='".$fila."' $selecction>$fila</option>";
            }
            $select .= "</select>";
            return print_r($select);
        }

        public static function table($id=NULL,$th=array(),$class=NULL)
        {
            $table = "<table id='".($id!=NULL?"$id":"")."' class='table ".($class!=NULL?"$class":"")."'>";
            $table .= '<thead>';
            foreach($th as $fila )
            {
                $table .= "<th>$fila</th>";
            }
            $table .= '</thead>';
            $table .= "</table>";
            return print_r($table);
        }
    }
?>