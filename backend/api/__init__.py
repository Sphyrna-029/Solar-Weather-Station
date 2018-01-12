from flask import Flask, request
from flask_restful import Resource, Api
from sqlalchemy import create_engine
from json import dumps
from flask_jsonpify import jsonify

db_connect = create_engine('sqlite:////home/di0de/Solar-Weather-Station/backend/apidatabase.db')
app = Flask(__name__)
api = Api(app)

class NodesList(Resource):
    def get(self):
        conn = db_connect.connect()
        query = conn.execute("select * from nodes")
        return {'nodes': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor.fetchall()]}

    def post(self):
        conn = db_connect.connect()
        print(request.json)
        nodeid = request.json['nodeid']
        latitude = request.json['lattitude']
        longitude = request.json['longitude']
        status = request.json['status']
        dateadded = request.json['dateadded']
        query = conn.execute("insert into nodes values('{0}', '{1}', '{2}', '{3}', '{4}')".format(nodeid, latitude, longitude, status, dateadded))
        return {'status':'success'}

class Nodes(Resource):
    def get(self, nodeid):
        conn = db_connect.connect()
        query = conn.execute("select * from nodes where nodeid = '" + nodeid + "';")
        return {nodeid : [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor.fetchall()]}

    def delete(self, nodeid):
        conn = db_connect.connect()
        query = conn.execute("delete from nodes where nodeid = '" + nodeid + "';")
        return {'status':'succcess'}


class Strikes(Resource):
    def get(self, nodeid):
        conn = db_connect.connect()
        query = conn.execute("select * from strikes where nodeid = '" + nodeid + "';")
        return {'strikes': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor.fetchall()]}


    def post(self, nodeid):
        conn = db_connect.connect()
        print(request.json)
        date = request.json['date']
        distance = request.json['distance']
        query = conn.execute("insert into strikes values('{0}', '{1}', '{2}')".format(nodeid, date, distance))
        return {'status':'success'}


class Multidata(Resource):
    def get(self, nodeid):
        conn = db_connect.connect()
        query = conn.execute("select date, humidity, pressure, temperature from multisensor where nodeid = '" + nodeid + "';")
        result = {'data': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor]}
        return jsonify(result)

    def post(self, nodeid):
        conn = db_connect.connect()
        print(request.json)
        date = request.json['date']
        humidity = request.json['humidity']
        pressure = request.json['pressure']
        temperature = request.json['temperature']
        query = conn.execute("insert into multisensor values('{0}', '{1}', '{2}', '{3}', '{4}')".format(nodeid, date, humidity, pressure, temperature))
        return {'status':'success'}

class Power(Resource):
    def get(self, nodeid):
        conn = db_connect.connect()
        query = conn.execute("select * from power " + nodeid + ";")
        result = {'data': [dict(zip(tuple (query.keys()) ,i)) for i in query.cursor]}
        return jsonify(result)

    def post(self, nodeid):
        conn = db_connect.connect()
        print(request.json)
        date = request.json['date']
        volts = request.json['volts']
        amps = request.json['amps']
        watts = request.json['watts']
        query = conn.execute("insert into power values('{0}', '{1}', '{2}', '{3}', '{4}')".format(nodeid, date, volts, amps, watts))
        return {'status':'success'}


api.add_resource(NodesList, '/nodes')
api.add_resource(Nodes, '/nodes/<nodeid>')
api.add_resource(Strikes, '/nodes/<nodeid>/strikes')
api.add_resource(Multidata, '/nodes/<nodeid>/multidata')
api.add_resource(Power, '/nodes/<nodeid>/power')


if __name__ == '__main__':
     app.run()
