<?php


class Values_check extends GenerateEntity {


   public function generate(){
    $this->start();
    $this->body();
    $this->end();
    return $this->string;
  }
  
  protected function start(){
    $this->string .= "  public function _check(){
";
  }



  protected function body(){
    $pkNfFk = $this->getEntity()->getFields();
    foreach ( $pkNfFk as $field ) $this->check($field);
  }


  protected function end(){
      $this->string .= "    return !\$this->_getLogs()->isError();
  }

";
  }

  protected function check($field){
    $this->string .= "    \$this->check{$field->getName('XxYy')}(\$this->{$field->getName('xxYy')});
"; 
  }

}
