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
        conn = db_connect.connect() 
        query = conn.execute("select tdate, distance from strikes") 
        return {'strikes': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor.fetchall()]}


    def post(self):
        conn = db_connect.connect()
        print(request.json)
        tdate = request.json['tdate']
        distance = request.json['distance']
        query = conn.execute("insert into strikes values('{0}','{1}')".format(tdate,distance))
        return {'status':'success'}

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


api.add_resource(Strikes, '/strikes') 
api.add_resource(Multidata, '/multidata')
api.add_resource(Power, '/power')


if __name__ == '__main__':
     app.run()
