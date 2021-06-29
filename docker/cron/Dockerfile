FROM my-laravel5.6/php:7.3

USER root
RUN apt-get install -y cron

COPY ./docker/cron/cron.root /etc/cron.d/cron
RUN chmod 0644 /etc/cron.d/cron && ln -sf /proc/1/fd/1 /var/log/cron.log

CMD cron -f
