from src import (app, request, jsonify, InterviewSoapClient, 
                 ValidationError, json)


@app.route("/work_order/<id>", methods=['GET', 'PATCH', 'DELETE'])
def work_order(id):   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='WorkOrderService',
            action='getWorkOrderById',
            args={'id': id}
        )

        return json.loads(res)
    

    if request.method == 'PATCH':
        request_data = request.get_json()
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='WorkOrderService',
            action='updateWorkOrderById',
            args={'id': id, 'status': request_data['status']}
        )
        return json.loads(res)
    
    
    
@app.route("/work_order", methods=['GET', 'POST'])
def work_orders():   
    if request.method == 'GET':
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='WorkOrderService',
            action='getAllWorkOrders'
        )

        return json.loads(res)
    
    body = request.get_json()
    
    try:
        
        soap_client = InterviewSoapClient()
        res = soap_client.call(
            service='WorkOrderService',
            action='createWorkOrder',
            args=body
        )
        return json.loads(res)
        
    except ValidationError as err:
      print(err)
    
    
    
    
    
    
    
    
