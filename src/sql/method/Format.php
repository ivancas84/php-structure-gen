<?php


class Sql_FormatSql extends GenerateEntity{
  /**
   * format no controla el valor del atributo admin de los fields
   * Por mas que no se utilice define todos los valores
   */

protected function start(){
    $this->string .= "
  public function format(array \$row){
    \$row_ = array();
";

  }


  public function generate(){
    $this->start();
    $this->pk();
    $this->nf($this->getEntity());
    $this->fk($this->getEntity());
    $this->end();

    return $this->string;
  }

  protected function pk(){
    //verificar existencia de pk: Si la pk no esta definida entonces no se realizara la actualizacion
    $field = $this->getEntity()->getPk();
    switch ( $field->getDataType()) {
      case "integer":
        $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->positiveIntegerWithoutZerofill(\$row['" . $field->getName() . "']);
";
      break;
      case "text": case "string":
        $this->string .= "    if(array_key_exists('{$field->getName()}', \$row))  \$row_['" . $field->getName() . "'] = \$this->format->string(\$row['" . $field->getName() . "']);
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





  protected function integerNonZero(Field $field){

    $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->positiveIntegerWithoutZerofill(\$row['" . $field->getName() . "']);
";

  }


  protected function number(Field $field){

    $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->numeric(\$row['" . $field->getName() . "']);
";

  }

  protected function dateTime(Field $field, $format){

    $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->dateTime(\$row['" . $field->getName() . "'], \"{$format}\");
";
  }




  protected function string(Field $field){

      $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->string(\$row['" . $field->getName() . "']);
";


  }



  protected function boolean(Field $field){

    $this->string .= "    if(array_key_exists('{$field->getName()}', \$row)) \$row_['" . $field->getName() . "'] = \$this->format->boolean(\$row['" . $field->getName() . "']);
";
  }




  //USAR getDataType
  protected function fk(Entity $entity){
    $fk = $entity->getFieldsFk();

    foreach ( $fk as $field) {

      switch ( $field->getDataType()) {
        case "integer": $this->integerNonZero($field); break;
        case "text": case "string": $this->string($field); break;
      }






    }
  }


  protected function end(){
    $this->string .= "
    return \$row_;
  }
";
  }




}
