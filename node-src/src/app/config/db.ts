import knex from 'knex';
import { Env } from './env';
import { injectable } from 'inversify';
import { Model } from 'objection';

const env = Env.all().environment;
const config = require('../../knexfile')[env];

const db = knex(config);

export { db };

@injectable()
export class PostgresConnection {
  getDb() {
    return db;
  }
}

Model.knex(db);
