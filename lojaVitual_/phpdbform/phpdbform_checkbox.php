<?php
/**************************************
 * phpdbform_checkbox                 *
 **************************************
 * Checkbox control                   *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2002 - 06 - 03                     *
 **************************************/

require_once("phpdbform/phpdbform_field.php");

class phpdbform_checkbox extends phpdbform_field {
    var $checked_value;
    var $unchecked_value;

    function phpdbform_checkbox($form_name,$field,$title,$checked_value,$unchecked_value)
    {
        $this->form_name = $form_name;
        $this->field = $field;
        $this->title = $title;
        $this->checked_value = $checked_value;
        $this->unchecked_value = $unchecked_value;
        $this->key = $this->form_name . "_" . $this->field;
		$this->cssclass = "field_checkbox";
    }

    function get_string()
    {
        if( strlen($this->onblur) ) $javascript = "onblur=\"{$this->onblur}\"";
        else $javascript="";
        $checked = ($this->value == $this->checked_value)?"checked":"";
        return "<input type=\"checkbox\" class=\"{$this->cssclass}\" name=\"$this->key\" value=\"1\" $checked $javascript {$this->tag_extra}>{$this->title}";
    }

    function process()
    {
        if( isset( $_POST[$this->key] ) )
            $this->value = $this->checked_value;
        else
            $this->value = $this->unchecked_value;
    }
}
?>