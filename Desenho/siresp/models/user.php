<?php
class UserModel extends Model{

    /*Resolução Ficha 5 - Criacao do método "Index" no modelo User que
    solicita à base dados os campos name e email de todos os utilizadores*/
    public function Index(){
        $this->query('SELECT name, email FROM users');
        $rows = $this->resultSet();
        return $rows;
    }

    public function register(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post!==null) {
            $password = md5($post['password']);

            if($post['submit']){
                if($post['name'] == '' || $post['email'] == '' || $post['password'] == ''){
                    Messages::setMsg('Please fill in all fields', 'error');
                    return;
                }
                //Insert into MySQL
                $this->query('INSERT INTO users (name, email, password) VALUES(:name, :email, :password)');
                $this->bind(':name', $post['name']);
                $this->bind(':email', $post['email']);
                $this->bind(':password', $password);
                $this->execute();
                //Verify
                if($this->lastInsertId()){
                    //Redirect
                    header('Location:'.ROOT_URL.'users/login');
                }
            }
        }

        return;
    }

    public function login(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if ($post!==null) {
            $password = md5($post['password']);

            if($post['submit']){
                if($post['email'] == '' || $post['password'] == ''){
                    Messages::setMsg('Please fill in all fields', 'error');
                    return;
                }
                //Compare login
                $this->query('SELECT * FROM users WHERE email = :email AND password = :password');
                $this->bind(':email', $post['email']);
                $this->bind(':password', md5($post['password']));

                $row = $this->single();

                if($row){

                    $_SESSION['is_logged_in'] = true;
                    $_SESSION['user_data'] = array(
                        "id"    => $row['id'],
                        "name"  => $row['name'],
                        "email" => $row['email']
                    );
                    header('Location:'.ROOT_URL.'Novidades');

                }else{
                    //$_SESSION['is_logged_in'] = false;
                    Messages::setMsg('Incorrect Login', 'error');
                }
            }
        }
        return;
    }
}
