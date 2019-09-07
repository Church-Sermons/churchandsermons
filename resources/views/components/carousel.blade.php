<div id="appCarousel" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @foreach ($slides as $slide)
            <li data-target="#appCarousel" data-slide-to="{{ $loop->index }}" class="@if($loop->first) active @endif"></li>
        @endforeach
    </ol>
    <div class="carousel-inner">
        @foreach ($slides as $slide)
            <div class="carousel-item @if($loop->first) active @endif">
                <img src="{{ $slide->getUrl() }}" class="d-block w-100" alt="{{ $slide->name }}">
                <div class="carousel-caption d-none d-md-block">
                    <h3 class="card-title font-weight-bold text-capitalize">{{ $slide->name }}</h3>
                    <p class="card-text">
                        Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aperiam enim expedita ex adipisci nihil suscipit dolore unde ab veniam quisquam?
                    </p>
                </div>
            </div>
        @endforeach
    </div>

    <a class="carousel-control-prev carousel-control" href="#appCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next carousel-control" href="#appCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>


