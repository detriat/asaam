@extends('layouts.master')

@section('title', $title)

@section('extra-css')
    <script>loadCSS( "/libs/owl-carousel/owl.carousel.min.css", false, "all" );</script>
    <script>loadCSS( "/libs/owl-carousel/owl.theme.default.min.css", false, "all" );</script>
@endsection

@section('content')

    @if (count($winners) > 0)
        <div class="child-page-content">
            <h1 class="title-page">{{$title}}</h1>

            <div class="child-page-content__text scroll-line">
                <p>
                    Значимость этих проблем настолько очевидна, что реализация намеченных плановых заданий требуют определения и уточнения направлений прогрессивного развития. Товарищи! консультация с широким активом способствует подготовки и реализации соответствующий условий активизации.
                </p>
            </div>

        </div>
        <div class="before-winner-carousel">
            <div class="winners-carousel">
                <div class="owl-carousel">
                    @foreach($winners as $winner)
                        <div>
                            <a href="{{$winner['network_profile']}}" class="owl-winner">
                                <span class="owl-winner__avatar" style="background-image: url('{{$winner['photo']}}');"></span>
                                <span class="owl-winner__name">{{$winner->getFullName()}}</span>
                                <span class="owl-winner_city">{{$winner['city']}}</span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="child-page-content">
            <h1 class="title-page">Победителей не найдено</h1>
        </div>
    @endif

@endsection

@if (count($winners) > 0 )
    @section('extra-scripts')
        <script src="/libs/owl-carousel/owl.carousel.min.js"></script>
        <script>
            $(document).ready(function () {
                $('.owl-carousel').owlCarousel({
                    margin: 50,
                    nav: true,
                    navText: ['', ''],
                    loop: true,
                    mouseDrag: false,
                    autoplay: true,
                    responsive: {
                        320: {
                            items: 1
                        },
                        640: {
                            items: 2
                        },
                        992: {
                            items: 3
                        },
                        1200: {
                            items: 4
                        }
                    }
                });
            });
        </script>
    @endsection
@endif