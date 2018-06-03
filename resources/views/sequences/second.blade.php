<div id="animations" style="display: none">
    @for ($i = 0; $i < 72; $i++)
        @if ($i < 10)
            <img src="/img/elefant/rgb_3/rgb_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/rgb_3/rgb_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/rgb_3/rgb_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>

<div id="animations_a" style="display: none">
    @for ($i = 0; $i < 72; $i++)
        @if ($i < 10)
            <img src="/img/elefant/alpha_3/alpha_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/alpha_3/alpha_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/alpha_3/alpha_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>