<?php

/*

*/

$servername = "localhost";

// REPLACE with your Database name
$dbname = "siresp";
// REPLACE with Database user
$username = "siresp";
// REPLACE with Database user password
$password = "Siresp123!";

$board_id = $zona = $lat = $lng = $geo = $sensor1 = $sensor2 = $sensor3 = $estado = $contacto ="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $board_id = test_input($_POST["board_id"]);
    $zona = test_input($_POST["zona"]);
    $lat = test_input($_POST["lat"]);
    $lng = test_input($_POST["lng"]);
    $geo = test_input($_POST["geo"]);
    $sensor1 = test_input($_POST["sensor1"]);
    $sensor2 = test_input($_POST["sensor2"]);
    $sensor3 = test_input($_POST["sensor3"]);
    $estado = test_input($_POST["estado"]);
    $contacto = test_input($_POST["contacto"]);

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO ocorrencias (board_id, zona, lat, lng, geo, sensor1, sensor2, sensor3, estado, contacto)
        VALUES ('" . $board_id . "', '" . $zona . "', '" . $lat . "', '" . $lng . "', '" . $geo . "','" . $sensor1 . "','" . $sensor2 . "','" . $sensor3 . "', '" . $estado . "', '" . $contacto . "')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    }
    else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }


    $sql = "SELECT * FROM piquetes WHERE zona = ".$zona;

    //$this->query('SELECT * FROM piquetes WHERE zona = :zona');
    //$this->bind(':zona', $post['zona']);

    if ($result = $conn->query($sql)) {
        while ($row = $result->fetch_assoc()) {
            $row_mail = $row["mail"];
            echo $row_mail;
            echo" ";

            $to = $row_mail;
            $subject = "Aviso Ocorrencia";
            $txt =  "Identificacao: ".$board_id."\n".
                "Zona: ".$_POST["zona"]."\n".
                "Localizacao: https://www.google.com/maps/search/?api=1&query=".$lat.",".$lng."\n".
                "fonte dados posição: ".$_POST["geo"]."\n".
                "Botao: ".$_POST["sensor1"]."\n".
                "Queda: ".$_POST["sensor2"]."\n".
                "Bateria: ".$_POST["sensor3"]."\n".
                "Contacto(s): ".$_POST["contacto"]."\n";
            $txt = wordwrap($txt,70);
            $headers = "From: siresp@jfaria.org";

            mail($to,$subject,$txt,$headers);

        }
        $result->free();
    }


    $conn->close();


}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
