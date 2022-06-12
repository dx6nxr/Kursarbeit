<?php include __DIR__ . '/../header.php'; ?>
<input type="text" placeholder="Number" name="num" id="num" required>
<input type="text" placeholder="Type" name="type" id="type" required><br>
<textarea rows="6" cols="50" placeholder="Trip" name="trip" id="trip" required></textarea>
<button onclick = "f()">Submit</button>
<script>
    function f(){
        let num = document.getElementById('num').value;
        let type = document.getElementById('type').value;
        let trip = document.getElementById('trip').value;
    if(num != '' && type != '' && trip != '') {
        window.location.replace(`/www/add?id=${num}&name=${type}&trip=${trip}`);
    }
    else{
        alert ("please fill out all forms");
    }
    }
</script>
<?php include __DIR__ . '/../footer.php'; ?>