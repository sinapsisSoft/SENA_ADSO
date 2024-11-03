import { Entity, PrimaryGeneratedColumn, Column, OneToMany } from "typeorm";
import {Course} from "./Course"

@Entity()
export class Student {
  @PrimaryGeneratedColumn()
  id: number;
  @Column()
  firsName: string;
  @Column()
  lastName: string;
  @Column()
  document: number;

  @OneToMany(type=> Course, course=>course.student,{eager:true,cascade:true})
  course:Course[];
}