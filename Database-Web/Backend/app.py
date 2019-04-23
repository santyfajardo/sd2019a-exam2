def application(environ, start_response):
    import psycopg2
    import socket
    status = '200 OK'
    ip = socket.gethostbyname(socket.gethostname())
    output = 'BIENVENID, tenemos estos autores:!'
    output += ip
    conn = psycopg2.connect(database="root", user="postgres", host="192.168.56.5", port="5432")
    cur = conn.cursor()
    cur.execute("SELECT * FROM peliculas")
    records= cur.fetchall()
    for record in records:
        output += repr(record)
    cur.close()
    conn.close()
    response_headers = [('Content-type', 'text/plain'),
                        ('Content-Length', str(len(output)))]
    start_response(status, response_headers)
    return [output]

