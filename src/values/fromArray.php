<?php


class ClassValues_fromArray extends GenerateEntity {


   public function generate(){
    $this->start();
    $this->body();
    $this->end();
    return $this->string;
  }

  protected function start(){
    $this->string .= "  public function _fromArray(array \$row = NULL, string \$p = \"\"){
    if(empty(\$row)) return;
";
  }


  protected function body(){
    $pkNfFk = $this->getEntity()->getFields();
    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()) {
        case "date": case "time": case "timestamp": case "year":
          $this->string .= "    if(key_exists(\$p.\"" . $field->getName() . "\", \$row)) \$this->set{$field->getName('XxYy')}(\$row[\$p.\"" . $field->getName() . "\"]);
";      
        break;
        default: 
          $this->string .= "    if(key_exists(\$p.\"" . $field->getName() . "\", \$row)) \$this->set{$field->getName('XxYy')}(\$row[\$p.\"" . $field->getName() . "\"]);
";      
      }
    }
  }

  protected function end(){
    $this->string .= "    return \$this;
  }

";
  }

}
