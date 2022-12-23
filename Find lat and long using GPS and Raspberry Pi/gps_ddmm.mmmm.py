# Serial4.py

import serial

# port = "/dev/ttyAMA0"  # Raspberry Pi 2
port = "/dev/ttyS0"  # Raspberry Pi 3


time = str
lat = str
dirLat = str
lon = str
dirLon = str
alt = str
sat = str


def parseGPS(data):
    #    print "raw: ", data[:-1]
    global time, lat, dirLat, lon, alt, sat, dirLon
    if data.find('GGA') > 0:
        s = data.split(",")
        if s[6] == '0':
            print("no satellite data available")
            return
        time = s[1][0:2] + ":" + s[1][2:4] + ":" + s[1][4:6]
        lat = decode(s[2])
        dirLat = s[3]
        lon = decode(s[4])
        dirLon = s[5]
        alt = s[9] + " m"
        sat = s[7]
    print("Time(UTC): %s-- Latitude: %s(%s)-- Longitude:%s(%s)\
    -- Altitute:%s--(%s satellites)") % (time, lat, dirLat, lon, dirLon, alt, sat)


def decode(raw_value):
    # DDDMM.MMMMM -> DD deg MM.MM
    raw_value = float(raw_value)
    decimal_value = raw_value / 100.00
    degrees = int(decimal_value)
    mm_mmmm = (decimal_value - int(decimal_value)) / 0.6
    position = degrees + mm_mmmm
    position = "%.4f" % position
    return position


ser = serial.Serial(port, baudrate=9600, timeout=0.5)
while True:
    data = ser.readline().decode()
    # print data
    parseGPS(data)
