FROM httpd:2.4

ARG USER="www-data"
ARG UID="1000"
ARG GROUP="www-data"
ARG GID="1000"
ARG DOCUMENT_DIR="/var/www/"
ARG WORKSPACE="/usr/local/apache2/"

# timezone (Asia/Tokyo)
ENV TZ JST-9

# etc
ENV TERM xterm

# tools
RUN apt-get update && apt-get -y install git vim less

# httpd.conf
RUN sed -i -e "s/#ServerName/ServerName/g" /usr/local/apache2/conf/httpd.conf
RUN { \
    echo ''; \
    echo '# Custom Settings'; \
    echo 'LoadModule rewrite_module modules/mod_rewrite.so'; \
    echo 'LoadModule proxy_module modules/mod_proxy.so'; \
    echo 'LoadModule proxy_fcgi_module modules/mod_proxy_fcgi.so'; \
    echo 'LoadModule ssl_module modules/mod_ssl.so'; \
    echo 'LoadModule socache_shmcb_module modules/mod_socache_shmcb.so'; \
    echo '<FilesMatch \.php$>'; \
    echo '  CGIPassAuth On'; \
    echo '  SetHandler "proxy:fcgi://php:9000"'; \
    echo '</FilesMatch>'; \
    echo 'Include conf/extra/httpd-vhosts.conf'; \
    echo ''; \
} >> /usr/local/apache2/conf/httpd.conf

# virtual hosts
COPY ./httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf

# document directory
RUN mkdir $DOCUMENT_DIR && chmod 705 $DOCUMENT_DIR

# user setting
WORKDIR $WORKSPACE
RUN usermod -u $UID $USER && groupmod -g $GID $GROUP
RUN chown -R $UID:$GID $DOCUMENT_DIR
RUN chown -R $UID:$GID $WORKSPACE
