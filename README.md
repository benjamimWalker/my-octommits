# My Octommits

## Installation

First clone this repository, install the dependencies, and setup your .env file.

```
git clone git@github.com:benjamimWalker/my-octommits.git
composer install
npm install or yarn install
cp .env.example .env
```

Generate your application key

```
php artisan key:generate
```

Register a new Oauth application on GitHub, add the client id and secret to your .env file.
Match the GitHub redirect callback url located at /config/services.php with your GitHub application callback URL.

Then create the necessary database and update your .env file and run the initial migrations.

```
php artisan migrate
```

## Usage

To run the application locally, execute the following commands.
```
npm run dev or yarn dev
php artisan serve
```
