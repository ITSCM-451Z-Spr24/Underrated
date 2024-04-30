import pyodbc
import pymysql

def escape_quotes(value):
    # If the value is a string, escape single quotes
    if isinstance(value, str):
        return value.replace("'", "''")
    else:
        return value

def import_table(table):
    # Connect to the Microsoft Access database
    conn_access = pyodbc.connect(r'DRIVER={Microsoft Access Driver (*.mdb, *.accdb)};DBQ=./lahman_1871-2022.mdb')
    cursor_access = conn_access.cursor()

    # Connect to the MySQL database
    conn_mysql = pymysql.connect(host='aws.hazelparys.com', user='Baseballreallysux', password='baseballsux', db='lahman')
    cursor_mysql = conn_mysql.cursor()

    try:
        # Access Select Statement for Inserting Data
        access_query = f"SELECT * FROM {table}"
        cursor_access.execute(access_query)
        filtered_data = cursor_access.fetchall()
        counter = 0
        # Insert the data into the MySQL database
        for row in filtered_data:
            # Escape single quotes in each value
            row = [escape_quotes(item) for item in row]
            # Convert Python None to SQL NULL
            row = ['NULL' if item is None else f"'{item}'" for item in row]
            insert_query = f"INSERT INTO {table} VALUES ({', '.join(row)})"
            try:
                cursor_mysql.execute(insert_query)
                counter += 1
                print(f"{counter}. Inserted {insert_query} into {table} table")
            except Exception as e:
                print(f"Error inserting row: {row}")
                raise e

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
    tables = ['People']
    for table in tables:
        import_table(table)


if __name__ == "__main__":
    main()
