from marshmallow import Schema, fields

class ServiceRateSchema(Schema):
    service_id = fields.Integer(required=True)
    unit = fields.Float(required=True) 
    amount = fields.Float(required=True) 
    duration = fields.Float(required=True) 
    supply_markup = fields.Float(required=True) 
    overhead_markup = fields.Float(required=True) 
    misc_markup = fields.Float(required=True) 
    
    class Meta:
        ordered = True

