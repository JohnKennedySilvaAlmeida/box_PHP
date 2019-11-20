<?php
/**************************************
 * phpdbform_textarea                 *
 **************************************
 * Textarea control                   *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2001 - 02 - 06                     *
 **************************************/

require_once("phpdbform/phpdbform_field.php");

class phpdbform_textarea extends phpdbform_field {

    function phpdbform_textarea( $form_name, $field, $title, $cols, $rows )
    {
        $this->form_name = $form_name;
        $this->field = $field;
        $this->title = $title;
        $this->cols = $cols;
        $this->rows = $rows;
        $this->key = $this->form_name . "_" . $this->field;
		$this->cssclass = "field_textbox";
    }

	function get_string()
	{
        if( strlen($this->onblur) ) $javascript = "onblur=\"{$this->onblur}\"";
        else $javascript="";
        if( !empty($this->title) ) $title = $this->title."<br>";
		else $title = "";
        return $title."<textarea wrap class=\"{$this->cssclass}\" name=\"$this->key\" cols=\"$this->cols\""
			." rows=\"$this->rows\" $javascript {$this->tag_extra}>".htmlspecialchars($this->value)."</textarea>\n";
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