from Adafruit_BME280 import *
import sqlite3
from datetime import datetime

sensor = BME280(t_mode=BME280_OSAMPLE_8, p_mode=BME280_OSAMPLE_8, h_mode=BME280_OSAMPLE_8)

degrees = sensor.read_temperature()
pascals = sensor.read_pressure()
hectopascals = pascals / 100
humidity = sensor.read_humidity()

now = str(datetime.now())

db = sqlite3.connect('/home/pi/WeatherDashboard/weatherdatabase.db')
cursor = db.cursor()
cursor.execute('''INSERT INTO multisensor VALUES(?,?,?,?)''', (now,round(humidity),round(hectopascals),round(degrees)))
db.commit()
db.close()

print 'Temp      = {0:0.3f} deg C'.format(degrees)
print 'Pressure  = {0:0.2f} hPa'.format(hectopascals)
print 'Humidity  = {0:0.2f} %'.format(humidity)
