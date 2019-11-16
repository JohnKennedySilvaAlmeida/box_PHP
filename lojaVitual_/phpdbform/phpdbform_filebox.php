<?php
/**************************************
 * phpdbform_filebox                  *
 **************************************
 * filebox control                    *
 * - Allow fiel uploading             *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2002 - 10 - 15                     *
 **************************************/

require_once("phpdbform/phpdbform_field.php");

class phpdbform_filebox extends phpdbform_field {
	var $maxsize;
	var $uploadfolder;

    function phpdbform_filebox( $form_name, $field, $title, $size, $maxsize, $uploadfolder )
    {
        $this->form_name = $form_name;
        $this->field = $field;
        $this->title = $title;
        $this->size = $size;
        $this->maxsize = $maxsize;
		$this->uploadfolder = $uploadfolder;
        $this->key = $this->form_name . "_" . $this->field;
		$this->cssclass = "field_filebox";
    }

    function get_string()
    {
        if( strlen($this->onblur) ) $javascript = "onblur=\"{$this->onblur}\"";
        else $javascript="";
        if( !empty($this->title) ) $ret = $this->title."<br>";
		else $ret = "";
		
		return $ret."<input type=\"file\" class=\"{$this->cssclass}\" name=\"{$this->key}\" size={$this->size} $javascript {$this->tag_extra}>\n";
    }

    function process()
    {
//        if( isset( $_POST[$this->key] ) ) {
//            $this->value = $_POST[$this->key];
//            $this->delmagic();
//        }
    }
}