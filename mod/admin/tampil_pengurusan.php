<?php
    include "../../config/koneksi.php";
    include "../../config/funct.php";
    $SELECT_VERIFI = mysqli_query($koneksi,"SELECT a.*,b.nama_kategori,c.jenis_pengurusan FROM pengurusan as a,kategori_pengurusan as b,jenis_pengurusan as c WHERE a.id_kategori_pengurusan=b.id_kategori and b.id_jenis_pengurusan=c.id_jenis_pengurusan and a.status_pengurusan = '1' and a.id_pengurusan NOT IN (SELECT id_pengurusan FROM verifikasi) ORDER BY a.tgl_pengurusan ASC");

    $jum_data = mysqli_num_rows($SELECT_VERIFI);
?>
<div class="row" style="margin-bottom:0px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div class="bg-danger" style="padding:10px;">
            Anda Memiliki <b><u><?=$jum_data?></u></b> Pengurusan Yang <b><u>Belum Diverifikasi</u></b>   <br/>
            <small>Untuk melihat berkas dari masing-masing pengurusan silahkan anda mengklik tombol &nbsp;<b>" <i title='Lihat Berkas'  class='fa  fa-file-archive-o' style='padding:5px; background-color:#dff0d8; color:#00AA8D; border-radius:5px; cursor:pointer'></i> "</b></small></div>
    </div>
</div>

<div class="row" style="margin-top:10px;">
    <div class="col-md-12 col-xs-12" style="padding-left:5px; padding-right:5px;">
        <div  style="padding:40px 40px 20px 40px; background-color:#FFFFFF;" >
            <table  id="table_tampil_pengurusan" class="table table-bordered table-striped">
                <thead class='bg-success'>
                <tr>
                  <th style="width:10px;">No</th>
                  <th>Atas Nama</th>
                  <th>Jenis Pengurusan</th>
                  <th>Tgl Pengurusan</th>
                  <th><center>Aksi</center></th>
                </tr>
                </thead>
                <tbody>
                    <?php
                        
                            $no=1;
                            if($jum_data > 0){
                                while ($data_verifi = mysqli_fetch_array($SELECT_VERIFI)) {
                                    $id_pengurusan = $data_verifi['id_pengurusan'];
                                    $atas_nama = $data_verifi['nama'];
                                    $hubungan = $data_verifi['hubungan'];
                                    $tgl_pengurusan = set_waktu($data_verifi['tgl_pengurusan']);
                                    $jenis_pengurusan = $data_verifi['jenis_pengurusan']." ".$data_verifi['nama_kategori'];

                                    echo "<tr>
                                            <td>$no</td>
                                            <td>$atas_nama</td>
                                            <td>$jenis_pengurusan</td>
                                            <td>$tgl_pengurusan</td>
                                            <td align='center'><i title='Lihat Berkas' onclick ='tampil_berkas(\"$id_pengurusan\",\"$jenis_pengurusan\",\"$atas_nama\")' class='fa  fa-file-archive-o' style='padding:5px; background-color:#dff0d8; color:#00AA8D; border-radius:5px; cursor:pointer'></i> </td>
                                         </tr>";
                                $no++;       
                                }
                                
                            }else{
                                // echo "<tr>
                                //             <td colspan='5' style='padding:20px;' align='center'>-- Belum Ada Pengurusan --</td>
                                //      </tr>";
                            }
                        ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function() {
        $('#table_tampil_pengurusan').dataTable();
    });
</script>