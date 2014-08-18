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
                <div class="col-md-2">

                </div>
                <div class="col-md-8">
                    <h1 class="text-center"> Impression Tool</h1>
                    <form role="form" onsubmit="return submitListIps()" method="post">
                        <div class="form-group">
                            <label for="ipAddress">List of Ips</label>
                            <textarea rows="8" name="ipAddress" id="ipAddress" class="form-control"><?php if (isset($_POST['ipAddress'])) echo htmlspecialchars(trim($_POST['ipAddress'])); ?></textarea>
                        </div>
                        <button type="submit" class="btn btn-default">Lookup</button>
						<button onclick="$('.export-container').show();" type="button" class="btn btn-default">Export</button>
                    </form>
                </div>
                <div class="col-md-2">

                </div>
            </div>
			<div class="row export-container" style="display: none">
				<div class="col-md-2">

                </div>
				<div class="col-md-8">
					<h3 class="text-center">Export the result</h3>
					<form role="form" method="post" onsubmit="return submitExport()">
						<div class="form-group">
							<label for="email">Email</label>
							<input type="hidden" name="ips" id="ipsExport">
							<input type="email" name="email" id="emailUser">
						</div>
						<button type="submit" class="btn btn-default">Get export by email</button>
					</form>
                </div>
				<div class="col-md-2">

                </div>
			</div>
            <div class="row">
                <div class="col-md-2">

                </div>
                <div class="col-md-8 result-container" style="display: none;">
					<h3 class="text-center"> Result</h3>
					<table class="lookup-result table">
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
						</tbody>
					</table>
					<p id="loading-data" style="display: none">Loading data...</p>
                </div>
                <div class="col-md-2">

                </div>
            </div>
        </div>
        <script>
						var active_select = '';
						var active_field;
						var ipPackages = [];
						var currentPackage = 0; //the current package of ip list
						var currentResult = 0; //number of result is on result table
						var isLookup = false; //flag of ajax Lookup
						function submitExportModal() {
							$('#ipsExportModal').val($('#ipAddress').val().trim());
							if (!validateEmail($('#emailUserModal').val())) {
								alert('Email is not correct.')
								return false;
							}
							$.ajax({
								type: 'post',
								url: '<?php echo base_url('index.php/home/ajax'); ?>',
								data: {
									'action': 'addExportJob',
									'ips': $('#ipsExportModal').val(),
									'email': $('#emailUserModal').val()
								},
								success: function(msg) {
									alert('We will send the export file to your email.');
									$('.export-container').hide();
									$('#exportForm').modal('hide');
									currentPackage = 10000;
								},
								error: function() {

								}
							});
							return false;
						}
						function validateEmail(email)
						{
							var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
							return email.match(re)
						}
						function submitExport() {
							$('#ipsExport').val($('#ipAddress').val().trim());
							var ips = $('#ipAddress').val().trim();
							ips = ips.split("\n");
							if (ips.length > 1000) {
								alert('To ensure reports are generated quickly, we must limit each report to 1000 IP addresses or less.');
								return false;
							}
							if (!validateEmail($('#emailUser').val())) {
								alert('Email is not correct.')
								return false;
							}
							$.ajax({
								type: 'post',
								url: '<?php echo base_url('index.php/home/ajax'); ?>',
								data: {
									'action': 'addExportJob',
									'ips': $('#ipsExport').val(),
									'email': $('#emailUser').val()
								},
								success: function(msg) {
									alert('We will send the export file to your email.');
									$('.export-container').hide();
									$('#exportForm').modal('hide');
									currentPackage = 10000;
								},
								error: function() {

								}
							});
							return false;
						}
						function submitListIps() {
							ipPackages = [];
							currentPackage = 0;
							currentResult = 0;
							$('.lookup-result tbody').html('');
							var ips = $('#ipAddress').val().trim();
							if (ips.length == "") {
								return false;
							}
							ips = ips.split("\n");
							if (ips.length > 1000) {
								alert('To ensure reports are generated quickly, we must limit each report to 1000 IP addresses or less.');
								return false;
							}
							$('.result-container').show();
							$('#loading-data').show();
							var itemsPerSmallerArr = 10;
							var count = 0;
							var tmpArr = [];
							//divide the list ip to small package 
							for (i = 0; i < ips.length; i++) {
								if (count < itemsPerSmallerArr)
								{
									tmpArr.push(ips[i]); //push ip to temp array
								}
								else
								{
									ipPackages.push(tmpArr); // push temp array to ipPackages
									count = 0;
									tmpArr = [];
									tmpArr.push(ips[i]);
								}
								count++;
							}
							;
							ipPackages.push(tmpArr);
							//start lookup
							ajaxLookup();
							return false;
						}
						function ajaxLookup() {
							$('#loading-data').show();
							if (!isLookup) {
								isLookup = true;
								$.ajax({
									type: 'post',
									url: '<?php echo base_url('index.php/home/ajax'); ?>',
									data: {
										'action': 'getLookup',
										'ipAddress': ipPackages[currentPackage].join('\n'),
										'currentResult': currentResult
									},
									success: function(msg) {
										$('.result-container').show();
										$('.lookup-result tbody').append(msg);
										currentResult = $('.lookup-result tr').length;
										if (currentResult > 50) {
											$('.lookup-result tr').each(function(index, element) {
												if (index + 1 > 50) {
													$(this).remove();
												}
											})
										}
										$('#loading-data').hide();
										isLookup = false;
									},
									error: function() {

									}
								});
							}
						}
						function setDataToEditBlockName(field, data) {
							return true;
						}
						function setDataToEditBlockRange(field, data) {
							return true;
						}
						function setDataToEditBlockOwner(field, data) {
							return true;
						}
						function submitEditForm(form) {
							return false;
						}
						//check user go to bottom make a new data
						$(window).scroll(function() {
							if ($(window).scrollTop() + window.innerHeight == $(document).height()) {
								currentPackage++;
								if (currentPackage >= ipPackages.length) {
									return;
								}
								if (currentResult > 50) {
									$('#exportForm').modal('show');
									return;
								}
								ajaxLookup();
							}
						});
        </script>

		<!-- export field modal -->
		<div class="modal fade" id="exportForm" tabindex="-1" role="dialog" aria-labelledby="exportForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Export the result</h4>
                    </div>
					<form role="form" method="post" onsubmit="return submitExportModal()">
						<div class="modal-body">
                            <p>To prevent abuse and limit the load on the server, please enter your email address to receive your report when we are done investigating the rest of your list</p>
                            <div class="form-group">
								<label for="email">Email</label>
								<input type="hidden" name="ips" id="ipsExportModal">
								<input type="email" name="email" id="emailUserModal">
							</div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Get export by email</button>
                        </div>
					</form>
                </div>
            </div>
        </div>
    </body>
</html>
