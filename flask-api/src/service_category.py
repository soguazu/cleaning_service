from src import app, request, ValidationError, json, InterviewSoapClient

 
    
    
@app.route("/service_category", methods=['GET', 'POST'])
def service_categories():   
 
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceCategoryService',
            action='getAllServiceCategories'
        )

        return json.loads(res)
    
    body = request.get_json()
    try:
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='ServiceCategoryService',
            action='createServiceCategory',
            args=body
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    