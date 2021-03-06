<?php ob_start(); ?>
<?php require "views/templates/header.php";?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="card border-0 my-auto mx-4">
            <div class="row no-gutters">
                <div class="col-md-4 icon-position rounded-left" style="background-image:url(assets/img/<?= $discDetails->disc_picture ?>)"></div>
                <div class="col-md-8">
                    <div class="card-body ml-0 ml-md-3">
                        <form action="index.php?action=updateDisc&id=<?= $discDetails->disc_id;?>" class="row" method="post" enctype="multipart/form-data">
				            			<div class="col-md-6 form-group">
					            			<label for="title">Title</label>
					            			<input type="text" name="title" class="form-control" value="<?= $_POST["title"] ?? $discDetails->disc_title; ?>" required="required">
					            			<span class="error"><?= $errors["title"] ?? "" ?></span>
				            			</div>
				            			<div class="col-md-6 form-group">
					            			<label for="artistName">Artist</label>
														<select name="artistName" class="custom-select">
															<?php foreach ($artists as $artist) { ?>
																<option value="<?= $artist->artist_id?>"<?php if ($artist->artist_id == $discDetails->artist_id) {echo "selected";}; ?>><?= $artist->artist_name; ?></option>
															<?php }; ?>
														</select>
														<span class="error"><?= $errors["artistName"] ?? "" ?></span>
				            			</div>
				            			<div class="col-md-6 form-group">
					            			<label for="label">Label</label>
					            			<input type="text" name="label" class="form-control" value="<?= $_POST["label"] ?? $discDetails->disc_label; ?>" required="required">
					            			<span class="error"><?= $errors["label"] ?? "" ?></span>
				            			</div>
				            			<div class="col-md-6 form-group">
					            			<label for="year">Year</label>
					            			<input type="text" name="year" class="form-control" value="<?= $_POST["year"] ?? $discDetails->disc_year; ?>" required="required">
					            			<span class="error"><?= $errors["year"] ?? "" ?></span>
				            			</div>
				           			 	<div class="col-md-6 form-group">
				                		<label for="genre">Genre</label>
					            			<input type="text" name="genre" class="form-control" value="<?= $_POST["genre"] ?? $discDetails->disc_genre; ?>" required="required">
					            			<span class="error"><?= $errors["genre"] ?? "" ?></span>
                          </div>
                          <div class="col-md-6 form-group">
					            			<label for="price">Price</label>
					            			<input type="text" name="price" class="form-control" value="<?= $_POST["price"] ?? $discDetails->disc_price; ?>" required="required">
					            			<span class="error"><?= $errors["price"] ?? "" ?></span>
				            			</div>
													<div class="col-sm-6 mt-4 custom-file">
														<input type="file" class="custom-file-input" name="picture" id="customFile">
														<label for="picture" class="custom-file-label">Choose file</label>
														<span class="error"><?= $errors["image"] ?? "" ?></span>
													</div>
													<div class="col-sm-6 mt-4 form-group">
														<input type="submit" class="btn btn-primary btn-block" value="Edit">
													</div>
			            			</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean(); ?>
<?php require "views/templates/template.php";?>



