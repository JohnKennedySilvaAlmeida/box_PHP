<?php
/**************************************
 * phpdbform_listbox                  *
 **************************************
 * ListBox with db list control       *
 * even using a db conn, it can be    *
 * used at phpform.                   *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2001 - 06 - 13                     *
 **************************************/

require_once("phpdbform/phpdbform_field.php");

class phpdbform_listbox extends phpdbform_field {
    var $db;
    var $table;
    var $lbkey;
    var $lbvalue;
    var $order;

    // todo: add support for more than one key/value (would use 2+ fields)
    function phpdbform_listbox( $form_name, $field, $title, &$db, $table, $key, $value, $order )
    {
        $this->form_name = $form_name;
        $this->field = $field;
        $this->title = $title;
        $this->db = $db;
        $this->table = $table;
        $this->lbkey = $key;
        $this->lbvalue = $value;
        $this->order = $order;
        $this->key = $this->form_name . "_" . $this->field;
		$this->cssclass = "field_listbox";
    }

    function get_string()
    {
        if( strlen($this->onblur) ) $javascript = "onblur=\"{$this->onblur}\"";
        else $javascript="";
        if( !empty($this->title) ) $txt = $this->title."<br>";
		else $txt = "";
        $stmt = "select {$this->lbkey}, {$this->lbvalue} from {$this->table} order by {$this->order}";
        $ret = $this->db->query( $stmt, "populating listbox" );
        $txt .= "<select class=\"{$this->cssclass}\" name=\"$this->key\" $javascript {$this->tag_extra}>\n";
        while( $row = $this->db->fetch_row($ret) )
        {
            $selected = ($row[0] == $this->value)?"selected":"";
            $txt .= "<option value=\"".htmlspecialchars($row[0])."\" $selected>"
                .htmlspecialchars($row[1])."</option>\n";
        }
        return $txt."</select>\n";
    }

    function process()
    {
        if( isset( $_POST[$this->key] ) ) {
            $this->value = $_POST[$this->key];
            $this->delmagic();
        }
    }
}
?>