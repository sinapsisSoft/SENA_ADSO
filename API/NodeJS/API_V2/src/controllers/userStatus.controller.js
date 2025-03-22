import userStatusModel from '../models/userStatus.model.js';

 const createUserStatus = async (req, res) => {
  try {
    await userStatusModel.sync();
    const dataUserStatus = req.body;
    const createUserStatus = await userStatusModel.create({
      userStatus_name: dataUserStatus.status_name,
      userStatus_descriptions: dataUserStatus.status_descriptions,
    });
    res.status(201).json({
      ok: true,
      status: 201,
      message: 'Create User Status :)',
      id: createUserStatus.userStatus_id,
    });
  }
  catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the request',
      status: 500,
    });
  }
};
 const showUserStatus = async (req, res) => {
  try {
    await userStatusModel.sync();

    const showUserStatus = await userStatusModel.findAll();
    res.status(200).json({
      ok: true,
      status: 200,
      message: 'Show user status:)',
      body: showUserStatus,
    });
  }
  catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the request',
      status: 500,
    });
  }
};
 const showIdUserStatus = async (req, res) => {
  try {
    await userStatusModel.sync();
    const idStatus = req.params.id;
    const showUserStatusId = await userStatusModel.findOne({
      where: {
        userStatus_id: idStatus,
      }
    });
    res.status(200).json({
      ok: true,
      status: 200,
      message: 'Show user status:)',
      body: showUserStatusId,
    });
  }
  catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the request',
      status: 500,
    });
  }
};
 const updateUserStatus = async (req, res) => {
  try {
    await userStatusModel.sync();
    const idStatus = req.params.id;
    const dataUserStatus = req.body;
    const createUserStatus = await userStatusModel.update({
      userStatus_name: dataUserStatus.name,
      userStatus_descriptions: dataUserStatus.status,
    }, {
      where: {
        userStatus_id: idStatus,
      }
    });
    res.status(201).json({
      ok: true,
      status: 201,
      message: 'Create User Status :)',
      id: createUserStatus.userStatus_id,
    });
  }
  catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the request',
      status: 500,
    });
  }
};
 const deleteUserStatus = async (req, res) => {
  try {
    await userStatusModel.sync();
    const idStatus = req.params.id;
    const deleteUserStatus = await userStatusModel.destroy({
      where: {
        userStatus_id: idStatus,
      }
    });
    res.status(200).json({
      ok: true,
      status: 204,
      message: 'Delete User :)',
      body: deleteUserStatus,
    });
  }
  catch (error) {
    return res.status(500).json({
      message: 'Something went wrong in the request',
      status: 500,
    });
  }
};

export default {
  createUserStatus,
  showUserStatus,
  showIdUserStatus,
  updateUserStatus,
  deleteUserStatus,
}