<?php
class OcorrenciaModel extends Model{
//(`id`, `board_id`, `lat`, `lng`, `sensor1`, `sensor2`, `sensor3`, `estado`, `reg_time`)

    public function Index(){
        //(`id`, `board_id`, `nome`, `numero`, `texto`)
        $rows = array();
        $this->query('SELECT * FROM ocorrencias ORDER BY estado ASC, reg_time DESC');
        $rows[0] = $this->resultSet();
        return $rows;
    }

    public function add(){
        // Sanitize POST
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

        if($post['submit']){
            if($post['board_id'] == '' || $post['estado'] == ''){
                Messages::setMsg('Please fill in all fields', 'error');
                return;
            }

            //Insert into MySQL
            //(`id`, `board_id`, `lat`, `lng`, `sensor1`, `sensor2`, `sensor3`, `estado`, `contacto`, `reg_time`)
            $this->query('INSERT INTO ocorrencias (board_id, zona, lat, lng, sensor1, sensor2, sensor3, estado, contacto) 
                                            VALUES(:board_id, :zona, :lat, :lng, :sensor1, :sensor2, :sensor3, :estado, :contacto)');
            $this->bind(':board_id', $post['board_id']);
            $this->bind(':zona', $post['zona']);
            $this->bind(':lat', $post['lat']);
            $this->bind(':lng', $post['lng']);
            $this->bind(':sensor1', $post['sensor1']);
            $this->bind(':sensor2', $post['sensor2']);
            $this->bind(':sensor3', $post['sensor3']);
            $this->bind(':estado', $post['estado']);
            $this->bind(':contacto',$post['contacto']);
            $this->execute();
            //Verify
            if($this->lastInsertId()){
                //Redirect
                header('Location:'.ROOT_URL.'ocorrencias');
            }

            // Send mail to piquetes
            $rows = array();
            $this->query('SELECT * FROM piquetes WHERE zona = :zona');
            $this->bind(':zona', $post['zona']);
            $rows[0] = $this->resultSet();
            foreach ( $rows[0] as &$row) {
                echo $row['mail'];
                echo" ";

                $to = $row['mail'];
                $subject = "Aviso Ocorrencia";
                $txt =  "Identificacao: ".$post['board_id']."\n".
                    "Zona: ".$post['zona']."\n".
                    "Localizacao: https://www.google.com/maps/search/?api=1&query=".$post['lat'].",".$post['lng']."\n".
                    "Botao: ".$post['sensor1']."\n".
                    "Queda: ".$post['sensor2']."\n".
                    "Bateria: ".$post['sensor3']."\n".
                    "Contacto(s): ".$post['contacto']."\n";
                $txt = wordwrap($txt,70);
                $headers = "From: siresp@jfaria.org";

                mail($to,$subject,$txt,$headers);
            }
        }

        return;
    }

    public function delete($id){
        $this->query('DELETE FROM ocorrencias WHERE id = :id');
        $this->bind(':id', $id);
        $this->execute();
        return;
    }

    public function change($id){
        $this->query('SELECT * FROM ocorrencias WHERE id = :id');
        $this->bind(':id', $id);
        $row_ocorrencia = $this->single();

        if ($row_ocorrencia['estado'] == '1'){
            $this->query('UPDATE ocorrencias SET estado = 2 WHERE id = :id');
            $this->bind(':id', $id);
            $this->execute();

            // Send mail to piquetes
            $rows_piquetes = array();
            $this->query('SELECT * FROM piquetes WHERE zona = :zona');
            $this->bind(':zona', $row_ocorrencia['zona']);
            $rows_piquetes[0] = $this->resultSet();
            foreach ( $rows_piquetes[0] as &$row_piquete) {
                echo $row_piquete['mail'];
                echo" ";

                $to = $row_piquete['mail'];
                $subject = "Estado Ocorrencia Alterado";
                $txt =  "Identificacao: ".$row_ocorrencia['board_id']."\n".
                    "Ocorrencia resolvida.\n".
                    "Zona: ".$row_ocorrencia['zona']."\n".
                    "Localizacao: https://www.google.com/maps/search/?api=1&query=".$row_ocorrencia['lat'].",".$row_ocorrencia['lng']."\n".
                    "Botao: ".$row_ocorrencia['sensor1']."\n".
                    "Queda: ".$row_ocorrencia['sensor2']."\n".
                    "Bateria: ".$row_ocorrencia['sensor3']."\n".
                    "Contacto(s): ".$row_ocorrencia['contacto']."\n";
                $txt = wordwrap($txt,70);
                $headers = "From: siresp@jfaria.org";

                mail($to,$subject,$txt,$headers);
            }

        } else {
            $this->query('UPDATE ocorrencias SET estado = 1 WHERE id = :id');
            $this->bind(':id', $id);
            $this->execute();
        }
        header('Location:'.ROOT_URL.'ocorrencias');
    }

    public function search(){
        return;
    }

    public function searchresult($search){
        $post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
        if($post['search'] == ''){
            $rows = array();
            $this->query('SELECT * FROM ocorrencias ORDER BY estado ASC, reg_time DESC');
            $rows[0] = $this->resultSet();
            return $rows;
        }
        if($post['submit']){
            $rows = array();
            $this->query('SELECT * FROM ocorrencias WHERE board_id LIKE :search OR zona LIKE :search ');
            //$this->query('SELECT * FROM ocorrencias ORDER BY estado ASC, reg_time DESC');
            $this->bind(':search', $post['search']."%");
            $rows[0] = $this->resultSet();
            return $rows;
        }
    }


}
