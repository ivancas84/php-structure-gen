<?php

require_once("GenerateFile.php");

/**
 * Generar estructura
 */
class GenFunctionGetEntityRelations extends GenerateFile {

  public function __construct() {
    parent::__construct($_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/function/","get_entity_relations.php");
  }

  protected function generateCode() {
    $container = new Container();
    $this->start();
    foreach($container->getStructure() as $entity) $this->attribRel($entity);
    $this->end();
  }

  protected function start() {
    $this->string .= "<?php

function get_entity_relations(\$entityName) {
  switch(\$entityName){
";
  }

  protected function attribRel($entity){
    require_once("function/AttribRel.php");
    $gen = new EntityRelations_attribRel($entity);
    $this->string .= $gen->generate();
  }
  protected function end() {
    $this->string .= "    default: return [];
  }
}
";
  }


}
