<!DOCTYPE html>
<html>

<head>
    <title></title>
    <link rel="stylesheet" href="<?php echo base_url() . 'asset/css/datepicker-ui.css' ?>">
    <!--  <script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>-->
    <script type="text/javascript" src="<?php echo base_url(); ?>./asset/js/jquery-ui.min.js"></script>

    <script src="<?php echo base_url(); ?>./asset/js/ace-elements.min.js"></script>
    <script src="<?php echo base_url(); ?>./asset/js/ace.min.js"></script>
</head>

<body>
    <?php
    $nip             = $data[0]['nip'];
    $noinduk        = $data[0]['noinduk'];
    $noslip            = $data[0]['noslip'];
    $nokop             = $data[0]['nokop'];
    $nama              = $data[0]['nama'];
    $alamat         = $data[0]['alamat'];
    $notlp             = $data[0]['notlp'];
    $jekel             = $data[0]['kelamin'];
    $agama             = $data[0]['agama'];
    $tempat_lahir     = $data[0]['tmplahir'];
    $tgl_lahir         = $data[0]['tgllahir'];
    $sperkawinan     = $data[0]['sperkawinan'];
    $jumanak         = $data[0]['jumanak'];
    $pendidikan         = $data[0]['pendidikan'];
    $tgl_masuk         = $data[0]['tglmasuk'];
    $penempatan     = $data[0]['pabrik'];
    $skill             = $data[0]['skill'];
    $divisi         = $data[0]['divisi'];
    $bagian         = $data[0]['bagian'];
    $seksi             = $data[0]['seksi'];
    $jabatan         = $data[0]['jabatan'];
    $tipe             = $data[0]['tkaryawan'];
    $status         = $data[0]['skerja'];
    $cc              = $data[0]['costcenter'];
    $ktp             = $data[0]['noktp'];
    $npwp             = $data[0]['nonpwp'];
    $kpj             = $data[0]['nokpj'];
    $bpjs             = $data[0]['nobpjs'];
    $norek             = $data[0]['norek'];
    $penggajian        = $data[0]['upah'];
    $ln             = $data[0]['ln'];
    $pensiun         = $data[0]['pensiun'];
    $spsi             = $data[0]['spsi'];
    $foto             = $data[0]['foto'];
    $nmdivisi = $this->db->query("select nama from t_divisi where kode='$divisi'")->result_array();
    $nmbagian = $this->db->query("select nama from t_bagian where kode='$bagian'")->result_array();
    $nmseksi = $this->db->query("select nama from t_seksi where kode='$seksi'")->result_array();
    ?>
</body>
<div class="panel panel-default">
    <div class="panel-heading">Detail Karyawan | <?= $nama ?></div>
    <div class="panel-body">
        <!-- <img src="<?php echo base_url() ?>/foto/50972.jpg" width="150px" height="150px" alt="Foto"> -->
        <div class="content">
            <!-- <?php if (isset($foto)) { ?>
                <img src="<?php echo base_url() ?>/foto/<?= $foto ?>" width="150px" height="150px" alt="Foto" class="img-rounded">
            <?php } else { ?>
                <img src="<?php echo base_url() ?>/foto/nophoto.jpg" width="150px" height="150px" alt="Foto" class="img-rounded">
            <?php } ?>
            <hr> -->
            <table class="table table-striped" cellpadding="0" cellspacing="0">
                <tr>
                    <td rowspan="9" style="background-color:white">
                        <?php if ($foto) { ?>
                            <img src="<?php echo base_url() ?>/foto/<?= $foto ?>" width="150px" height="150px" alt="Foto" class="img-rounded">
                        <?php } else { ?>
                            <img src="<?php echo base_url() ?>/foto/nophoto.jpg" width="150px" height="150px" alt="Foto" class="img-rounded">
                        <?php } ?>
                    </td>
                    <td width="20%">NIP</td>
                    <td width="1%">:</td>
                    <td><?= $nip  ?></td>

                    <td width="20%">No Induk</td>
                    <td width="1%">:</td>
                    <td><?= $noinduk  ?></td>
                </tr>
                <tr>
                    <td width="20%">Nama Lengkap</td>
                    <td width="1%">:</td>
                    <td><?= $nama  ?></td>

                    <td width="20%">Devisi</td>
                    <td width="1%">:</td>
                    <td><?= $nmdivisi ? $nmdivisi[0]['nama'] : ''  ?></td>
                </tr>
                <tr>
                    <td>Tempat/Tgl. Lahir</td>
                    <td width="1%">:</td>
                    <td><?= $tempat_lahir . " / " . $tgl_lahir  ?></td>

                    <td>Bagian</td>
                    <td width="1%">:</td>
                    <td><?= $nmbagian ? $nmbagian[0]['nama'] : '' ?></td>

                </tr>
                <tr>
                    <td>Alamat</td>
                    <td width="1%">:</td>
                    <td><?= $alamat  ?></td>

                    <td>Seksi</td>
                    <td width="1%">:</td>
                    <td><?= $nmseksi ? $nmseksi[0]['nama'] : ''  ?></td>
                </tr>
                <tr>
                    <td>No. Hp</td>
                    <td width="1%">:</td>
                    <td><?= $notlp  ?></td>

                    <td>Jabatan</td>
                    <td width="1%">:</td>
                    <td><?= $jabatan  ?></td>
                </tr>
                <tr>
                    <td>Kelamin</td>
                    <td width="1%">:</td>
                    <td><?= $jekel  ?></td>

                    <td>Tgl Masuk</td>
                    <td width="1%">:</td>
                    <td><?= $tgl_masuk  ?></td>
                </tr>
                <tr>
                    <td>Agama</td>
                    <td width="1%">:</td>
                    <td><?= $agama  ?></td>

                    <td>Status Kerja</td>
                    <td width="1%">:</td>
                    <td><?= $status  ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td width="1%">:</td>
                    <td><?= $sperkawinan  ?></td>

                    <td>No Rekening</td>
                    <td width="1%">:</td>
                    <td><?= $norek  ?></td>
                </tr>
                <tr>
                    <td>Pendidikan</td>
                    <td width="1%">:</td>
                    <td><?= $pendidikan  ?></td>

                    <td>&nbsp;</td>
                    <td width="1%">&nbsp;</td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    </div>
</div>
<div class="panel-footer text-center">
    <a href="" class="btn btn-primary" style="border-radius:50px">
        << Kembali</a> <div class="row">
</div>

</html>