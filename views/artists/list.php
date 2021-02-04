<?php ob_start(); ?>
<?php include_once "views/templates/header.php" ?>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-12 my-4">
      <h1>Artists Gallery (<?= count($artists) ?>)</h1>
    </div>
    <?php foreach ($artists as $artist) { ?>
    <div class="col-lg-6">
      <div class="card border-0 mb-4">
        <div class="row no-gutters">
          <div class="col-md-4 icon-position rounded-left" style="background-image:url(https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/features/feature13/img1.jpg)"></div>
          <div class="col-md-8 card-bg">
            <div class="card-body ml-0 ml-md-3">
              <div class="linking">
                <a href="index.php?action=artistDetails&id=<?= $artist->artist_id;?>"><i class="far fa-edit"></i></a>
                <a href="index.php?action=deleteArtist&id=<?= $artist->artist_id;?>" class="delete"><i class="far fa-trash-alt"></i></a>
              </div>
              <h5><?= $artist->artist_name; ?></h5>
              <a href="index.php?action=artistDiscsList&id=<?= $artist->artist_id;?>">View Details <i class="ti-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php } ;?>
  </div>
</div>
<footer class="footer">
      <div class="container">
        <span><a href="index.php?action=newArtist"><i class="fas fa-plus-circle fa-5x"></i></a></span>
      </div>
</footer>
<?php $content = ob_get_clean(); ?>
<?php require "views/templates/template.php";?>