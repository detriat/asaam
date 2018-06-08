<div id="animations" style="display: none">
    @for ($i = 0; $i < 255; $i++)
        @if ($i < 10)
            <img src="/img/elefant/mobile/rgb/rgb_00000_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/mobile/rgb/rgb_00000_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/mobile/rgb/rgb_00000_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>

<div id="animations_a" style="display: none">
    @for ($i = 0; $i < 255; $i++)
        @if ($i < 10)
            <img src="/img/elefant/mobile/alpha/Alpha_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/mobile/alpha/Alpha_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/mobile/alpha/Alpha_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>