# Solar-Weather-Station


A web front end for my solar powered weather station. Built on Apache wsgi, sqlite3, PHP, and python. Capable of detecting lightning strikes but more features to come. With the current power setup the station can run for 3 days of overcast. Moving the web server and databse off the pi could improve power consumption.


## Component List:
 **LM2596 DC-DC Step Down Variable Voltage Regulator** - https://www.amazon.com/eBoot-LM2596-Converter-3-0-40V-1-5-35V/dp/B01GJ0SC2C
 
 **35w Solar Panel** - https://www.amazon.com/gp/product/B01G1II6LY/ref=oh_aui_detailpage_o01_s00?ie=UTF8&psc=1
 
 **12v 12AH battery** - https://www.amazon.com/gp/product/B00A82A2ZS/ref=oh_aui_detailpage_o02_s00?ie=UTF8&psc=1
 
 **12v 5a solar charge controller** - Went through two of these in a year https://www.amazon.com/gp/product/B00XTQ76WW/ref=oh_aui_detailpage_o01_s00?ie=UTF8&psc=1
 
 Testing a different model now (found here): https://www.amazon.com/gp/product/B007VLMRP2/ref=oh_aui_detailpage_o00_s00?ie=UTF8&psc=1
 
 
 
 **MOD-1016 AS3935 Lightning and Storm Sensor Module** - https://www.embeddedadventures.com/as3935_lightning_sensor_module_mod-1016.html
 
 **Adafruit BME280 (Temperature, Pressure, Humidity)** - https://www.adafruit.com/product/2652
 
 **INA219 High Side DC Current Sensor** - https://www.adafruit.com/product/904

![alt text](https://i.imgur.com/kkbUGGT.png)




## Live Demo: 
http://weather.zerogravityantfarm.com/

![alt text](http://i.imgur.com/h6EX04n.png)

**Lightning sensor:** https://github.com/pcfens/RaspberryPi-AS3935

**Humidity/Pressure/Temperature sensor:** https://github.com/adafruit/Adafruit_Python_BME280

**Voltage/Current sensor:** https://github.com/chrisb2/pi_ina219


## Cron Entries:
*/10 * * * * python /home/pi/WeatherDashboard/cpuTemp.py

*/10 * * * * python /home/pi/WeatherDashboard/MultiSensor.py

*/10 * * * * python /home/pi/WeatherDashboard/power.py



## Database Schema (NEW):
```
CREATE TABLE nodes(nodeid TEXT, latitude NUMERIC, longitude NUMERIC, status NUMERIC, dateadded DATE);
		
CREATE TABLE strikes(nodeid TEXT, date DATE, distance NUMERIC);

CREATE TABLE power(nodeid TEXT, date DATE, volts NUMERIC, amps NUMERIC, watts NUMERIC);

CREATE TABLE multisensor(nodeid TEXT, date DATE, humidity NUMERIC, pressure NUMERIC, temperature NUMERIC);
```



## Tiny API

Implemented a small api in flask and apache wsgi. Goals are to allow multiple weather stations to communicate with one server allowing station monitoring, lightning triangulation, and weather modeling. 

**Live Demo:** <br />
http://api.zerogravityantfarm.com/nodes <br />
http://api.zerogravityantfarm.com/nodes/node1/strikes <br />

**API Endpoint Resources:**

	/nodes
		GET - List nodes, locations, and status (online/offline)
		POST - Add new nodes to the system
	
	/nodes/{nodeid}
		GET - Get information on single node
		PUT - Modify information on a single node
		DELETE - Delete node but not node data
		
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
