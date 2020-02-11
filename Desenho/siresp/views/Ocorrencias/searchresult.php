<?php
// Joao Miguel Guedes Faria
// 16145
?>

<div class="panel panel-default">
    <div class="panel-body">
        <div >
            <h4 class="panel-title">Resultado Pesquisa</h4>
        </div>
        <p> </p>
        <div class="well">
            <section>
                <p>
                <table border='1' width='75%'>
                    <tr>
                        <th  id="Board_id"> Board_id</th>
                        <th  id="Estado"> Estado</th>
                        <th  id="Data"> Data</th>
                        <th  id="Zona"> Zona</th>
                        <th  id="Sensor 1"> Sensor 1</th>
                        <th  id="Sensor 2"> Sensor 2</th>
                    </tr>
                    <?php foreach ($viewmodel[0] as $item) : ?>
                        <?php
                        echo '<td> '. $item['board_id'].' </td>';
                        echo '<td> '. $item['estado'].' </td>';
                        echo '<td> '. $item['reg_time'].' </td>';
                        echo '<td> '. $item['zona'].' </td>';
                        echo '<td> '. $item['sensor1'].' </td>';
                        echo '<td> '. $item['sensor2'].' </td>';
                        echo "</tr>";
                        ?>
                    <?php endforeach; ?>
                </table>
            </section>
            <footer>
        </div>
    </div>
