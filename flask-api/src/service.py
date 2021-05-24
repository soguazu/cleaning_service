from src import app, request, ValidationError, ServiceSchema, json, InterviewSoapClient



    
    
@app.route("/service", methods=['GET', 'POST'])
def services():   
 
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceService',
            action='getAllServices'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        service_schema = ServiceSchema()
        service_dict = service_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceService',
            action='createService',
            args=service_dict
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    