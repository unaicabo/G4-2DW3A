ARG VITE_APP_URL
ENV VITE_APP_URL=$VITE_APP_URL

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# Instalar Git
RUN apt-get update \
    && apt-get install -y git \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones PHP necesarias
RUN apt-get update \
    && apt-get install -y libzip-dev zip unzip \
    && docker-php-ext-install pdo pdo_mysql bcmath zip \
    && rm -rf /var/lib/apt/lists/*
