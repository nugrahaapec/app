<!DOCTYPE html>
<html lang="en">
<?= $this->include('/auth/tanggal.php'); ?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="<?= base_url() ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url() ?>/dist/css/adminlte.min.css">

<body>
    <div class="content-fluid">
        <div class="invoice px-5">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th rowspan="3" style="text-align:center; vertical-align: middle;">HHBG</th>
                        <th style="text-align:center;width: 12cm;vertical-align: middle;">FORM</th>
                        <th style="text-align:left;width: 5cm;vertical-align: middle;">No. Dokumen</th>
                        <th style="text-align:left">HBG/SUP/FRM/B.04/1</th>
                    </tr>
                    <tr>
                        <th rowspan="2" style="text-align:center; vertical-align: middle;">DELIVERY ORDER FORM</th>
                        <th style="text-align:left">Revisi Ke</th>
                        <th style="text-align:left">0</th>
                    </tr>
                    <tr>
                        <th style="text-align:left">Tgl. Berlaku</th>
                        <th style="text-align:left">11 Februari 2019</th>
                    </tr>
                </thead>
            </table>
            <div class="row invoice-info py-2">
                <div class="col-sm-6 invoice-col">
                    <address>
                        <strong>PT. EKA BOGAINTI</strong><br>
                        Head Office<br>
                        Jl. Raya Poncol No.2 Ciracas, Jakarta 13740 Indonesia.<br>
                        Ph. +62 21 29981234 &nbsp;&nbsp;&nbsp;&nbsp; fax. +62 21 8700444-5<br>
                        www.hokben.co.id
                    </address>
                </div>
                <div class="col-sm-6 invoice-col">
                    <address>
                        <br>
                        Repesentative Office<br>
                        Gandaria 8 Office Tower 18<sup>th</sup> <br>
                        Jl. Sultan Iskandar Muda, Jakarta 12240<br>
                        ph. +62 21 29304123 &nbsp;&nbsp;&nbsp;&nbsp; fax. +62 21 29304122
                    </address>
                </div>
            </div>
        </div>
        <div class="row invoice">
            <div class="col-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">Delivery Date</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; height: 2cm; vertical-align: middle;"><?= tgl_indo(date('Y-m-d')) ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">DO Number</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; height: 2cm; vertical-align: middle;"><?= $store->no_do ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-4">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="text-align:center">DO Date</th>
                        </tr>
                        <tr>
                            <th style="text-align:center; height: 2cm; vertical-align: middle;"><?= tgl_indo(date('Y-m-d')) ?></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="row invoice">
            <div class="col-6">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <th style="text-align:left;vertical-align: top;">DELIVER FROM</br>
                                Div. IT</br>
                                Head Office - Ciracas
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-6">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <th style="text-align:left;vertical-align: top;">DELIVER TO</br>
                                <h4>HHB <?= strtoupper($store->nama_store) ?></h4>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <div class="col-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Brand / Type</th>
                        <th style="text-align:center;">Serial Number</th>
                        <th style="text-align:center;">Qty</th>
                        <th style="text-align:center;">Description</th>
                    </tr>
                </thead>
                <tbody style="height: 9cm;">
                    <tr>
                        <td style="text-align:center;">
                            1
                        </td>
                        <td>
                            Terlampir
                        </td>
                        <td>
                            Terlampir
                        </td>
                        <td style="text-align:center;">
                            Terlampir
                        </td>
                        <td>
                            New Store
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <center>
                <label style="text-size-adjust: 24px;" for="cek">PLEASE CHECK EVERY ITEM RECEIVED IS COMPLETE</label>
            </center>
        </div>
        <div class="row invoice">
            <div class="col-3">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <td style="text-align:left;vertical-align: top;">Checked by : </br> (Team IT)</br>
                                </br>
                                </br>
                                </br>
                                ( <?= ucwords($store->nama_user) ?> )
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-3">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <td style="text-align:left;vertical-align: top;">Approved by : </br> (Admin IT)</br>
                                </br>
                                </br>
                                </br>
                                ( <?= ucfirst(session('nama_user')) ?> )
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-3">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <td style="text-align:left;vertical-align: top;">Delivered : </br>(Driver/Distribusi)</br>
                                </br>
                                </br>
                                </br>
                                ( ............................................... )
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="col-3">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <td style="text-align:left;vertical-align: top;">Approved by : </br> (Staff Logistik)</br>
                                </br>
                                </br>
                                </br>
                                ( ............................................... )
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <br>
        <br>
        <div class="row invoice">
            <div class="col-6">
                <table class="table table-bordered" style="height: 3cm;">
                    <thead>
                        <tr>
                            <td style="text-align:left;vertical-align: top;"><b>Approved by</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Date Received : ............................</br>
                                (PIC Store/User)</br>
                                </br>
                                </br>
                                ( ............................................... )
                                <br>Authorized Signature</br>
                            </td>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
        <footer class="footer" style="position: fixed;bottom: 0;">
            <b>Note :</b> Mohon setelah barang diterima, tanda tangan tangan dibagian <b><i>Received By,</i></b> kemudian kirim kembali ke Divisi IT.
        </footer>
    </div>

    <script>
        window.print();
        window.close();
    </script>
</body>
</head>

<br>
<label for="lampiran">Lampiran :</label>
<div class="col-12">
    <table class="table table-bordered border-dark table-sm">
        <thead>
            <tr>
                <th style="text-align:center;">No</th>
                <th style="text-align:center;">Brand / Type</th>
                <th style="text-align:center;">Serial Number</th>
                <th style="text-align:center;">Qty</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($result as $data) :
            ?>
                <tr>
                    <td style="text-align:center;">
                        <p><?= $no++ ?></p>
                    </td>
                    <td>
                        <?= ucfirst($data['merk']) ?> / <?= ucfirst($data['perangkat']) ?>
                    </td>
                    <td>
                        <?= $data['sn'] ?>
                    </td>
                    <td style="text-align:center;">
                        1
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>