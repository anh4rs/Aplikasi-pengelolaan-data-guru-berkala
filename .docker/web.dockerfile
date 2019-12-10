FROM nginx:1.10

ADD .docker/nginx.conf /etc/nginx/conf.d/default.conf
WORKDIR /var/www
