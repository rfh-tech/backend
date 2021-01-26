use RFHApiDB;

INSERT INTO Users_AccountTypes (TypeName) VALUES 
('Field Agent'), 
('Extension Agent'), 
('Supervisor'), 
('Sub Admin'), 
('Super Admin'), 
('Farmer'), 
('Merchant');

INSERT INTO SpatialEntities_EntityTypes (SpatialEntityTypeName, AdminLevel) VALUES
('Country', 0),
('State', 1),
('City', 2),
('Village', 3),
('Farm', 4)