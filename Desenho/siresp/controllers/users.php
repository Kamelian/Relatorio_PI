<?php
class Users extends Controller{

  /*Resolução Ficha 5 - Criacao do método de ação "Index" que
   responde ao pedido de listagem de utilizadores*/
  protected function Index(){
   $viewmodel = new UserModel();
   $this->returnView($viewmodel->Index(), true);
  }

  protected function register(){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->register(), true);
  }

  protected function login(){
    $viewmodel = new UserModel();
    $this->returnView($viewmodel->login(), true);
  }

  protected function logout(){
    unset($_SESSION['is_logged_in']);
    unset($_SESSION['user_data']);
    session_destroy();
    //Redirect
    header('Location:'.ROOT_URL);
  }
}
