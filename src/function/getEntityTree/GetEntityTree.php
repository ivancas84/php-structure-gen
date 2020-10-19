<?php

require_once("GenerateFile.php");

/**
 * Generar estructura
 */
class GenFunctionGetEntityTree extends GenerateFile {

  public function __construct() {
    parent::__construct($_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/function/","get_entity_tree.php");
  }

  protected function generateCode() {
    $container = new Container();
    $this->start();
    foreach($container->getStructure() as $entity) $this->attribRel($entity);
    $this->end();
  }

  protected function start() {
    $this->string .= "<?php

function get_entity_tree(\$entityName) {
  switch(\$entityName){
";
  }

  protected function attribRel($entity){
    require_once("function/getEntityTree/GetEntityTreeElement.php");
    $gen = new GetEntityTreeElement($entity);
    $this->string .= $gen->generate();
  }
  protected function end() {
    $this->string .= "    default: return [];
  }
}
";
  }


}
