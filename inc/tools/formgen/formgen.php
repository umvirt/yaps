<?php

Class Formgen_Form{
var $method;
var $submitlabel;
var $action;
var $fields;
var $hiddenfields;

function __construct(){
$this->method;
$this->submitlabel;
$this->actions=Array();
$this->fields=Array();
$this->hiddenfields=Array();
}


function AddField($label,$name,$value="",$type="",$description=""){
$field=new Formgen_Field();
$field->label=$label;
$field->name=$name;
$field->value=$value;
$field->type=$type;
$field->description=$description;
//add field
$this->fields[]=$field;

return $field;
}

function AddHiddenField($name,$value){
$field=new Formgen_HiddenField();
$field->name=$name;
$field->value=$value;
//add field
$this->hiddenfields[]=$field;

return $this;
}



function render(){
//Visible fields
$f="";
foreach($this->fields as $field){
$f.="<div><b>$field->label</b></div>\n";
switch($field->type){
case 'textarea':
$f.="<div><textarea rows=6 cols=40 name=$field->name>$field->value</textarea><br/><i>$field->description</i></div>\n";
break;
case 'select':
$f.="<div><select name=$field->name>";
foreach($field->options as $option){
$selected="";
if($option->selected){
$selected="selected";
}
$f.="<option value=\"$option->value\" $selected>$option->label</option>";
}
$f.="</select><br/><i>$field->description</i></div>\n";
break;
case 'bool':
$checked="";
if($field->value){
$checked="checked";
}
$f.="<div><input name=$field->name type=checkbox $checked><br/><i>$field->description</i></div>\n";
break;

default:

$type="";
if($field->type){
$type="type=\"".$field->type."\"";
}
$f.="<div><input name=$field->name value=\"$field->value\" autocomplete=off $type><br/><i>$field->description</i></div>\n";
}

//Submit button
$sv="";
if($this->submitlabel){
$sv="value=\"$this->submitlabel\"";
}
$submit="<div><input type=submit $sv></div>";


//Hidden fields
$hf="";
foreach($this->hiddenfields as $field){
$hf.="<input type=hidden name=\"$field->name\" value=\"$field->value\">\n";
}


}


$a="";
if($this->action){
$a="action=\"$this->action\"";
}
if($this->method){
$a.=" method=\"$this->method\"";

}


$s="<form $a>\n$f\n$submit\n$hf</form>\n";
return($s); 
}

}

Class Formgen_Field{
var $label;
var $name;
var $value;
var $type;
var $options;

function __construct(){
$this->options=array();
}

function addOption($value,$label,$selected=false){
$option=new Formgen_Field_Option;

$option->value=$value;
$option->label=$label;
$option->selected=$selected;

$this->options[]=$option;

return $this;
}

}

class Formgen_Field_Option{
var $value;
var $label;
var $selected;
}

Class Formgen_HiddenField{
var $name;
var $value;
}


