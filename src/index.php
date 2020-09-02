<?php

require_once("../config/config.php");

require_once("class/model/entity/structure.php");

require_once("class/tools/Filter.php");

$generate = Filter::get("gen");

foreach($structure as $entity) {
  switch($generate){
		//doc
		case "doc": doc($entity); break;
		
		//model
		case "sqlo": sqlo($entity); break;
		case "sql": sql($entity); break;
		case "values": values($entity); break;
        
    default:
      apiAll($entity);
			apiCount($entity);
			apiGetAll($entity);			
			apiIds($entity);			
			apiUnique($entity);			
			
			doc($entity);
			
			sqlo($entity);
			sql($entity);
			values($entity);
		break;
  }
}

function apiAll(Entity $entity){
  require_once("api/All.php");
  $gen = new GenControllerAll($entity);
  $gen->generateIfNotExistsWithImp();
}

function apiCount(Entity $entity){
  require_once("api/Count.php");
  $gen = new GenControllerCount($entity);
  $gen->generateIfNotExistsWithImp();
}

function apiGetAll(Entity $entity){
  require_once("api/GetAll.php");
  $gen = new GenControllerGetAll($entity);
  $gen->generateIfNotExistsWithImp();
}

function apiIds(Entity $entity){
  require_once("api/Ids.php");
  $gen = new GenControllerIds($entity);
  $gen->generateIfNotExistsWithImp();
}

function apiUnique(Entity $entity){
  require_once("api/Unique.php");
  $gen = new GenControllerUnique($entity);
  $gen->generateIfNotExistsWithImp();
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

function values(Entity $entity){
  require_once("values/Values.php");
  $gen = new GenClassValues($entity);
  $gen->generate();
}