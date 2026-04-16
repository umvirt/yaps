<?php
namespace Yaps\Tools\Formgen;
/**
 * @package YAPS\Tools\Formgen
 */
/**
 * Form class
 */
class FormgenForm{
    /**
     * HTML form method
     * @var string $method form's method 'get' or 'post'
     */
    var $method;
    /**
     * HTML form submit button label
     * @var string $label label for submit button
     */
    var $submitlabel;
    /**
     * HTML form action
     * @var string $action form's action
     */
    var $action;
    /**
     * HTML form visible fields list
     * @var array $fields form's visible fields
     */
    var $fields;
    /**
     * HTML form hidden fields list
     * @var array $hiddenfields form's hidden fields
     */
    var $hiddenfields;
    /**
     * Constructor
     */
    function __construct()
    {
        $this->method;
        $this->submitlabel;
        $this->actions=Array();
        $this->fields=Array();
        $this->hiddenfields=Array();
    }

    /**
     * Add visible field
     *
     * @param string $label field label
     * @param string $name field name
     * @param string $value field value
     * @param string $type field type
     * @param string $description field description text
     *
     * @return FormgenField field object
     */
    function AddField($label,$name,$value="",$type="",$description="")
    {
        // create field object
        $field=new FormgenField();

        // pass values
        $field->label=$label;
        $field->name=$name;
        $field->value=$value;
        $field->type=$type;
        $field->description=$description;

        //add field
        $this->fields[]=$field;

        return $field;
    }

    /**
     * Add hidden field
     *
     * @param string $name field name
     * @param string $value field value
     *
     * @return FormgenHiddenField hidden field object
     */
    function AddHiddenField($name,$value)
    {
        $field=new FormgenHiddenField();
        $field->name=$name;
        $field->value=$value;
        //add field
        $this->hiddenfields[]=$field;

        return $field;
    }


    /**
     * HTML form render
     *
     * @return string HTML code string
     */
    function render()
    {
        // Visible fields rendering
        // init buffer
        $f="";
        // process each visible field
        foreach($this->fields as $field)
        {
            // pass label to buffer
            $f.="<div><b>$field->label</b></div>\n";
            // check a field type
            switch($field->type)
            {
                // if 'textarea'
                case 'textarea':
                    // pass textarea to buffer
                    $f.="<div><textarea rows=6 cols=40 name=$field->name>$field->value</textarea><br/><i>$field->description</i></div>\n";
                break;
                // if 'select'
                case 'select':
                    // pass select to buffer
                    $f.="<div><select name=$field->name>";
                    // process each option
                    foreach($field->options as $option)
                    {
                        // init selected mark
                        $selected="";
                        // if option selected
                        if($option->selected)
                        {
                            // set mark value
                            $selected="selected";
                        }
                        // pass option to buffer
                        $f.="<option value=\"$option->value\" $selected>$option->label</option>";
                    }
                    // pass select to buffer
                    $f.="</select><br/><i>$field->description</i></div>\n";
                    break;
                // if binary field
                case 'bool':
                    // init checked mark
                    $checked="";
                    // if value is defined
                    if($field->value)
                    {
                        // set mark value
                        $checked="checked";
                    }
                    //pass checkbox field to buffer
                    $f.="<div><input name=$field->name type=checkbox $checked><br/><i>$field->description</i></div>\n";
                    break;
                // in other case
                default:
                    // define default value for field
                    $type="";
                    // if field for value is defined
                    if($field->type)
                    {
                        // pass it
                        $type="type=\"".$field->type."\"";
                    }
                    // pass field to buffer
                    $f.="<div><input name=$field->name value=\"$field->value\" autocomplete=off $type><br/><i>$field->description</i></div>\n";
            }
        }

        // Submit button
        // define default value
        $sv="";
        // if label is defined
        if($this->submitlabel)
        {
            //override default value
            $sv="value=\"$this->submitlabel\"";
        }
        // generate submit button code
        $submit="<div><input type=submit $sv></div>";


        // Hidden fields

        // init buffer
        $hf="";

        // process each hiden field
        foreach($this->hiddenfields as $field)
        {
            //pass field to buffer
            $hf.="<input type=hidden name=\"$field->name\" value=\"$field->value\">\n";
        }


        // init form action buffer
        $a="";
        // if form action is defined
        if($this->action)
        {
            //redefine bouffer
            $a="action=\"$this->action\"";
        }

        // if form method is defined
        if($this->method){
            //save it in buffer
            $a.=" method=\"$this->method\"";
        }

        // generate form code
        $s="<form $a>\n$f\n$submit\n$hf</form>\n";

        return($s);
    }
}

/**
 * Form visible field class
 */
class FormgenField
{
    /**
     * @var field label
     */
    var $label;
    /**
     * @var field name
     */
    var $name;
    /**
     * @var field value
     */
    var $value;
    /**
     * @var field type
     */
    var $type;
    /**
     * @var field options (used by select fields)
     */
    var $options;

    /**
     * Constructor
     */
    function __construct()
    {
        $this->options=array();
    }

    /**
     * Add option to field
     *
     * @param string value option value
     * @param string label option label
     * @param bool selected selected mark
     *
     * @return object field option object
     */
    function addOption($value,$label,$selected=false)
    {
        $option=new FormgenFieldOption;

        $option->value=$value;
        $option->label=$label;
        $option->selected=$selected;

        $this->options[]=$option;

        return $this;
    }
}

/**
 * Form field option class
 */
class FormgenFieldOption
{
    var $value;
    var $label;
    var $selected;
}
/**
 * Form hidden field class
 */
Class FormgenHiddenField{
    var $name;
    var $value;
}


