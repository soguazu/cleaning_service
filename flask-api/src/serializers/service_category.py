from marshmallow import Schema, fields

class ServiceCategorySchema(Schema):
    name = fields.Str(required=True)
    
    class Meta:
        ordered = True

