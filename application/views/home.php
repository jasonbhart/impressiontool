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
                    <form role="form" method="post">
                        <div class="form-group">
                            <label for="ipAddress">List of Ips</label>
                            <textarea rows="8" name="ipAddress" class="form-control"><?php if (isset($_POST['ipAddress'])) echo htmlspecialchars(trim($_POST['ipAddress'])); ?></textarea>
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
								<?php foreach ($resultWhois as $index => $whois): ?>
									<?php if ($whois['whois_status'] == -1) $class = 'notwhois'; ?>
									<?php if ($whois['whois_status'] == 1) $class = 'black'; ?>
									<?php if ($whois['whois_status'] == 0) $class = 'white'; ?>
									<tr class="<?php echo $class; ?> tr_<?php echo $index; ?>"> 
										<td><?php echo ($index + 1); ?></td>
										<td><?php echo $whois['ip']; ?></td>
										<td onclick="setDataToEditBlockName(this, '<?php echo $whois['ip_block_name']; ?>')" data-toggle="modal" data-target="#addToListBlockName"><?php echo $whois['ip_block_name']; ?></td>
										<td onclick="setDataToEditBlockRange(this, '<?php echo $whois['ip_block_range']; ?>')" data-toggle="modal" data-target="#addToListBlockRange"><?php echo $whois['ip_block_range']; ?></td>
										<td onclick="setDataToEditBlockOwner(this, '<?php echo $whois['ip_block_owner']; ?>')" data-toggle="modal" data-target="#addToListBlockOwner"><?php echo $whois['ip_block_owner']; ?></td>
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
        <script>
											var active_select = '';
											var active_field;
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

        </script>
        <!-- Modal -->
        <div class="modal fade" id="addToList" tabindex="-1" role="dialog" aria-labelledby="addToListBlockName" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Whois</h4>
                    </div>
                    <form onsubmit="return submitEditForm(this)" role="form" method="post" action="<?php echo base_url('index.php/home/ajax'); ?>">
                        <div class="modal-body">
                            <p> Choose a list</p>
                            <input type="hidden" name="whois" id="whois">
                            <input type="hidden" name="action" value="editWhois">
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
    </body>
</html>
