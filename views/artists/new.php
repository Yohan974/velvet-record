<?php ob_start(); ?>
<?php require "views/templates/header.php";?>
<div class="container-fluid">
    <div class="row h-100">
        <div class="card border-0 my-auto mx-5 w-100">
            <div class="row no-gutters">
                <div class="col-md-4 icon-position rounded-left" style="background-image:url(https://www.wrappixel.com/demos/ui-kit/wrapkit/assets/images/features/feature13/img1.jpg)"></div>
                <div class="col-md-8">
                    <div class="card-body ml-0 ml-md-3">
                        <form action="index.php?action=createArtist" class="row" method="post">
				            			<div class="col-12 form-group">
					            			<label for="name">Name</label>
					            			<input type="text" name="name" class="form-control" value="" required="required">
					            			<span class="error"><?= $errors["name"] ?? "" ?></span>
				            			</div>
													<div class="col-12 mt-4 form-group">
														<input type="submit" class="btn btn-primary btn-block" value="Add a new artist">
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