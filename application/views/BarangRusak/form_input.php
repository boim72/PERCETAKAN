<style>
	.select2-container .select2-selection--single {
		box-sizing: border-box;
		cursor: pointer;
		display: block;
		height: 35px;
		user-select: none;
		-webkit-user-select: none;
	}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-7 col-md-7 col-md-push-3 ">
			<div class="box box-info">
				<div class='box-header  with-border'>
					<h3 class='box-title'>Tambah Data Barang Rusak</h3>
				</div>
				<div class="box-body">
					<?php
					echo form_open('BarangRusak/post', ['class' => 'form-horizontal', 'role' => "form", 'id' => "myForm", 'data-toggle' => "validator"]);
					?>
					<div class="form-group" style="width:600px;padding-left:50px">
						<label for="stok" class="control-label">Nama Barang</label>
						<div class="input-group">
							<select class="form-control select22" name="id_barang" id="barang" >
								<option value="" data-jumlah="0">Pilih Ukuran</option>
								<?php
								foreach ($barang as $b) {
									echo "<option value='$b->id_barang'>$b->nama_barang </option>";
								}
								?>
							</select>
							<span class="input-group-addon">
								<span class="fa fa-cubes"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>

					<div class="form-group" style="width:600px;padding-left:50px">
						<label for="jumlah_rusak" class="control-label">Jumlah Barang Rusak </label>
						<div class="input-group">
							<input type="text" class="form-control" name="jumlah_rusak" id="jumlah_rusak" data-error="jumlah rusak harus diisi" placeholder="Jumlah Rusak" value="" required />
							<span class="input-group-addon">
								<span class="fa fa-cubes"></span>
							</span>
						</div>
						<div class="help-block with-errors"></div>
					</div>
					<button type="submit" class="btn btn-info" name="submit"> simpan </button>
					<a href="<?php echo base_url()?>BarangRusak" class="btn btn-default ">Cancel</a>
					</form>
				</div>
			</div>
		</div>
</div>
</section>
