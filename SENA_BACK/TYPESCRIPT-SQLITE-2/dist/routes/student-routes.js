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
router.get('/', (req, res) => {
    res.json({ message: "Method Get" });
});
router.get('/:id', (req, res) => {
    res.json({ message: `Method Get ID: "${req.params.id}` });
});
router.post('/', (req, res) => __awaiter(void 0, void 0, void 0, function* () {
    const newStudent = yield (0, typeorm_1.getRepository)(Student_1.Student).create(req.body);
    const result = yield (0, typeorm_1.getRepository)(Student_1.Student).save(newStudent);
    res.json({ message: 'Method Post', data: result });
}));
router.put('/', (req, res) => {
    res.json({ message: "Method Put" });
});
router.delete('/', (req, res) => {
    res.json({ message: "Method Delete" });
});
exports.default = router;
