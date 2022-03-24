import random
import time
import datetime
import math
import json
import mysql.connector

startZt = random.randint(60, 80)

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
        mycursor.execute("SELECT * FROM tstats WHERE tstatId = 1")
        myresult = mycursor.fetchone()
        print(myresult)
        

        print(type(myresult))
        htgSp = myresult[2]
        clgSp = myresult[3]
        sysSp = myresult[4]
        
        tempF = startZt
        print ('Temperature : %.2f'%(tempF))
        print ('htgSp : %d, clgSp : %d, Temperature : %d'%(htgSp,clgSp,tempF))
        
        #check zt and set outputs
        if sysSp == 'auto' and int(tempF) < int(htgSp):
            htg = 0 #htg
            clg = 1 #clg
            sf = 0 #sf
        elif sysSp == 'auto' and int(tempF) > int(clgSp):
            htg = 1 #htg
            clg = 0 #clg
            sf = 0 #sf
        elif sysSp == 'htg' and int(tempF) < int(htgSp):
            htg = 0 #htg
            clg = 1 #clg
            sf = 0 #sf
        elif sysSp == 'clg' and int(tempF) > int(clgSp):
            htg = 1 #htg
            clg = 0 #clg
            sf = 0 #sf 
        else:
            htg = 1 #htg
            clg = 1 #clg
            sf = 1 #sf 
       
        print ('Heating : %d, Cooling : %d, Supply Fan : %d'%(htg,clg,sf))
        
        sql = "UPDATE tstats SET zt = %s, htg = %s, clg = %s, sf = %s WHERE tstatId = %s"
        val = (tempF, htg, clg, sf, 1)
        mycursor.execute(sql, val)
        mydb.commit()

        ct = datetime.datetime.now()
        print(ct)
        sql = "INSERT INTO tstatStat (tstatId, htgSp, clgSp, sysSp, zt, sf, htg, clg, time) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)"
        val = (1, htgSp, clgSp, sysSp, tempF, htg, clg, sf, ct)
        mycursor.execute(sql, val)
        mydb.commit()

        f = open("./data/temperature.txt", "w")

        f.write(json.dumps(int(tempF)))
        f.close()

        mydb.close()  
        time.sleep(60)
        if htg == 0:
            tempF += 1
        elif clg == 0:
            tempF -= 1
        else:
            r = random.randint(-1,1)
            tempF += r

if __name__ == '__main__':  # Program entrance
    print ('Program is starting ... ')
    try:
        loop()
    except KeyboardInterrupt: # Press ctrl-c to end the program.
        print ('Program is ending ... ')
        