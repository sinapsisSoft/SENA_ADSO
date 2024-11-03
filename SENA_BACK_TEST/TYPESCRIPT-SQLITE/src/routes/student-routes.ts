import { Router,Request,Response } from "express";

const router=Router();

router.get('/',(req:Request,res:Response)=>{
  res.json({message:'Method Get'});
})
router.get('/:id',(req:Request,res:Response)=>{
  res.json({message:`Method Get ID : ${req.params.id}`});
})
router.post('/',(req:Request,res:Response)=>{
  res.json({message:'Method Post'});
})
router.put('/',(req:Request,res:Response)=>{
  res.json({message:'Method Put'});
})

router.delete('/',(req:Request,res:Response)=>{
  res.json({message:'Method Delete'});
})

export default router;