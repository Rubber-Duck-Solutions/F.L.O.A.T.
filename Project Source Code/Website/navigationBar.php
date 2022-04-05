<?php
include './user_validation/login_validation.php'
?>
 <nav>
            <div class="personal__logo">F.L.O.A.T.</div>
            <ul class="nav__link--list">
                <li>
                    <a href="" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> Hi, <?= $_SESSION['uName']?></a>
                </li>
                <li>
                    <a href="RideList.php" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> Home</a>
                </li>
                <li>
                    <a href="logout.php" class="
                    nav__link--anchor
                    nav__link--anchor--primary
                    ">Log Out</a>
                </li>
            </ul>
</nav>