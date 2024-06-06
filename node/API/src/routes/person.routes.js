import { Router } from "express";
import {showPerson,showPersonId,createPerson,updatePerson,deletePerson} from '../controllers/person.controller.js';

const router =Router();


router.post('/person',createPerson);
router.get('/person',showPerson);
router.get('/person/:id',showPersonId);
router.put('/person/:id',updatePerson);
router.delete('/person/:id',deletePerson);



export default router;