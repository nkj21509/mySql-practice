<?php 
    include("login.php");

    session_start();

    include("connection.php");

    $query = "SELECT * FROM login WHERE id='".$_SESSION['id']."' LIMIT 1";

    $result = mysqli_query($link, $query);

    $row = mysqli_fetch_array($result);

    $diary = $row['diary'];
?>

<ul>
    <li>
        <a href="index.php?logout=1">Logout</a>
    </li>
</ul>

<form method="post">
    <textarea name="diary" id="" cols="30" rows="10"><?php echo $diary; ?></textarea>
</form>

<!-- jQuery -->
<script
  src="https://code.jquery.com/jquery-3.5.1.min.js"
  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
  crossorigin="anonymous"></script>
<script>
    $('textarea').keyup(function() {
        $.post('updatediary.php', { diary:$('textarea').val() });
    })
</script>