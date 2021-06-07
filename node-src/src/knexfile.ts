// Update with your config settings.
import Knex from 'knex';
import { Env } from './app/config/env';

const env = Env.all();

interface IKnexConfig {
  development: Knex.Config<any>;
  staging: Knex.Config<any>;
  production: Knex.Config<any>;
  test: Knex.Config<any>;
}

const knexConfiguration: IKnexConfig = {
  development: {
    client: 'postgresql',
    connection: {
      host: env.pg_host,
      user: env.pg_user,
      password: env.pg_password,
      database: env.pg_dbname
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      directory: './database/migrations',
      tableName: 'boilerplate_service_migrations'
    },
    seeds: {
      directory: './database/seeds'
    }
  },

  staging: {
    client: 'postgresql',
    connection: {
      host: env.pg_host,
      user: env.pg_user,
      password: env.pg_password,
      database: env.pg_dbname
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      directory: './database/migrations',
      tableName: 'boilerplate_service_migrations'
    },
    seeds: {
      directory: './database/seeds'
    }
  },

  production: {
    client: 'postgresql',
    connection: {
      host: env.pg_host,
      user: env.pg_user,
      password: env.pg_password,
      database: env.pg_dbname
    },
    pool: {
      min: 2,
      max: 10
    },
    migrations: {
      directory: './database/migrations',
      tableName: 'boilerplate_service_migrations'
    },
    seeds: {
      directory: './database/seeds'
    }
  },

  test: {
    client: 'sqlite3',
    connection: {
      filename: './dev.sqlite3'
    },
    useNullAsDefault: true
  }
};

module.exports = knexConfiguration;
