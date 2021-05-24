from src import app, request, ValidationError, ServiceRateSchema, json, InterviewSoapClient

    
    
@app.route("/service_rate", methods=['GET', 'POST'])
def service_rates():   
 
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceRateService',
            action='getAllServiceRates'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        service_rate_schema = ServiceRateSchema()
        service_rate_dict = service_rate_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceRateService',
            action='createServiceRate',
            args=service_rate_dict
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    