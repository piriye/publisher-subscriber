import { Request, Response } from 'express';
import { controller, httpPost } from 'inversify-express-utils';
import { BaseController } from '.';
import { MessageSchema } from './validations/messageSchema';

@controller('/receiver')
export class ReceiverController extends BaseController {
    @httpPost('/')
    public async receiveMessage(req: Request, res: Response) {
        try {
            const errors = this.validateRequest(req.body, MessageSchema);

            if (errors) {
                return this.error(res, 'VALIDATION_ERRORS', errors);
            }

            const message = req.body;

            console.log('Message received from publisher: ', message);

            return this.success(res, [], 'Successfully received message', 200);
        } catch (error) {
            console.error(error);
            return this.error(res, 'INTERNAL_SERVER_ERROR', error.message, 500);
        }
    }
}
