FROM redis:alpine

COPY docker/redis/redis.conf /usr/local/etc/redis/redis.conf

HEALTHCHECK --interval=5s --timeout=5s --retries=3 CMD redis-cli ping || exit 1

EXPOSE 6379

CMD ["redis-server", "/usr/local/etc/redis/redis.conf"]
