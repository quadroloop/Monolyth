<?php
$c1 = file_get_contents('count.h');
$count = (int)$c1;
echo $count;
?>
<html>
<head>
<script>
var pg1 = <?php echo $count; ?>;
localStorage.setItem('pg',pg1);
</script>
</head>
</html>