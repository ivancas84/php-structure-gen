<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();

entityTreeJson();
entityRelJson();
publicScope();

foreach($container->getStructure() as $entity) {
  doc($entity);
}

function entityTreeJson(){
  require_once("function/entityTreeJson/EntityTreeJson.php");
  $gen = new EntityTreeJson();
  $gen->generate();
}

function entityRelJson(){
  require_once("function/entityRelJson/EntityRelJson.php");
  $gen = new EntityRelJson();
  $gen->generate();
}


function publicScope(){
  require_once("function/publicScope/publicScope.php");
  $gen = new GenFunctionPublicScope();
  $gen->generateIfNotExists();
}

function doc(Entity $entity){
  require_once("doc/Main.php");
  $gen = new Doc($entity);
  $gen->generate();
}





