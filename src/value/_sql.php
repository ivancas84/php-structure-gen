<?php


class GenValue_sql extends GenerateEntity {


   public function generate(){
    $pkNfFk = $this->getEntity()->getFieldsByType(["pk", "nf", "fk"]);

    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        case "date": 
          $this->dateTime($field, "Y-m-d");
          $this->dateTime($field, "Y-m", "Ym");
          $this->dateTime($field, "Y", "Y");
        break;
        case "time": 
          $this->dateTime($field, "H:i:s");
          $this->dateTime($field, "H:i", "Hm"); 
        break;
        case "year": 
           $this->dateTime($field, "Y"); 
        break;
        case "timestamp": 
          $this->dateTime($field, "Y-m-d H:i:s");
          $this->dateTime($field, "Y-m-d", "Date");
          $this->dateTime($field, "Y-m", "Ym");
          $this->dateTime($field, "Y", "Y"); 
        break;
        case "boolean": $this->boolean($field); break;
        case "integer": case "float": $this->number($field); break;
        case "string": case "text": $this->text($field); break;
       }
     }
     return $this->string . "
";

    }


  protected function dateTime(Field $field, $format, $sufix = ""){
    $this->string .= "  public function sql{$field->getName('XxYy')}{$sufix}() { return \$this->sql->dateTime(\$this->{$field->getName('xxYy')}, \"{$format}\"); }
";
  }

  protected function boolean(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->sql->boolean(\$this->{$field->getName('xxYy')}); }
";
  }

  protected function number(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->sql->Number(\$this->{$field->getName('xxYy')}); }
";
  }

  protected function text(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->sql->string(\$this->{$field->getName('xxYy')}); }
";
  }


}
