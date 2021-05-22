from marshmallow import Schema, fields

class EmployeeSchema(Schema):
    user_id = fields.Integer(required=True)
    company_id = fields.Integer(required=True)
    first_name = fields.Str()
    last_name = fields.Str()
    hourly_rate = fields.Float(required=True)
    
    class Meta:
        ordered = True

