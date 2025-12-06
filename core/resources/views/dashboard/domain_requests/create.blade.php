<!-- column -->
<div class="col-sm-6 col-md-7">
    <div class="row-col">
        <div class="p-a-sm">
            <h6 class="m-b-0 m-t-sm"><i class="material-icons">
                    &#xe02e;</i> New Domain Request
            </h6>
        </div>
        <div class="row-row">
            <div class="row-body">
                <div class="row-inner">
                    <div class="padding p-y-sm ">
                        @if(Session::has('error'))
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert"
                                                aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        {{ Session::get('error') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form method="POST" action="{{ route("domainRequestsStore") }}" class="dashboard-form">
                            @csrf
                            <!-- fields -->
                            <div class="form-horizontal">
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Domain</label>
                                    <div class="col-sm-9">
                                        <input type="text" autocomplete="off" name="domain" id="domain" value="" required placeholder="example.com" class="form-control"/>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 form-control-label">Username</label>
                                    <div class="col-sm-9">
                                        <input type="hidden" name="username" id="username" value="{{ getTenantPrefix() }}"/>
                                        <input type="text" value="{{ getTenantPrefix() }}" class="form-control" disabled/>
                                        <small class="text-muted">This field is automatically filled</small>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-offset-3 col-sm-9">
                                        <button type="submit" class="btn btn-primary"><i
                                                class="material-icons">
                                                &#xe31b;</i> Submit Request</button>
                                    </div>
                                </div>

                            </div>
                            <!-- / fields -->
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /column -->

