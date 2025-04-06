class Person {

  constructor(id, document, name, age) {
    this.id = id;
    this.document = document;
    this.name = name;
    this.age = age;
  }
  getBasicInfo() {
    return {
      id: this.id,
      document: this.document,
      name: this.name,
      age: this.age
    };
  }
  greet() {
    return `Hello, my name is ${this.name} and I am ${this.age} years old.`;
  }
}
class Student extends Person {

  constructor(id, document, name, age) {
    super(id, document, name, age);
    this.course = null;
  }
  setCourse(course) {
    this.course = course;
  }
  getStudentInfo() {
    return {
      ...super.getBasicInfo(),
      course: this.course ? this.course.name : 'No course assigned',
      teacher: this.course ? this.course.teacher.name : 'No teacher assigned to course'
    };
  }
  study() {
    return `${this.name} is studying ${this.course ? ' ' + this.course.name : ''}`;
  }

}

class Teacher extends Person {

  constructor(id, document, name, age, specialty) {
    super(id, document, name, age);
    this.specialty = specialty;
  }

  getTeacherInfo() {
    return {
      ...super.getBasicInfo(),
      specialty: this.specialty,
      role: 'Teacher'
    };
  }
  teach() {
    return `${this.name} is teaching ${this.specialty}`;
  }

}
class Course {
  constructor(id, name, teacher) {
    this.id = id;
    this.name = name;
    this.teacher = teacher;
    this.students = [];
  }
  addStudent(student) {
    if (this.students.length < 10) {
      this.students.push(student);
      student.setCourse(this);
      return true;
    }
    console.log(`Course  ${this.name} is full.`);
    return false;

  }

  getCourseInfo() {
    return {
      id: this.id,
      name: this.name,
      teacher: this.teacher.name,
      students: this.students.map(s => s.name),
      studentCount: this.students.length
    };
  }
}
function generateRandomName() {
  const firstNames = ['John', 'Jane', 'Michael', 'Sarah', 'David', 'Emily'];
  const lastNames = ['Smith', 'Johnson', 'Williams', 'Jones', 'Brown', 'Davis'];
  return `${firstNames[Math.floor(Math.random() * firstNames.length)]} ${lastNames[Math.floor(Math.random() * lastNames.length)]}`;

}
function generateRandomDocument() {
  return Math.floor(100000000 + Math.random() * 9000000000).toString();
}

const teachers = [
  new Teacher(1, generateRandomDocument(), generateRandomName(), 30, 'Mathematics'),
  new Teacher(2, generateRandomDocument(), generateRandomName(), 35, 'Physics'),
  new Teacher(3, generateRandomDocument(), generateRandomName(), 40, 'Chemistry'),
  new Teacher(4, generateRandomDocument(), generateRandomName(), 45, 'Biology'),
  new Teacher(5, generateRandomDocument(), generateRandomName(), 50, 'History')
];
const courses = [
  new Course(101, 'Mathematics', teachers[0]),
  new Course(202, 'Physics', teachers[1]),
  new Course(302, 'Chemistry', teachers[2]),
  new Course(402, 'Biology', teachers[3]),
  new Course(502, 'History', teachers[4])
];
const students = [];
for (let i = 0; i <= 50; i++) {
  students.push(new Student(i, generateRandomDocument(), generateRandomName(), Math.floor(Math.random() * 10) + 18));
}
let courseIndex = 0;
students.forEach(student => {
  if (!courses[courseIndex].addStudent(student)) {
    courseIndex = (courseIndex + 1) % courses.length;
    courses[courseIndex].addStudent(student);
  }
});


console.log("\n===TABLA DE PERSONAS (Profesores)===\n");
console.table(teachers.map(t => t.getBasicInfo()));
console.log("\n===TABLA DE PERSONAS (Estudiantes)===\n");  
console.table(students.slice(0, 10).map(s => s.getBasicInfo()));
console.log("\n===TABLA DE CURSOS===\n");
console.table(courses.map(c =>({
  Id: c.id,
  Name: c.name, 
  Teacher: c.teacher.name,
  StudentCount: c.students.length,
  List: c.students.map(s => s.name).join(', ')
})));

console.log("\n===Métodos)===\n");
console.log(teachers[0].teach());
console.log(students[0].study());   


  
