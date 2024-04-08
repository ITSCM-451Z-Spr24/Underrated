import pyodbc
import time

# Connect to the Microsoft Access database
conn = pyodbc.connect(r'DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=S:\scripts\lahman_1871-2022.accdb')
cursor = conn.cursor()

sql_query = """
SELECT * FROM Batting

"""

cursor.execute(sql_query)
filtered_players = cursor.fetchall()
for player in filtered_players:
    time.sleep(0.5)
    print(player)

# Close files
schema_file.close()
data_file.close()

# Close connections
cursor.close()
conn.close()
