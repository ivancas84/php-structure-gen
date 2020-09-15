<?php


class GenValue_isEmpty extends GenerateEntity {


   public function generate(){
    $pkNfFk = $this->getEntity()->getFields();
    foreach ( $pkNfFk as $field ) {
      $this->string .= "  public function isEmpty{$field->getName('XxYy')}() { if(!Validation::is_empty(\$this->{$field->getName('xxYy')})) return false; }
";
    }
    return $this->string . "
";
  }

}
