def run(): 
    import psycopg2
    import socket
    status = '200 OK'
    ip = str(socket.gethostbyname(socket.gethostname()))
    output = 'WELCOME!'
    output+=ip
    try:
    # connect to the PostgreSQL server
        conn = psycopg2.connect(database="root", user="postgres", host="192.168.56.5", port="5432")
        cur = conn.cursor()
    # create table one by one
        cur.execute("SELECT * FROM peliculas")
        records= cur.fetchall()
        for record in records:
            output+='\n'
            output += repr(record)
    # close communication with the PostgreSQL database server
        cur.close()
    # commit the changes
        conn.commit()
    except (Exception, psycopg2.DatabaseError) as error:
        print(error)
    finally:
        if conn is not None:
            conn.close()

    print(output)
    response_headers = [('Content-type', 'text/plain'),
                        ('Content-Length', str(len(output)))]
if __name__ == "__main__":
   run() 
