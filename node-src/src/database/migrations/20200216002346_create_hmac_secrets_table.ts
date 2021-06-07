import * as Knex from 'knex';

const boilerplateSchema = 'boilerplate_service';
const table = 'hmac_secrets';

export async function up(knex: Knex): Promise<any> {
  try {
    return await knex.transaction(async (trx: Knex.Transaction) => {
      await trx.schema.createSchema(boilerplateSchema);

      return await trx.schema.withSchema(boilerplateSchema).createTable(table, (table: Knex.CreateTableBuilder) => {
        table.bigIncrements().primary();
        table.uuid('user_id').notNullable();
        table.string('secret').notNullable();
        table.timestamps(true, true);
      });
    });
  } catch (e) {
    console.error('Migration error: ' + e.message);
    throw e;
  }
}

export async function down(knex: Knex): Promise<any> {
  try {
    return await knex.transaction(async (trx: Knex.Transaction) => {
      await trx.schema.withSchema(boilerplateSchema).dropTableIfExists(table);
    });
  } catch (err) {
    throw err;
  }
}
