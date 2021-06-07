# About
Server-Side implementation for authenticatin requests.

## Installation
To clone the project:
```bash
https://github.com/MAXDeliveryNG/boilerplate-service.git
```
`cd` into the `boilerplate-service` directory
```bash
cd boilerplate-service
```

create a `.env` file with actual values similar to the `.env.example` file.

install project dependencies
```
yarn install
```

compile Typescript files to Javascript (by continuously watching)
```bash
yarn tsc -w
```

open another terminal, and run the project
```bash
yarn start:dev
```

## Knex.js Configuration

To make migrations
```bash
knex migrate:make <migration-name> --env <development-environment> --knexfile ./src/knexfile.ts -x ts

or

NODE_ENV=<development-environment> knex migrate:make <migration-name> --knexfile ./src/knexfile.ts -x ts
```

To run all migrations
```bash
knex migrate:latest --env <development-environment> --knexfile ./src/knexfile.ts
```

To create seeds

```bash
knex seed:make <seed-name> --env <development-environment> --knexfile ./src/knexfile.ts -x ts
```

To run seeds on database
```bash
knex seed:run --env <development-environment> --knexfile ./src/knexfile.ts
```

## Web API Documentation
* [Login Admin](#login-admin)


## Login Admin
`POST`: `/login`

Sample Login Request Body
```json
{
  "username": "johndoe@max.ng",
  "password": "password12345"
}
```

Sample Successful Login Response

`Response Code`: `200`
```json
{
  "status": "success",
  "message": "Login Successful",
  "data": {
    "user": {
      "first_name": "Tobi",
      "last_name": "Daada"
    }
  },
  "access_token": "ejy.2345432"
}
```

Sample Unsuccessful Response

`Response Code`: `404` | `400`
```json
{
  "status": "error",
  "message": "Invalid Login Credentials"
}
```





