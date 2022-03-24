#!/usr/bin/env python3
#############################################################################
# Filename    : Thermometer.py
# Description : DIY Thermometer
# Author      : www.freenove.com
# modification: 2019/03/09
# modified    : By Philip Bowler for homeautomation project
########################################################################
import RPi.GPIO as GPIO
import time
import datetime
import math
import json
from ADCDevice import *
import mysql.connector

htg = 20
clg = 19
sf = 16

GPIO.setwarnings(False)
GPIO.setmode(GPIO.BCM)
GPIO.setup(htg,GPIO.OUT)
GPIO.setup(clg,GPIO.OUT)
GPIO.setup(sf,GPIO.OUT)

adc = ADCDevice() # Define an ADCDevice class object



def setup():
    #turn all outputs off
    GPIO.output(htg,1)
    GPIO.output(clg,1)
    GPIO.output(sf,1)
    global adc
    if(adc.detectI2C(0x48)): # Detect the pcf8591.
        adc = PCF8591()
    elif(adc.detectI2C(0x4b)): # Detect the ads7830
        adc = ADS7830()
    else:
        print("No correct I2C address found, \n"
        "Please use command 'i2cdetect -y 1' to check the I2C address! \n"
        "Program Exit. \n");
        exit(-1)
        
def loop():
    while True:
        mydb = mysql.connector.connect(
            #host="localhost",
            #user="admin",
            #password="fleetree123",
            #database="tstat"
            host="us-cdbr-east-05.cleardb.net",
            user="b4ea6cffd8b299",
            password="3e88d9bf",
            database="heroku_cd3f44fce4ead91"
        )
        mycursor = mydb.cursor()
        mycursor.execute("SELECT * FROM tstats WHERE tstatId = 2")
        myresult = mycursor.fetchone()
        print(myresult)
        

        print(type(myresult))
        htgSp = myresult[2]
        clgSp = myresult[3]
        sysSp = myresult[4]
        
        valueZT = adc.analogRead(0)        # read ADC value A0 pin
        valueSAT = adc.analogRead(1)

        if valueZT < 1  or valueZT > 254:
            print('ZT value less then 1')
            voltageZT = 1
            RtZT = 1
            zt = 1
        else:
            print('ZT value greater then 1 %d'%(valueZT))
            voltageZT = valueZT / 255.0 * 3.3        # calculate voltage
            RtZT = 10 * voltageZT / (3.3 - voltageZT)    # calculate resistance value of thermistor
            zt = ((1/(1/(273.15 + 25) + math.log(RtZT/10)/3950.0)) -273.15) * 1.8 + 32

        if valueSAT < 1 or valueSAT > 254:
            print('SAT value less then 1')
            voltageSAT = 1
            RtSAT = 1
            sat = 1
        else:
            print('SAT value greater then 1')
            voltageSAT = valueSAT / 255.0 * 3.3        # calculate voltage
            RtSAT = 10 * voltageSAT / (3.3 - voltageSAT)    # calculate resistance value of thermistor
            sat = ((1/(1/(273.15 + 25) + math.log(RtSAT/10)/3950.0)) -273.15) * 1.8 + 32

        print ('ADC Value ZT : %d, Voltage : %.2f, Zone Temperature : %.2f'%(valueZT,voltageZT,zt))
        print ('ADC Value SAT : %d, Voltage : %.2f, Supply Air Temperature : %.2f'%(valueSAT,voltageSAT,sat))
        print ('htgSp : %d, clgSp : %d, Temperature : %d, SAT : %d'%(htgSp,clgSp,zt,sat))
        
        #check zt and set outputs
        if sysSp == 'auto' and int(zt) < int(htgSp):
            GPIO.output(htg,0) #htg
            GPIO.output(clg,1) #clg
            GPIO.output(sf,1) #sf
        elif sysSp == 'auto' and int(zt) > int(clgSp):
            GPIO.output(htg,1) #htg
            GPIO.output(clg,0) #clg
            GPIO.output(sf,0) #sf
        elif sysSp == 'htg' and int(zt) < int(htgSp):
            GPIO.output(htg,0) #htg
            GPIO.output(clg,1) #clg
            GPIO.output(sf,1) #sf
        elif sysSp == 'clg' and int(zt) > int(clgSp):
            GPIO.output(htg,1) #htg
            GPIO.output(clg,0) #clg
            GPIO.output(sf,0) #sf 
        else:
            GPIO.output(htg,1) #htg
            GPIO.output(clg,1) #clg
            GPIO.output(sf,1) #sf 
       
        print ('Heating : %d, Cooling : %d, Supply Fan : %d'%(GPIO.input(htg),GPIO.input(clg),GPIO.input(sf)))
        print ('ZT : %d, SAT : %d '%(zt,sat))
        
        sql = "UPDATE tstats SET zt = %s, sat = %s, htg = %s, clg = %s, sf = %s WHERE tstatId = %s"
        val = (zt, sat, GPIO.input(htg), GPIO.input(clg), GPIO.input(sf), 1)
        mycursor.execute(sql, val)
        mydb.commit()

        ct = datetime.datetime.now()
        print(ct)
        sql = "INSERT INTO tstatStat (tstatId, htgSp, clgSp, sysSp, zt, sat, sf, htg, clg, time) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s)"
        val = (2, htgSp, clgSp, sysSp, zt, sat, GPIO.input(sf), GPIO.input(htg), GPIO.input(clg), ct)
        mycursor.execute(sql, val)
        mydb.commit()

        f = open("/var/www/html/tstat/data/temperature.txt", "w")

        f.write(json.dumps(int(zt)))
        f.close()
        
        mydb.close()    
        time.sleep(30)


def destroy():
    adc.close()
    GPIO.output(htg,1) #htg
    GPIO.output(clg,1) #clg
    GPIO.output(sf,1) #sf 
    GPIO.cleanup()
    mydb.close()  
    
if __name__ == '__main__':  # Program entrance
    print ('Program is starting ... ')
    setup()
    try:
        loop()
    except KeyboardInterrupt: # Press ctrl-c to end the program.
        destroy()
        