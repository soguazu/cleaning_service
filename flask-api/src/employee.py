from src import app, request, ValidationError, EmployeeSchema, json, InterviewSoapClient


@app.route("/employee/<int:id>", methods=['GET', 'PATCH', 'DELETE'])
def employee(id):   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='EmployeeService',
            action='getEmployeeById',
            args={'id': id}
        )

        return json.loads(res)
    
    
@app.route("/employee", methods=['GET', 'POST'])
def employees():   
 
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='EmployeeService',
            action='getAllEmployees'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        employee_schema = EmployeeSchema()
        employee_dict = employee_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='EmployeeService',
            action='createEmployee',
            args=employee_dict
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    