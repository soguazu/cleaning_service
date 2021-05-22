from src import app, request, ValidationError, CustomerSchema, json, InterviewSoapClient


@app.route("/customer/<int:id>", methods=['GET', 'PATCH', 'DELETE'])
def customer(id):   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CustomerService',
            action='getCustomerById',
            args={'id': id}
        )

        return json.loads(res)
    
    
@app.route("/customer", methods=['GET', 'POST'])
def customers():   
 
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CustomerService',
            action='getAllCustomers'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        customer_schema = CustomerSchema()
        customer_dict = customer_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CustomerService',
            action='createCustomer',
            args=customer_dict
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    