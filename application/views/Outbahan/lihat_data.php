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
</style>
<?php if ($this->session->flashdata('message')) { ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-success">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-check"></i>Berhasil</h4>
			<p><?php echo $this->session->flashdata('message'); ?></p>
		</div>
	</div>
<?php } else {
} ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="box box-info">
				<div class='box-header  with-border'>
					<h3 class='box-title'>Stok Barang</h3>
					<div class="pull-right">
						<?php
						echo anchor('outbahan/post', 'Tambah Data', array('class' => 'btn btn-success'));
						?>
					</div>
				</div>
				<div class="box-body">
					<table id="myTable" class="table table-bordered table-striped table-hover">
						<thead>
							<tr>
								<th>No</th>
								<th>Tanggal Keluar </th>
								<th>Nama bahan </th>
								<th>Jumlah Keluar </th>
								<!-- <th>Harga Satuan </th> -->
								<!-- <th>Kapasitas</th> -->
								<!-- <th>Total Harga</th> -->
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$no = 0;
							foreach ($outbahan as $out) { ?>
								<tr>
									<td><?php echo ++$no ?> </td>
									<td><?php echo $out->out_tanggal; ?></td>

									<?php foreach ($bahan as $ba) : 
										if ($out->id_bahan == $ba->id_bahan) { ?>		
										<td><?= $ba->nama_bahan; ?></td>
									<?php } endforeach; ?>

									<td>
										<?php echo $out->out_jumlah; ?>
									</td>

									<td><?php
										echo anchor(site_url('outbahan/edit/' . $out->id_outbahan), '<i class="fa fa-pencil-square-o fa-lg"></i>&nbsp;&nbsp;Edit', array('title' => 'edit', 'class' => 'btn btn-sm btn-warning'));
										echo '&nbsp';
										echo anchor(site_url('outbahan/hapus/' . $out->id_outbahan), '<i class="fa fa-trash fa-lg"></i>&nbsp;&nbsp;Hapus', 'title="delete" class="btn btn-sm btn-danger "');
										?>
									</td>
								</tr>
							<?php }	?>
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
</script>