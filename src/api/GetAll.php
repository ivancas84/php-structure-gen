<?php

require_once("class/model/Entity.php");

require_once("GenerateFileEntity.php");


class GenControllerGetAll extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/api/getAll/";
    $nombreArchivo = "_".$entity->getName("XxYy").".php";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode() {
    $this->string .= "<?php

require_once(\"class/api/GetAll.php\");

class _" . $this->getEntity()->getName("XxYy") . "GetAll extends GetAll {
  public \$entityName = \"" . $this->getEntity()->getName() . "\";
}

";
  }


}
