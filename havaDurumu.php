<?php

$sehir = "Ankara";
$sayi = 0;
$sayi1 = 0;
$sayi2 = 0;
$sayi3 = 0;

if (!empty($_POST)) {
    $sehir = $_POST["sehir"];
    if ($sehir == "Istanbul") {
        $sehir = "İstanbul";
    } else if ($sehir == "Ankara") {
        $sehir = "Ankara";
    }
}

if (!empty($_POST)) {
    $havaDurumUrl = "https://api.collectapi.com/weather/getWeather?data.lang=tr&data.city=" . $sehir;

    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => $havaDurumUrl,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "authorization: apikey 0HdRm3cHsBYDeCg1S9CyV2:1gZOjjQsrrYpw60gZGwTAi",
            "content-type: application/json"
        ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    if ($err) {
        echo "cURL Error #:" . $err;
    } else {
        $veriCek = json_decode($response);
        $veriler = $veriCek->result;
    }
}
?>

<!doctype html>
<html lang="tr">

<head>
    <title>5 Günlük Hava Durumu</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="shortcut icon" href="weather.ico" type="image/x-icon">
    <link rel="icon" href="weather.ico" type="image/x-icon">

    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">

    <link rel="stylesheet" href="havaDurumu.css">
</head>

<body>
    <div class="col-md-12 w-auto text-center" id="div1">
        <br>
        <h1 class="fw-bolder text-white"><?php print $sehir; ?></h1>
        <h3 class='text-white'><?php echo $veriler[0]->description; ?></h3>
        <h4 class='text-white'><?php echo $veriler[0]->degree; ?> &#8451</h4>
        <br>
        <form method="post">
            <div class="input-group text-center" id="div4">
                <input id="arama" class="form-control rounded" name="sehir"
                    placeholder="Hava Durumunu Öğrenmek İstediğiniz Şehiri Giriniz." autocomplete="false" />
            </div>
            <button type="submit" class="btn btn-secondary text-white mt-2 fw-bolder"><i
                    class="bi bi-caret-down-fill"></i> &nbsp Ara &nbsp <i class="bi bi-caret-down-fill"></i></button>
        </form>
    </div>

    <link href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/4.9.95/css/materialdesignicons.css"
        rel="stylesheet">
    <div class='container'>
        <div class='row mt-5'>
            <?php
            for ($sayi = 0; $sayi < 6; $sayi++) {
                print "
                <div class='col-lg-4'>
                    <div class='bg-white mt-3 price-box'>
                        <div class='pricing-name text-center'>
                            <h2> </h2>
                            <h4 class='mb-0'> </h4>
                        </div>
                        <div class='plan-price text-center mt-4'>
                            <h1 class=' ###'><span>" . $veriler[$sayi]->day . "<span></h1>
                        </div>
                        <div class='price-features mt-5'>
                            <p><i class='bi bi-cloud-haze2'></i></i> Havanın Durumu: " . $veriler[$sayi]->description . " <span class='font-weight-bold'></span></p>
                            <p><i class='bi bi-thermometer-half'></i></i> Sıcaklık: " . $veriler[$sayi]->degree . " &#8451 <span class='font-weight-bold'></span></p>
                            <p><i class='bi bi-moisture'></i></i> Nem: " . $veriler[$sayi]->humidity . "&#8451 <span class='font-weight-bold'></span></p>
                            <p><i class='bi bi-cloud-haze2'></i></i> Min. Hava Sıcaklığı: " . $veriler[$sayi]->min . " &#8451<span class='font-weight-bold'></span></p>
                            <p><i class='bi bi-cloud-fog2'></i></i> Maks. Hava Sıcaklığı: " . $veriler[$sayi]->max . " &#8451<span class='font-weight-bold'></span></p>
                        </div>
                    </div>
                </div>";
            }
            ?>
        </div>
    </div>

    <br><br>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css"
        integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css"
        integrity="sha256-NAxhq54eOPdU1hhCEYv7nCXdij1jvS9lG6ofzKp8kbA=" crossorigin="anonymous" />

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-4fhiHP1WWGldT9d53Rn5SPLapdGRU9HTpJuxDilu0SWO1bx22o+5OHM5zthZTgks"
        crossorigin="anonymous"></script>
</body>

</html>
