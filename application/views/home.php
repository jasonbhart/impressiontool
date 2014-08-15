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
						function submitExport() {
							$('#ipsExport').val($('#ipAddress').val().trim());
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
												if (index+1 > 50) {
													$(this).remove();
												}
											})
											$('#exportForm').modal('show');
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
							$('#ip-block-name').val(data);
							active_select = 'blockname-status';
							active_field = field;
						}
						function setDataToEditBlockRange(field, data) {
							$('#ip-block-range').val(data);
							active_select = 'blockrange-status';
							active_field = field;
						}
						function setDataToEditBlockOwner(field, data) {
							$('#ip-block-owner').val(data);
							active_select = 'blockowner-status';
							active_field = field;
						}
						function submitEditForm(form) {
							$.ajax({
								type: $(form).attr('method'),
								url: $(form).attr('action'),
								data: $(form).serialize(),
								success: function(msg) {
									if (msg == 1) {
										var list_class;
										if ($('.' + active_select + ' :selected').val() == 1) {
											list_class = 'black';
										}
										;
										if ($('.' + active_select + ' :selected').val() == 0) {
											list_class = 'white';
										}
										;
										$(active_field).removeClass('black');
										$(active_field).removeClass('white');
										$(active_field).removeClass('notwhois');
										$(active_field).addClass(list_class);
										$('.modal').modal('hide');
									}
									else {
										alert('error');
									}
								},
								error: function() {



								}
							});
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
        <!-- Modal -->
        <div class="modal fade" id="addToListBlockName" tabindex="-1" role="dialog" aria-labelledby="addToListBlockName" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ip block name</h4>
                    </div>
                    <form onsubmit="return submitEditForm(this)" role="form" method="post" action="<?php echo base_url('index.php/home/ajax'); ?>">
                        <div class="modal-body">
                            <p> Choose list for the ip block name</p>
                            <input type="hidden" name="ip_block_name" id="ip-block-name">
                            <input type="hidden" name="action" value="editBlockName">
                            <div class="form-group">

                                <select name="status" class="form-control blockname-status">
                                    <option value="1">Black List</option>
                                    <option value="0">White List</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addToListBlockRange" tabindex="-1" role="dialog" aria-labelledby="addToListBlockRange" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ip block range</h4>
                    </div>
                    <form onsubmit="return submitEditForm(this)"  role="form" method="post" action="<?php echo base_url('index.php/home/ajax'); ?>">
                        <div class="modal-body">
                            <p> Choose list for the ip block range</p>
                            <input type="hidden" name="ip_block_range" id="ip-block-range">
                            <input type="hidden" name="action" value="editBlockRange">
                            <div class="form-group">
                                <select name="status" class="form-control blockrange-status">
                                    <option value="1">Black List</option>
                                    <option value="0">White List</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addToListBlockOwner" tabindex="-1" role="dialog" aria-labelledby="addToListBlockOwner" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Ip block owner</h4>
                    </div>
                    <form onsubmit="return submitEditForm(this)"  role="form" method="post" action="<?php echo base_url('index.php/home/ajax'); ?>">
                        <div class="modal-body">
                            <p> Choose list for the ip block owner</p>
                            <input type="hidden" name="ip_block_owner" id="ip-block-owner">
                            <input type="hidden" name="action" value="editBlockOwner">
                            <div class="form-group">
                                <select name="status" class="form-control blockowner-status">

                                    <option value="1">Black List</option>
                                    <option value="0">White List</option>
                                </select>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

		<!-- export field modal -->
		<div class="modal fade" id="exportForm" tabindex="-1" role="dialog" aria-labelledby="exportForm" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Export the result</h4>
                    </div>
					<form role="form" method="post" onsubmit="return submitExport()">
						<div class="modal-body">
                            <p>To prevent abuse and limit the load on the server, please enter your email address to receive your report when we are done investigating the rest of your list</p>
                            <div class="form-group">
								<label for="email">Email</label>
								<input type="hidden" name="ips" id="ipsExport">
								<input type="email" name="email" id="emailUser">
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
