FROM mysql:5.7

ARG USER="mysql"
ARG UID="1000"
ARG GROUP="mysql"
ARG GID="1000"
ARG WORKSPACE="/var/lib/mysql/"

# timezone (Asia/Tokyo)
ENV TZ JST-9

# etc
ENV TERM xterm

# my.conf
COPY mysql.cnf /etc/mysql/conf.d/custom.cnf

# user setting
WORKDIR $WORKSPACE
RUN usermod -u $UID $USER && groupmod -g $GID $GROUP
