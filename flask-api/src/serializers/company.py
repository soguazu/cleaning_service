from marshmallow import Schema, fields, ValidationError

class CompanySchema(Schema):
    name = fields.Str(required=True)
    email = fields.Email(required=True)
    logo_url = fields.Str()
    address = fields.Str(required=True)
    country = fields.Str(required=True)
    tax_rate = fields.Float()
    
    class Meta:
        ordered = True

