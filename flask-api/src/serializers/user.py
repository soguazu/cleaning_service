from marshmallow import Schema, fields

class UserSchema(Schema):
    password = fields.Str(required=True)
    email = fields.Email(required=True)
    avatar_url = fields.Str()
    role = fields.Str(required=True)
    
    class Meta:
        ordered = True

