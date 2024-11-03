import { Router,Request,Response } from "express";
import { getRepository } from "typeorm";
import { Student } from "../entities/Student";

const router=Router();

router.get('/',(req:Request,res:Response)=>{
  res.json({message:"Method Get"});
})

router.get('/:id',(req:Request,res:Response)=>{
  res.json({message:`Method Get ID: "${req.params.id}`});
})

router.post('/',async (req:Request,res:Response)=>{

  const newStudent = await getRepository(Student).create(req.body);
  const result = await getRepository(Student).save(newStudent);
  res.json({ message: 'Method Post', data: result });
})

router.put('/',(req:Request,res:Response)=>{
  res.json({message:"Method Put"});
})

router.delete('/',(req:Request,res:Response)=>{
  res.json({message:"Method Delete"});
})

export default router;