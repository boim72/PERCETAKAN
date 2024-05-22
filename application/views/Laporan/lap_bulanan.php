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
<style>
@media print {
    body * {
        visibility: hidden;
    }
    #printArea, #printArea * {
        visibility: visible;
    }
    #printArea {
        position: absolute;
        left: 0;
        top: 0;
    }
}
</style>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class='box-header  with-border'>
                    <h3 class='box-title'>Laporan Penjualan Bulanan</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <?php foreach ($cards as $info_cards) : ?>
                            <div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box bg-<?= $info_cards->box ?>">
                                    <span class="info-box-icon"><i class="fa fa-<?= $info_cards->icon ?>"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text"><?= $info_cards->title; ?></span>
                                        <span class="info-box-number"><?= $info_cards->total; ?></span>
                                        <div class="progress">
                                            <div style="width: 100%" class="progress-bar"></div>
                                        </div>
                                        <span class="progress-description">
                                            <?= $info_cards->description; ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="row">
                            <div class="col-xs-12">
                                <?php echo form_open('lapbulanan', array('role' => "form", 'id' => "myForm", 'data-toggle' => "validator")); ?>
                                <div class="col-md-3">
                                    <div class="input-daterange">
                                        <div class="form-group">
                                            <label for="start_date" class="control-label">Tanggal Awal</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="start_date" id="start_date" data-error="Tanggal Awal harus diisi" required />
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="input-daterange">
                                        <div class="form-group">
                                            <label for="end_date" class="control-label">Tanggal Akhir</label>
                                            <div class="input-group">
                                                <input type="date" class="form-control" name="end_date" id="end_date" data-error="Tanggal Akhir harus diisi" required />
                                                <span class="input-group-addon">
                                                    <span class="fa fa-calendar"></span>
                                                </span>
                                            </div>
                                            <div class="help-block with-errors"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="metode" class="control-label">Metode</label>
                                        <div class="input-group">
                                            <select class="form-control" name="metode">
                                                <option value="">Pilih Semua</option>
                                                <?php
                                                foreach ($metode as $m) {
                                                    echo "<option value=' $m->id_byr'>$m->metode</option>";
                                                }
                                                ?>
                                            </select>
                                            <span class="input-group-addon">
                                                <span class="fa fa-list"></span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2" style="padding-top:25px;">
                                    <button type="submit" name="search" id="search" value="Search" class="btn btn-info"> Search</button>
                                </div>
                                </form>
                            </div>
                        </div>
                        <!-- <div class="col-md-12">                           
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <?php
                                        $next = intval($tahun) + 1;
                                        $prev = intval($tahun) - 1;
                                        ?>
                                        <th>
                                            <a href="<?php echo base_url('index.php/lapbulanan/index/' . $prev) ?>">&lt;&lt;</a>
                                        </th>
                                        <th><?php if ($tahun) {
                                                                echo $tahun;
                                                            } ?></th>
                                        <th>
                                            <a href="<?php echo base_url('index.php/lapbulanan/index/' . $next) ?>">&gt;&gt;</a>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php foreach ($bulanan as $row) :  ?>
                                            <th>
                                                <?php
                                                $bulan = $this->fungsi->bulan($row->tgl_trf);
                                                echo $bulan ?>
                                            </th>
                                        <?php endforeach; ?>
                                    </tr>
                                    <tr>
                                        <?php foreach ($bulanan as $row) :  ?>
                                            <td>
                                                <?php
                                                $bulan = $row->tgl_trf;
                                                $mnow = date('m');
                                                $bulanskrng = substr($bulan,6,1);
                                                if ($bulanskrng == $mnow){
                                                    echo '<span class="highlight">Rp'.number_format($row->gtotal).'</span>';
                                                }
                                                else{
                                                    echo 'Rp'.number_format($row->gtotal);
                                                }
                                                    ?>
                                                
                                            </td>
                                        <?php endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div> -->
                         <!-- <div class="box-body">
                            <table id="myTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Barang</th>
                                        <th>Harga</th>
                                        <th>Jumlah Barang</th>
                                        <th>ID Pembayaran</th>
                                        <th>Grand Total</th>
                                        <th>Tanggal Transfer</th>
                                        <th>Nama Pelanggan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1; ?>
                                    <?php if(!empty($laporan)): ?>
                                    <?php foreach($laporan as $row): ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?php echo $row->nama_barang; ?></td>
                                            <td><?php echo $row->harga; ?></td>
                                            <td><?php echo $row->jumlah_barang; ?></td>
                                            <td><?php echo $row->id_byr; ?></td>
                                            <td><?php echo $row->grand_total; ?></td>
                                            <td><?php echo $row->tgl_trf; ?></td>
                                            <td><?php echo $row->nama_pelanggan; ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div> -->
                    </div>
                    
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="table-responsive" id="printArea">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Harga</th>                                         
                                            <th>Pembayaran</th>
                                            <th>Tanggal Transfer</th>
                                            <th>Nama Pelanggan</th>
                                            <th>Jumlah Barang</th>
                                            <th>Grand Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        $total_semua = 0; ?>
                                        <?php if(!empty($laporan)): ?>
                                            <?php foreach($laporan as $row): ?>
                                                <tr>
                                                    <td><?= $no++; ?></td>
                                                    <td><?php echo $row->nama_barang; ?></td>
                                                    <td><?php echo $row->harga; ?></td>                                                  
                                                    <td><?php echo $row->metode; ?></td>                                                   
                                                    <td><?php echo $row->tgl_trf; ?></td>
                                                    <td><?php echo $row->nama_pelanggan; ?></td>
                                                     <td><?php echo $row->jumlah_barang; ?></td>
                                                    <td><?php echo ($row->jumlah_barang * $row->grand_total); ?></td>
                                                </tr>
                                                <?php 
                                                // Hitung total barang x grand total
                                                $total_semua += $row->jumlah_barang * $row->grand_total; 
                                                ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <tr>
                                                <td colspan="7" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                     <tfoot>
                                        <tr>
                                            <th colspan="7" class="text-right">Total penjualan:</th>
                                            <th><?php echo number_format($total_semua, 2); ?></th>
                                        </tr>
                                        <tr>
                                            <?php  
                                            $total_kerugian = 0;
                                            if (!empty($rusak)):
                                                foreach ($rusak as $rusak ) :
                                                    $total_kerugian += $rusak->jumlah_rusak * $rusak->harga;
                                                endforeach;
                                            endif;?>
                                            
                                            <th colspan="7" class="text-right">Total kerugian:</th>
                                            <th><?php echo number_format($total_kerugian, 2); ?></th>
                                        </tr>
                                        <tr>
                                            <th colspan="7" class="text-right">Laba Bersih:</th>
                                            <th><?php echo number_format($total_semua - $total_kerugian, 2); ?></th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Tambahkan Tombol Cetak -->
                    <div class="row">
                        <div class="col-xs-12 text-right">
                            <button onclick="printTable()" class="btn btn-primary">Print</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
function printTable() {
    var printContents = document.getElementById('printArea').innerHTML;
    var originalContents = document.body.innerHTML;
    
    document.body.innerHTML = printContents;
    window.print();
    document.body.innerHTML = originalContents;
    location.reload(); // Refresh halaman untuk mengembalikan state awal
}
</script>