<div class="modal fade" tab-index="-1" role="dialog" id="categoryModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="font-weight-bold">{{ $title }}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <div class="card-body py-4">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
</div>
