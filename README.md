# Ropstam Project Backend

## Requirements

Following requirements are necessary to setup this repository on any environment.
```
PHP  >= 8.1

Composer = 2


## Repo Setup

After cloning this repository create an empty database and run the following command
` cp .env.example .env `

Now add your `Mysql` and other configurations in .env 

Now follow the following steps in the same order as they are written

```
composer install


php artisan migrate --seed

# Ropstam Project Frontened

## Requirements

Run the following command

npm install
npm run serve