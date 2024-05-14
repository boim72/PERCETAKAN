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
					<h3 class='box-title'>Edit Data Barang Masuk</h3>
				</div>
				<div class="box-body">
					<?php echo form_open_multipart('inbahan/edit', array('role' => "form", 'id_inbahan' => "myForm", 'data-toggle' => "validator")); ?>
					<div class="form-group">
						<label for="in_tanggal" class="control-label">Tanggal Masuk</label>
						<div class="input-group date">
							<input type="date" class="form-control" name="in_tanggal" id="in_tanggal" data-error="tanggal harus diisi" placeholder="date" value="<?php echo $record['in_tanggal']; ?>" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
                        <label for="id_bahan" class="control-label">Nama bahan</label>
                        <div class="input-group">
                            <select class="form-control select22" name="id_bahan">
                                <?php foreach ($bahan as $b) : ?>
                                    <option value='<?php echo $b->id_bahan; ?>' <?php echo ($b->id_bahan == $record['id_bahan']) ? 'selected' : ''; ?>><?php echo $b->nama_bahan; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="input-group-addon">
                                <span class="fa fa-cubes"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>

					<div class="form-group">
                        <label for="in_jumlah" class="control-label">Jumlah</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="in_jumlah" id="in_jumlah" data-error="jumlah harus diisi" placeholder="jumlah" value="<?php echo $record['in_jumlah']; ?>" required />
                            <span class="input-group-addon">
                                <span class="fa fa-cube"></span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
					<div class="form-group">
                        <label for="in_harga" class="control-label">Harga Masuk</label>
                        <div class="input-group">
                            <input type="number" name="in_harga" id="in_harga" data-error="Harga harus di isi" class="form-control" placeholder="Harga bahan" value="<?php echo $record['in_harga']; ?>" required>
                            <span class="input-group-addon">
                                <span class="fas fa-money">
                                </span>
                            </span>
                        </div>
                        <div class="help-block with-errors"></div>
                    </div>
					<div class="box-footer">
						<input type="hidden" name="id_inbahan" value="<?php echo $record['id_inbahan'] ?>">
						<button type="submit" name="submit" class="btn btn-primary ">Simpan</button>
						<a href="<?php echo base_url() ?>barang" class="btn btn-default ">Cancel</a>
					</div>
					</form>
				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div>
	</div>
</section>