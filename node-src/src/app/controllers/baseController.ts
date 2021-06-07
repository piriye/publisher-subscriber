import { Response } from 'express';
import Joi from '@hapi/joi';
import { injectable } from 'inversify';

@injectable()
export abstract class BaseController {
  constructor() {}

  protected async validateRequest(requestBody: any, validationSchema: Joi.Schema) {
    const error = validationSchema.validate(requestBody);

    if (error.error) {
      return error.error.details[0].message;
    }
  }

  protected async success(res: Response, data: any = [], message: string = '', httpStatus: number = 200) {
    return res.status(httpStatus).send({
      status: 'success',
      message: message,
      data: data
    });
  }

  protected async error(res: Response, code: string, message: string, httpStatus: number = 400) {
    return res.status(httpStatus).send({
      status: 'error',
      code: code,
      message: message
    });
  }
}
