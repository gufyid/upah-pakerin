<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="<?php echo base_url(); ?>./asset/js/jquery-2.1.4.min.js"></script>
    <style>
        .modal {
            height: 600px;
        }

        .kiri {
            background-color: lightblue;
            width: 250px;
            height: 430px;
            border-radius: 10px;
            margin-left: 30px;
        }

        .kanan {
            background-color: yellowgreen;
            /* margin-right: 20px; */
            width: 250px;
            margin-left: 10px;
            height: 430px;
            border-radius: 10px;
        }

        h4 {
            font-weight: bold;
            text-align: center;
        }

        hr {
            width: 100px;
            border: 1px solid black;
            /* padding-top: -100px; */
            margin-top: 0px;
        }

        h2 {
            background-color: cadetblue;
            text-align: center;
            color: darkblue;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#mymodal">
        Panduan
    </button>
    <!-- Modal -->
    <div class="modal fade" tabindex="-1" role="dialog" id="mymodal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button> -->
                    <h2 class="modal-title">Cara Upload Excell File</h2>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-3 kiri">
                                <h4>Bulanan</h4>
                                <hr>
                                <p><b>Upload Absensi</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah Absen Kolom 9</li>
                                    <li>Jumlah Cuti Kolom 11</li>
                                </ul>

                                <p><b>Upload Premi</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah Premi Kolom 5</li>
                                </ul>

                                <p><b>Upload LT</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah LT Kolom 36</li>
                                </ul>

                                <p><b>Upload Koperasi</b></p>
                                <ul>
                                    <li>No AC Kolom 0 (A)</li>
                                    <li>Jumlah Koperasi Kolom 2 </li>
                                    <li>Jumlah Cicilan Kolom 3</li>
                                </ul>
                            </div>
                            <div class="col-md-3 kanan">
                                <h4>Mingguan</h4>
                                <hr>
                                <p><b>Upload Absensi</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah Absen Kolom 12</li>
                                    <li>Jumlah Cuti Kolom 14</li>
                                </ul>

                                <p><b>Upload Premi</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah Premi Kolom 5</li>
                                </ul>

                                <p><b>Upload LT</b></p>
                                <ul>
                                    <li>No Induk Kolom 0 (A)</li>
                                    <li>Jumlah LT Kolom 26</li>
                                </ul>

                                <p><b>Upload Koperasi</b></p>
                                <ul>
                                    <li>No AC Kolom 0 (A)</li>
                                    <li>Status Kolom 1 </li>
                                    <li>Jumlah Koperasi Kolom 2 </li>
                                    <li>Jumlah Cicilan Kolom 3</li>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <script>
        $(document).ready(function() {
            // $(document).on('load', '#mymodal', function() {
            //     // $(this).fadeIn('slow');
            //     alert('test')
            // });
            $('#mymodal').modal('show');
        });
    </script>
</body>

</html>