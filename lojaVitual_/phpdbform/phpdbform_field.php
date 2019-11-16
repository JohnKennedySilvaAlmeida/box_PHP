<?php
/**************************************
 * phpdbform_field                    *
 **************************************
 * Base class for controls            *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2001 - 02 - 06                     *
 **************************************/

class phpdbform_field {
    var $form_name;
    var $field;
    var $title;
    var $size;
    var $maxlength;
    var $cols;
    var $rows;
    var $type;
    var $value;
    var $key;
	var $cssclass;
	var $updatable = true;

    // Javascript support
    var $onblur;
    var $tag_extra;

    function draw() { print $this->get_string(); }
    function process() {}
	function get_string() { return ""; }
    function delmagic()
    {
        // this function removes backslashes ig magic_quotes_gpc is on
        if( get_magic_quotes_gpc() ) $this->value = stripslashes( $this->value );
    }
}
?>