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
</style>
<section class="content">
	<div class="row">
	<div class="col-md-12">
			<div class="box box-info">
				<div class='box-header  with-border'>
					<h3 class='box-title'>Data Ukuran</h3>
					<div class="pull-right">
						<?php
						echo anchor('Ukuran/post', 'Tambah Data', array('class' => 'btn btn-success'));
						?>
					</div>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Ukuran</th>
								<th>Harga Ukuran</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($record as $ukuran) {  ?>
								<tr>
									<td><?php echo ++$no; ?></td>
									<td><?php echo $ukuran->nama_ukuran; ?></td>
									<td><?= $ukuran->harga_ukuran; ?></td>
									<td><?php
										echo anchor(site_url('ukuran/edit/' . $ukuran->id_ukuran), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('ukuran/hapus/' . $ukuran->id_ukuran), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>

</section>

<script src="<?php echo base_url() ?>assets/app/js/alert.js"></script>
<script>
	$(document).ready(function() {
		$('#myTable').DataTable();
	});
</script>