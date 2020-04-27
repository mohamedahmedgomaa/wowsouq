@for($i= 1; $i <= 5;$i++)
    <i class="fa fa-star{{$rate >= $i?'':'-o'}}"></i>
@endfor
