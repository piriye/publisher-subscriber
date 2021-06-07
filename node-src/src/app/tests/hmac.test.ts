import request from 'supertest';
import app from '../index'; // our Node application
import { db } from '../config/db';

beforeEach(async () => {
  await db.migrate.rollback();
  await db.migrate.latest();
});

describe('Generate Hmac Secret', () => {
  it('should fail with missing user id', async () => {
    await post(`/hmac`, {}).expect(400);
  });

  it('should generate hmac secret for user', async () => {
    await post(`/hmac`, { user_id: '000449a7-cb06-4479-b9c0-19350d73544d' }).expect(201);
  });
});

export function post(url: string, body: any) {
  const httpRequest = request(app).post(url);

  httpRequest.send(body);
  httpRequest.set('Accept', 'application/json');
  httpRequest.set('Origin', 'http://localhost:3000');

  return httpRequest;
}
