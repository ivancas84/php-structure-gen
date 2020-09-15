<?php


class GenValue_json extends GenerateEntity {


   public function generate(){
     $this->defecto($this->getEntity()->getPk());
     $pkNfFk = $this->getEntity()->getFieldsByType(["nf", "fk"]);

     foreach ( $pkNfFk as $field ) {

       switch($field->getDataType()){
         case "date": $this->dateTime($field); break;
         case "time": $this->dateTime($field); break;
         case "year": $this->dateTime($field); break;
         case "timestamp": $this->dateTime($field); break;
         //case "boolean": $this->boolean($field); break;
         //case "string": case "text": $this->text($field); break;
         default: $this->defecto($field);

       }
     }
     return $this->string . "
";

  }

  protected function dateTime(Field $field){
    $this->string .= "  public function json{$field->getName('XxYy')}() { return \$this->{$field->getName('xxYy')}('c'); }
";
  }

  protected function defecto(Field $field){
    $this->string .= "  public function json{$field->getName('XxYy')}() { return \$this->{$field->getName('xxYy')}; }
";
  }

}
