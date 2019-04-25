FROM mysql:5.5.62

ENV MYSQL_DATABASE Escuela

VOLUME /var/lib/mysql

COPY ./scripts.sql /docker-entrypoint-initdb.d/
COPY ./scriptsadd.sql /docker-entrypoint-initdb.d/
