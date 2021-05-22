from src import app, request, ValidationError, HolidaySchema, json, InterviewSoapClient
from datetime import datetime
from dateutil import parser


    
@app.route("/holiday", methods=['POST'])
def holidays():  
    body = request.json
    print(body)
   
    if 'start_date' in body:
        body['start_date']  =  parser.parse(body['start_date']).strftime("%Y-%m-%d %H:%M:%S")
      
        
    if 'end_date' in body:
        body['end_date']  =  parser.parse(body['end_date']).strftime("%Y-%m-%d %H:%M:%S")
        
    print(body['end_date'] )
        
    try:
        
        soap_client = InterviewSoapClient()
        
        res = soap_client.call(
            service='HolidayService',
            action='createHoliday',
            args=body
        )
        return res
        
    except ValidationError as err:
      print(err)
      
    
    except Exception as err:
        print(err)
    
    
    