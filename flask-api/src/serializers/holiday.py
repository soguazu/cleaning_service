from marshmallow import Schema, fields

class HolidaySchema(Schema):
    employee_id = fields.Integer(required=True)
    company_id = fields.Integer(required=True)
    start_date = fields.Raw(required=True)
    end_date = fields.Raw(required=True)
    approved = fields.Integer()
    
    class Meta:
        ordered = True

