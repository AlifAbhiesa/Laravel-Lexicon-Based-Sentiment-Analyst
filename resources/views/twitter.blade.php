<!DOCTYPE html>
<html>
<body>
    <form action="{{route('twitter')}}" method="POST">
        @csrf
        <input type="text" name="username">
        <button type="submit">Submit</button>
    </form>

    @if(!empty($response))
        @foreach ($response as $res)
            <li> {{$res->text}} - Positive : {{$res->pos}} Netral : {{$res->neu}} Negative : {{$res->neg}}</li>  
            {{-- <li> {{$res->text}} - Positive : {{$res->pos}}</li>     --}}
        @endforeach
    @endif
</body>
</html>
