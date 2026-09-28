FROM mariadb:12.3

VOLUME /var/lib/mysql

ADD ./docker/db/mysqld.cnf /etc/mysql/conf.d

# Initialize extra databases and data using the official entrypoint hook
ADD ./docker/db/init/ /docker-entrypoint-initdb.d/
