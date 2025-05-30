import DocumentTypeModel from '../models/documentType.model.js';

class DocumentTypeController {

  async register(req, res) {
    try {
      const { name, description } = req.body;
      // Basic validate
      if (!name || !description ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Create the new document type
      const DocumentTypeModelId = await DocumentTypeModel.create({
        name,
        description
      });
      res.status(201).json({ 
        message: 'Document type created successfully',
        data:DocumentTypeModelId 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }

  async show(req, res) {
    try {
      // Verify if the document type already exists
      const existingDocumentTypeModel = await DocumentTypeModel.show();
      if (!existingDocumentTypeModel) {
        return res.status(409).json({ error: 'The document type no already exists' });
      }
      res.status(201).json({ 
        message: 'Document type successfully',
        data:existingDocumentTypeModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
  
  async update(req, res) {
    try {
      const { name, description} = req.body;
      const id = req.params.id;  
      // Basic validate
      if (!name || !description || !id) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the document type already exists
      const updateDocumentTypeModel = await DocumentTypeModel.update(id,{name,description});
      if (!updateDocumentTypeModel) {
        return res.status(409).json({ error: 'The document type already exists' });
      }
      res.status(201).json({ 
        message: 'Document type update successfully',
        data:updateDocumentTypeModel 
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
      // Verify if the document type already exists
      const deleteDocumentTypeModel = await DocumentTypeModel.delete(id);
      if (!deleteDocumentTypeModel) {
        return res.status(409).json({ error: 'The document type already exists' });
      }
      res.status(201).json({ 
        message: 'Document type delete successfully',
        data:deleteDocumentTypeModel 
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
      if (!id ) {
        return res.status(400).json({ error: 'Required fields are missing' });
      }
      // Verify if the document type already exists
      const existingDocumentTypeModel = await DocumentTypeModel.findById(id);
      if (!existingDocumentTypeModel) {
        return res.status(409).json({ error: 'The document type No already exists' });
      }
      res.status(201).json({ 
        message: 'Document type successfully',
        data:existingDocumentTypeModel 
      });
    } catch (error) {
      console.error('Error in registration:', error);
      res.status(500).json({ error: 'Internal Server Error' });
    }
  }
}
export default new DocumentTypeController();