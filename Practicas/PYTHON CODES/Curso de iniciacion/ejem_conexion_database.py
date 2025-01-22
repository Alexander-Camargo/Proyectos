import mysql.connector
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
)

cursor = mydb.cursor()

#sql = "CREATE DATABASE IF NOT EXISTS db_prueba"

print(mydb)