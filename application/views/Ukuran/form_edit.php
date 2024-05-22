<style type="text/css">
	table,
	th,
	tr,
	td {
		text-align: center;
	}
</style>

<section class="content">
	<div class="row">
		<div class='col-xs-12'>
			<div class="box box-info">
				<div class="box-header with-border">
					<h3 class="box-title"> Edit Data Ukuran</h3>
				</div>
				<div class="box-body">
					<?php
					echo form_open('Ukuran/edit', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator"));
					?>
					<input type="hidden" name="id" value="<?php echo $record['id_ukuran']; ?>">
					<div class="form-group">
						<label for="nama_ukuran" class="control-label">Nama nama_ukuran</label>
						<div class="input-group">
							<input type="text" class="form-control" name="nama_ukuran" id="nama_ukuran" data-error="Nama ukuran harus diisi" placeholder="Nama ukuran" value="<?php echo $record['nama_ukuran']; ?>" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<div class="form-group">
						<label for="harga_ukuran" class="control-label">Harga ukuran</label>
						<div class="input-group">
							<input type="text" class="form-control" name="harga_ukuran" id="harga_ukuran" data-error="Nama ukuran harus diisi" placeholder="Nama ukuran" value="<?php echo $record['harga_ukuran']; ?>" required />
							<span class="input-group-addon">
								<span class="fa fa-cube"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-info" name="submit"> simpan </button>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>