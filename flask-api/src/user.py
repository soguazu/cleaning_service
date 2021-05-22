from src import app, request, ValidationError, UserSchema, json, InterviewSoapClient


@app.route("/user/<int:id>", methods=['GET', 'PATCH', 'DELETE'])
def user(id):   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='UserService',
            action='getUserById',
            args={'id': id}
        )

        return json.loads(res)
    
    
@app.route("/user", methods=['GET', 'POST'])
def users():   
  
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='UserService',
            action='getAllUsers'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        user_schema = UserSchema()
        user_dict = user_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='UserService',
            action='createUser',
            args=user_dict
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    