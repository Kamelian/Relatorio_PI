<?php
class Novidades extends Controller{

    protected function Index(){
        $viewmodel = new NovidadeModel();
        $this->returnView($viewmodel->Index(), true);
    }

    protected function add(){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'novidades');
        }
        $viewmodel = new NovidadeModel();
        $this->returnView($viewmodel->add(), true);
    }

    protected function edit($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'novidades');
        }
        $viewmodel = new NovidadeModel();
        $this->returnView($viewmodel->edit($id), true);
    }

    protected function editsave($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'novidades');
        }
        $viewmodel = new NovidadeModel();
        $this->returnView($viewmodel->editsave($id), true);
    }

    protected function delete($id){
        if(!isset($_SESSION['is_logged_in'])){
            header('Location: '.ROOT_URL.'novidades');
        }
        $viewmodel = new NovidadeModel();
        $this->returnView($viewmodel->delete($id), true);
    }

}