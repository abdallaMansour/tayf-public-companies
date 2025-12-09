<div class="b-a p-a-md m-b-md">
    <h5 class="m-b-md">
        <i class="material-icons">&#xe02e;</i> {{ __('backend.newDomainRequest') }}
    </h5>
    
    @if(Session::has('error'))
        <div class="alert alert-danger m-b-md">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
            </button>
            {{ Session::get('error') }}
        </div>
    @endif
    
    <form method="POST" action="{{ route("domainRequestsStore") }}" class="dashboard-form">
        @csrf
        <div class="form-horizontal">
            <div class="form-group row">
                <label class="col-sm-3 form-control-label">{{ __('backend.domain') }}</label>
                <div class="col-sm-9">
                    <input type="text" autocomplete="off" name="domain" id="domain" value="" required placeholder="example.com" class="form-control"/>
                </div>
            </div>
            <input type="hidden" name="username" id="username" value="{{ getTenantPrefix() }}"/>
            <div class="form-group row">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-primary">
                        <i class="material-icons">&#xe31b;</i> {{ __('backend.submitRequest') }}
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

