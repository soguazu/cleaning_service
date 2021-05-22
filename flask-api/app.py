# from flask import Flask, request
from src import app
# from flask_swagger_ui import get_swaggerui_blueprint
# from lib.interview_soap_client import InterviewSoapClient

# app = Flask(__name__)

 
### swagger specific ###
# SWAGGER_URL = '/docs'
# API_URL = '/static/swagger.json'
# SWAGGERUI_BLUEPRINT = get_swaggerui_blueprint(
    # SWAGGER_URL,
    # API_URL,
    # config={
        # 'app_name': "Cleaning service rest api"
    # }
# )
# 
# app.register_blueprint(SWAGGERUI_BLUEPRINT, url_prefix=SWAGGER_URL)





# @app.route("/")
# def index():
    # return "Congratulations, lets get started!"


# @app.route("/soap")
# def soap():
    # soap_client = InterviewSoapClient()
    # res = soap_client.call(
        # service='CompanyService',
        # action='helloFromPHP',
    # )
# 
    # return res
# 
# 
# @app.route("/company")
# def company():
    # soap_client = InterviewSoapClient()
    # res = soap_client.call(
        # service='CompanyService',
        # action='getCompanyById',
        # args={'id': 1}
    # )
# 
    # return res


# @app.route("/customer")
# def customer():
    # soap_client = InterviewSoapClient()
    # res = soap_client.call(
        # service='CustomerService',
        # action='createCustomer',
        # args={'name': 'g', 'address': '1', 'phone': '090', 'user_id': 1}
    # )
# 
    # return res



if __name__ == "__main__":
    app.run(host="0.0.0.0", port=5000, debug=True)