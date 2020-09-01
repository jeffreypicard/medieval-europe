@foreach ($sheets as $key => $val)
    {{-- echo html ::stylesheet('media/css/'.$key, $val, FALSE); --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('media/css'.$key) }}" />'
@endforeach
@yield('content')
