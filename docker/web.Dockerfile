FROM nginx:alpine

WORKDIR /var/www/html

RUN mkdir -p /etc/nginx/sites-available /etc/nginx/sites-enabled

COPY docker/nginx/nginx.conf /etc/nginx/nginx.conf
COPY docker/nginx/default.conf /etc/nginx/conf.d/default.conf
COPY docker/nginx/app.conf /etc/nginx/conf.d/${APP_NAME}.conf

RUN sed -i "s/\${NGINX_PORT}/${NGINX_PORT}/g" /etc/nginx/conf.d/${APP_NAME}.conf

RUN addgroup -g 1000 www && \
    adduser -D -G www -u 1000 www

RUN chown -R www:www /var/www/html

EXPOSE ${NGINX_PORT}

CMD ["nginx", "-g", "daemon off;"]
