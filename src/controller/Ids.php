<?php

require_once("class/model/Entity.php");

require_once("GenerateFileEntity.php");


class GenControllerIds extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_ROOT."/class/controller/ids/";
    $nombreArchivo = "_".$entity->getName("XxYy").".php";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode() {
    $this->string .= "<?php

require_once(\"class/controller/Ids.php\");

class _" . $this->getEntity()->getName("XxYy") . "Ids extends Ids {
  public \$entityName = \"" . $this->getEntity()->getName() . "\";
}

";
  }


}
