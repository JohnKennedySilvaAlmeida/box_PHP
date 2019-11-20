<?php
/**************************************
 * phpform                            *
 **************************************
 * Base class for forms               *
 *                                    *
 * Paulo Assis <paulo@phpdbform.com>  *
 * 2001 - 02 - 06                     *
 **************************************/
// leave this as is
//echo "magic" .  ini_set ( "magic_quotes_gpc", "0" );
//echo "register" . ini_set ( "register_globals", "0" );

require_once("phpdbform/phpdbform_field.php");
require_once("phpdbform/phpdbform_textbox.php");
require_once("phpdbform/phpdbform_textarea.php");
require_once("phpdbform/phpdbform_password.php");
require_once("phpdbform/phpdbform_static_listbox.php");
require_once("phpdbform/phpdbform_hidden.php");
require_once("phpdbform/phpdbform_checkbox.php");
require_once("phpdbform/phpdbform_listbox.php");
require_once("phpdbform/phpdbform_static_radiobox.php");
require_once("phpdbform/phpdbform_date.php");
require_once("phpdbform/phpdbform_filebox.php");

class phpform {
    var $name;
    var $action;
    var $fields;

    function phpform( $name, $action = "" )
    {
        $this->fields = array();
        $this->name = $name;
        if( $action == "" ) $action = basename($_SERVER["PHP_SELF"]);
        $this->action = $action;
    }

    function add_textbox( $field, $title, $size, $maxlength=0 )
    {
        $this->fields[$field] = new phpdbform_textbox( $this->name, $field, $title, $size, $maxlength );
    }

    function add_textarea( $field, $title, $cols, $rows )
    {
        $this->fields[$field] = new phpdbform_textarea( $this->name, $field, $title, $cols, $rows );
    }

    function add_password( $field, $title, $size, $maxlength=0 )
    {
        $this->fields[$field] = new phpdbform_password( $this->name, $field, $title, $size, $maxlength );
    }

    function add_static_listbox( $field, $title, $options )
    {
        $this->fields[$field] = new phpdbform_static_listbox( $this->name, $field, $title, $options );
    }

    function add_hidden( $field )
    {
        $this->fields[$field] = new phpdbform_hidden( $this->name, $field );
    }

    function add_checkbox( $field, $title, $checked_value, $unchecked_value )
    {
        $this->fields[$field] = new phpdbform_checkbox( $this->name, $field, $title,  $checked_value, $unchecked_value );
    }

    function add_listbox( $field, $title, &$db, $table, $key, $value, $order )
    {
        $this->fields[$field] = new phpdbform_listbox( $this->name, $field, $title, $db, $table, $key, $value, $order );
    }

    function add_static_radiobox( $field, $title, $options )
    {
        $this->fields[$field] = new phpdbform_static_radiobox( $this->name, $field, $title, $options );
    }

    function add_date( $field, $title, $dateformat )
    {
        $this->fields[$field] = new phpdbform_date( $this->name, $field, $title, $dateformat );
    }

    function add_date_cal( $field, $title, $dateformat )
    {
        $this->fields[$field] = new phpdbform_date_cal( $this->name, $field, $title, $dateformat );
    }

    function add_filebox( $field, $title, $size, $maxsize, $uploadfolder )
    {
        $this->fields[$field] = new phpdbform_filebox( $this->name, $field, $title, $size, $maxsize, $uploadfolder );
    }

    function draw_submit( $button_text )
    {
        print "<input type=\"hidden\" name=\"{$this->name}_phpform_sent\" value=\"1\">\n"
             ."<input type=\"submit\" name=\"submit\" class=\"button\" value=\"$button_text\">\n";
    }

    function draw_header()
    {
        print "<form method=\"post\" action=\"{$this->action}\" name=\"{$this->name}\" enctype=\"multipart/form-data\">\n";
    }

    function draw_footer()
    {
        print "</form>\n";
    }

    function draw()
    {
        $this->draw_header();
        reset($this->fields);
        while( $field = each($this->fields) )
        {
//            print $field[1]."<br>";
            $field[1]->draw();
            echo "<br>";
        }
        print "<br>";
        $this->draw_submit( "Submit" );
    }

    function process()
    {
        if( !isset( $_POST["{$this->name}_phpform_sent"] ) ) return false;
        reset($this->fields);
        while( $field = each($this->fields) )
        {
            $this->fields[$field[1]->field]->process();
        }
        return true;
    }

    function clear()
    {
        reset($this->fields);
        while( $field = each($this->fields) )
        {
            $this->fields[$field[1]->field]->value = "";
        }
    }
}
?>
