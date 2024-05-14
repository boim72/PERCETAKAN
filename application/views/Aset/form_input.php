<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/app/css/style.css">
<?php if ($this->session->flashdata('message')) { ?>
<div class="col-lg-12 alerts">
	<div class="alert alert-dismissible alert-danger">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<h4> <i class="icon fa fa-ban"></i> Error</h4>
		<p><?php echo $this->session->flashdata('message'); ?></p>
	</div>
</div>
<?php } else { } ?>
<section class="content">
	<div class="row">
		<div class='col-xs-12'>
			<div class='box box-primary'>
				<div class='box-header  with-border'>
					<h3 class='box-title'>Tambah Data Aset</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('Aset/post', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="form-group">
						<label for="nama_aset" class="control-label">Nama Aset</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_aset" id="nama_aset" data-error="Nama Barang harus diisi" placeholder="nama barang" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="kategori" class="control-label">Nama Kategori</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" data-error="Nama Kategori harus diisi" placeholder="Nama Kategori" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					
					<div class="form-group">
						<label for="harga" class="control-label">Harga</label>
						<div class="input-group">
							<input type="text" name="harga" id="harga" data-error="harga harus di isi" class="form-control" placeholder="Harga Barang" required>
							<span class="input-group-addon">
								<span class="fas fa-money">
								</span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="foto" class="control-label">Foto</label>
						<div class="input-group">
							<input type="file" name="foto" class="form-control">
							<span class="input-group-addon">
								<span class="fa fa-photo">
								</span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="box-footer">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>barang" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>