<?php
class piqueteModel extends Model{

    public function Index(){
        $this->query('SELECT * FROM piquetes ORDER BY nome ASC');
		$rows = $this->resultSet();
        return $rows;
    }

    public function add(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
             if($post['nome'] == '' || $post['numero'] == ''){
               Messages::setMsg('Please fill in all fields', 'error');
               return;
             }

              //Insert into MySQL
              //(`id`, `board_id`, `nome`, `numero`, `texto`)
              $this->query('INSERT INTO piquetes (zona, nome, mail, numero, texto) VALUES(:zona, :nome, :mail, :numero, :texto)');
              $this->bind(':zona', $post['zona']);
              $this->bind(':nome', $post['nome']);
              $this->bind(':mail', $post['mail']);
              $this->bind(':numero', $post['numero']);
              $this->bind(':texto', $post['texto']);
              $this->execute();
              //Verify
              if($this->lastInsertId()){
                //Redirect
                header('Location:'.ROOT_URL.'piquetes');
              }
        }
        return;
    }


    public function search(){
        return;
    }

    public function searchresult($search){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['search'] == ''){
            $this->query('SELECT * FROM piquetes');
            //$this->bind(':search', $post['search']."%");
            $rows = $this->resultSet();
            return $rows;
        }
        if($post['submit']){
            $this->query('SELECT * FROM piquetes WHERE zona LIKE :search OR nome LIKE :search ');
            $this->bind(':search', $post['search']."%");
            $rows = $this->resultSet();
            return $rows;
        }
    }


    public function edit($id){
        $sql= 'SELECT id, zona, nome, mail, numero, texto FROM piquetes WHERE id ='. $id.';';
        $this->query($sql);
        $rows = $this->resultSet();
        return $rows;
    }


    public function editsave($id){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
            if($post['nome'] == '' || $post['numero'] == ''){
                Messages::setMsg('Please fill in all fields xXx', 'error');
                return;
            }
            //Insert into MySQL
            //(`id`, `board_id`, `nome`, `numero`, `texto`)
            $this->query('UPDATE piquetes SET zona = :zona, nome = :nome, mail = :mail, numero = :numero, texto = :texto WHERE id = :id');
            $this->bind(':zona', $post['zona']);
            $this->bind(':nome', $post['nome']);
            $this->bind(':mail', $post['mail']);
            $this->bind(':numero', $post['numero']);
            $this->bind(':texto', $post['texto']);
            $this->bind(':id', $id);
            $this->execute();
            //Verify
            if($this->lastInsertId()){
                //Redirect
                header('Location:'.ROOT_URL.'piquetes');
            }
        }
        return;
    }

    public function delete($id){
        $this->query('DELETE FROM piquetes WHERE id = :id');
        $this->bind(':id', $id);
        $this->execute();
        return;
    }

}
