FROM mysql

VOLUME /var/lib/mysql

ENTRYPOINT ["/entrypoint.sh"]
HEALTHCHECK CMD /healthcheck.sh
EXPOSE 3306 33060

CMD ["mysqld"]
