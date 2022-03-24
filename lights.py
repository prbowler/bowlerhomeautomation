import json
import time
import datetime
import libioplus
import mysql.connector


def setup():
    #turn all outputs off
    libioplus.setRelayCh(0, 1, 0)
    libioplus.setRelayCh(0, 2, 0)
    libioplus.setRelayCh(0, 3, 0)
    libioplus.setRelayCh(0, 4, 0)
    libioplus.setRelayCh(0, 5, 0)
    libioplus.setRelayCh(0, 6, 0)
    libioplus.setRelayCh(0, 7, 0)
    libioplus.setRelayCh(0, 8, 0)

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
        mycursor.execute("SELECT * FROM lighting")
        myresult = mycursor.fetchall()
        print(myresult)

        for light in myresult:
            num = light[0]
            room = light[1]
            stat = light[2]
            if stat == 1:
                watts = light[3]
            else:
                watts = 0
            libioplus.setRelayCh(0, num, stat)
        
            ct = datetime.datetime.now()
            print(ct)
            sql = "INSERT INTO lightingStat (lightId, room, switch, watts, time) VALUES (%s, %s, %s, %s, %s)"
            val = (num, room, stat, watts, ct)
            mycursor.execute(sql, val)
            mydb.commit()

        mydb.close() 
        time.sleep(60)


def destroy():
    libioplus.setRelayCh(0, 1, 0)
    libioplus.setRelayCh(0, 2, 0)
    libioplus.setRelayCh(0, 3, 0)
    libioplus.setRelayCh(0, 4, 0)
    libioplus.setRelayCh(0, 5, 0)
    libioplus.setRelayCh(0, 6, 0)
    libioplus.setRelayCh(0, 7, 0)
    libioplus.setRelayCh(0, 8, 0)
    mydb.close()         

if __name__ == '__main__':  # Program entrance
    print ('Program is starting ... ')
    setup()
    try:
        loop()
    except KeyboardInterrupt: # Press ctrl-c to end the program.
        destroy()
