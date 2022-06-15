<?php include __DIR__ . '/../header.php'; ?>
<?= !empty($user) ? 'Привет, ' . $user->getRole() . " - " . $user->getNickname() : 'Войдите на сайт' ?>
<ul id="menu" class="list">
    <?php foreach ($transports as $transport): ?>

        <li class="li-trip-title">

            <h2 class="transport-number"><img style="width: 4%" src="<?= "/www/img/" . $transport->GetName() . "-img.png" ?>"/>

                <a <a href="/www/routes/<?= $transport->GetId() ?>"><?= $transport->GetId() ?></a>

            </h2>
            <p class="trip"><strong>

                    <?= json_decode($transport->GetText(), true)[0] . ' > ' .
                    json_decode($transport->GetText(), true)[count((array)json_decode($transport->GetText()))-1] ?>

                </strong></p>
        </li>
        <?php $stops = json_decode($transport->GetText(), true) ?>
        <ul class="path_list list">
            <?php foreach ($stops as $stop): ?>
                <li class="path_list_item"> <?= $stop ?></li>
            <?php endforeach; ?>
        </ul>


        <hr>
    <?php endforeach; ?>
    <script type="text/javascript">
        $(document).on('click', '.list > li ', function () {
            $(this).next('ul').slideToggle("slow", function (){});
        })
    </script>
</ul>
<?php //var_dump($transports[0]->type); ?>
<?php include __DIR__ . '/../footer.php'; ?>

