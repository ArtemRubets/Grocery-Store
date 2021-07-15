@if(session('setDefaultStatus'))
    <div
        class="alert @if(session('setDefaultError'))alert-danger @else alert-success @endif alert-dismissible"
        role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button>
        {{ session('setDefaultStatus') }}
    </div>
@endif

@if(session('add_currency_message'))
    <div
        class="alert @if(session('flash_error'))alert-danger @else alert-success @endif alert-dismissible"
        role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button>
        {{ session('add_currency_message') }}
    </div>
@endif

@if(session('destroy_currency_message'))
    <div
        class="alert @if(session('flash_error'))alert-danger @else alert-success @endif alert-dismissible"
        role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                aria-hidden="true">&times;</span>
        </button>
        {{ session('destroy_currency_message') }}
    </div>
@endif
