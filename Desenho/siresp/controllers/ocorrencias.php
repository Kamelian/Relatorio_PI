<?php
class Ocorrencias extends Controller{
  protected function Index(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'home');
    }
    $viewmodel = new OcorrenciaModel();
    $this->returnView($viewmodel->Index(), true);
  }
  protected function add(){
    if(!isset($_SESSION['is_logged_in'])){
      header('Location: '.ROOT_URL.'home');
    }
    $viewmodel = new OcorrenciaModel();
    $this->returnView($viewmodel->add(), true);
  }

    protected function delete($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new OcorrenciaModel();
        $this->returnView($viewmodel->delete($id), true);
    }

    protected function change($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new OcorrenciaModel();
        $this->returnView($viewmodel->change($id), true);
    }

    protected function search(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new OcorrenciaModel();
        $this->returnView($viewmodel->search(), true);
    }

    protected function searchresult($search){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'home');
        }
        $viewmodel = new OcorrenciaModel();
        $this->returnView($viewmodel->searchresult($search), true);
    }

}
