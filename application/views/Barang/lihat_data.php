<style type="text/css">
	table,
	th,
	tr,
	td {
		text-align: center;
	}

	.swal2-popup {
		font-family: inherit;
		font-size: 1.2rem;
	}

	.btn-group,
	.btn-group-vertical {
		position: relative;
		display: initial;
		vertical-align: middle;
	}
	.horizontal-buttons {
		display: flex;
		gap: 5px; /* Jarak antar tombol */
	}

	.horizontal-buttons a {
		display: inline-block;
	}

</style>
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-success">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-check"></i>Berhasil</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } ?>
<?php $akses_user = $this->session->userdata('akses'); ?>
<section class="content">
	<?php  if ($akses_user == 1) : ?>
		<div class="container">
			<header class="d-flex justify-content-center py-3">
			<ul class="nav nav-pills">
				<li class="nav-item <?= uri_string() === 'barang/index' ? 'active' : '' ?>">
					<a href="<?= base_url('barang/index') ?>" class="nav-link">Data Pesanan</a>
				</li>
				<li class="nav-item <?= uri_string() === 'barang/index_pembayaran' ? 'active' : '' ?>">
					<a href="<?= base_url('barang/index_pembayaran') ?>" class="nav-link">Pembayaran</a>
				</li>
				<li class="nav-item <?= uri_string() === 'barang/index_offline' ? 'active' : '' ?>">
					<a href="<?= base_url('barang/index_offline') ?>" class="nav-link">Sudah dibayar</a>
				</li>
				<li class="nav-item <?= uri_string() === 'barang/index_produksi' ? 'active' : '' ?>">
					<a href="<?= base_url('barang/index_produksi') ?>" class="nav-link">Siap Produksi</a>
				</li>
			</ul>
			</header>
		</div>
	<?php  endif; ?>
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class='box-header with-border'>
					<h3 class='box-title'>Data Pemesanan</h3>
					<div class="pull-right">
						<?php
						echo anchor('barang/post', 'Tambah data', array('class' => 'btn btn-success'))
						?>
					</div>
				</div>
				<?php 
				
				if ($akses_user == 1) { ?>
					<div class="box-body">
						<table id="myTable" class="table table-bordered table-hover ">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pemesanan</th>
									<th>Kategori Pemesanan</th>
									<th>Ukuran</th>
									<th>Harga</th>
									<th>Foto</th>
									<th>catatan</th>
									<th>Progres</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0;
								foreach ($record as $r) { ?>
								<tr>
									<td><?php echo ++$no; ?></td>
									<td><?php echo $r->nama_barang; ?></td>
									<td><?php echo $r->nama_kategori; ?></td>
									<td><?php echo $r->nama_ukuran; ?></td>
									<td>Rp.<?php echo number_format($r->harga); ?></td>
									<td>
										<a href="<?php echo (site_url('uploads/' . $r->foto)); ?>" class="image-link">
											<img src="<?php echo (site_url('uploads/' . $r->foto)); ?>" alt="" style="width:30px;height:30px">
										</a>
									</td>
									<td><?php echo $r->catatan; ?></td>
									<td><span class="badge text-bg-primary"><?php echo $r->progres; ?></span></td>
									<td class="horizontal-buttons">
										<?php echo anchor(site_url('barang/edit/' . $r->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'Edit', 'class' => 'btn btn-sm btn-warning')); ?>
										<?php if ($r->progres == 'Berhasil' || !empty($r->foto_payment)): ?>
											<?php echo anchor(site_url('barang/struck/' . $r->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Struk', array('title' => 'Struk', 'class' => 'btn btn-sm btn-primary')); ?>                                
										<?php endif; ?>
										<?php echo anchor(site_url('barang/hapus/' . $r->id_barang), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="Delete" class="btn btn-sm btn-danger"'); ?>
									</td>

								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				<?php } else { ?>
					<div class="box-body">
						<table id="myTable" class="table table-bordered table-hover ">
							<thead>
								<tr>
									<th>No</th>
									<th>Nama Pemesanan</th>
									<th>Kategori Pemesanan</th>
									<th>Ukuran</th>
									<th>Harga</th>
									<th>Jumlah</th>
									<th>Total</th>
									<th>Foto</th>
									<th>catatan</th>
									<th>Progres</th>
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
								<?php $no = 0;
								foreach ($user as $u) { ?>
								<tr>
									<td><?php echo ++$no; ?></td>
									<td><?php echo $u->nama_barang; ?></td>
									<td><?php echo $u->nama_kategori; ?></td>
									<td><?php echo $u->nama_ukuran; ?></td>
									<td>Rp.<?php echo number_format($u->harga); ?></td>
									<th><?= $u->jumlah_barang; ?></th>
									<?php $total = $u->harga * $u->jumlah_barang ?>
									<th><?= number_format($total); ?></th>
									<td>
										<a href="<?php echo (site_url('uploads/' . $u->foto)); ?>" class="image-link">
											<img src="<?php echo (site_url('uploads/' . $u->foto)); ?>" alt="" style="width:30px;height:30px">
										</a>
									</td>
									<td><?php echo $u->catatan; ?></td>
									<td><span class="badge text-bg-primary"><?php echo $u->progres; ?></span></td>
									<td>
										<?php if ($u->progres == 'Pembayaran'): ?>
											<?php if (!empty($u->foto_payment)) : ?>						
												<?php echo anchor(site_url('barang/struck/' . $u->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Struk', array('title' => 'Struk', 'class' => 'btn btn-sm btn-primary')); ?>								
											<?php	else : ?>
												<div class="box-body">
													<button type="button" class="btn btn-success" data-toggle="modal" id="" data-target="#modal-<?= $u->id_barang; ?>">
														<i class="fa fa-fw fa-credit-card"></i>Pembayaran
													</button>
												</div>
											<?php endif; ?>
										<?php else: ?>
											<?php echo anchor(site_url('barang/edit/' . $u->id_barang), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'Edit', 'class' => 'btn btn-sm btn-warning')); ?>
											&nbsp;
											<?php echo anchor(site_url('barang/hapus/' . $u->id_barang), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="Delete" class="btn btn-sm btn-danger"'); ?>
										<?php endif; ?>
									</td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<?php foreach ($user as $u) : ?>
						<!-- <div class="modal fade" id="modal-default" hidden> -->
						<div class="modal fade" id="modal-<?= $u->id_barang; ?>" hidden>
							<form method="post" enctype="multipart/form-data" action="<?= site_url('barang/pembayaran') ?>">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
												<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title">Default Modal</h4>
										</div>
										<div class="modal-body">
											<div class="row" id="rek">
												<div class="col-xs-6">
													<div class="form-group">
														<label for="note">Bank</label><br>
														<label for=""style="margin-bottom: 5px;"> <img src="<?= base_url(); ?>assets/dist/img/bank/mandiri.png" alt=""> &emsp; 087265765678 </label><br>
														<label for=""style="margin-bottom: 5px;"><img src="<?= base_url(); ?>assets/dist/img/bank/bni.png" alt=""> &emsp; 087265765678</label><br>
														<label for=""style="margin-bottom: 5px;"><img src="<?= base_url(); ?>assets/dist/img/bank/bca.png" alt=""> &emsp; 087265765678</label><br>
														<div id="byjson"></div>
													</div>
												</div>
												<div class="col-xs-6">
													<div class="form-group">
														<label for="note"></label><br>
														<label for=""><img src="<?= base_url(); ?>assets/dist/img/bank/bri.png" alt=""> &emsp; 087265765678</label><br>
														<label for=""><img src="<?= base_url(); ?>assets/dist/img/bank/niaga.png" alt=""> &emsp; 087265765678</label><br>
													</div>
												</div>
												<input type="hidden" name="id_barang" value="<?= $u->id_barang; ?>">
												<input type="hidden" name="harga" value="<?= $u->harga; ?>">
												<!-- id detail pembayaran  -->
												<input type="hidden" name="id" value="<?= $nota + 1; ?>">
												<div class="col-xs-12">
													<div class="form-group">
														<td>
															<a href="<?php echo (site_url('uploads/' . $u->foto_payment)); ?>" class="image-link">
																<img src="<?php echo (site_url('uploads/' . $u->foto_payment)); ?>" alt="" style="width: 100px;height: 100px;">
															</a>
														</td></BR>
														<label for="foto" class="control-label">Foto</label>
														<div class="input-group">
															<input type="file" name="foto_payment" class="form-control" required>
															<span class="input-group-addon">
																<span class="fa fa-photo"></span>
															</span>
														</div>
														<div class="help-block with-errors"></div>
													</div>
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
											<button type="submit" name="submit" class="btn btn-primary">Save changes</button>
										</div>
									</div>
								</div>
							</form>
						</div>
					<?php endforeach; ?>
				<?php } ?>

				
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<!-- <script>
	$(document).ready(function() {
		$('#myTable').DataTable({

			dom: 'Blfrtip',
			buttons: [{
					extend: 'csvHtml5',
					exportOptions: {
						columns: [0, 1, 2, 3, 4, ],
					},
				},
				{
					extend: 'excelHtml5',
					title: 'DATA BARANG',
					exportOptions: {
						columns: [0, 1, 2, 3, 4],
					},
				},
				{
					extend: 'copyHtml5',
					title: 'Data Barang',
					exportOptions: {
						columns: [0, 1, 2, 3, 4],
					},
				},
				{
					extend: 'pdfHtml5',
					oriented: 'portrait',
					pageSize: 'legal',
					title: 'Data Barang',
					download: 'open',
					exportOptions: {
						columns: [0, 1, 2, 3, 4],
					},
					customize: function(doc) {
						doc.content[1].table.widths = Array(doc.content[1].table.body[0].length + 1).join('*').split('');
						doc.styles.tableBodyEven.alignment = 'center';
						doc.styles.tableBodyOdd.alignment = 'center';
					},
				},
				{
					extend: 'print',
					oriented: 'portrait',
					pageSize: 'A4',
					title: 'Data Barang',
					exportOptions: {
						columns: [0, 1, 2, 3, 4],
					},
				},
			],
			"fnDrawCallback": function() {
				$('.image-link').magnificPopup({
					type: 'image',
					closeOnContentClick: true,
					closeBtnInside: false,
					fixedContentPos: true,
					image: {
						verticalFit: true
					},
					zoom: {
						enabled: true,
						duration: 300 // don't foget to change the duration also in CSS
					},
				});
			}
		});
	});
</script> -->
