# Solar-Weather-Station


A web front end for my solar powered weather station. Built on lighttp, sqlite3, and python. Capable of detecting lightning strikes but more features to come.

![alt text](http://i.imgur.com/mCtV8hN.png)

Lightning sensor: https://github.com/pcfens/RaspberryPi-AS3935

Humidity/Pressure/Temperature sensor: https://github.com/adafruit/Adafruit_Python_BME280

Cron Entries:
*/10 * * * * python /home/pi/WeatherDashboard/cpuTemp.py


Database Schema:

CREATE TABLE temps (tdate DATE, ttime TIME, ttype TEXT, temperature NUMERIC);

CREATE TABLE strikes(tdate TEXT, distance TEXT);
