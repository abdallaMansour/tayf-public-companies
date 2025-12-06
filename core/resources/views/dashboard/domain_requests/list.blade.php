@extends('dashboard.layouts.master')
@section('title', 'Domain Requests')
@section('content')
    <div class="padding">
        <div class="app-body-inner">
            <div class="row-col row-col-xs">
                <!-- column -->
                <div class="col-sm-4 col-md-3 bg b-r">
                    <div class="row-col">
                        <div class="p-a-xs b-b">
                            <form method="POST" action="{{ route("domainRequestsSearch") }}" class="dashboard-form">
                                @csrf
                                <div class="input-group">
                                    <input type="text" style="width: 85%" name="q" required value="{{ $search_word }}"
                                           class="form-control no-border no-bg"
                                           placeholder="Search Domain Requests">

                                    <button type="submit" style="padding-top: 10px;"
                                            class="input-group-addon no-border no-shadow no-bg pull-left"><i
                                            class="fa fa-search"></i>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="row-row">
                            <div class="row-body scrollable hover">
                                <div class="row-inner">
                                    <div class="list inset">

                                        @foreach($DomainRequests as $DomainRequest)
                                            <div class="list-item">
                                                <div class="list-left">
                                                    <span class="w-40 avatar">
                                                        <i class="material-icons" style="font-size: 24px; padding: 8px;">&#xe894;</i>
                                                    </span>
                                                </div>
                                                <div class="list-body">
                                                    {{ $DomainRequest->domain }}
                                                    <small class="block">
                                                        <span dir="ltr">
                                                            <i class="fa fa-user m-r-sm text-muted"></i> {{ $DomainRequest->username }}
                                                            <br>
                                                            @if($DomainRequest->status == 1)
                                                                <span class="label label-sm success">Active</span>
                                                            @elseif($DomainRequest->status == 0)
                                                                <span class="label label-sm warn">Pending</span>
                                                            @else
                                                                <span class="label label-sm danger">Inactive</span>
                                                            @endif
                                                        </span>
                                                    </small>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                        @if($DomainRequests->total() > config('smartend.backend_pagination'))
                            <div class="p-a b-t text-center">
                                {!! $DomainRequests->links() !!}
                            </div>
                        @endif
                    </div>
                </div>
                <!-- /column -->

                @include('dashboard.domain_requests.create')

            </div>
        </div>
    </div>
    <style>
        .app-footer {
            display: none;
        }
    </style>
@endsection

