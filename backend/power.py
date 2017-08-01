#!/usr/bin/env python

from ina219 import INA219
from datetime import datetime
import sqlite3


db = sqlite3.connect('/home/pi/WeatherDashboard/weatherdatabase.db')
cursor = db.cursor()
now = str(datetime.now())

SHUNT_OHMS = 0.1
MAX_EXPECTED_AMPS = 0.25

ina = INA219(SHUNT_OHMS, MAX_EXPECTED_AMPS)
ina.configure(ina.RANGE_16V, ina.GAIN_AUTO)

cursor.execute('''INSERT INTO power VALUES(?,?,?,?)''', (now, ina.voltage(), round(ina.current()), round(ina.power())))

db.commit()

db.close()
print("Bus Voltage    : %.3f V" % ina.voltage())
print("Bus Current    : %.3f mA" % ina.current())
print("Supply Voltage : %.3f V" % ina.supply_voltage())
print("Shunt voltage  : %.3f mV" % ina.shunt_voltage())
print("Power          : %.3f mW" % ina.power())
