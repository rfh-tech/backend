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
        $parentId = $data["entityParentId"] ?? null;
        $geometry = $data["entityGeometry"] ?? null;
        $description = $data["description"] ?? null;

        $inputData = [
            "EntityName"=>QB::wrapString($name, "'"),
            "EntityType"=>QB::wrapString($type, "'"),
            "EntityParent"=>$parentId,
            "EntityDescription"=>QB::wrapString($description, "'")
        ];

        if (!is_null($geometry)){
            $inputData["EntityGeometry"] = QB::wrapString($geometry);
        }

        $result = DBQueryFactory::insert("SpatialEntities_Entities", $inputData, false);

        if (!$result['lastInsertId']){
			//throw an exception, insert was unsuccessful
		}	
		
		return $result;
    }
}