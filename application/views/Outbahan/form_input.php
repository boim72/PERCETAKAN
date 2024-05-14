<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
	<div class="col-lg-12 alerts">
		<div class="alert alert-dismissible alert-danger">
			<button type="button" class="close" data-dismiss="alert">&times;</button>
			<h4> <i class="icon fa fa-ban"></i> Error</h4>
			<p><?php echo $this->session->flashdata('message'); ?></p>
		</div>
	</div>
<?php } else {
} ?>
<section class="content">
	<div class="row">
		<div class='col-xs-10'>
			<div class='box box-primary'>
				<div class='box-header  with-border'>
					<h3 class='box-title'>Data Bahan Keluar</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('outbahan/post', array('role' => "form", 'id_outbahan' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="form-group">
						<label for="out_tanggal" class="control-label">Tanggal Keluar</label>
						<div class="input-group date">
							<input type="date" class="form-control" name="out_tanggal" id="out_tanggal" data-error="tanggal harus diisi" placeholder="date" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="id_bahan" class="control-label">Nama bahan</label>
						<div class="input-group">
							<select class="form-control select22" name="id_bahan" id="id_bahan_select">
								<?php foreach ($bahan as $b) : ?>
									<option value='<?php echo $b->id_bahan; ?>'><?php echo $b->nama_bahan; ?></option>
								<?php endforeach; ?>
							</select>
							<span class="input-group-addon">
								<span class="fa fa-cubes"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="jumlah_tersedia" class="control-label">Stok Tersedia</label>
						<div class="input-group">
							<input type="text" class="form-control" id="jumlah_tersedia" readonly>
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
					</div>

					<div class="form-group">
						<label for="out_jumlah" class="control-label">Jumlah</label>
						<div class="input-group">
							<input type="number" class="form-control" name="out_jumlah" id="out_jumlah" data-error="jumlah harus diisi" placeholder="jumlah" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="box-footer">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>outbahan" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>
<script src="<?= base_url(); ?>/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script>
 $(document).ready(function() {
    // Ambil jumlah tersedia dari tabel bahan berdasarkan pilihan user
    $('#id_bahan_select').change(function() {
        var id_bahan = $(this).val();
        $.ajax({
            url: '<?php echo base_url() ?>outbahan/get_jumlah_bahan',
            type: 'post',
            data: {
                id_bahan: id_bahan
            },
            dataType: 'json',
            success: function(response) {
                $('#jumlah_tersedia').val(response.jumlah);
            }
        });
    });

    // Validasi jumlah yang dimasukkan agar tidak melebihi jumlah tersedia
    $('#out_jumlah').keyup(function() {
        var jumlah_tersedia = parseInt($('#jumlah_tersedia').val());
        var out_jumlah = parseInt($(this).val());
        if (out_jumlah > jumlah_tersedia) {
            alert('Jumlah yang dimasukkan melebihi jumlah yang tersedia!');
            $(this).val(jumlah_tersedia);
        }
    });

    // Update jumlah tersedia saat halaman pertama kali dimuat
    var id_bahan_default = $('#id_bahan_select').val();
    $.ajax({
        url: '<?php echo base_url() ?>outbahan/get_jumlah_bahan',
        type: 'post',
        data: {
            id_bahan: id_bahan_default
        },
        dataType: 'json',
        success: function(response) {
            $('#jumlah_tersedia').val(response.jumlah);
        }
    });
});


</script>
