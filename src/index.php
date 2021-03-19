<?php

require_once("../config/config.php");
require_once("class/Container.php");


$container = new Container();

getEntityRelations();
getEntityRel();
getEntityTree();
publicScope();

foreach($container->getStructure() as $entity) {
  doc($entity);
}

function getEntityFk(){
  require_once("function/GetEntityFk.php");
  $gen = new GetEntityFk();
  $gen->generate();
}

function getEntityRelations(){
  require_once("function/GetEntityRelations.php");
  $gen = new GenFunctionGetEntityRelations();
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

function mapping(Entity $entity){
  require_once("mapping/Mapping.php");
  $gen = new GenClassMapping($entity);
  $gen->generate();
}

function condition(Entity $entity){
  require_once("condition/Condition.php");
  $gen = new GenClassCondition($entity);
  $gen->generate();
}


function value(Entity $entity){
  require_once("value/Value.php");
  $gen = new GenClassValue($entity);
  $gen->generate();
}