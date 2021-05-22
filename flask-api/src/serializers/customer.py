from marshmallow import Schema, fields

class CustomerSchema(Schema):
    user_id = fields.Integer(required=True)
    name = fields.Str(required=True)
    address = fields.Str()
    phone = fields.Str(required=True)
    
    class Meta:
        ordered = True

