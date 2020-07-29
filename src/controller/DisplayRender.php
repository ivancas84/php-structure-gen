<?php

require_once("class/model/Entity.php");

require_once("GenerateFileEntity.php");


class GenControllerDisplayRender extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/controller/displayRender/";
    $nombreArchivo = "_".$entity->getName("XxYy").".php";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode() {
    $this->string .= "<?php

require_once(\"class/controller/DisplayRender.php\");

class _" . $this->getEntity()->getName("XxYy") . "DisplayRender extends DisplayRender {
  public \$entityName = \"" . $this->getEntity()->getName() . "\";
}

";
  }


}
