"use strict";
var __awaiter = (this && this.__awaiter) || function (thisArg, _arguments, P, generator) {
    function adopt(value) { return value instanceof P ? value : new P(function (resolve) { resolve(value); }); }
    return new (P || (P = Promise))(function (resolve, reject) {
        function fulfilled(value) { try { step(generator.next(value)); } catch (e) { reject(e); } }
        function rejected(value) { try { step(generator["throw"](value)); } catch (e) { reject(e); } }
        function step(result) { result.done ? resolve(result.value) : adopt(result.value).then(fulfilled, rejected); }
        step((generator = generator.apply(thisArg, _arguments || [])).next());
    });
};
Object.defineProperty(exports, "__esModule", { value: true });
const express_1 = require("express");
const typeorm_1 = require("typeorm");
const Student_1 = require("../entities/Student");
const router = (0, express_1.Router)();
router.get('/', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const students = yield (0, typeorm_1.getRepository)(Student_1.Student).find();
    res.json({ message: 'Method Get', data: students });
}));
router.get('/:id', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const student = yield (0, typeorm_1.getRepository)(Student_1.Student).findOneBy({ id: parseInt(req.params.id, 10) });
    res.json({ message: 'Method Get Id', data: student });
}));
router.post('/', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const newStudent = yield (0, typeorm_1.getRepository)(Student_1.Student).create(req.body);
    const result = yield (0, typeorm_1.getRepository)(Student_1.Student).save(newStudent);
    res.json({ message: 'Method Post', data: result });
}));
router.put('/:id', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const student = yield (0, typeorm_1.getRepository)(Student_1.Student).findOne({ where: { id: parseInt(req.params.id, 10) } });
    if (student) {
        (0, typeorm_1.getRepository)(Student_1.Student).merge(student, req.body);
        const result = (0, typeorm_1.getRepository)(Student_1.Student).save(student);
        res.json({ message: 'Method Put', data: result });
    }
    else {
        res.json({ message: 'Student does not exist' });
    }
}));
router.delete('/:id', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    (0, typeorm_1.getRepository)(Student_1.Student).delete(req.params.id);
    res.json({ message: `Method Delete ID :${req.params.id}` });
}));
exports.default = router;
