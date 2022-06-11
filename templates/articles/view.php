<?php include __DIR__ . '/../header.php'; ?>
    <h1><?= $transport->getName() . " " . $transport->getId()  ?></h1>
    <!--<p><?/*= $transport->getText() */?></p>-->
<p class="trip"><strong>

                    <?= json_decode($transport->GetText(), true)['stop1'] . ' > ' .
                    json_decode($transport->GetText(), true)[count((array)json_decode($transport->GetText()))] ?>

                </strong></p>
        </li>
        <?php $stops = json_decode($transport->GetText(), true) ?>
        <ul class="path_list list">
            <?php foreach ($stops as $stop): ?>
                <li class="path_list_item"> <?= $stop ?></li>
            <?php endforeach; ?>
        </ul>
    <script type="text/javascript">
        $(document).on('click', '.list > li ', function () {
            $(this).next('ul').slideToggle("slow", function (){});
        })
    </script>
<?php include __DIR__ . '/../footer.php'; ?>

