<?php
$sql = "SELECT * FROM users";
$query = mysqli_query($conn, $sql);
while ($user = mysqli_fetch_assoc($query)) {
?>
    <article class="style1">
        <span class="image">
            <img src="images/pic01.jpg" alt="" />
        </span>
        <a href="generic.html">
            <h2>
                <?= $user['usersName'] ?>
            </h2>
            <p><?= $user['usersUid'] ?></p>
            <div class="content">
                <p><?= $user['usersEmail'] ?>.</p>
            </div>
        </a>
    </article>
<?php  } ?>