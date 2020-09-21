<?php

require_once("../config/config.php");
require_once("class/tools/Filter.php");
require_once("class/Container.php");


$generate = Filter::get("gen");
$container = new Container();
foreach($container->getStructure() as $entity) {
  switch($generate){
		//doc
		case "doc": doc($entity); break;
		
		//model
		case "sqlo": sqlo($entity); break;
		case "sql": sql($entity); break;
    case "mapping": mapping($entity); break;
    case "condition": condition($entity); break;
    case "field_alias": fieldAlias($entity); break;
    case "value": value($entity); break;

    default:
			doc($entity);
			
			sqlo($entity);
			sql($entity);
      
      mapping($entity);
      condition($entity);
      fieldAlias($entity);
      value($entity);
		break;
  }
}

function doc(Entity $entity){
  require_once("doc/Main.php");
  $gen = new Doc($entity);
  $gen->generate();
}

function sqlo(Entity $entity){
  require_once("sqlo/Sqlo.php");
  $gen = new GenClassSqlo($entity);
  $gen->generate();
}

function sql(Entity $entity){
  require_once("sql/Sql.php");
  $gen = new GenClassSql($entity);
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

function fieldAlias(Entity $entity){
  require_once("fieldAlias/FieldAlias.php");
  $gen = new GenClassFieldAlias($entity);
  $gen->generate();
}

function value(Entity $entity){
  require_once("value/Value.php");
  $gen = new GenClassValue($entity);
  $gen->generate();
}