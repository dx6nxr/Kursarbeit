<?php include __DIR__ . '/../header.php'; ?>
<?php
$stops = '';
foreach(json_decode($info->GetText()) as $stop){
    $stops .= $stop . ", ";
}
$stops = substr($stops, 0, -2);
?>
<br>
<h1 style="color: red;"><?= $error ?></h1>
<input type="text" value="<?= $info->GetId() ?>" name="num" id="num" readonly>
<input type="text" value="<?= $info->GetName() ?>" name="type" id="type">
<br>
<textarea rows="6" cols="50" value="" name="trip" id="trip"><?= $stops ?></textarea>
<br>
<input type="password" placeholder="Masterpass" name="pass" id="pass">
<button onclick = "f()">Submit</button>
<script>
    function f(){
        let type = document.getElementById('type').value;
        let trip = document.getElementById('trip').value;
        let pass = document.getElementById('pass').value;
        if(num != '' && type != '' && trip != '' && pass != '') {
            window.location.replace(`?name=${type}&trip=${trip}&MasterPass=${pass}`);
        }
        else{
            alert ("please fill out all forms");
        }
    }
</script>
<?php include __DIR__ . '/../footer.php'; ?>
