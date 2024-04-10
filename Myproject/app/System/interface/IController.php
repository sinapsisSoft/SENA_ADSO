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
 /* These lines of code define the methods that must be implemented by any class that implements the
 `IController` interface. The methods include `create()`, `update()`, `delete()`, `index()`,
 `show()`, `showId()`, and `getDataModel()`. By defining these methods in the interface, it enforces
 that any class implementing this interface must provide implementations for these methods. This
 helps in standardizing the behavior of classes that use this interface. */
  public function create();
  public function update();
  public function delete();
  public function index();
  public function show();
  public function showId();
  public function getDataModel();
}
