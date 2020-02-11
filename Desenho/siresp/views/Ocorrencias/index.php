<!-- (`id`, `board_id`, `lat`, `lng`, `sensor1`, `sensor2`, `sensor3`, `estado`, `reg_time`) -->
<!-- https://www.google.com/maps/search/?api=1&query=37.2223333,-7.4591 -->
<!-- https://www.embedgooglemap.net/ -->

<div>
    <h3>Ocorrencias</h3>
    <?php if (isset($_SESSION['is_logged_in'])) : ?>
        <a href="<?php echo ROOT_PATH; ?>ocorrencias/add" class="btn btn-success">Adicionar Ocorrencia</a>
        <a href="<?php echo ROOT_PATH; ?>ocorrencias/search" class="btn btn-success">Procurar.</a>
        <p></p>
        <?php foreach ($viewmodel[0] as $item) : ?>
            <div class="well" id="accordion">
                <table style="width:100%">
                    <tr>
                        <td>
                            <h3>Identificação: <?php echo $item['board_id']; ?></h3>
                            <h3>Estado:
                                <?php
                                switch ($item['estado']) {
                                    case 1:
                                        echo "<font color='red'> Não Resolvido </font>";
                                        break;
                                    case 2:
                                        echo "Resolvido";
                                        break;
                                }
                                ?>
                            </h3>

                            <a href="<?php echo ROOT_PATH; ?>ocorrencias/change/<?php echo $item['id']; ?>" class="btn btn-default"">Alterar</a>
                            <a href="#info<?php echo $item['id']; ?>" data-parent="#accordion" class="btn btn-default" data-toggle="collapse">Detalhes</a>
                            <a href="<?php echo ROOT_PATH; ?>ocorrencias/delete/<?php echo $item['id']; ?>" class="btn btn-danger" onclick="return confirm('Tem a certeza que deseja apagar?')">Apagar</a>
                        </td>

                    </tr>
                    <tr >
                        <td>
                            <div id="info<?php echo $item['id']; ?>" class="collapse">
                                <p>Ultima actualização: <?php echo $item['reg_time']; ?></p>
                                <p>Zona da ocorrência: <?php echo $item['zona']; ?></p>
                                <p>Localização: <?php echo $item['geo']; ?></p>
                                <p>Botão Emergência: <?php echo $item['sensor1']; ?></p>
                                <p>Detecção Queda: <?php echo $item['sensor2']; ?></p>
                                <p>Bateria: <?php echo $item['sensor3']." Volts"; ?></p>
                                <p>
                                    Numero(s) de contacto:
                                <ul style="list-style-type:none;">
                                    <li>
                                        <?php
                                        $arrayContactos =  explode(';', $item['contacto']);
                                        foreach ($arrayContactos as $itemContacto) {
                                            $arrayDadosContacto =  explode(',', $itemContacto);


                                            foreach ($arrayDadosContacto as $keyDadosContacto => $itemDadosContacto) {
                                                echo "$itemDadosContacto";
                                                if($keyDadosContacto % 2 == 0){
                                                    echo "  ";
                                                } else{
                                                    echo "<p> </p>";
                                                }
                                                ;
                                            }
                                        }
                                        ?>
                                    </li>
                                </ul>
                                </p>

                                <a href="https://www.google.com/maps/search/?api=1&query=<?php echo $item['lat']; ?>,<?php echo $item['lng']; ?>" class="btn  btn-default"">Google Maps</a>
                            </div>
                        </td>
                        <td>
                            <div id="info<?php echo $item['id']; ?>" class="collapse">
                                <div class="mapouter">
                                    <div class="gmap_canvas">
                                        <iframe width="600"
                                                height="300"
                                                style="float:right"
                                                id="gmap_canvas"
                                        <!-- src="https://maps.google.com/maps?q=<?php echo $item['lat']; ?>%2C%20<?php echo $item['lng']; ?>&t=k&z=17&ie=UTF8&iwloc=&output=embed" -->
                                        src="https://maps.google.com/maps?q=<?php echo $item['lat']; ?>%2C%20<?php echo $item['lng']; ?>"
                                        frameborder="0"
                                        scrolling="no"
                                        marginheight="0"
                                        marginwidth="0">

                                        </iframe>
                                    </div>
                                    <style>
                                        .mapouter{position:relative;text-align:right;height:300px;width:600px;}
                                        .gmap_canvas {overflow:hidden;background:none!important;height:300px;width:600px;}
                                    </style>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
