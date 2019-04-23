import psycopg2

try:
    conn = psycopg2.connect(database="root", user="postgres", host="192.168.56.5", port="5432")
except:
    print("I am unable to connect to the database") 

cur = conn.cursor()
try:
    cur.execute("CREATE TABLE peliculas(id serial PRIMARY KEY, titulo VARCHAR(255) NOT NULL,estreno VARCHAR(255) NOT NULL, genero VARCHAR(255) NOT NULL);")
    cur.execute("INSERT INTO peliculas VALUES(100, 'el senor de los anillos','2001','fantasia,aventura');")
    cur.execute("INSERT INTO peliculas VALUES(101, 'harry potter','2002','magia,aventura,romance');")
    cur.execute("INSERT INTO peliculas VALUES(103, 'Batman V superman','2017','superheroes');")
except:
    print("ya existe la tabla")


conn.commit() # <--- makes sure the change is shown in the database
conn.close()
cur.close()
