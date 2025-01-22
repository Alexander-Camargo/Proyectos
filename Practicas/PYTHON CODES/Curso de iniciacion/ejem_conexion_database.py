import mysql.connector
mydb = mysql.connector.connect(
    host="localhost",
    user="root",
    password="",
)

cursor = mydb.cursor()

# sql = "CREATE DATABASE IF NOT EXISTS db_prueba"
# sql = "INSERT INTO db_prueba (nombre, apellido, edad) VALUES (%s, %s, %s)"
# val = ("valor1", "valor2", "valor3")

# para insertar estas sentencias de SQL utilizamos:
# cursor.execute(sql, val)
# mydb.commit()
# pimero le decimos que se ejecute y luego le damos la sentencia a ejecutar y los valores si es que lleva esta sentencia

# verificar si el registro fue exitoso con:
# print(cursor.rowcount, "record inserted.")

# algunas sentencias pueden ser ejecutadas directamente por ejemplo:
# cursor.execute("SElECT * FROM nombre_de_la_tabla")

# buscar todos los registros:
# resultado = cursor.fetchall()

# imprimir todos los registros:
# for x  in resultado:
#    print(x)

print(mydb)