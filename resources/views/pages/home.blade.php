@extends('layouts.master')

@section('title', $title)

@section('content')
    <div class="work_zone bottom-box-effect">
        <div id="container">
            <div class="tracking">
                <video id="video" autoplay muted crossOrigin="anonymous" webkit-playsinline style="visibility:visible;"></video>
            </div>
            <div class="gif-position"></div>
            <div class="elefant" id="e_screen"><img src="/img/elefant/1.png" alt="" id="elefant"></div>
            <div id="results"></div>
        </div>
        <div class="btn snapshot-btn" onclick="take_snapshot()">Сделать снимок</div>
        <div class="snapshot-form">
            <div class="btn continue-stream" onclick="clearResults()">Сделать ещё раз</div>
            <a href="#" class="btn" id="uploadBase64Image">Далее</a>
        </div>
    </div>

    <div id="animations">
        <img src="/img/elefant/1.png" alt="" class="frame1">
        <img src="/img/elefant/2.png" alt="" class="frame2">
        <img src="/img/elefant/3.png" alt="" class="frame3">
        <img src="/img/elefant/4.png" alt="" class="frame4">
        <img src="/img/elefant/5.png" alt="" class="frame5">
        <img src="/img/elefant/6.png" alt="" class="frame6">
        <img src="/img/elefant/7.png" alt="" class="frame7">
        <img src="/img/elefant/8.png" alt="" class="frame8">
        <img src="/img/elefant/9.png" alt="" class="frame9">
        <img src="/img/elefant/10.png" alt="" class="frame10">
        <img src="/img/elefant/11.png" alt="" class="frame11">
        <img src="/img/elefant/12.png" alt="" class="frame12">
        <img src="/img/elefant/13.png" alt="" class="frame13">
        <img src="/img/elefant/14.png" alt="" class="frame14">
        <img src="/img/elefant/15.png" alt="" class="frame15">
        <img src="/img/elefant/16.png" alt="" class="frame16">
        <img src="/img/elefant/17.png" alt="" class="frame17">
        <img src="/img/elefant/18.png" alt="" class="frame18">
        <img src="/img/elefant/19.png" alt="" class="frame19">
        <img src="/img/elefant/20.png" alt="" class="frame20">
        <img src="/img/elefant/21.png" alt="" class="frame21">
        <img src="/img/elefant/22.png" alt="" class="frame22">
        <img src="/img/elefant/23.png" alt="" class="frame23">
        <img src="/img/elefant/24.png" alt="" class="frame24">
        <img src="/img/elefant/25.png" alt="" class="frame25">
        <img src="/img/elefant/26.png" alt="" class="frame26">
        <img src="/img/elefant/27.png" alt="" class="frame27">
        <img src="/img/elefant/28.png" alt="" class="frame28">
        <img src="/img/elefant/29.png" alt="" class="frame29">
        <img src="/img/elefant/30.png" alt="" class="frame30">
        <img src="/img/elefant/31.png" alt="" class="frame31">
        <img src="/img/elefant/32.png" alt="" class="frame32">
        <img src="/img/elefant/33.png" alt="" class="frame33">
        <img src="/img/elefant/34.png" alt="" class="frame34">
        <img src="/img/elefant/35.png" alt="" class="frame35">
        <img src="/img/elefant/35.png" alt="" class="frame35">
        <img src="/img/elefant/35.png" alt="" class="frame35">
        <img src="/img/elefant/36.png" alt="" class="frame36">
        <img src="/img/elefant/37.png" alt="" class="frame37">
        <img src="/img/elefant/38.png" alt="" class="frame38">
        <img src="/img/elefant/39.png" alt="" class="frame39">
        <img src="/img/elefant/40.png" alt="" class="frame40">
        <img src="/img/elefant/41.png" alt="" class="frame41">
        <img src="/img/elefant/42.png" alt="" class="frame42">
        <img src="/img/elefant/43.png" alt="" class="frame43">
        <img src="/img/elefant/44.png" alt="" class="frame44">
        <img src="/img/elefant/45.png" alt="" class="frame45">
        <img src="/img/elefant/46.png" alt="" class="frame46">
        <img src="/img/elefant/47.png" alt="" class="frame47">
        <img src="/img/elefant/48.png" alt="" class="frame48">
        <img src="/img/elefant/49.png" alt="" class="frame49">
        <img src="/img/elefant/50.png" alt="" class="frame50">
        <img src="/img/elefant/51.png" alt="" class="frame51">
        <img src="/img/elefant/52.png" alt="" class="frame52">
        <img src="/img/elefant/53.png" alt="" class="frame53">
        <img src="/img/elefant/54.png" alt="" class="frame54">
        <img src="/img/elefant/55.png" alt="" class="frame55">
        <img src="/img/elefant/56.png" alt="" class="frame56">
        <img src="/img/elefant/57.png" alt="" class="frame57">
        <img src="/img/elefant/58.png" alt="" class="frame58">
        <img src="/img/elefant/59.png" alt="" class="frame59">
        <img src="/img/elefant/60.png" alt="" class="frame60">

        <img src="/img/elefant/61.png" alt="" class="frame61">
        <img src="/img/elefant/62.png" alt="" class="frame62">
        <img src="/img/elefant/63.png" alt="" class="frame63">
        <img src="/img/elefant/64.png" alt="" class="frame64">
        <img src="/img/elefant/65.png" alt="" class="frame65">
        <img src="/img/elefant/66.png" alt="" class="frame66">
        <img src="/img/elefant/67.png" alt="" class="frame67">
        <img src="/img/elefant/68.png" alt="" class="frame68">
        <img src="/img/elefant/69.png" alt="" class="frame69">
        <img src="/img/elefant/70.png" alt="" class="frame70">
        <img src="/img/elefant/71.png" alt="" class="frame71">
        <img src="/img/elefant/72.png" alt="" class="frame72">
        <img src="/img/elefant/73.png" alt="" class="frame73">
        <img src="/img/elefant/74.png" alt="" class="frame74">
        <img src="/img/elefant/75.png" alt="" class="frame75">
        <img src="/img/elefant/76.png" alt="" class="frame76">
        <img src="/img/elefant/77.png" alt="" class="frame77">
        <img src="/img/elefant/78.png" alt="" class="frame78">
        <img src="/img/elefant/79.png" alt="" class="frame79">
        <img src="/img/elefant/80.png" alt="" class="frame80">
        <img src="/img/elefant/81.png" alt="" class="frame81">
        <img src="/img/elefant/82.png" alt="" class="frame82">
        <img src="/img/elefant/83.png" alt="" class="frame83">
        <img src="/img/elefant/84.png" alt="" class="frame84">
        <img src="/img/elefant/85.png" alt="" class="frame85">
        <img src="/img/elefant/86.png" alt="" class="frame86">
        <img src="/img/elefant/87.png" alt="" class="frame87">
        <img src="/img/elefant/88.png" alt="" class="frame88">
        <img src="/img/elefant/89.png" alt="" class="frame89">
        <img src="/img/elefant/90.png" alt="" class="frame90">
        <img src="/img/elefant/91.png" alt="" class="frame91">
        <img src="/img/elefant/92.png" alt="" class="frame92">
        <img src="/img/elefant/93.png" alt="" class="frame93">
        <img src="/img/elefant/94.png" alt="" class="frame94">
        <img src="/img/elefant/95.png" alt="" class="frame95">
        <img src="/img/elefant/96.png" alt="" class="frame96">
        <img src="/img/elefant/97.png" alt="" class="frame97">
        <img src="/img/elefant/98.png" alt="" class="frame98">
        <img src="/img/elefant/99.png" alt="" class="frame99">
        <img src="/img/elefant/100.png" alt="" class="frame100">
        <img src="/img/elefant/101.png" alt="" class="frame101">
        <img src="/img/elefant/102.png" alt="" class="frame102">
        <img src="/img/elefant/103.png" alt="" class="frame103">
        <img src="/img/elefant/104.png" alt="" class="frame104">
        <img src="/img/elefant/105.png" alt="" class="frame105">
        <img src="/img/elefant/106.png" alt="" class="frame106">
        <img src="/img/elefant/107.png" alt="" class="frame107">
        <img src="/img/elefant/108.png" alt="" class="frame108">
        <img src="/img/elefant/109.png" alt="" class="frame109">
        <img src="/img/elefant/110.png" alt="" class="frame110">
        <img src="/img/elefant/111.png" alt="" class="frame111">
        <img src="/img/elefant/112.png" alt="" class="frame112">
        <img src="/img/elefant/113.png" alt="" class="frame113">
        <img src="/img/elefant/114.png" alt="" class="frame114">
        <img src="/img/elefant/115.png" alt="" class="frame115">
        <img src="/img/elefant/116.png" alt="" class="frame116">
        <img src="/img/elefant/117.png" alt="" class="frame117">
        <img src="/img/elefant/118.png" alt="" class="frame118">
        <img src="/img/elefant/119.png" alt="" class="frame119">
        <img src="/img/elefant/120.png" alt="" class="frame120">

        <img src="/img/elefant/121.png" alt="" class="frame121">
        <img src="/img/elefant/122.png" alt="" class="frame122">
        <img src="/img/elefant/123.png" alt="" class="frame123">
        <img src="/img/elefant/124.png" alt="" class="frame124">
        <img src="/img/elefant/125.png" alt="" class="frame125">
        <img src="/img/elefant/126.png" alt="" class="frame126">
        <img src="/img/elefant/127.png" alt="" class="frame127">
        <img src="/img/elefant/128.png" alt="" class="frame128">
        <img src="/img/elefant/129.png" alt="" class="frame129">
        <img src="/img/elefant/130.png" alt="" class="frame130">
        <img src="/img/elefant/131.png" alt="" class="frame131">
        <img src="/img/elefant/132.png" alt="" class="frame132">
        <img src="/img/elefant/133.png" alt="" class="frame133">
        <img src="/img/elefant/134.png" alt="" class="frame134">
        <img src="/img/elefant/135.png" alt="" class="frame135">
        <img src="/img/elefant/136.png" alt="" class="frame136">
        <img src="/img/elefant/137.png" alt="" class="frame137">
        <img src="/img/elefant/138.png" alt="" class="frame138">
        <img src="/img/elefant/139.png" alt="" class="frame139">
        <img src="/img/elefant/140.png" alt="" class="frame140">
        <img src="/img/elefant/141.png" alt="" class="frame141">
        <img src="/img/elefant/142.png" alt="" class="frame142">
        <img src="/img/elefant/143.png" alt="" class="frame143">
        <img src="/img/elefant/144.png" alt="" class="frame144">
        <img src="/img/elefant/145.png" alt="" class="frame145">
        <img src="/img/elefant/146.png" alt="" class="frame146">
        <img src="/img/elefant/147.png" alt="" class="frame147">
        <img src="/img/elefant/148.png" alt="" class="frame148">
        <img src="/img/elefant/149.png" alt="" class="frame149">
        <img src="/img/elefant/150.png" alt="" class="frame150">
        <img src="/img/elefant/151.png" alt="" class="frame151">
        <img src="/img/elefant/152.png" alt="" class="frame152">
        <img src="/img/elefant/153.png" alt="" class="frame153">
        <img src="/img/elefant/154.png" alt="" class="frame154">
        <img src="/img/elefant/155.png" alt="" class="frame155">
        <img src="/img/elefant/156.png" alt="" class="frame156">
        <img src="/img/elefant/157.png" alt="" class="frame157">
        <img src="/img/elefant/158.png" alt="" class="frame158">
        <img src="/img/elefant/159.png" alt="" class="frame159">
        <img src="/img/elefant/160.png" alt="" class="frame160">
        <img src="/img/elefant/161.png" alt="" class="frame161">
        <img src="/img/elefant/162.png" alt="" class="frame162">
        <img src="/img/elefant/163.png" alt="" class="frame163">
        <img src="/img/elefant/164.png" alt="" class="frame164">
        <img src="/img/elefant/165.png" alt="" class="frame165">
        <img src="/img/elefant/166.png" alt="" class="frame166">
        <img src="/img/elefant/167.png" alt="" class="frame167">
        <img src="/img/elefant/168.png" alt="" class="frame168">
        <img src="/img/elefant/169.png" alt="" class="frame169">
        <img src="/img/elefant/170.png" alt="" class="frame170">
        <img src="/img/elefant/171.png" alt="" class="frame171">
        <img src="/img/elefant/172.png" alt="" class="frame172">
        <img src="/img/elefant/173.png" alt="" class="frame173">
        <img src="/img/elefant/174.png" alt="" class="frame174">
        <img src="/img/elefant/175.png" alt="" class="frame175">
        <img src="/img/elefant/176.png" alt="" class="frame176">
        <img src="/img/elefant/177.png" alt="" class="frame177">
        <img src="/img/elefant/178.png" alt="" class="frame178">
        <img src="/img/elefant/179.png" alt="" class="frame179">
        <img src="/img/elefant/180.png" alt="" class="frame180">
        <img src="/img/elefant/181.png" alt="" class="frame181">
        <img src="/img/elefant/182.png" alt="" class="frame182">
        <img src="/img/elefant/183.png" alt="" class="frame183">
        <img src="/img/elefant/184.png" alt="" class="frame184">
        <img src="/img/elefant/185.png" alt="" class="frame185">
        <img src="/img/elefant/186.png" alt="" class="frame186">
        <img src="/img/elefant/187.png" alt="" class="frame187">


    </div>
