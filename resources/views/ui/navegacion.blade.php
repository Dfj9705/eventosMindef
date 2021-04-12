<div class="row justify-content-end">
    @if (!Request::is('eventos/nuevo'))
        <div class="col-2">
            <a href="{{route('eventos.create')}}" class="btn btn-success btn-block">
                <i class="fas fa-plus-circle mr-2"></i>
                Nuevo
            </a>
        </div>

    @endif
    @if (!Request::is('eventos'))
        <div class="col-2">
            <a href="{{route('eventos.index')}}" class="btn btn-dark btn-block">
                <i class="fas fa-list mr-2"></i>
                Ver todos
            </a>
        </div>

    @endif
</div>
