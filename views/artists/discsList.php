<?php ob_start(); ?>
<?php include_once "views/templates/header.php" ?>
<div class="container">
  <div class="row">
    <div class="col-12 my-4">
      <h1>Discography (<?= count($artistDiscsList) ?>)</h1>
    </div>
    <?php foreach ($artistDiscsList as $disc) { ?>
    <div class="col-lg-6">
      <div class="card border-0 mb-4">
        <div class="row no-gutters">
          <div class="col-md-4 icon-position rounded-left" style="background-image:url(assets/img/<?= $disc->disc_picture ?>)"></div>
          <div class="col-md-8 card-bg">
            <div class="card-body ml-0 ml-md-3">
              <div class="linking">
                <a href="index.php?action=discDetails&id=<?= $disc->disc_id;?>"><i class="far fa-edit"></i></a>
                <a href="index.php?action=deleteDisc&id=<?= $disc->disc_id;?>"><i class="far fa-trash-alt"></i></a>
              </div>
              <h5><?= $disc->disc_title; ?></h5>
              <h6>(<?= $disc->artist_name; ?>)</h6>
              <p>Year: <?= $disc->disc_year ?> 
              <br>Label: <?= $disc->disc_label ?>
              <br>Genre: <?= $disc->disc_genre ?>
              <br>Price: <?= $disc->disc_price ?>€</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ;?>
  </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require "views/templates/template.php";?>
