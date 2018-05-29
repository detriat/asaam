<div id="animations" style="display: none">
    @for ($i = 0; $i < 201; $i++)
        @if ($i < 10)
            <img src="/img/elefant/rgb/SLON_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/rgb/SLON_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/rgb/SLON_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>

<div id="animations_a" style="display: none">
    @for ($i = 0; $i < 201; $i++)
        @if ($i < 10)
            <img src="/img/elefant/alpha/Alpha_0000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/alpha/Alpha_000{{$i}}.jpg" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/alpha/Alpha_00{{$i}}.jpg" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>