@endsection

@section('overlay')
    <div class="overlay" id="startStream">
        <div class="window-confirm">
            <div class="confirm-title">Подключить web-камеру устройства?</div>
            <div class="confirm-btns">
                <a href="#startStream" class="btn confirm-btn confirmation-confirm" data-action="start-stream">Да</a>
                <a href="#startStream" class="btn confirm-btn cancel-confirm">Нет</a>
            </div>
        </div>
    </div>

    <div class="overlay" id="warningNotice">
        <div class="window-confirm">
            <div class="confirm-title"></div>
            <div class="confirm-btns">
                <a href="#warningNotice" class="btn confirm-btn confirmation-confirm" data-action="read-notice">Хорошо</a>
            </div>
        </div>
    </div>

    <div class="overlay" id="confirmAction">
        <div class="window-confirm">
            <div class="confirm-title">Вы уверены?</div>
            <div class="confirm-btns">
                <a href="#confirmAction" class="btn confirm-btn confirmation-confirm" data-action="confirm-action">Да</a>
                <a href="#confirmAction" class="btn confirm-btn cancel-confirm">Нет</a>
            </div>
        </div>
    </div>
@endsection

@section('extra-scripts')
    <script src="/libs/html2canvas/html2canvas.min.js"></script>
    <script src="/js/webcam.min.js"></script>
    <script src="/js/main.js"></script>
    <script>
        $(document).ready(function () {
            $('#uploadBase64Image').click(function (e) {
                e.preventDefault();
                e.stopPropagation();

                var $this = $(this);
                var href  = $this.attr('href');
                var base64Image = $('#results').find('img').attr('src');

                $.post('{{action('ImageEditor@uploadBase64Image')}}', {
                    base64Image: base64Image
                }, function (res) {

                    if (res['redirect']){
                        window.location = res['redirect'];
                    }

                    if (res['error']){
                        showWarningNotice(res['error']);
                    }

                });
            });


            $(window).resize(function () {
                resizeVideo();
            });
        });

    </script>
@endsection