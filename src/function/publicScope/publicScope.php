<?php

require_once("GenerateFile.php");
require_once("function/get_entity_names.php");
/**
 * Generar estructura
 */
class GenFunctionPublicScope extends GenerateFile {

  public $container;

  public function __construct() {
    parent::__construct($_SERVER["DOCUMENT_ROOT"]."/".PATH_CONFIG."/","public_scope.php");
  }

  protected function generateCode() {
    $this->container = new Container();
    $this->start();
    $this->body();
    $this->end();
  }

  protected function start() {
    $this->string .= "<?php

function public_scope() {
  return [
";
  }

  protected function body(){
    foreach(get_entity_names() as $entityName){
      $this->string .= "    '{$entityName}.rwx',  
";  
    }
    
  }

  protected function end() {
    $this->string .= "  ];
}
";
  }


}
