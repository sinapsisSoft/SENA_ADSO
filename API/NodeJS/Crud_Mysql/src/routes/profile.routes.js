/**
*Author: 	DIEGO CASALLAS
*Date:		03/26/2025  
*Description:	Index file for the API - NODEJS
**/
import {Router} from 'express';

const router=Router();
const apiName='/api_v1/profile';

router.get(apiName,(req,res)=>res.send("GET profile API"));//GET
router.get(apiName+'/:id',(req,res)=>res.send("GET profile API FOR ID "+req.params.id));//GET ID
router.post(apiName,(req,res)=>res.send("POST profile API "));//POST 
router.put(apiName+'/:id',(req,res)=>res.send("PUT profile API FOR ID "+req.params.id));//PUT ID
router.delete(apiName+'/:id',(req,res)=>res.send("DELETE profile API FOR ID "+req.params.id));//DELETE ID
export default router;