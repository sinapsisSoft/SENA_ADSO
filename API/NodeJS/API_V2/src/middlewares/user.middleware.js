export default (schema)=>{
  return async(req, res,next)=>{
    try{
        await schema.validateAsync(req.body);
        next(); 
    }catch(err){
      res.send(err.message);
    }
  }
}