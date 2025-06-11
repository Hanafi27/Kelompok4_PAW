<<<<<<< HEAD
# E-Voting Project

An online voting system for the student activity units at campus, featuring admin and user dashboards. This project utilizes AdminLTE 3 for the bootstrap template and Chart.js for displaying vote counts.

## Table of Contents

- [Features](#features)
- [Prerequisites](#prerequisites)
- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
- [Dependencies](#dependencies)
- [License](#license)

## Features

### Admin Dashboard
- **Dashboard**: Displays total number of candidates, voters, and vote count with a bar chart from Chart.js.
- **Kelola Kandidat**: Add and delete candidates.
- **Kelola Mahasiswa**: Add and delete user accounts.
- **Profile**: Admin profile management.
- **Vote Log**: Logs of all voting activities.

### User Dashboard
- **Vote**: Page for users to cast their votes.
- **Profile**: User profile management.

## Prerequisites

- PHP >= 7.3
- Composer
- Laravel
- Node.js and npm

## Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/Sidiq0/E-Voting.git
    ```

2. **Install dependencies:**
    ```sh
    composer install
    npm install
    ```

3. **Environment setup:**
    - Copy `.env.example` to `.env`:
        ```sh
        cp .env.example .env
        ```
    - Update the `.env` file with your database and other configurations.

4. **Generate application key:**
    ```sh
    php artisan key:generate
    ```

5. **Create a symbolic link to the storage directory:**
    ```sh
    php artisan storage:link
    ```

6. **Run migrations and seed the database:**
    ```sh
    php artisan migrate:fresh --seed
    ```

## Configuration

Update the `.env` file with your specific environment settings, such as database connection details and other application configurations.

## Usage

1. **Start the development server:**
    ```sh
    php artisan serve
    ```

2. **Access the application:**
    Open your browser and navigate to `http://localhost:8000`.

3. **Login Credentials:**
    - **Admin:**
        - Email: `admin@example.com`
        - Password: `12345678`
    - **User:**
        - Email: `user@example.com`
        - Password: `12345678`

## Dependencies

<details>
<summary><strong>PHP Dependencies</strong></summary>

- almasaeed2010/adminlte v3.2.0
- brick/math 0.12.1
- carbonphp/carbon-doctrine-types 2.1.0
- dflydev/dot-access-data v3.0.3
- doctrine/inflector 2.0.10
- doctrine/lexer 3.0.1
- dragonmantank/cron-expression v3.3.3
- egulias/email-validator 4.0.2
- fakerphp/faker v1.23.1
- filp/whoops 2.15.4
- fruitcake/php-cors v1.3.0
- graham-campbell/result-type v1.1.2
- guzzlehttp/guzzle 7.8.1
- guzzlehttp/promises 2.0.2
- guzzlehttp/psr7 2.6.2
- guzzlehttp/uri-template v1.0.3
- hamcrest/hamcrest-php v2.0.1
- jeroennoten/laravel-adminlte v3.12.0
- laravel/framework v10.48.16
- laravel/pint v1.16.2
- laravel/prompts v0.1.24
- laravel/sail v1.30.2
- laravel/sanctum v3.3.3
- laravel/serializable-closure v1.3.3
- laravel/tinker v2.9.0
- laravel/ui v4.5.2
- league/commonmark 2.4.2
- league/config v1.2.0
- league/flysystem v3.28.0
- league/flysystem-local v3.28.0
- league/mime-type-detection v1.15.0
- mockery/mockery 1.6.12
- monolog/monolog 3.7.0
- myclabs/deep-copy 1.12.0
- nesbot/carbon 2.72.5
- nette/schema v1.3.0
- nette/utils v4.0.4
- nikic/php-parser v5.1.0
- nunomaduro/collision v7.10.0
- nunomaduro/termwind v1.15.1
- phar-io/manifest 2.0.4
- phar-io/version 3.2.1
- phpoption/phpoption 1.9.2
- phpunit/php-code-coverage 10.1.15
- phpunit/php-file-iterator 4.1.0
- phpunit/php-invoker 4.0.0
- phpunit/php-text-template 3.0.1
- phpunit/php-timer 6.0.0
- phpunit/phpunit 10.5.27
- psr/clock 1.0.0
- psr/container 2.0.2
- psr/event-dispatcher 1.0.0
- psr/http-client 1.0.3
- psr/http-factory 1.1.0
- psr/http-message 2.0
- psr/log 3.0.0
- psr/simple-cache 3.0.0
- psy/psysh v0.12.4
- ralouphie/getallheaders 3.0.3
- ramsey/collection 2.0.0
- ramsey/uuid 4.7.6
- sebastian/cli-parser 2.0.1
- sebastian/code-unit 2.0.0
- sebastian/code-unit-reverse-lookup 3.0.0
- sebastian/comparator 5.0.1
- sebastian/complexity 3.2.0
- sebastian/diff 5.1.1
- sebastian/environment 6.1.0
- sebastian/exporter 5.1.2
- sebastian/global-state 6.0.2
- sebastian/lines-of-code 2.0.2
- sebastian/object-enumerator 5.0.0
- sebastian/object-reflector 3.0.0
- sebastian/recursion-context 5.0.0
- sebastian/type 4.0.0
- sebastian/version 4.0.1
- spatie/backtrace 1.6.1
- spatie/error-solutions 1.0.5
- spatie/flare-client-php 1.7.0
- spatie/ignition 1.15.0
- spatie/laravel-ignition 2.8.0
- symfony/console v6.4.9
- symfony/css-selector v6.4.8
- symfony/deprecation-contracts v3.5.0
- symfony/error-handler v6.4.9
- symfony/event-dispatcher v6.4.8
- symfony/event-dispatcher-contracts v3.5.0
- symfony/finder v6.4.8
- symfony/http-foundation v6.4.8
- symfony/http-kernel v6.4.9
- symfony/mailer v6.4.9
- symfony/mime v6.4.9
- symfony/polyfill-ctype v1.30.0
- symfony/polyfill-intl-grapheme v1.30.0
- symfony/polyfill-intl-idn v1.30.0
- symfony/polyfill-intl-normalizer v1.30.0
- symfony/polyfill-mbstring v1.30.0
- symfony/polyfill-php72 v1.30.0
- symfony/polyfill-php80 v1.30.0
- symfony/polyfill-php83 v1.30.0
- symfony/polyfill-uuid v1.30.0
- symfony/process v6.4.8
- symfony/routing v6.4.8
- symfony/service-contracts v3.5.0
- symfony/string v6.4.9
- symfony/translation v6.4.8
- symfony/translation-contracts v3.5.0
- symfony/uid v6.4.8
- symfony/var-dumper v6.4.9
- symfony/yaml v6.4.8
- theseer/tokenizer 1.2.3
- tijsverkoyen/css-to-inline-styles v2.2.7
- vlucas/phpdotenv v5.6.0
- voku/portable-ascii 2.0.1
- webmozart/assert 1.11.0

</details>

<details>
<summary><strong>Node.js Dependencies</strong></summary>

- @popperjs/core@2.11.8
- axios@1.7.2
- bootstrap@5.3.3
- jquery@3.7.1
- laravel-vite-plugin@1.0.5
- popper.js@1.16.1
- sass@1.77.8
- vite@5.3.3

</details>

## License

This project is licensed under the MIT License 
=======
# Kelompok4_PAW
Kelompok 4 SI07C
>>>>>>> be57a2de4b2b0a0cf593ae7ea897aeee7e4974e2
