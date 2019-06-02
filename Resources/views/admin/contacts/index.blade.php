@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('contact::contacts.title.contacts') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('contact::contacts.title.contacts') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 col-sm-12 col-lg-12">

            <div class="box box-primary">
                <div class="box-header">

                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row mailbox-wrapper">
                        <div class="col-md-3">
                            <div class="content-box nav-list mrg15B">
                                <div class="pad10A"> <span class="btn btn-success btn-lg btn-block" style="cursor:unset!important">
							<a href="{{route('admin.contact.contact.index')}}">İletişim Formu</a>
						</span> </div>
                                <div class="list-group">
                                    <a href="javascript:void(0);"  id="filter_" class="list-group-item" valuex="" title=""> <i class="glyph-icon font-gray icon-inbox"></i> Hepsini Goster <span class="badge bg-blue"></span> </a>
                                    @foreach ($filtered_value as $f)
                                        <a href="javascript:void(0);"  id="filter_{{$f['ID']}}" valuex="{{$f['ID']}}" class="list-group-item" title=""> <i class="glyph-icon font-gray icon-inbox"></i> {{$f["SUBJECT"]}} <span class="badge bg-blue">{{$f["NUMBER"]}}</span> </a>
                                    @endforeach

                                          </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="content-box">

                                <div class="mail-toolbar clearfix">
                                    {!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'table-id'],true) !!}

                                   
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>

@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')

@stop

@section('scripts')
    <script type="text/javascript">
        $( document ).ready(function() {

        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@stop
