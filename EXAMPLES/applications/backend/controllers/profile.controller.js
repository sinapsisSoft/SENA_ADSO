import ProfileModel from '../models/profile.model.js';


class ProfileController {

  async register(req, res) {
    try {
      const {userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate} = req.body;
      // Basic validation
      if (!userId || !first_name || !last_name || !address||!phone || !documentTypeId || !documentNumber || !photoUrl || !birthDate) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
     
      const profileId = await ProfileModel.create({
        userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate
      });
      res.status(201).json({
        message: 'Profile created successfully',
        id: profileId
      });
    } catch (error) {
      console.error('Registration error:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the Profile already exists
      const profileModel = await ProfileModel.show();
      if (!profileModel) {
        return res.status(409).json({ error: 'The Profile no already exists' });
      }
      res.status(201).json({
        message: 'Profile successfully',
        data: profileModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async update(req, res) {
    try {
      const { userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate} = req.body;
      const id = req.params.id;
      // Basic validate
      if (!userId || !first_name || !last_name || !address||!phone || !documentTypeId || !documentNumber || !photoUrl || !birthDate) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }

      const updateProfileModel = await ProfileModel.update(id, { userId, first_name, last_name, address, phone, documentTypeId, documentNumber, photoUrl, birthDate});
      res.status(201).json({
        message: 'Profile update successfully',
        data: updateProfileModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async delete(req, res) {
    try {
      const id = req.params.id;
      // Basic validate
      if (!id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the Profile already exists
      const deleteProfileModel = await ProfileModel.delete(id);
      res.status(201).json({
        message: 'Profile delete successfully',
        data: deleteProfileModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async findById(req, res) {
    try {
      const id = req.params.id;
      // Basic validate
      if (!id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the Profile already exists
      const existingProfileModel = await ProfileModel.findById(id);
      if (!existingProfileModel) {
        return res.status(409).json({ error: 'The Profile No already exists' });
      }
      res.status(201).json({
        message: 'Profile successfully',
        data: existingProfileModel
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

}

export default new ProfileController();