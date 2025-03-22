import sequelize from "../config/connect.db.js";
import {Model, DataTypes} from 'sequelize';

class UserStatus extends Model{};

UserStatus.init({
    userStatus_id:{
      type:DataTypes.INTEGER,
      autoIncrement:true,
      primaryKey:true,
    },
    userStatus_name:{
      type:DataTypes.STRING,
      allowNull:false,
      unique:true,
    },
    userStatus_descriptions:{
      type:DataTypes.STRING,
      allowNull:true,
    }
},{sequelize, modelName:"user_Status"});

export default UserStatus;
