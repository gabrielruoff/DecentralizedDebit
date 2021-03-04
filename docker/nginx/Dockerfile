FROM alpine:3.11

ENV NGINX_VERSION 1.17.8
ENV TEMPDIR /tmp/src

RUN set -x \
# create nginx user/group first, to be consistent throughout docker variants
    && addgroup -g 101 -S nginx \
    && adduser -S -D -H -u 101 -h /var/cache/nginx -s /sbin/nologin -G nginx -g nginx nginx

RUN set -x \
    && mkdir -p ${TEMPDIR} \
    && mkdir /var/cache/nginx \
    && touch /var/cache/nginx/client_temp \
    && apk add --no-cache --virtual .build-deps \
    curl \
    git \
    gcc \
    g++ \
    libc-dev \
    make \
    openssl-dev \
    pcre-dev \
    zlib-dev \
    linux-headers \
    libxslt-dev \
    gd-dev \
    geoip-dev \
    perl-dev \
    libedit-dev \
    mercurial \
    bash \
    alpine-sdk \
    findutils \
    && apk add pcre-dev \
    && cd ${TEMPDIR} \
    && git clone https://github.com/openresty/headers-more-nginx-module.git \
    && wget http://nginx.org/download/nginx-${NGINX_VERSION}.tar.gz \
    && tar -xzvf nginx-${NGINX_VERSION}.tar.gz \
    && cd nginx-${NGINX_VERSION} \
    RUN cd ${TEMPDIR}/nginx-${NGINX_VERSION} \
    && ./configure \
    --prefix=/etc/nginx \
    --sbin-path=/usr/sbin/nginx \
    --modules-path=/usr/lib/nginx/modules \
    --conf-path=/etc/nginx/nginx.conf \
    --error-log-path=/var/log/nginx/error.log \
    --http-log-path=/var/log/nginx/access.log \
    --pid-path=/var/run/nginx.pid \
    --lock-path=/var/run/nginx.lock \
    --http-client-body-temp-path=/var/cache/nginx/client_temp \
    --http-proxy-temp-path=/var/cache/nginx/proxy_temp \
    --http-fastcgi-temp-path=/var/cache/nginx/fastcgi_temp \
    --http-uwsgi-temp-path=/var/cache/nginx/uwsgi_temp \
    --http-scgi-temp-path=/var/cache/nginx/scgi_temp \
    --user=nginx \
    --group=nginx \
    --with-http_ssl_module \
    --with-http_realip_module \
    --with-http_addition_module \
    --with-http_sub_module \
    --with-http_dav_module \
    --with-http_flv_module \
    --with-http_mp4_module \
    --with-http_gunzip_module \
    --with-http_gzip_static_module \
    --with-http_random_index_module \
    --with-http_secure_link_module \
    --with-http_stub_status_module \
    --with-http_auth_request_module \
    --with-http_xslt_module=dynamic \
    --with-http_image_filter_module=dynamic \
    --with-http_geoip_module=dynamic \
    --with-threads \
    --with-stream \
    --with-stream_ssl_module \
    --with-stream_ssl_preread_module \
    --with-stream_realip_module \
    --with-stream_geoip_module=dynamic \
    --with-http_slice_module \
    #--with-mail \
    #--with-mail_ssl_module \
    --with-compat \
    --with-file-aio \
    --with-http_v2_module \
    --without-http_uwsgi_module \
    --add-dynamic-module=${TEMPDIR}/headers-more-nginx-module \
    && make \
    && make install \

    # create links to log files
    && ln -sf /dev/stdout /var/log/nginx/access.log \
    && ln -sf /dev/stderr /var/log/nginx/error.log

    RUN apk add --no-cache $runDeps \
# Bring in curl and ca-certificates to make registering on DNS SD easier
    && apk add --no-cache curl ca-certificates \
# create a docker-entrypoint.d directory
    && mkdir /docker-entrypoint.d

COPY docker-entrypoint.sh /
COPY 10-listen-on-ipv6-by-default.sh /docker-entrypoint.d
COPY 20-envsubst-on-templates.sh /docker-entrypoint.d

RUN rm /etc/nginx/nginx.conf
#RUN rm /etc/nginx/conf.d/default.conf
COPY nginx.conf /etc/nginx/
COPY default.conf /etc/nginx/conf.d/

RUN mkdir -p /var/www/ \
    && mkdir /auth \
    && chown -R nginx:nginx /var/www/ \
    && chown -R nginx:nginx /auth

#OPY .htpasswd /auth

ENTRYPOINT ["/docker-entrypoint.sh"]

EXPOSE 80:80

STOPSIGNAL SIGQUIT

CMD ["nginx"]
