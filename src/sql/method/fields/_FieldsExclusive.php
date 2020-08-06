<?php


class Sql__fieldsExclusive extends GenerateEntity {
  public function generate(){
    $this->start();
    $this->fields();
    $this->end();
    return $this->string;
  }








  protected function start(){
    $this->string .= "  public function _fieldsExclusive(){
    \$p = \$this->prf();
    return '
";
  }


  /**
  * Generar sql distinct fields
  * @param array $table Tabla de la estructura
  * @param string $string Codigo generado hasta el momento
  * @return string Codigo generado
  */
  protected function fields(){
    $pk = $this->getEntity()->getPk();
    $nfFk = $this->getEntity()->getFieldsByType(["nf","fk"]);

    $fields = ["' . \$this->_mappingField(\$p.'{$this->getEntity()->getPk()->getName()}') . '"];
    foreach ( $nfFk as $field ) {
      if(!$field->isExclusive()) continue;
      array_push($fields, "' . \$this->_mappingField(\$p.'{$field->getName()}') . '");
    }

    $this->string .= implode(", ", $fields);
  }


  protected function end(){
    $this->string .= "';
  }

";
  }




}
