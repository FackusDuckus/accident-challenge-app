<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}

    @foreach($permissions as $p)
        <p>{{ $p->id }}. {{ $p->name }}</p>
    @endforeach

    @foreach($roles as $p)
        <p>{{ $p->id }}. {{ $p->name }}</p>
    @endforeach


</div>
