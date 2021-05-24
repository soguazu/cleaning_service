from marshmallow import Schema, fields

class ServiceSchema(Schema):
    service_category_id = fields.Integer(required=True)
    company_id = fields.Integer(required=True)
    name = fields.Str()
    
    
    class Meta:
        ordered = True

