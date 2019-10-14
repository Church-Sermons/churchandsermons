<div class="modal fade" tab-index="-1" role="dialog" id="generalModal">
        <div class="modal-dialog @if($size) {{ $size }} @endif" role="document">
            <div class="modal-content">
                @if ($header)
                    <div class="modal-header">
                        <h4 class="font-weight-bold">{{ $title }}</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true"><i class="fas fa-times"></i></span>
                        </button>
                    </div>
                @endif
                <div class="modal-body">
                    <div class="card-body py-4">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </div>
