<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();

getEntityRel();
getEntityTree();
publicScope();

foreach($container->getStructure() as $entity) {
  doc($entity);
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





