FROM my-laravel5.6/php:7.3

USER root
RUN apt-get install -y supervisor

COPY ./docker/supervisor/supervisord.conf /etc/supervisor/supervisord.conf
COPY ./docker/supervisor/application.conf /etc/supervisor/conf.d/application.conf

CMD ["/usr/bin/supervisord"]
