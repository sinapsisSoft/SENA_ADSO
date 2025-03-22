import sequelize from "../config/connect.db.js";
import {Model, DataTypes} from 'sequelize';

class User extends Model{};

User.init({
    user_id:{
      type:DataTypes.UUID,
      defaultValue:DataTypes.UUIDV4,
      primaryKey:true,
    },
    user_user:{
      type:DataTypes.STRING,
      allowNull:false,
      unique:true,
    },
    user_password:{
      type:DataTypes.STRING,
      allowNull:false,
    }
},{sequelize, modelName:"user"});

export default User;
