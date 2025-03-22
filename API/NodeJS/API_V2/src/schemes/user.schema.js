import Joi from '@hapi/joi';

export default{
    createUser:Joi.object({
      user_user: Joi.string().required().min(10),
      user_password:Joi.string().required().min(7),
      userStatus_FK:Joi.number().required(),
      role_FK:Joi.number().required(),
    }),
    updateUser:Joi.object({
      user_user: Joi.string().required().min(10),
      user_password:Joi.string().required().min(7),
      userStatus_FK:Joi.number().required(),
      role_FK:Joi.number().required(),
    }),
}