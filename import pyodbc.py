import pyodbc
import pymysql

def import_table(table):
    # Connect to the Microsoft Access database
    conn_access = pyodbc.connect(r'DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=./lahman_1871-2022.mdb')
    cursor_access = conn_access.cursor()

    # Connect to the MySQL database
    conn_mysql = pymysql.connect(host='group5db2.cfmq22o2upla.us-east-2.rds.amazonaws.com', user='migrationuser', password='Baseballgood', db='lahman')
    cursor_mysql = conn_mysql.cursor()

    try:
        # Access Select Statement for Inserting Data
        access_query = f"SELECT * FROM {table}"
        cursor_access.execute(access_query)
        filtered_data = cursor_access.fetchall()

        # Insert the data into the MySQL database
        for row in filtered_data:
            # Convert None to NULL
            row = ['NULL' if item is None else item for item in row]
            insert_query = f"INSERT INTO {table} VALUES " + str(tuple(row))
            cursor_mysql.execute(insert_query)
            print(f"Inserted data into {table} table")

        # Commit the changes
        conn_mysql.commit()

    except Exception as e:
        print(f"An error occurred while importing table {table}: {e}")

    finally:
        # Close the cursors and connections
        cursor_access.close()
        conn_access.close()
        cursor_mysql.close()
        conn_mysql.close()


def main():
    # List of table names
    tables = ['AllStarFull', 'Batting', 'Pitching', 'People', 'Appearances']
    for table in tables:
        import_table(table)


if __name__ == "__main__":
    main()