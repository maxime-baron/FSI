<?php
session_start();
if(isset($_SESSION['username'])){
      $username = $_SESSION['username'];
      $groupe = $_SESSION['groupe'];
}

try{
      $bdd = new PDO('mysql:host=localhost;dbname=cinema','root','');
}
catch(Exception $e){
      die('Erreur de connexion : '.$e->getMessage());
}
if($groupe == "user"){
      $req = $bdd -> prepare('SELECT titre,annee,resume,Image,username FROM cinema.film INNER JOIN noter ON noter.Film_idFilm= film.idFilm INNER JOIN internaute ON noter.Internaute_idInternaute=internaute.idInternaute and internaute.username = :user');
      $req->execute(array('user' => $username)) or die(print_r($req->errorInfo()));
      $donnee = $req->fetchAll(PDO::FETCH_ASSOC);
      $req->closeCursor();
}
?>
<html lang="fr">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <!-- FONTS -->
      <link href="http://fonts.cdnfonts.com/css/kernel-panic-nbp" rel="stylesheet">
      <!-- CSS -->
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" type="text/css" href="./styles/reset.css"/>
      <link rel="stylesheet" type="text/css" href="./styles/style.css">
      <link rel="stylesheet" type="text/css" href="./styles/header.css">
      <link rel="stylesheet" type="text/css" href="./styles/profil.css">
      <title>FSI - <?php echo($username); ?></title>
