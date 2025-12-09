@extends('dashboard.layouts.master')
@section('title', 'Domain Requests')
@section('content')
    <div class="padding">
        <div>
            <div class="row">
                <div class="col-12">
                    @if ($DomainRequest)
                        <!-- Domain Request Info Card -->
                        <div class="b-a p-a-md m-b-md">
                            <h5 class="m-b-md">
                                <i class="material-icons">&#xe894;</i> {{ __('backend.yourDomainRequest') }}
                            </h5>
                            <div class="b-a p-a-md m-b-md">
                                <h5 class="m-b-md">
                                    <i class="fa fa-globe text-primary"></i>
                                    {{ $DomainRequest->domain }}
                                </h5>
                                <div class="m-b-md">
                                    <strong>{{ __('backend.status') }}:</strong>
                                    @if ($DomainRequest->status == 1)
                                        <span class="label label-success">
                                            <i class="fa fa-check-circle"></i> {{ __('backend.active') }}
                                        </span>
                                    @elseif($DomainRequest->status == 0)
                                        <span class="label label-warning">
                                            <i class="fa fa-clock"></i> {{ __('backend.pending') }}
                                        </span>
                                    @else
                                        <span class="label label-danger">
                                            <i class="fa fa-times-circle"></i> {{ __('backend.inactive') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @else
                        <!-- No Domain Request - Show Create Form -->
                        @include('dashboard.domain_requests.create')
                    @endif

                    <!-- Name Server Instructions - Always Visible -->
                    <div class="b-a b-primary p-a-md m-t-md" style="background-color: #f0f8ff;">
                        <h6 class="text-primary m-b-md">
                            <i class="fa fa-info-circle"></i>
                            {{ __('backend.howToConnectYourDomain') }}
                        </h6>
                        <p class="m-b-md">
                            <strong>{{ __('backend.changeNameServerRecords') }}</strong>
                        </p>
                        <ol class="m-b-md" style="padding-left: 20px;">
                            <li class="m-b-sm">{{ __('backend.loginToGoDaddy') }}</li>
                            <li class="m-b-sm">{{ __('backend.goToDomainManagement') }}</li>
                            <li class="m-b-sm">{{ __('backend.deleteNameServerRecords') }}</li>
                        </ol>
                        <div class="b-a p-a-md m-b-md" style="background-color: #fff;">
                            <code style="font-size: 16px; color: #3164F5;">
                                ns1.dns-parking.com<br>
                                ns2.dns-parking.com
                            </code>
                        </div>
                        <div class="alert alert-info m-b-0">
                            <i class="fa fa-clock-o"></i>
                            <strong>{{ __('backend.note') }}:</strong> {{ __('backend.domainConnectionNote') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .app-footer {
            display: none;
        }

        code {
            display: block;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 4px;
            font-family: 'Courier New', monospace;
        }
    </style>
@endsection
