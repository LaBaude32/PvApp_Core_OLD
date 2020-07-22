FROM lavoweb/php-7.4
MAINTAINER Aurélien Lavorel <aurelien@lavoweb.net>

ADD . /app/

EXPOSE 80

CMD php -S localhost:80 -t /app/public/
