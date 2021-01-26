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
('Farm', 4);

INSERT INTO SpatialEntities_MetadataFieldTypes (TypeName) VALUES
('number'),
('text'),
('currency'),
('date');

INSERT INTO SpatialEntities_MetadataFields (FieldName, FieldType) VALUES
('country_capital', 'text'),
('country_phone_code', 'text'),
('country_currency', 'currency'),
('country_currency_symbol', 'text');