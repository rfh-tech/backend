USE RFHApiDB;

-- This schema stores Geographic/Geospatial Features.
-- A geographic feature is anything in the world that has a location. A feature can be:
-- An entity. For example, a farm.
-- A space. For example, a city, country, etc.

CREATE TABLE SpatialEntities_EntityTypes (
	SpatialEntityTypeId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	SpatialEntityTypeName VARCHAR(50) NOT NULL UNIQUE,
	AdminLevel TINYINT NOT NULL DEFAULT 256,
	SpatialEntityTypeDescription VARCHAR(500)
);

CREATE TABLE SpatialEntities_Entities (
	EntityId INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	EntityName VARCHAR(256),
	EntityType INT,
	EntityGeometry GEOMETRY,
	EntityDescription VARCHAR(500),
	DateCreated DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	LastModified DATETIME,

	CONSTRAINT fk_Entities_SpatialEntities_EntityTypes_SpatialEntityTypeId
		FOREIGN KEY (EntityId) REFERENCES SpatialEntities_EntityTypes (SpatialEntityTypeId) ON UPDATE CASCADE ON DELETE CASCADE
);
