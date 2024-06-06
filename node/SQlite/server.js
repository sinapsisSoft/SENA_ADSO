const sqlite=require("sqlite3");
let sql="";
const db=new sqlite.Database('./data.db',sqlite.OPEN_READWRITE,(error)=>{
  if(error){
    console.error(error);
  }
});

// sql='CREATE TABLE IF NOT EXISTS products (id INTEGER PRIMARY KEY AUTOINCREMENT,name VARCHAR(100) NOT NULL)';

// db.run(sql,(error)=>{
//   if(error){
//     console.error(error);
//   }
// });

sql='INSERT INTO products (name) VALUES(?)';
db.run(sql,["Product 2"],(error)=>{
  if(error){
    console.error(error);
  }
});
