<?
    class html
    {
        /* funcion para el tutilo de la pagina*/
        public static function title($x,$y=null)
        {
            return "<title>$x".( $y==null ? '': " | $y" )."</title>";
        }

        /* funcion para agregar los links css*/
        public static function css($css)
        {
            return print_r("<link type='text/css' rel='stylesheet' href='".$css."' />");
        }
        
        /* funcion para agregar los scripts js*/
        public static function js($js,$webversion=null)
        {
            return print_r("<script type='module' language='javascript' src='".$js.( $webversion != null ? "?v=$webversion":"" )."'></script>");
        }
        
        /* funcion para agregar los scripts js*/
        public static function input($type="text",$id=null,$value=null,$clases=null)
        {
            return "<input type='".$type."' name='".($id!=NULL?"$id":"")."' id='".($id!=null?"$id":"")."' class='form-control ".($clases!=null?"$clases":"")."' value='".($value!=NULL?"$value":"")."' />";
        }

        public static function select($id=null,$option=array(),$selected=NULL,$class=null)
        {
            $select = "<select name='".($id!=NULL?"$id":"")."' id='".($id!=NULL?"$id":"")."' class='form-control ".($class!=null?" $class":"")."'>";
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
    }
?>