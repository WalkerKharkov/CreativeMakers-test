@extends('layouts.master')

@section('styles')
    <link href="{{ asset('assets/web/css/test.css')}}" rel="stylesheet" type="text/css">
@stop

@section('content')
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-8">
                <table class="table table-bordered table-striped table-hover dataTable">
                    <thead>
                    <tr>
                        <th>{!! trans("icon") !!}</th>
                        <th>{!! trans("date") !!}</th>
                        <th>{!! trans("name") !!}</th>
                        <th>{!! trans("phone") !!}</th>
                        <th>{!! trans("email") !!}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($leads as $lead)
                            <tr class="testTableRow" data_id="{!! $lead->id !!}">
                                <td></td>
                                <td data-lead="date">{!! $lead->date !!}</td>
                                <td data-lead="name">{!! $lead->name !!}</td>
                                <td data-lead="phone">{!! $lead->phone !!}</td>
                                <td data-lead="email">{!! $lead->email !!}</td>
                            </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <div id="lead_info" class="row col-md-4 result-table">
                <table class="table table-bordered table-striped table-hover query-table">
                    <tr>
                        <th>{!! trans("icon") !!}</th><td> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("date") !!}</th><td class="data-lead" data-lead="date"> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("name") !!}</th><td class="data-lead" data-lead="name"> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("phone") !!}</th><td class="data-lead" data-lead="phone"> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("email") !!}</th><td class="data-lead" data-lead="email"> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("Radio") !!}</th><td class="data-lead" data-lead="radio"> </td>
                    </tr>
                    <tr>
                        <th>{!! trans("Checkbox") !!}</th><td class="data-lead" data-lead="checkbox"> </td>
                    </tr>
                </table>
                <button class="btn btn-primary test-table-close">Close</button>
            </div>

        </div>

        </div>
    </div>

@stop

@section('scripts')
    <script type="text/javascript" src="{{ asset('assets/web/js/test.js') }}"></script>
@stop