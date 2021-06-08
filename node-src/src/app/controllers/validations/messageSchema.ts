/* eslint-disable @typescript-eslint/camelcase */
import Joi from '@hapi/joi';

export const MessageSchema = Joi.object({
    topic: Joi.string().required(),
    data: Joi.object()
});
