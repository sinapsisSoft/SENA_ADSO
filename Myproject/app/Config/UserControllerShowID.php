<?php
/**
 * Author:DIEGO CASALLAS
 * Date:13/02/2024
 * Update Date:
 * Descriptions:
 * 
 */
include_once('../Config/Config.php');
if(!empty($_GET) && isset($_GET)){
  
  $user_id=$_GET['User_id'];
  $query = "CALL sp_select_id_user(".$user_id."); ";
  $query.= "SELECT * FROM `role` ;";
  $query.= "SELECT * FROM `user_status`;";
  $data=array();

  if ( $mysqli -> multi_query($query)){
    do {
      // Store first result set
      if ($result = $mysqli -> store_result()) {

        $resultQuery = $result->fetch_all(MYSQLI_NUM);
        array_push($data, $resultQuery);
    
        $result->free();
       
      
      }
      // if there are more result-sets, the print a divider
      if ($mysqli -> more_results()) {
       // printf("-------------\n");
       
      }
       //Prepare next result set
    } while ($mysqli -> next_result());

    
  }
 
  $getDataUser=$data[0];
  $getDataRole=$data[1];
  $getDataUserStatus=$data[2];

  
  //
  

  
  //$result2->free_result();
  //$mysqli->close();
  //echo("User id GET Data Form ".$user_id);
  //var_dump($datarole);
  //header('Location: http://localhost/SENA/SENA_ADSO/Myproject/app/Views/user/user.html');
}

?>
<?php include('../Views/assets/css/css.php'); ?>
<div class="container-fluid">
            <div class="row">
                <div class="col-6 mx-auto">
   <form id="form_login" action="../../app/Config/UserControllerUpdate.php" method="POST" onsubmit="//getData(this.id,event)">
   <input type="hidden" value="<?=$user_id?>" id="User_id" name="User_id">                         
   <div class="container-fluid">
                                <div class="row">
                                    <div class="mb-3 col-6">
                                        <label for="User_user"
                                            class="form-label">Email
                                            address</label>
                                        <input type="email"
                                            class="form-control input_disabled"
                                            maxlength="50" minlength="10"
                                            name="User_user"
                                            id="User_user"value="<?=$getDataUser[0][1] ?>"
                                            aria-describedby="emailHelp" disabled>

                                    </div>
                    
                                    <div class="mb-3  col-3">
                                        <label for="Role_id"
                                            class="form-label">Rol</label>
                                        <select class="form-select"
                                            aria-label="Default select example"
                                            name="Role_id" id="Role_id" disabled>
                                            <option >Open this select
                                                menu</option>
                                              <?php
                                                for($i=0;$i<count($getDataRole);$i++){
                                               
                                                if($getDataUser[0][5]==$getDataUserStatus[$i][0]){
                                                    echo('<option selected value="'.$getDataRole[$i][0].'">'.$getDataRole[$i][1].'</option>');
                                                }else{
                                                    echo('<option value="'.$getDataRole[$i][0].'">'.$getDataRole[$i][1].'</option>');
                                                }
                                                }
                                              ?>                          
                                            

                                        </select>
                                    </div>
                                    <div class="mb-3  col-3">
                                        <label for="User_status_id"
                                            class="form-label">Estado</label>
                                        <select class="form-select"
                                            aria-label="Default select example"
                                            name="User_status_id" id="User_status_id" disabled>
                                            <option>Open this select
                                                menu</option>
                                              <?php
                                                for($i=0;$i<count($getDataUserStatus);$i++){
                                                    if($getDataUser[0][3]==$getDataUserStatus[$i][0]){
                                                        echo('<option selected value="'.$getDataUserStatus[$i][0].'">'.$getDataUserStatus[$i][1].'</option>');
                                                    }else{
                                                        echo('<option value="'.$getDataUserStatus[$i][0].'">'.$getDataUserStatus[$i][1].'</option>');
                                                    }
                                                }
                                              ?> 

                                        </select>
                                    </div>
                                </div>
                            </div>
                   
                        </form>
                </div></div></div>