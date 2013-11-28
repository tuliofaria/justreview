<?php

App::uses('FormHelper', 'View/Helper');

class FFHelper extends FormHelper {
    public function input($name="", $options = array()){
      if ((isset($options["label"]))&&($options["label"]!=false)){
        $options["label"] = array('class' => 'col-sm-2 control-label', 'label'=>$options["label"]);
      }else{
        $options["label"] = array('class' => 'col-sm-2 control-label');
      }
       return parent::input($name, $options);
    }
    public function create($model = null, $options = array()){

    $optionsDef = array(
      'role'=>'form',
      'class' => 'form-horizontal',
      'inputDefaults' => array(
          'format' => array('before', 'label', 'between', 'input', 'error', 'after'),
          'div' => array('class' => 'form-group'),
          'label' => array('class' => 'col-sm-2 control-label'),
          'between' => '<div class="col-sm-10">',
          'after' => '</div>',
          'error' => array('attributes' => array('wrap' => 'span', 'class' => 'help-inline')))
      );
      if(count($options)>0){
        $optionsDef = array_merge($optionsDef, $options);
      }
      

      return parent::create($model, $optionsDef);
    }
}