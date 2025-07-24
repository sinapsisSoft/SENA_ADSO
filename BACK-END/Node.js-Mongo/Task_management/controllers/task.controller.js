/*
  author: Diego Casallas
  date: 14/07/2025  
  description: Backend application using Node.js and MongoDB.
  version: 1.0.0    
  license: MIT License
*/
import TaskModel from '../models/task.model.js';// Import the user model
import { mongoose } from '../config/db/connection.js'; // Import mongoose from the connection

class TaskController {
    // Create a new task
    async addTask(req, res) {
        try {
            const {
                userId,
                title,
                description,
                type,
                priority,
                color,
                dateStart,
                dateEnd,
                notificationEmail,
                assignees,
                createdBy,
                tags
            } = req.body;

            // Validate required fields
            if (!userId) {
                return res.status(400).json({ error: 'User ID is required' });
            }

            //Vailidate required fields
            if (!title || !type || !dateStart || !dateEnd) {
                return res.status(400).json({ error: 'Title, type, start date, and end date are required' });
            }

            // Convert date strings to Date objects
            const startDate = new Date(dateStart);
            const endDate = new Date(dateEnd);
            if (isNaN(startDate) || isNaN(endDate)) {
                return res.status(400).json({ error: 'Invalid date format' });
            }
            if (endDate < startDate) {
                return res.status(400).json({ error: 'End date must be after start date' });
            }
            // Create a new task        
            const newTasks = new TaskModel({
                title,
                description,
                type,
                priority,
                color,
                startDate,
                endDate,
                notificationEmail,
                assignees: Array.isArray(assignees)
                    ? assignees.map(assignee => ({
                        name: assignee.name,
                        email: assignee.email,
                        role: assignee.role,
                        userId: assignee.userId // Do not convert to ObjectId here
                    }))
                    : [],
                projectId: req.body.projectId ? new mongoose.Types.ObjectId(req.body.projectId) : null, // Convert to ObjectId if provided
                createdBy: createdBy || userId, // Use userId if createdBy is not provided
                tags: Array.isArray(tags) ? tags.map(tag => tag.name) : []
            });

            const savedTasks = await newTasks.save();
            // Optional: Send notification by email
            if (notificationEmail) {
                //  Here you would integrate the emailController
                // emailController.sendNotificationEmail(notificationEmail, savedTasks);
            }
            // Return the saved task as a response  
            res.status(201).json({ "data": savedTasks });
        } catch (error) {
            res.status(400).json({
                error: error.message,
                details: error.errors
            });
        }
    };

    //show all tasks
    async getTaskId(req, res) {
        try {
            const task = await TaskModel.findById(req.params.id);
            if (!task) {
                return res.status(404).json({ error: 'Task not found' });
            }

            res.status(200).json(task);
        } catch (error) {
            res.status(500).json({ error: 'Error in get task details' });
        }
    };

    //show all tasks
    async getTasks(req, res) {
        try {
            const tasks = await TaskModel.find();
            if (!tasks || tasks.length === 0) {
                return res.status(404).json({ error: 'No tasks found' });
            }
            res.status(200).json(tasks);
        } catch (error) {
            res.status(500).json({ error: 'Error in get task details' });
        }
    };

    // Update a task add array of managers
    async updateTask(req, res) {
        try {
            const updates = req.body;

            // Convert date strings to Date objects
            if (updates.dateStart) updates.dateStart = new Date(updates.dateStart);
            if (updates.dateEnd) updates.dateEnd = new Date(updates.dateEnd);

            // Convert ids in managers to ObjectId
            if (updates.managers) {
                updates.managers = updates.managers.map(inCharge => ({
                    ...inCharge,
                    userId: new mongoose.Types.ObjectId(inCharge.userId)
                }));
            }

            const updateTask = await TaskModel.findByIdAndUpdate(
                req.params.id,
                { $set: updates },
                { new: true, runValidators: true }
            );

            res.status(200).json(updateTask);
        } catch (error) {
            res.status(400).json({
                error: error.message,
                details: error.errors
            });
        }
    };

    //Add comment to a task
    async addComment(req, res) {
        try {
            const { userId, name, text } = req.body;
            // Validate required fields
            if (!userId || !name || !text) {        
                return res.status(400).json({ error: 'User ID, name, and text are required' });
            }           
            // Find the task and add the comment
            const task = await TaskModel.findById(req.params.id);

            if (!task) {
                return res.status(404).json({ error: 'Task not found' });   
            }
            // Check if the comment already exists
            const existingComment = task.comments.find(comment => comment.userId.toString() === userId && comment.text === text);
            if (existingComment) {
                return res.status(400).json({ error: 'Comment already exists' });
            }
            // Add the comment
            task.comments.push({
                userId: userId,
                name: name,
                text: text,
                date: new Date()
            });     
            // Save the updated task    
            await task.save();

            // Return the updated task
            res.status(200).json(task);
        } catch (error) {
            res.status(400).json({ error: error.message });
        }
    };
   
    // Add file to a task
    async addFile(req, res) {
        try {
            // Assuming multer uploaded the file and we have the info in req.file
            const { name, extension, type, size, url } =req.body;
            if (!name || !extension || !type || !size || !url) {
                return res.status(400).json({ error: 'File information is incomplete' });
            }
            const task = await TaskModel.findByIdAndUpdate(
                req.params.id,
                {
                    $push: {
                        files: {
                            name: name,
                            url: url,
                            type: type,
                            extension: extension,
                            size: size
                        }
                    }
                },
                { new: true }
            );

            res.status(200).json(task);
        } catch (error) {
            res.status(400).json({ error: error.message });
        }
    };
}

export default new TaskController();