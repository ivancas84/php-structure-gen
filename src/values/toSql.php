<?php


class Values_toSql extends GenerateEntity {


   public function generate(){
    $this->start();
    $this->body();
    $this->end();
    return $this->string;
  }
  
  protected function start(){
    $this->string .= "  public function _toSql(){
    \$row = [];
";
  }



  protected function body(){
    $pkNfFk = $this->getEntity()->getFields();
    foreach ( $pkNfFk as $field ) {
      switch($field->getDataType()){
        case "date": $this->datetime($field, "Y-m-d"); break;
        case "timestamp": $this->datetime($field, "Y-m-d H:i:s"); break;
        case "time": $this->datetime($field, "H:i:s"); break;
        case "year": $this->datetime($field, "Y"); break;  
        case "integer": case "float": $this->number($field); break;
        default: $this->defecto($field); break;
      }
    }
  }


  protected function end(){
      $this->string .= "    return \$row;
  }

";
    }

  protected function number($field){
    $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) {
      \$row[\$p . \"" . $field->getName() . "\"] = (is_null(\$this->{$field->getName('xxYy')}())) ? 
        'null' : \$this->{$field->getName('xxYy')}();
    }
"; 
  }
  

  protected function datetime($field, $format){
      $f = empty($format) ? "" : "\"{$format}\"";
      $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) {
      \$row[\$p . \"" . $field->getName() . "\"] = (empty(\$this->{$field->getName('xxYy')}())) ? 
        'null' : \$this->{$field->getName('xxYy')}->format({$f});
    }
";
    }

    protected function boolean($field){
      $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) {
      if (is_null(\$this->{$field->getName('xxYy')}())) {
        \$row[\$p . \"" . $field->getName() . "\"] = \"null\";
        return;
      }
      \$row[\$p . \"" . $field->getName() . "\"] = (\$this->{$field->getName('xxYy')}) ? \"true\" : \"false\";
    }
";
    }


    protected function defecto($field){
      $this->string .= "    if(\$this->{$field->getName('xxYy')} !== UNDEFINED) \$row[\"" . $field->getName() . "\"] = empty(\$this->{$field->getName('xxYy')}) ? \"null\" : \$this->_db->escapeString(\$this->{$field->getName('xxYy')});
";
    }


}
