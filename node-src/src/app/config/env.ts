/**
 * cache ENV value, its faster!
 *
 */
const envGlobCache: { [x: string]: string } = {};

function getEnv(envKey: string) {
  if (envGlobCache[envKey] !== undefined) {
    return envGlobCache[envKey];
  }
  const newEnv = process.env[envKey];
  if (newEnv !== undefined) {
    envGlobCache[envKey] = newEnv;
    return newEnv;
  }
  return '';
}

function getEnvBool(envKey: string) {
  const val = getEnv(envKey);
  if (val !== undefined && Boolean(val) === true) {
    return true;
  }
  return false;
}

function getEnvNumber(envKey: string, defaultVal?: number) {
  const val = getEnv(envKey);
  if (val !== undefined && !isNaN(Number(val))) {
    return Number(val);
  }
  return defaultVal as number;
}

interface IEnv {
  port: number;
  environment: string;
  pg_port: string;
  pg_host: string;
  pg_password: string;
  pg_user: string;
  pg_dbname: string;
  can_log_to_file: boolean;
}

const config: IEnv = {
  port: getEnvNumber('PORT'),
  environment: getEnv('NODE_ENV'),
  pg_port: getEnv('POSTGRES_PORT'),
  pg_password: getEnv('POSTGRES_PASSWORD'),
  pg_host: getEnv('POSTGRES_HOST'),
  pg_dbname: getEnv('POSTGRES_DBNAME'),
  pg_user: getEnv('POSTGRES_USER'),
  can_log_to_file: getEnvBool('CAN_LOG_TO_FILE')
};

export class Env {
  static all() {
    return config;
  }
}
