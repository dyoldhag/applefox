@if($listOutlet)
  @foreach ($listOutlet as $index => $value)
    <div class="index">Redemption dates: <span>{{$index}}</span></div>
    @php $i = 0; @endphp
    <div class="row">
    @foreach ($value as $item)
    @php $i++; @endphp
      <div class="col-12 @if(count($value) > 1) col-md-6 @endif item @if($i%2==0) item2 @endif text-center text-md-left">{{$item}}</div>
    @endforeach
  </div>
  @endforeach
@endif