<?php
class NovidadeModel extends Model{

    public function Index(){
        $this->query('SELECT * FROM novidades ORDER BY create_date DESC');
        $rows = $this->resultSet();
        return $rows;
    }

    public function add(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
            if($post['title'] == '' || $post['body'] == ''){
                Messages::setMsg('Please fill in all fields', 'error');
                return;
            }

            //Insert into MySQL
            $this->query('INSERT INTO novidades (title, body, link, user_id) VALUES(:title, :body, :link, :user_id)');
            $this->bind(':title', $post['title']);
            $this->bind(':body', $post['body']);
            $this->bind(':link', $post['link']);
            $this->bind(':user_id', 1);
            $this->execute();
            //Verify
            if($this->lastInsertId()){
                //Redirect
                header('Location:'.ROOT_URL.'novidades');
            }
        }
        return;

    }

    public function edit($id){
        $sql= 'SELECT id, title, body, link FROM novidades WHERE id ='. $id.';';
        //$this->query('SELECT title, body, link FROM shares WHERE id = $id');
        $this->query($sql);
        $rows = $this->resultSet();
        return $rows;
    }


    public function editsave($id){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
            if($post['title'] == '' || $post['body'] == ''){
                Messages::setMsg('Please fill in all fields xXx', 'error');
                return;
            }
            //Insert into MySQL
            $this->query('UPDATE novidades SET title = :title, body = :body, link = :link, user_id = :user_id WHERE id = :id');
            $this->bind(':title', $post['title']);
            $this->bind(':body', $post['body']);
            $this->bind(':link', $post['link']);
            $this->bind(':user_id', 1);
            $this->bind(':id', $id);
            $this->execute();
            //Verify
            if($this->lastInsertId()){
                //Redirect
                //header('Location:'.ROOT_URL.'novidades');
            }
        }
        return;
    }

    public function delete($id){
        $this->query('DELETE FROM novidades WHERE id = :id');
        $this->bind(':id', $id);
        $this->execute();
        return;
    }

}
