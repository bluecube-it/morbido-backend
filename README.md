# Morbido Backend

## How to run with Dockerfile
In order to run application with dockerfile you need to build the image, like this:

```bash
docker build -t morbido-backend .
```

When you run the container you need to pass the environment variable ML_ENGINE_ENDPOINT in order to comunicate with the ML Engine Module, see below the example:

```bash
docker run [OPTIONS YOU WANT] **-e ML_ENGINE_ENDPOINT=http://endpoint.that.you.want** morbido-backend
```

## Without Dockerfile

```bash
cp .env.example .env
```

Install dependencies

```bash
composer install
```

Change the ML_ENGINE_ENDPOINT variable in .env





