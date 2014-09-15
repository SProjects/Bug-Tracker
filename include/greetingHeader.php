<?php include_once "./header.php"; ?>
<nav class="ui fixed top transparent inverted main menu">
    <div class="container">
        <h3 class="ui header left floated item blue">Bug Tracking System</h3>
        <?php if(isset($_SESSION['SESS_USER_ID'])){?>
        <span class="ui icon input right floated item small">
                Welcome: <?php echo $_SESSION['SESS_USER_NAME']; ?> |
                <a href="logout.php" class="linked"><i class="sign out icon" title="Log Out"></i></a>
        </span>
        <?php } ?>
    </div>
</nav>