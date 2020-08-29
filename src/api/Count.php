<?php

require_once("class/model/Entity.php");

require_once("GenerateFileEntity.php");


class GenControllerCount extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/api/count/";
    $nombreArchivo = "_".$entity->getName("XxYy").".php";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode() {
    $this->string .= "<?php

require_once(\"class/api/Count.php\");

class _" . $this->getEntity()->getName("XxYy") . "CountApi extends CountApi {
  public \$entityName = \"" . $this->getEntity()->getName() . "\";
}

";
  }


}
