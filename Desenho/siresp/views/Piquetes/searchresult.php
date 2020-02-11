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
                <table border='1' width='50%'>
                    <tr>
                        <th  id="Zona"> Zona</th>
                        <th  id="Nome"> Nome</th>
                        <th  id="Contacto"> Numero Contacto</th>
                        <th  id="Email"> Email</th>
                    </tr>
                    <?php foreach ($viewmodel as $item) : ?>
                        <?php
                        echo '<td> '. $item['zona'].' </td>';
                        echo '<td> '. $item['nome'].' </td>';
                        echo '<td> '. $item['numero'].' </td>';
                        echo '<td> '. $item['mail'].' </td>';
                        echo "</tr>";
                        ?>

                    <?php endforeach; ?>

                </table>
            </section>
            <footer>
        </div>
    </div>
</div>