## About Project

This project is to solve a test task
https://docs.google.com/document/d/1VPh4ydYtZRRnsLDOvas_aevOxXkw52K1-TYOAqYe4Vs/edit#

## Tech Stack

-   Laravel
-   Docker
-   MongoDb
-   Redis
-   Swagger

## Running the project

1. cp .env.example .env
2. ./vendor/bin/sail up
3. ./vendor/bin/sail composer install
4. ./vendor/bin/sail db:seed to add example entities
5. Go to http://localhost/api/documentation to access the API

## Highlights & Requirements

- ✅ Mandatory adherence to REST
- ✅ The application must start and work. Non-working code is not considered.
- ✅ Using Redis to cache request where it will be a lot like entities
- ✅ Not using ORM, Eloquent and Models.
- ✅ Following Laravel best practices
- ✅ Compliant to PSR-4
