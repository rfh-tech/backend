<?php declare (strict_types=1);
/**
 * Controller Class.
 *
 * This file is part of RFHubAPI, please read the documentation
 * available in the root level of this project
 *
 * @license MIT
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 *
 */


namespace RFHApi\SpatialEntity\Entity;

use EmmetBlue\Core\Factory\DatabaseConnectionFactory as DBConnectionFactory;
use EmmetBlue\Core\Factory\DatabaseQueryFactory as DBQueryFactory;
use EmmetBlue\Core\Builder\QueryBuilder\QueryBuilder as QB;


/**
 * class RFHApi\SpatialEntity\Entity\Entity.
 *
 * Entity Controller
 *
 * @author Samuel Adeshina <samueladeshina73@gmail.com>
 * @since v0.0.1 27/01/2021 09:15
 */
class Entity {
	public function newEntity(array $data){
        $name = $data["entityName"];
        $type = $data["entityType"];
        $parent = $data["entityParent"];
        $geometry = $data["entityGeometry"];
        $description = $data["description"] ?? null;

        $result = DBQueryFactory::insert("SpatialEntities_Entities", [
            "EntityName"=>QB::wrapString($name, "'"),
            "EntityType"=>QB::wrapString($type, "'"),
            "EntityParent"=>QB::wrapString($parent, "'"),
            "EntityGeometry"=>QB::wrapString($geometry, "'"),
            "EntityDescription"=>QB::wrapString($description, "'")
        ], false);

        if (!$result['lastInsertId']){
			//throw an exception, insert was unsuccessful
		}	
		
		return $result;
    }
}