</head>
<body>
      <header>
            <div class="titre glitch-title" data-text="FILMSTREAMINGILLEGAL">FILMSTREAMINGILLEGAL</div>
            <div class="end-div"></div>
            <div class="div-boutton">
                  <div class="oblique-profil">
                        <a class="profile" href="profil.php">
                              <svg  buttonsHeader account" width="32" height="32" viewBox="0 0 41 41" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M41 20.4795C41 9.17375 31.816 0 20.5 0C9.184 0 0 9.17375 0 20.4795C0 26.7064 2.829 32.3182 7.257 36.0851C7.298 36.1261 7.339 36.1261 7.339 36.1671C7.708 36.4541 8.077 36.7411 8.487 37.0281C8.692 37.1511 8.856 37.3126 9.061 37.4766C12.4488 39.7735 16.4479 41.0009 20.541 41C24.6341 41.0009 28.6332 39.7735 32.021 37.4766C32.226 37.3536 32.39 37.1921 32.595 37.0666C32.964 36.7821 33.374 36.4951 33.743 36.2081C33.784 36.1671 33.825 36.1671 33.825 36.1261C38.171 32.3157 41 26.7064 41 20.4795ZM20.5 38.4196C16.646 38.4196 13.12 37.1896 10.209 35.1421C10.25 34.8141 10.332 34.4887 10.414 34.1607C10.6583 33.2718 11.0166 32.4182 11.48 31.6213C11.931 30.8423 12.464 30.1453 13.12 29.5303C13.735 28.9153 14.473 28.3438 15.211 27.8928C15.99 27.4418 16.81 27.1138 17.712 26.8678C18.621 26.6228 19.5585 26.4996 20.5 26.5014C23.2948 26.4816 25.9869 27.5536 28.003 29.4893C28.946 30.4323 29.684 31.5393 30.217 32.8077C30.504 33.5457 30.709 34.3247 30.832 35.1421C27.8061 37.2694 24.1988 38.4137 20.5 38.4196ZM14.227 19.4571C13.8657 18.6299 13.6841 17.7356 13.694 16.8331C13.694 15.9336 13.858 15.0316 14.227 14.2116C14.596 13.3916 15.088 12.6562 15.703 12.0412C16.318 11.4262 17.056 10.9368 17.876 10.5677C18.696 10.1988 19.598 10.0347 20.5 10.0347C21.443 10.0347 22.304 10.1988 23.124 10.5677C23.944 10.9368 24.682 11.4288 25.297 12.0412C25.912 12.6562 26.404 13.3942 26.773 14.2116C27.142 15.0316 27.306 15.9336 27.306 16.8331C27.306 17.7761 27.142 18.6371 26.773 19.4545C26.4169 20.2624 25.9167 20.9987 25.297 21.6275C24.668 22.2463 23.9317 22.7456 23.124 23.1009C21.4297 23.7972 19.5293 23.7972 17.835 23.1009C17.0273 22.7456 16.291 22.2463 15.662 21.6275C15.0414 21.0079 14.5532 20.2686 14.227 19.4545V19.4571ZM33.251 33.0537C33.251 32.9717 33.21 32.9307 33.21 32.8487C32.8068 31.5659 32.2124 30.3513 31.447 29.2458C30.6809 28.1321 29.7393 27.1499 28.659 26.3374C27.8339 25.7167 26.9396 25.1939 25.994 24.7794C26.4242 24.4956 26.8228 24.1665 27.183 23.7979C27.7943 23.1945 28.3311 22.52 28.782 21.7889C29.69 20.2971 30.159 18.5794 30.135 16.8331C30.1477 15.5403 29.8966 14.2586 29.397 13.0662C28.9038 11.9173 28.1938 10.8741 27.306 9.99375C26.4195 9.12258 25.3761 8.42701 24.231 7.94375C23.0366 7.44507 21.7532 7.19484 20.459 7.20831C19.1646 7.19565 17.8812 7.44676 16.687 7.94631C15.532 8.42854 14.4861 9.13886 13.612 10.0347C12.7409 10.9203 12.0453 11.9628 11.562 13.1072C11.0624 14.2996 10.8113 15.5813 10.824 16.8741C10.824 17.7761 10.947 18.6371 11.193 19.4545C11.439 20.3155 11.767 21.0945 12.218 21.8299C12.628 22.5679 13.202 23.2239 13.817 23.8389C14.186 24.2079 14.596 24.5334 15.047 24.8204C14.0985 25.2459 13.2038 25.7827 12.382 26.4194C11.316 27.2394 10.373 28.2208 9.594 29.2868C8.82079 30.3877 8.22583 31.6036 7.831 32.8897C7.79 32.9717 7.79 33.0537 7.79 33.0947C4.551 29.8172 2.542 25.3944 2.542 20.4795C2.542 10.6088 10.619 2.53944 20.5 2.53944C30.381 2.53944 38.458 10.6088 38.458 20.4795C38.4526 25.1944 36.5805 29.7153 33.251 33.0537Z" fill="#49F300"/>
                              </svg>
                        </a>
                        <div class="Obliques">
                              <span class="oblique"></span>
                              <span class="oblique"></span>
                        </div>
                  </div>
                  <div class="bouttons">
                        <button class="boutton glitch slide">Fiction</button>
                        <button class="boutton glitch slide">Comedie</button>
                        <button class="boutton glitch slide">Drame</button>
                        <button class="boutton glitch slide">Action</button>
                  </div>
            </div>
      </header>
      <div class="content">
            <h2><?php echo($username); ?></h2>
            <div class="lesNote">
            <?php 
            if($groupe == "user"){
                  foreach($donnee as $note){
                        echo '
                        <div class="film">
                              <img src="';
                        echo($note['Image']);
                        echo'" width="70" height="105">
                              <div class="note-content">
                                    <div class="titreFilm"><h4>';
                        echo ($note["titre"]);
                        echo'</h4></div>
                                    <div class="note-commentaire">
                                          <div class="commentaire"></div>
                                          <div class="note">
                                                <span class="laNote">10</span>
                                                <span class="surDix">/10</span>
                                          </div>
                                    </div>
                              </div>
                        </div>
                        ';
                  }
            }elseif($groupe == "admin"){
                  echo '
                        <select class="action-select">
                              <option value="">Choisir une action</option>
                              <option value="add">Ajouter un film</option>
                              <option value="addA">Ajouter un artiste</option>
                              <option value="del">Supprimer un film</option>
                              <!-- <option value="">Choisir une action</option> -->
                        </select>
                        <form id="formADD" method="post"></form>
                  ';
            }
            ?>

                  <!-- <div class="film">
                        <img src="./assets/images/arcane.jpg" width="70" height="105">
                        <div class="note-content">
                              <div class="titreFilm"><h4>Titre</h4></div>
                              <div class="note-commentaire">
                                    <div class="commentaire">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!</div>
                                    <div class="note">
                                          <span class="laNote">10</span>
                                          <span class="surDix">/10</span>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <div class="film">
                        <img src="./assets/images/arcane.jpg" width="70" height="105">
                        <div class="note-content">
                              <div class="titreFilm"><h4>Titre</h4></div>
                              <div class="note-commentaire">
                                    <div class="commentaire">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aliquid nulla maiores quaerat neque reiciendis architecto voluptatum magnam ab numquam. Expedita labore ad suscipit consectetur porro optio, amet tempore magni veritatis!</div>
                                    <div class="note">
                                          <span class="laNote">10</span>
                                          <span class="surDix">/10</span>
                                    </div>
                              </div>
                        </div>
                  </div> -->
            </div>
      </div>
      <script type="text/javascript" src="./assets/js/admin.js"></script>
</body>
</html>