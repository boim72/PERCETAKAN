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
					<h3 class='box-title'>Edit Data Aset</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('Aset/edit', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="form-group">
						<label for="nama_barang" class="control-label">Nama Aset</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_aset" id="nama_aset" value="<?php echo $aset['nama_aset'] ?>" data-error="Nama Aset harus diisi" placeholder="nama aset" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="nama_barang" class="control-label">Nama kategori</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_kategori" id="nama_kategori" value="<?php echo $aset['nama_kategori'] ?>" data-error="Nama Ketegori harus diisi" placeholder="nama Kategori" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					
					<div class="form-group">
						<label for="harga" class="control-label">Harga</label>
						<div class="input-group">
							<input type="text" name="harga" id="harga" data-error="harga harus di isi" class="form-control" value="<?php echo $aset['harga'] ?>" placeholder="Harga Aset" required>
							<span class="input-group-addon">
								<span class="fas fa-money">
								</span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="foto" class="control-label" >Foto</label>
						<div class="input-group">
							<input type="file" name="foto">
							<span class="input-group-addon">
								<span class="fa fa-photo">
								</span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="box-footer">
						<input type="hidden" name="id" value="<?php echo $aset['id_aset'] ?>">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>aset" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>