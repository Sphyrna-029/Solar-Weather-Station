## Solar-Weather-Station


A web front end for my solar powered weather station. Built on lighttp, sqlite3, and python. Capable of detecting lightning strikes but more features to come. Requires sqlite for php. 

**Live Demo:** http://weather.zerogravityantfarm.com/

![alt text](http://i.imgur.com/h6EX04n.png)

**Lightning sensor:** https://github.com/pcfens/RaspberryPi-AS3935

**Humidity/Pressure/Temperature sensor:** https://github.com/adafruit/Adafruit_Python_BME280

**Voltage/Current sensor:** https://github.com/chrisb2/pi_ina219


# Cron Entries:
*/10 * * * * python /home/pi/WeatherDashboard/cpuTemp.py

*/10 * * * * python /home/pi/WeatherDashboard/MultiSensor.py

*/10 * * * * python /home/pi/WeatherDashboard/power.py





# Database Schema (NEW):
```
CREATE TABLE nodes(nodeid TEXT, latitude NUMERIC, longitude NUMERIC, status NUMERIC, dateadded DATE);
		
CREATE TABLE strikes(nodeid TEXT, date DATE, distance NUMERIC);

CREATE TABLE power(nodeid TEXT, date DATE, volts NUMERIC, amps NUMERIC, watts NUMERIC);

CREATE TABLE multisensor(nodeid TEXT, date DATE, humidity NUMERIC, pressure NUMERIC, temperature NUMERIC);
```

# Tiny API

Implemented a small api in flask and apache wsgi. Goals are to allow multiple weather stations to communicate with one server allowing station monitoring, lightning triangulation, and weather modeling. 

**Live Demo:** <br />
http://api.zerogravityantfarm.com/multidata <br />
http://api.zerogravityantfarm.com/power <br />
http://api.zerogravityantfarm.com/strikes <br />

API Endpoint Resources:

	/nodes
		GET - List nodes, locations, and status (online/offline)
		POST - Add new nodes to the system
	
	/nodes/{nodeid}
		GET - Get information on single node
		PUT - Modify information on a single node
		DELET - Delete node but not node data
		
	/nodes/{nodeid}/strikes
		GET - List all strikes for {nodeid}
		POST - Write single strike distance and date/time
		
	/nodes/{nodeid}/power
		GET - List all power data for {nodeid}
		POST - Write new power data 
		
	/nodes/{nodeid}/multisensor
		GET - List all multisensor data for {nodeid}
		POST - Write new sensor data

Api example followed from here: https://github.com/sagaragarwal94/python_rest_flask
