<?php


class GenValue_resetters extends GenerateEntity {


   public function generate(){
     $pkNfFk = $this->getEntity()->getFields();

     foreach ( $pkNfFk as $field ) {

       switch($field->getDataType()){
         case "string": case "text": $this->text($field); break;

       }
     }
     
     return $this->string . "
";

    }

  protected function text(Field $field){
    $this->string .= "  public function reset{$field->getName('XxYy')}() { if(!Validation::is_empty(\$this->{$field->getName('xxYy')})) \$this->{$field->getName('xxYy')} = preg_replace('/\s\s+/', ' ', trim(\$this->{$field->getName('xxYy')})); }
";
  }


}
