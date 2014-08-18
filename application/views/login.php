<!DOCTYPE html>
<html lang="en">
    <head>
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/libs/bootstrap/css/bootstrap.min.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/libs/bootstrap/css/bootstrap-theme.min.css') ?>" />
        <link type="text/css" rel="stylesheet" href="<?php echo base_url('public/css/style.css') ?>" />
        <script src="<?php echo base_url('public/libs/jquery/jquery.js') ?>"></script>
        <script src="<?php echo base_url('public/libs/bootstrap/js/bootstrap.min.js') ?>"></script>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-md-4">

                </div>
                <div class="col-md-4">
					<?php if ($message != ''): ?>
						<div class="alert alert-warning">
							<?php echo $message; ?>
						</div>
					<?php endif; ?>
                    <h3 class="text-center">Login to use as Admin</h3>
                    <form role="form" method="post" action="<?php echo base_url('index.php/login/check'); ?>">
                        <div class="form-group">
                            <label for="ipAddress">Username</label>
                            <input class="form-control" type="text" name="username">
                        </div>
						<div class="form-group">
                            <label for="ipAddress">Password</label>
                            <input class="form-control" type="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-default">Login</button>
                    </form>
                </div>
                <div class="col-md-4">

                </div>
            </div>
		</div>

    </body>
</html>
