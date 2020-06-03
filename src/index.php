<?php

require_once("../config/config.php");

require_once("class/model/entity/structure.php");

require_once("class/tools/Filter.php");

$generate = Filter::get("gen");

foreach($structure as $entity) {
    switch($generate){
        //controllers
        case "controller_all": controllerAll($entity); break;
		case "controller_count": controllerCount($entity); break;
		case "controller_get_all": controllerGetAll($entity); break;
		case "controller_ids": controllerIds($entity); break;
		case "controller_unique": controllerUnique($entity); break;
		case "controller_display_render": controllerDisplayRender($entity); break;

		//doc
		case "doc": doc($entity); break;
		
		//model
		case "sqlo": sqlo($entity); break;
		case "sql": sql($entity); break;
		case "values": values($entity); break;
        
        default:
        	controllerAll($entity);
			controllerCount($entity);
			controllerGetAll($entity);			
			controllerIds($entity);			
			controllerUnique($entity);			
			controllerDisplayRender($entity);
			
			doc($entity);
			
			sqlo($entity);
			sql($entity);
			values($entity);
		break;
    }
}

function controllerAll(Entity $entity){
    require_once("controller/All.php");
    $gen = new Gen_All($entity);
    $gen->generateIfNotExists();
}

function controllerCount(Entity $entity){
    require_once("controller/Count.php");
    $gen = new Gen_Count($entity);
    $gen->generateIfNotExists();
}

function controllerGetAll(Entity $entity){
    require_once("controller/GetAll.php");
    $gen = new Gen_GetAll($entity);
    $gen->generateIfNotExists();
}

function controllerIds(Entity $entity){
    require_once("controller/Ids.php");
    $gen = new Gen_Ids($entity);
    $gen->generateIfNotExists();
}

function controllerUnique(Entity $entity){
    require_once("controller/Unique.php");
    $gen = new Gen_Unique($entity);
    $gen->generateIfNotExists();
}

function controllerDisplayRender(Entity $entity){
    require_once("controller/DisplayRender.php");
    $gen = new Gen_DisplayRender($entity);
    $gen->generateIfNotExists();
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
    require_once("values/_Values.php");
    $gen = new _ClassValues($entity);
    $gen->generate();

    require_once("values/Values.php");
    $gen = new ClassValues($entity);
    $gen->generateIfNotExists();
}