<div class="media">
    <img src="{{ $image }}" alt="{{ "{$title}-Logo" }}" class="mr-2" width="100" height="100">
    <div class="media-body">
        <h4 class="text-capitalize mb-0 font-weight-bold">{{ $title }}</h4>
        <p class="my-1 lead">{{ $description }}</p>
        <h4 class="mini-texts text-muted">
            <span>{{ $message->created_at?__("Published ").$message->created_at->diffForHumans():null }}</span>
        </h4>
        {{ $slot }}
    </div>
</div>
