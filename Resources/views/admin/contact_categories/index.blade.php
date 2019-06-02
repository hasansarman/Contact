@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('contact::contacts.title.contact_categories') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('contact::contacts.title.contact_categories') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">

            <div class="box box-primary">
                <div class="box-header">
                    {!! Form::open(['route' => ['admin.contact.contact_categories.store'], 'method' => 'post','id'=>'tempo_form']) !!}
                    <div class="row">
                        <div class="col-md-12">
                            <div class="nav-tabs-custom">

                                {!! Form::normalInput('SUBJECT', trans('contact::contact_categories.SUBJECT'), $errors) !!}

                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary btn-flat">{{ trans('core::core.button.create') }}</button>

                                </div>
                            </div>
                        </div> {{-- end nav-tabs-custom --}}
                    </div>
                </div>
                {!! Form::close() !!}
                </div>
            <script>
                $(document).ready(function(){
                    $('#tempo_form').validate({

                        rules: {
                            SUBJECT: {
                                minlength: 1,
                                required: true
                            }
                        },
                   
                    });
                });

            </script>
                <!-- /.box-header -->
                <div class="box-body">
                    {!! $dataTable->table(['class' => 'table table-bordered', 'id' => 'table-id'],true) !!}
  {!! $dataTable->scripts() !!}
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('contact::contacts.title.create contact') }}</dd>
    </dl>
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
