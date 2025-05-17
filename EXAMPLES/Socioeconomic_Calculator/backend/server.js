/**
 * Author:Diego Casallas
 * Date: 2025-05-16
 * Description: This is the main server file for the backend of the application.
*/
const fs = require('fs');

const getDataSalaries = JSON.parse(fs.readFileSync('./data/salaries.json', 'utf-8'));


const getSalary = 15000;
let socioeconomicClass = {};
const DaySalary = (getSalary / 30).toFixed(2);
const DailySalaryWage = getDataSalaries.metadata.salario_minimo_mensual / 30;

for (const group of getDataSalaries.clases_sociales) {
  if (getSalary >= group.min && (group.max === null || getSalary <= group.max)) {
    socioeconomicClass = { ...group, DaySalary };
    break;
  }
}

const comparativeSalary = getDataSalaries.salarios_referencia.map(ref => {
  const timesMinimumWage = (ref.salario_diario / DailySalaryWage).toFixed(2);
  const timesSalary = (ref.salario_diario / getSalary).toFixed(2);
  return {
    nombre: ref.nombre,
    salario_diario: ref.salario_diario,
    veces_salario_minimo: timesMinimumWage,
    veces_salario_usuario: timesSalary,
    tipo: ref.tipo
  };
});

const result = { class: socioeconomicClass, references: getDataSalaries.salarios_referencia, comparative:comparativeSalary };
console.log(result);

