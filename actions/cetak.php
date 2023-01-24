<?php 
    session_start();
    include ("../koneksi.php");

    $izin_id = $_POST['izin_id'];

    $query = "SELECT * FROM izin LEFT JOIN users ON izin.user_id = users.user_id WHERE izin_id = '$izin_id'";
    $izinDetail = $db->query($query)->fetch_assoc();

    if($izinDetail['user_id'] != $_SESSION['user_id'] || $izinDetail['isAccepted'] != 2) {
        header("Location: dashboard.php");
    }
?>
<html>
    <head>
        <meta content="text/html; charset=UTF-8" http-equiv="content-type">
        <style type="text/css">
            ol { 
                margin:0;padding:0
            }
            
            table td,table th {
                padding:0
            }
            
            .c7 {
                border-right-style:solid;
                padding:5pt 5pt 5pt 5pt;
                border-bottom-color:#000000;
                border-top-width:1pt;
                border-right-width:1pt;
                border-left-color:#000000;
                vertical-align:top;
                border-right-color:#000000;
                border-left-width:1pt;
                border-top-style:solid;
                border-left-style:solid;
                border-bottom-width:1pt;
                width:225.7pt;
                border-top-color:#000000;
                border-bottom-style:solid
                }
                .c10 {
                    border-right-style:solid;
                    padding:5pt 5pt 5pt 5pt;
                    border-bottom-color:#000000;
                    border-top-width:1pt;
                    border-right-width:1pt;
                    border-left-color:#000000;
                    vertical-align:top;
                    border-right-color:#000000;
                    border-left-width:1pt;
                    border-top-style:solid;
                    border-left-style:solid;
                    border-bottom-width:1pt;
                    width:451.4pt;
                    border-top-color:#000000;
                    border-bottom-style:solid
                }
                .c14 {
                    -webkit-text-decoration-skip:none;
                    color:#000000;
                    text-decoration:underline;
                    vertical-align:baseline;
                    text-decoration-skip-ink:none;
                    font-size:11pt;
                    font-family:"Arial";
                    font-style:normal
                }
                .c6 {
                    color:#000000;
                    font-weight:400;
                    text-decoration:none;
                    vertical-align:baseline;
                    font-size:11pt;
                    font-family:"Arial";
                    font-style:normal
                }
                .c1 {
                    color:#000000;
                    font-weight:700;
                    text-decoration:none;
                    vertical-align:baseline;
                    font-size:7pt;
                    font-family:"Arial";
                    font-style:italic
                }
                .c12 {
                    padding-top:0pt;
                    padding-bottom:0pt;
                    line-height:1.15;
                    orphans:2;
                    widows:2;
                    text-align:left;
                    height:11pt
                } 
                .c0 {
                    color:#000000;
                    font-weight:700;
                    text-decoration:none;
                    vertical-align:baseline;
                    font-size:11pt;
                    font-family:"Arial";
                    font-style:normal
                }
                .c11 {
                    padding-top:0pt;
                    padding-bottom:0pt;
                    line-height:1.15;
                    orphans:2;
                    widows:2;
                    text-align:center;
                    height:11pt
                }
                .c13 {
                    padding-top:0pt;
                    padding-bottom:0pt;
                    line-height:1.15;
                    orphans:2;
                    widows:2;
                    text-align:center
                }
                .c15 {
                    color:#000000;
                    text-decoration:none;
                    vertical-align:baseline;
                    font-size:7pt;
                    font-family:"Arial";
                    font-style:normal
                } 
                .c8 {
                    margin-left:auto;
                    border-spacing:0;
                    border-collapse:collapse;
                    margin-right:auto
                }
                .c2 {
                    padding-top:0pt;
                    padding-bottom:0pt;
                    line-height:1.0;
                    text-align:center
                }
                .c9 {
                    padding-top:0pt;
                    padding-bottom:0pt;
                    line-height:1.0;
                    text-align:left
                }
                .c3 {
                    background-color:#ffffff;
                    max-width:451.4pt;
                    padding:72pt 72pt 72pt 72pt
                }
                .c5 {
                    height:0pt
                }
                .c4 {
                    font-weight:700
                }
                .title {
                    padding-top:0pt;
                    color:#000000;
                    font-size:26pt;
                    padding-bottom:3pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                } 
                .subtitle {
                    padding-top:0pt;
                    color:#666666;
                    font-size:15pt;
                    padding-bottom:16pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                li {
                    color:#000000;
                    font-size:11pt;
                    font-family:"Arial"
                }
                p {
                    margin:0;
                    color:#000000;
                    font-size:11pt;
                    font-family:"Arial"
                }
                h1 {
                    padding-top:20pt;
                    color:#000000;
                    font-size:20pt;
                    padding-bottom:6pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                h2 {
                    padding-top:18pt;
                    color:#000000;
                    font-size:16pt;
                    padding-bottom:6pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                h3 {
                    padding-top:16pt;
                    color:#434343;
                    font-size:14pt;
                    padding-bottom:4pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                h4 {
                    padding-top:14pt;
                    color:#666666;
                    font-size:12pt;
                    padding-bottom:4pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                h5 {
                    padding-top:12pt;
                    color:#666666;
                    font-size:11pt;
                    padding-bottom:4pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
                h6 {
                    padding-top:12pt;
                    color:#666666;
                    font-size:11pt;
                    padding-bottom:4pt;
                    font-family:"Arial";
                    line-height:1.15;
                    page-break-after:avoid;
                    font-style:italic;
                    orphans:2;
                    widows:2;
                    text-align:left
                }
        </style>
    </head>
    <body class="c3">
        <p class="c13">
            <span style="overflow: hidden; display: inline-block; margin: 0.00px 0.00px; border: 0.00px solid #000000; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px); width: 378.15px; height: 100px;"><img alt="" src="../assets/img/logo-1.jpg" style="width: 100px; height: 100px; margin-left: 0.00px; margin-top: 0.00px; transform: rotate(0.00rad) translateZ(0px); -webkit-transform: rotate(0.00rad) translateZ(0px);" title="">
            </span>
        </p>
        <p class="c13"><span class="c4 c14">KARTU IZIN KELUAR</span>
        </p>
        <p class="c13"><span class="c4 c15"></span></p><p class="c11"><span class="c0"></span></p><p class="c11"><span class="c0"></span></p><a id="t.88078215e7c6d2d12c2632f6a884153e77b596e5"></a><a id="t.0"></a><table class="c8"><tbody><tr class="c5"><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c0">UID</span></p><p class="c2"><span class="c1"></span></p></td><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c0">NAMA</span></p><p class="c2"><span class="c1"></span></p></td></tr><tr class="c5"><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c6">
        <?= $izinDetail['user_id'] ?>
    </span></p></td><td class="c7" colspan="1" rowspan="1"><p class="c2"><span>
        <?= $izinDetail['nama_lengkap'] ?>
    </span></p></td></tr></tbody></table><p class="c11"><span class="c0"></span></p><p class="c11"><span class="c0"></span></p><a id="t.41ec1c73533aed6efc357e3ccfb8ed755c2c7e69"></a><a id="t.1"></a><table class="c8"><tbody><tr class="c5"><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c4">KELUAR</span></p></td><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c4">KEMBALI</span></p></td></tr><tr class="c5"><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c6">
        <?= date("d-m-Y", strtotime($izinDetail['tanggal_keluar']))?>
    </span></p></td><td class="c7" colspan="1" rowspan="1"><p class="c2"><span class="c6">
    <?= date("d-m-Y", strtotime($izinDetail['tanggal_masuk']))?>
    </span></p></td></tr></tbody></table><p class="c11"><span class="c0"></span></p><p class="c11"><span class="c0"></span></p><a id="t.d7504bc4435911a9b636efd6af46a62cfe176b4a"></a><a id="t.2"></a><table class="c8"><tbody><tr class="c5"><td class="c10" colspan="1" rowspan="1"><p class="c2"><span class="c0">KETERANGAN IZIN</span></p></td></tr><tr class="c5"><td class="c10" colspan="1" rowspan="1"><p class="c9"><span class="c6">
        <?= $izinDetail['keperluan'] ?>
    </span></p></td></tr></tbody></table><p class="c12"><span class="c0"></span></p></body></html>

    <script>window.print();</script>