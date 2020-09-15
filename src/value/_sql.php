<?php


class GenValue_sql extends GenerateEntity {


   public function generate(){
     $pkNfFk = $this->getEntity()->getFieldsByType(["pk", "nf", "fk"]);

     foreach ( $pkNfFk as $field ) {
       switch($field->getDataType()){
         case "date": $this->dateTime($field, "Y-m-d"); break;
         case "time": $this->dateTime($field, "H:i:s"); break;
         case "year": $this->dateTime($field, "Y"); break;
         case "timestamp": $this->dateTime($field, "Y-m-d H:i:s"); break;
         case "boolean": $this->boolean($field); break;
         case "integer": case "float": $this->number($field); break;
         case "string": case "text": $this->text($field); break;
       }
     }
     return $this->string . "
";

    }


  protected function dateTime(Field $field, $format){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->_sqlDateTime(\$this->{$field->getName('xxYy')}, \"{$format}\"); }
";
  }

  protected function boolean(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->_sqlBoolean(\$this->{$field->getName('xxYy')}); }
";
  }

  protected function number(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->_sqlNumber(\$this->{$field->getName('xxYy')}); }
";
  }

  protected function text(Field $field){
    $this->string .= "  public function sql{$field->getName('XxYy')}() { return \$this->_sqlString(\$this->{$field->getName('xxYy')}); }
";
  }


}
