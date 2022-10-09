<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();

entityTreeJson();
entityRelJson();
getEntityRel();
getEntityTree();
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


function getEntityRel(){
  require_once("function/getEntityRel/GetEntityRel.php");
  $gen = new GetEntityRel();
  $gen->generate();
}

function getEntityTree(){
  require_once("function/getEntityTree/GetEntityTree.php");
  $gen = new GenFunctionGetEntityTree();
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





