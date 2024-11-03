import { Router, Request, Response } from "express";
import { getRepository } from "typeorm";
import { Student } from '../entities/Student';
const router = Router();

router.get('/', async (req: Request, res: Response) => {
  const students = await getRepository(Student).find();
  res.json({ message: 'Method Get', data: students });
});

router.get('/:id', async(req: Request, res: Response) => {
  const student =await getRepository(Student).findOneBy({ id: parseInt(req.params.id, 10) });
  res.json({ message: 'Method Get Id', data: student });
});

router.post('/', async (req: Request, res: Response) => {
  const newStudent = await getRepository(Student).create(req.body);
  const result = await getRepository(Student).save(newStudent);
  res.json({ message: 'Method Post', data: result });
});

router.put('/:id', async(req: Request, res: Response) => {
  const student =await getRepository(Student).findOne({ where:{ id: parseInt(req.params.id, 10) }});
  if(student){
    getRepository(Student).merge(student,req.body);
    const result = getRepository(Student).save(student);
    res.json({ message: 'Method Put', data: result });
    
  }else{
    res.json({ message: 'Student does not exist' });
  }
 
});

router.delete('/:id', async(req: Request, res: Response) => {
  getRepository(Student).delete(req.params.id);
  res.json({ message: `Method Delete ID :${req.params.id}` });
});

export default router;
