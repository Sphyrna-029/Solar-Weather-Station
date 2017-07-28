import sqlite3
from subprocess import PIPE, Popen
import psutil
from datetime import datetime

#Get our CPU temp
def get_cpu_temperature():
    process = Popen(['vcgencmd', 'measure_temp'], stdout=PIPE)
    output, _error = process.communicate()
    return float(output[output.index('=') + 1:output.rindex("'")])

#Setup our database connection
db = sqlite3.connect('/home/pi/WeatherDashboard/weatherdatabase.db')

temp = get_cpu_temperature()
now = str(datetime.now())
type = 'CPU'

#Insert data into the temps table
cursor = db.cursor()
cursor.execute('''INSERT INTO temp VALUES(?,?,?)''', (now,type,temp))

db.commit()

db.close()

