@extends('home/layouts/main')

@section('container')
    <section id="hero" class="d-flex align-items-center">
        @foreach ($profiles as $profile)
            <div class="container position-relative" data-aos="zoom-out" data-aos-delay="100">
                <img src="/img/fruits.png" style="max-height: 100px;">
                <img src="/img/vegetable.png" style="max-height: 100px;">
                <h1><span>Buah</span> dan <span>Sayur</span></h1>
                <h2>Katalog berbagai macam buah dan sayur.</h2>
                <div class="d-flex">
                    <a href="/home/profiles" class="btn-get-started scrollto">Tentang Kami</a>
                    <a href="{{ $profile->link_embed }}" class="glightbox btn-watch-video"><i class="bi bi-play-circle"></i><span></span></a>
                </div>
            </div>
        @endforeach
    </section><!-- End Hero -->
    <div class="m-5">
        <h4 class="mt-5">Chart</h4>

    <canvas id="myChart" style="width:100%;max-width:600px"></canvas>

    <canvas id="myChart2" style="width:100%;max-width:600px"></canvas>

    <script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = ["red", "green","blue","orange","brown"];

    new Chart("myChart", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Harga Buah Tahun 2022"
        }
    }
    });
    </script>

<script>
    var xValues = ["Italy", "France", "Spain", "USA", "Argentina"];
    var yValues = [55, 49, 44, 24, 15];
    var barColors = ["red", "green","blue","orange","brown"];

    new Chart("myChart2", {
    type: "bar",
    data: {
        labels: xValues,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Harga Buah Tahun 2022"
        }
    }
    });
    </script>
    </div>
@endsection