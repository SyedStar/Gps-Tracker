# Serial4.py

import serial
import urllib
import requests
import sys


# port = "/dev/ttyAMA0"  # Raspberry Pi 2
port = "/dev/ttyS0"  # Raspberry Pi 3





def parseGPS(data):
    #    print "raw: ", data[:-1]
    global lat, lon
    if data.find('GGA') > 0:
        s = data.split(",")
        lat = decode(s[2])
        lon = decode(s[4])
    payload = {"u_lat": lat, "u_lon": lon}
    r = requests.get('http://192.168.1.17/gps/api/gps.php', params=payload)
    print(r.url)


def decode(raw_value):
    # DDDMM.MMMMM -> DD deg MM.MM
    raw_value = float(raw_value)
    decimal_value = raw_value / 100.00
    degrees = int(decimal_value)
    mm_mmmm = (decimal_value - int(decimal_value)) / 0.6
    position = degrees + mm_mmmm
    position = "%.8f" % position
    return position


def sendSms(lat, lon):
    print("Sending SMS\n")
    ser.write(b'AT+CMGF=1\r\n')
    sleep(0.5)
    ser.write(b'AT+CMGS="9902427350"''\"')
    serialcmd = args["mobile"]
    ser.write(serialcmd.encode())
    ser.write(b'\"\r\n')
    sleep(0.5)
    serialcmd = lat, lon
    ser.write(serialcmd.encode())
    ser.write(b'\x1A')
    sleep(3)


ser = serial.Serial(port, baudrate=9600, timeout=0.5)
ser.flush()
try:
    while True:
        data = port.readline()
        # print data
        parseGPS(data)
            print(" Latitude:", lat, "Longitude:", lon, '\n')
            sendSms(lat, lon)
            sleep(30)


except KeyboardInterrupt:
    sys.exit(0)
