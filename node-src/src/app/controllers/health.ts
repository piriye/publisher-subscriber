import { Request, Response } from 'express';
import { controller, httpGet } from 'inversify-express-utils';

@controller('/health')
export class HealthController {
  @httpGet('/')
  public basicCheck(_: Request, res: Response) {
    return res.status(200).json({
      status: 'success',
      // tslint:disable-next-line:object-literal-sort-keys
      message: 'Basic Health Check Route Working.'
    });
  }
}
