#!/usr/bin/python2
import serial
import mysql.connector
import time
import datetime
import math

ser = serial.Serial('/dev/ttyAMA0', 38400)



try:
    while 1:
            mydb = mysql.connector.connect(
                #host="localhost",
                #user="admin",
                #password="fleetree123",
                #database="usage"
                host="us-cdbr-east-05.cleardb.net",
                user="b4ea6cffd8b299",
                password="3e88d9bf",
                database="heroku_cd3f44fce4ead91"
            )
            # Read one line from the serial buffer
            line = ser.readline()

            # Remove the trailing carriage return line feed
            line = line[:-2]

            # Create an array of the data
            Z = line.split()

            mycursor = mydb.cursor()

            watt1 = int(float(Z[1]))
            if watt1 > 10:
                status1 = 1
            else:
                status1 = 0
                watt1 = 0

            watt2 = int(float(Z[2]))
            if watt2 > 10:
                status2 = 1
            else:
                status2 = 0
                watt2 = 0

            watt3 = int(float(Z[3]))
            if watt3 > 50:
                status3 = 1
            else:
                status3 = 0
                watt3 = 0

            ct = datetime.datetime.now()

            sql = "INSERT INTO breakersstat (breakerId, breakerName, amps, status, time) VALUES (%s, %s, %s, %s, %s)"
            val = (1, 'LivingRoom', watt1, status1, ct)
            mycursor.execute(sql, val)
            mydb.commit()

            sql = "INSERT INTO breakersstat (breakerId, breakerName, amps, status, time) VALUES (%s, %s, %s, %s, %s)"
            val = (2, 'Kitchen', watt2, status2, ct)
            mycursor.execute(sql, val)
            mydb.commit()

            sql = "INSERT INTO breakersstat (breakerId, breakerName, amps, status, time) VALUES (%s, %s, %s, %s, %s)"
            val = (4, 'Hottub', watt3, status3, ct)
            mycursor.execute(sql, val)
            mydb.commit() 

            sql = "UPDATE breakers SET amps = %s WHERE breakerId = %s"
            val = (watt1, 1)
            mycursor.execute(sql, val)
            mydb.commit()

            sql = "UPDATE breakers SET amps = %s WHERE breakerId = %s"
            val = (watt2, 2)
            mycursor.execute(sql, val)
            mydb.commit()
            
            sql = "UPDATE breakers SET amps = %s WHERE breakerId = %s"
            val = (watt3, 4)
            mycursor.execute(sql, val)
            mydb.commit()

            # Print it nicely
            print ("----------")
            for i in range(len(Z)):
                if i==0:
                    print ("NodeID: %s" % Z[0])
                elif i in [1,2,3]:
                    amp = float(Z[i])
                    print ("Power %d: %s W" % (i, amp))
                elif i==4:
                    temp = int(float(Z[i])) * 1.8 + 32
                    print ("Temperature: %s F" % temp)
                    
            mydb.close()
            time.sleep(30)    

except KeyboardInterrupt:
    ser.close()
    mydb.close()