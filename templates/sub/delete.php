<?php include __DIR__ . '/../header.php'; ?>
<h1 style="color: red;"><?= $error ?></h1>
<input type="password" placeholder="Masterpass" name="pass" id="pass">
<button onclick = "f()">Submit</button>
<script>
    function f(){
        let pass = document.getElementById('pass').value;
        if(pass != '') {
            window.location.replace(`?MasterPass=${pass}`);
        }
        else{
            alert ("please fill out all forms");
        }
    }
</script>
<?php include __DIR__ . '/../footer.php'; ?>
