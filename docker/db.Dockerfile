FROM postgres:14-alpine

EXPOSE 5432

# RUN mkdir -p /docker-entrypoint-initdb.d

# ENV POSTGRES_USER=${DB_USER}
# ENV POSTGRES_PASSWORD=${DB_PASSWORD}
# ENV POSTGRES_DB=${DB_DATABASE}
# ENV POSTGRES_HOST_AUTH_METHOD=trust

# COPY docker/postgres/init.sql /docker-entrypoint-initdb.d/init.sql

HEALTHCHECK --interval=5s --timeout=5s --retries=3 CMD pg_isready -U postgres -d laravel || exit 1
