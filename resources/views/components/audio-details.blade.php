<div class="container pt-3">
    <div class="row">
        <div class="col-md-2 pr-1">
            <img src="{{ $albumArt }}" alt="placeholder-image" class="rounded w-100" height="80"/>
        </div>

        <div class="col-md-8 pl-2">
            <h4 id="title" class="font-weight-bold text-capitalize">{{ $title }}</h4>
            <h5 id="artist" class="text-capitalize">{{ $artist }}</h5>
            <h6 id="size" class="text-uppercase text-muted">{{ $size }}</h6>
        </div>
        <div class="col-md-2 text-center">
            {{-- <span class="spinner-grow text-success"></span> --}}
        </div>
    </div>

</div>



