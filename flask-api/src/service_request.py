from src import (app, request, InterviewSoapClient, 
                 ValidationError, json)

from dateutil import parser

    
@app.route("/service_request", methods=['GET', 'POST'])
def service_requests():   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceRequestService',
            action='getAllServiceRequests'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    if 'proposed_start_date' in body:
        body['proposed_start_date']  =  parser.parse(body['proposed_start_date']).strftime("%Y-%m-%d %H:%M:%S")
  
    
    if 'proposed_end_date' in body:
        body['proposed_end_date']  =  parser.parse(body['proposed_end_date']).strftime("%Y-%m-%d %H:%M:%S")
        
    if 'actual_start_date' in body:
        body['actual_start_date']  =  parser.parse(body['actual_start_date']).strftime("%Y-%m-%d %H:%M:%S")
        
        
    if 'actual_end_date' in body:
        body['actual_end_date']  =  parser.parse(body['actual_end_date']).strftime("%Y-%m-%d %H:%M:%S")

    
    
    try:
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceRequestService',
            action='createServiceRequest',
            args=body
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    
    
    
    
    
    
