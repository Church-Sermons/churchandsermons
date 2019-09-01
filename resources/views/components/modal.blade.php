<div id="modalContainer" class="custom-modal-container">
        <div class="columns">
            <div class="column {{ $col }}">
                <div class="card m-t-50">
                    <div class="card-header">
                        <h4 class="card-header-title">{{ $title }}</h4>
                        <span class="is-pulled-right m-t-10 m-r-5">
                            <button class="button is-danger is-small close is-rounded"><i class="fas fa-times"></i></button>
                        </span>
                    </div>
                    <div class="card-content">
                        {{ $slot }}
                    </div>
                </div>

            </div>
        </div>
    </div>
