from src import (app, request, jsonify, InterviewSoapClient, 
                 CompanySchema, ValidationError)


@app.route("/company/<id>", methods=['GET', 'PATCH', 'DELETE'])
def company(id):   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CompanyService',
            action='getCompanyById',
            args={'id': id}
        )

        return res
    

    
    
    
@app.route("/company", methods=['GET', 'POST'])
def companies():   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CompanyService',
            action='getAllCompanies'
        )

        return res
    
    body = request.get_json()
    
    try:
        company_schema = CompanySchema()
        company_dict = company_schema.load(body)
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='CompanyService',
            action='createCompany',
            args=company_dict
        )
        return res
        
    except ValidationError as err:
      print(err.message)
    
    
    
    
    
    
    
    
