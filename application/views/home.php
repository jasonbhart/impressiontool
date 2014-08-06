<!DOCTYPE html>
<html lang="en">
	<head>
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('public/libs/bootstrap/css/bootstrap.min.css') ?>" />
		<link type="text/css" rel="stylesheet" href="<?php echo base_url('public/libs/bootstrap/css/bootstrap-theme.min.css') ?>" />
		<script src="<?php echo base_url('public/libs/bootstrap/js/bootstrap.min.js') ?>"></script>
	</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
					<h1 class="text-center"> Impression Tool</h1>
					<form role="form" method="post">
						<div class="form-group">
							<label for="ipAddress">List of Ips</label>
							<textarea rows="8" name="ipAddress"class="form-control">

							</textarea>
						</div>
						<button type="submit" class="btn btn-default">Submit</button>
					</form>
				</div>
				<div class="col-md-2">

				</div>
			</div>
			<div class="row">
				<div class="col-md-2">

				</div>
				<div class="col-md-8">
					<?php if (count($resultWhois) > 0): ?>
						<h3 class="text-center"> Result</h3>
						<table class="table table-hover">
							<thead>
								<tr>
									<th>#</th>
									<th>Ip</th>
									<th>IP block name</th>
									<th>IP block range</th>
									<th>IP block owner</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($resultWhois as $index => $whois): ?>
									<tr>
										<td><?php echo ($index+1); ?></td>
										<td><?php echo $whois['ip']; ?></td>
										<td><?php echo $whois['ip_block_name']; ?></td>
										<td><?php echo $whois['ip_block_range']; ?></td>
										<td><?php echo $whois['ip_block_owner']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					<?php endif; ?>
				</div>
				<div class="col-md-2">

				</div>
			</div>
		</div>
	</body>
</html>