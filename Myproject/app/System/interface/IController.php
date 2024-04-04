<?php

namespace App\System\interface;
/**
 * Author:DIEGO CASALLAS
 * Date:27/02/2024
 * Update Date:
 * Descriptions:This interface are mandatory methods to apply in the classes that use it
 * 
 */
interface IController
{
//This methods 
  public function create();
  public function update();
  public function edit();
  public function delete();
  public function show();
  public function showId();
  public function getDataModel(int $id);
}
