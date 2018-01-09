from flask import Flask, request
from flask_restful import Resource, Api
from sqlalchemy import create_engine
from json import dumps
from flask_jsonpify import jsonify

db_connect = create_engine('sqlite:////home/kickinwing/Solar-Weather-Station/backend/weatherdatabase.db')
app = Flask(__name__)
api = Api(app)

class Strikes(Resource):
    def get(self):
        conn = db_connect.connect() # connect to database
        query = conn.execute("select tdate, distance from strikes") # This line performs query and returns json result
        return {'strikes': [i[0] for i in query.cursor.fetchall()]} # Fetches first column that is Employee ID

class Multidata(Resource):
    def get(self):
        conn = db_connect.connect()
        query = conn.execute("select tdate, humidity, pressure, temperature from multisensor;")
        result = {'data': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor]}
        return jsonify(result)

class Power(Resource):
    def get(self):
        conn = db_connect.connect()
        query = conn.execute("select * from power;")
        result = {'data': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor]}
        return jsonify(result)


api.add_resource(Strikes, '/strikes') # Route_1
api.add_resource(Multidata, '/multidata')
api.add_resource(Power, '/power')

if __name__ == '__main__':
     app.run()
