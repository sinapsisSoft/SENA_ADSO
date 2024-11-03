import { Entity, PrimaryGeneratedColumn, Column, ManyToMany, ManyToOne } from "typeorm";
import {Student} from "./Student"

@Entity()
export class Course{
  @PrimaryGeneratedColumn()
  id: number;
  @Column()
  name: string;

  @ManyToOne(type=> Student, student=>student.course)
  student:Student;
 
}