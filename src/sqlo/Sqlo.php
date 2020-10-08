<?php

require_once("class/model/Entity.php");
require_once("GenerateFileEntity.php");

//Generar codigo de clase
class GenClassSqlo extends GenerateFileEntity {

  public function __construct(Entity $entity) {
    $directorio = $_SERVER["DOCUMENT_ROOT"]."/".PATH_SRC."/class/model/sqlo/";
    $nombreArchivo = "_". $entity->getName("XxYy") . ".php";
    parent::__construct($directorio, $nombreArchivo, $entity);
  }

  protected function generateCode(){
    $this->start();
    $this->construct();
    $this->json();
    $this->values(); //@todo deprecated
    $this->end();
  }

  protected function start(){
    $this->string .= "<?php

require_once(\"class/model/Sqlo.php\");
require_once(\"class/model/Sql.php\");
require_once(\"class/model/Entity.php\");
require_once(\"class/model/Values.php\");

class _" . $this->getEntity()->getName("XxYy") . "Sqlo extends EntitySqlo {
";
  }

  protected function construct(){
    $this->string .= "
  public \$entityName = \"{$this->getEntity()->getName()}\";

";
  }

  protected function json(){
    require_once("sqlo/method/Json.php");
    $gen = new Sqlo_json($this->getEntity());
    $this->string .= $gen->generate();
  }

  protected function end(){
    $this->string .= "

}
" ;
  }
  
  protected function values(){
    require_once("sqlo/method/Values.php");
    $gen = new Sqlo_values($this->getEntity());
    $this->string .= $gen->generate();

  }

}
