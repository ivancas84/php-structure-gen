<?php

require_once("GenerateFileEntity.php");

class GenClassSqlFormat extends GenerateFileEntity{

  public function __construct(Entity $entity) {
    $dir = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/sqlFormat/";
    $name = "_" . $entity->getName("XxYy") . ".php";
    parent::__construct($dir, $name, $entity);
  }

  protected function generateCode(){
    $this->start();

    $this->pk();
    $this->nf($this->getEntity());
    $this->fk($this->getEntity());

    
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php
require_once(\"class/model/entityOptions/SqlFormat.php\");

class _" .  $this->getEntity()->getName("XxYy") . "SqlFormat extends SqlFormatEntityOptions{

";
  }

  protected function end(){
    $this->string .= "

}
" ;
  }


  protected function pk(){
    //verificar existencia de pk: Si la pk no esta definida entonces no se realizara la actualizacion
    $field = $this->getEntity()->getPk();
    switch ( $field->getDataType()) {
      case "text": case "string":
        $this->string .= "  public function id(\$value) { return \$this->format->string(\$value); }
";
      break;


    }

  }



  protected function nf(Entity $entity){
    $nf = $entity->getFieldsNf();

    //redefinir valores de timestamp y datetime. Los valores timestamp y datetime se dividen en diferentes partes correspondientes a dia mes anio hora minutos y segundos. Dichas partes deben unirse en una sola variable
    foreach ( $nf as $field ) {
      switch ( $field->getDataType()) {
        case "timestamp": $this->dateTime($field, "Y-m-d H:i:s"); break;
        case "date": $this->dateTime($field, "Y-m-d"); break;
        case "time": $this->dateTime($field, "H:i:s"); break;
        case "year": $this->dateTime($field, "Y"); break;
        case "text": case "string": $this->string($field); break;
        case "integer": case "float": $this->number($field); break;
        case "boolean": $this->boolean($field); break;
      }
    }
    unset ( $field );
  }

  protected function fk(Entity $entity){
    $fk = $entity->getFieldsFk();

    foreach ( $fk as $field) {

      switch ( $field->getDataType()) {
        case "text": case "string": $this->string($field); break;
      }
    }
  }




  protected function integerNonZero(Field $field){

    $this->string .= "  public function {$field->getName('xxYy')}(\$value) { return \$this->format->positiveIntegerWithoutZerofill(\$value); }
";

  }


  protected function number(Field $field){

    $this->string .= "  public function {$field->getName('xxYy')}(\$value) { return \$this->format->numeric(\$value); }
";

  }

  protected function dateTime(Field $field, $format){
    $this->string .= "  public function {$field->getName('xxYy')}(\$value) { return \$this->format->dateTime(\$value, \"{$format}\"); }
";
  }

  protected function string(Field $field){

      $this->string .= "  public function {$field->getName('xxYy')}(\$value) { return \$this->format->string(\$value); }
";


  }



  protected function boolean(Field $field){

    $this->string .= "  public function {$field->getName('xxYy')}(\$value) { return \$this->format->boolean(\$value); }
";
  }


}
