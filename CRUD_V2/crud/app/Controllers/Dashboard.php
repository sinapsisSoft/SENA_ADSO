<?php

/**
 * Author:DIEGO CASALLAS
 * Date:23/05/2024
 * Descriptions:This is controller class for managing dashboard
 * **/
//Is file namespace   
namespace App\Controllers;
//These are the class that will be used in this controller
use App\Models\DashboardModel;
use App\Models\RoleModulesModel;
use App\Models\ProfileModel;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\Message;
use CodeIgniter\HTTP\ResponseInterface;
use Exception;

//This is the user class
class Dashboard extends Controller
{
  //Variable declarations. 
  private $dashboardModel;
  private $profileModel;
  private $roleModuleModel;
  private $data;

  //This method is the constructor
  public function __construct()
  {
    $this->dashboardModel = new DashboardModel();
    $this->profileModel = new ProfileModel();
    $this->roleModuleModel = new RoleModulesModel();
    $this->data = [];
  }
  //This method is the index, Started the view, set parameters for send the data in the view of the html render  
  public function index()
  {
    $this->data['title'] = "DASHBOARD";
    $this->data['profile'] =  $this->profileModel->where('User_id_fk', (int)$this->getSessionIdUser()['User_id'])->first();
    $this->data['userModules'] =  $this->roleModuleModel->sp_role_modules_id((int)$this->getSessionIdUser()['Roles_fk']);
    return view('dashboard/dashboard_view', $this->data);
  }

}
