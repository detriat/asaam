<div id="animations">
    @for ($i = 0; $i < 201; $i++)
        @if ($i < 10)
            <img src="/img/elefant/SLON.RGB_color_0000{{$i}}.png" alt="" class="frame{{$i}}">
        @elseif ($i < 100)
            <img src="/img/elefant/SLON.RGB_color_000{{$i}}.png" alt="" class="frame{{$i}}">
        @else
            <img src="/img/elefant/SLON.RGB_color_00{{$i}}.png" alt="" class="frame{{$i}}">
        @endif
    @endfor
</div>