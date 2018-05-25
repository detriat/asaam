<div id="animations" style="display: none">
    @for ($i = 0; $i < 201; $i++)
        @if ($i < 10)
            <img src="/img/elefant/rgb/SLON.RGB_color_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/rgb/SLON.RGB_color_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/rgb/SLON.RGB_color_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>

<div id="animations_a" style="display: none">
    @for ($i = 40; $i < 240; $i++)
        @if ($i < 100)
            <img src="/img/elefant/alpha/SLON.Alpha.00{{$i}}.jpg" alt="" class="frame{{$i - 40}}">
        @else
            <img src="/img/elefant/alpha/SLON.Alpha.0{{$i}}.jpg" alt="" class="frame{{$i - 40}}">
        @endif
    @endfor
</div>