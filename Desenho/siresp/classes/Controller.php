<?php
abstract class Controller{
  protected $request;
  protected $action;

  public function __construct($action, $request){
    $this->action=$action;
    $this->request=$request;
  }
  public function executeAction(){
      /*Resolução Ficha 5 - deteçao da passagem do parametro "id"
      do URL para passar ao método de ação respetivo           */
      if(isset($this->request['id'])){
          //$this->id = '';
          //echo $this->request['id'];
          return $this->{$this->action}($this->request['id']);
      }else{
          //echo $this->request['id'];
          return $this->{$this->action}();
      }
    //return $this->{$this->action}();
  }

  protected function returnView($viewmodel, $fullview){
    $view = 'views/'. get_class($this). '/' . $this->action. '.php';
    if($fullview){
      require('views/main.php');
    }else{
      require($view);
    }
  }
}
