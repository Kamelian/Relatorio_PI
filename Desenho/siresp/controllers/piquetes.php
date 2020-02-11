<?php
class Piquetes extends Controller{
  protected function Index(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'home');
    }
    $viewmodel = new PiqueteModel();
    $this->returnView($viewmodel->Index(), true);
  }

  protected function add(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'home');
    }
      $viewmodel = new PiqueteModel();
      $this->returnView($viewmodel->add(), true);
  }

    protected function search(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new PiqueteModel();
        $this->returnView($viewmodel->search(), true);
    }

    protected function searchresult($search){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new PiqueteModel();
        $this->returnView($viewmodel->searchresult($search), true);
    }

    protected function edit($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new PiqueteModel();
        $this->returnView($viewmodel->edit($id), true);
    }

    protected function editsave($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new PiqueteModel();
        $this->returnView($viewmodel->editsave($id), true);
    }

    protected function delete($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'novidades');
        }
        $viewmodel = new PiqueteModel();
        $this->returnView($viewmodel->delete($id), true);
    }
}
