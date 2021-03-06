import { Container } from 'inversify';
import { HealthController, ReceiverController } from '../controllers';
import TYPES from './types';
import { PostgresConnection } from './db';

const container = new Container();

// controllers
container.bind<HealthController>(TYPES.HealthController).to(HealthController).inSingletonScope();
container.bind<ReceiverController>(TYPES.ReceiverController).to(ReceiverController).inSingletonScope();

// services

// repositories

// database
container.bind<PostgresConnection>(TYPES.DatabaseConnection).to(PostgresConnection).inSingletonScope();

export default container;
