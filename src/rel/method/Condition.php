<?php


require_once("GenerateEntityRecursiveFk.php");

class Rel_condition extends GenerateEntityRecursiveFk{



  protected function start(){
    $this->string .= "  public function condition(\$field, \$option, \$value) {
    if(\$c = \$this->container->getCondition(\$this->entityName)->_eval(\$field, [\$option, \$value])) return \$c;
";
  }


  protected function body(Entity $entity, $prefix){
    $this->string .= "    if(\$c = \$this->container->getCondition('{$entity->getName()}','{$prefix}')->_eval(\$field, [\$option, \$value])) return \$c;
";
  }

  protected function end(){
    $this->string .= "  }

";
  }







}
