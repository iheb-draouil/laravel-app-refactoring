

# Setup

There are 3 external systems that your application must communicate with. Each of these systems offer two services:

- Authentication:
    - Each system has its own process for authentication.
    - Usernames are prefixed with a unique string sequence which corresponds to the system that the user account originates from.

- Resource retreival:
    - You are only concerned with the retreival of titles.
    - Some of the resource services are unreliable. You're required to implement a caching mechanism to increase the availability of the resource endpoint of your app.

# Task and Constraints

You're allowed to modify the structure and the content of files within the project but make sure the content of the "External" directory in the project root is intact.

The directory contains services that act as third party services with which your app communicates but may not modify in any way.

Your task is to expose a REST API that offers these two functionalities:
- Authentication: It must be done a way that users from all the systems can authenticate with your app using their respective system's credentials.
- Expose an enpoint that allows the retreival of all the resources from all the systems at once.

# Submission

## Usage

Restore PHP packages
```bash
composer install
```

Start the development server
```bash
php artisan serve
```

Attempting login with invalid credentials:
```bash
curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--header 'Content-Type: application/json' \
--data-raw '{"login":"TEST_1","password":"some-password" }'
```

Response:
```
{"status":"failure"}
```

Attempting login with valid credentials:
```bash
curl --location --request POST 'http://127.0.0.1:8000/api/login' \
--header 'Content-Type: application/json' \
--data-raw '{"login":"SYS_A_1","password":"some-password"}'
```

Response:
```
{"status":"success","token":"eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJsb2dpbiI6IkZPT18xIiwiY29udGV4dCI6IkZPTyIsImlhdCI6MTUxNjIzOTAyMn0.iOLIsd1TXyU53nrMGfjShXD7KSMz_lbaT256TQVYDz8"}
```

Retreive resources
```bash
curl 'http://127.0.0.1:8000/api/titles'
```

Response:
```
["Proin ornare mollis lectus tincidunt.","Lorem ipsum dolor sit amet.","Per no modo erroribus percipitur","Mutat accusam fastidii quo id","Vis et cetero accommodare","Eu vel noster reprehendunt","Vim ubique legendos te","Usu simul laboramus at"]
```