from flask import Flask, request, jsonify, json
from flask_swagger_ui import get_swaggerui_blueprint

from lib.interview_soap_client import InterviewSoapClient
from src.serializers.company import CompanySchema, ValidationError
from src.serializers.user import UserSchema
from src.serializers.customer import CustomerSchema
from src.serializers.employee import EmployeeSchema
from src.serializers.holiday import HolidaySchema
from src.serializers.service import ServiceSchema
from src.serializers.service_rate import ServiceRateSchema

app = Flask(__name__)

SWAGGER_URL = '/docs'
API_URL = '/static/swagger.json'
SWAGGERUI_BLUEPRINT = get_swaggerui_blueprint(
    SWAGGER_URL,
    API_URL,
    config={
        'app_name': "Cleaning service rest api"
    }
)

app.register_blueprint(SWAGGERUI_BLUEPRINT, url_prefix=SWAGGER_URL)

@app.route("/")
def index():
    return "Congratulations, lets get started!"

from src import user
from src import company
from src import customer
from src import employee
from src import holiday
from src import service_category
from src import service
from src import service_rate
from src import service_request
from src import work_order
