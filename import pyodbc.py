import pyodbc

# Connect to the Microsoft Access database
conn = pyodbc.connect(r'DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=C:\Users\ajlou\Downloads\lahman_1871-2022.mdb')

# Create a cursor to execute SQL queries
cursor = conn.cursor()

# Define the SQL query to select all baseball players who are allstars
sql_query = """
SELECT *
FROM People
WHERE PlayerID IN (SELECT PlayerID FROM AllstarFull)
"""

sql_query = """
SELECT nameFirst, nameLast
FROM People
WHERE PlayerID IN (SELECT PlayerID FROM AllstarFull)
"""



# Execute the SQL query
cursor.execute(sql_query)

# Fetch all the filtered players
filtered_players = cursor.fetchall()

# Display the filtered players
for player in filtered_players:
    print(player)

# Close the cursor and connection
cursor.close()
conn.close()
