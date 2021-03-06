<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>F.L.O.A.T</title>
    <link rel="stylesheet" href="./styles.css">
    <script src="https://kit.fontawesome.com/c8e4d183c2.js" crossorigin="anonymous"></script>
</head>
<body>
    <section id="about-me">
        <nav>
            <div class="personal__logo">F.L.O.A.T.</div>
            <ul class="nav__link--list">
                <li>
                    <a href="" class="
                    nav__link--anchor
                    link__hover-effect
                    link__hover-effect--black
                    "> <?= $_SESSION['uName']?></a>
                </li>
                <li>
                    <a href="logout.php" class="
                    nav__link--anchor
                    nav__link--anchor--primary
                    ">Log Out</a>
                </li>
            </ul>
        </nav>

        <div class="
                    flex
                    flex-1">
            <div class="about-me__info row">
              <div class="about-me__info--container">
                  
                  <p class="about-me__info--para">
                        Summary of patrol yeet
                  </p>
               </div>
               <figure class="about-me__img--container">
                   <iframe src="https://www.google.com/maps/d/embed?mid=13RqbSgcUj1SQBNrck1AwzzMjPGVmBKEu&ehbc=2E312F" width="640" height="480"></iframe>

               </figure>
               <figure class="about-me__img--container">
		 <iframe src="https://docs.google.com/spreadsheets/d/e/2PACX-1vR8UDHJy7DnHEVCk_58Xu2_i-i4HK9muFWmXI5yfANK1JQHR-dQfQv1g8c3C7OK-pnFikP56WigcJid/pubhtml?gid=0&amp;single=true&amp;widget=true&amp;headers=false"></iframe>

	       </figure>
            </div>
        </div>
    </section>
</body>
</html>