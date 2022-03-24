#!/usr/bin/python2
import mysql.connector
import time
import datetime
import math
import random

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
           
            mycursor = mydb.cursor()

            w1 = random.randint(0,1)
            w2 = random.randint(0,1)
            w3 = random.randint(0,1)

            if w1 == 0:
                status1 = 0
                watt1 = 0
            else:
                status1 = 1
                watt1 = 15

            if w2 == 0:
                status2 = 0
                watt2 = 0
            else:
                status2 = 1
                watt2 = 15 

            if w3 == 0:
                status3 = 0
                watt3 = 0
            else:
                status3 = 1
                watt3 = 15 

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

            print ("Breaker1: %s Breaker2: %s Breaker3: %s"% (watt1,watt2,watt3))

            mydb.cose()
            time.sleep(30)    

except KeyboardInterrupt:
    mydb.cose()