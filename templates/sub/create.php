<?php include __DIR__ . '/../header.php'; ?>
<h1 style="color: red;"><?= $error ?></h1>
<input type="text" placeholder="Number" value="<?= $num ?>" name="num" id="num" required>
<input type="text" placeholder="Type" value="<?= $name ?>" name="type" id="type" required><br>
<input rows="6" cols="50" placeholder="Trip" value="<?= $trip ?>" name="trip" id="trip" required></input>
<br>
<input type="password" placeholder="Masterpass" name="pass" id="pass">
<button onclick = "f()">Submit</button>
<script>
    function f(){
        let num = document.getElementById('num').value;
        let type = document.getElementById('type').value;
        let trip = document.getElementById('trip').value;
        let pass = document.getElementById('pass').value;
    if(num != '' && type != '' && trip != '' && pass != '') {
        window.location.replace(`/www/add?id=${num}&name=${type}&trip=${trip}&MasterPass=${pass}`);
    }
    else{
        alert ("please fill out all forms");
    }
    }
</script>
<?php include __DIR__ . '/../footer.php'; ?>