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
@section('styles')
    <script src="/assets/akrep_assets/js/vendor/ckeditor/ckeditor.js"></script>

@stop
@section('content')
    <div class="row">
        <div class="col-xs-12 col-md-12 col-xs-12 col-lg-12">

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

                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="col-md-9">

                                <div class="content-box">
                                    <div class="mail-header clearfix">
                                        <div class="float-left">
                                            <span class="mail-title">RefID:
                                                @if ($contact->PARENT_ID==0)
                                                    {{$contact->CONTACT_ID}}

                                                @else
                                                   {{ $contact->PARENT_ID." // ".$contact->CONTAC_ID}}
                                                @endif</span>
                                        </div>
                                        <div class="float-right col-md-4 pad0A">
                                            <div class="input-group">
                                                <input class="form-control" type="text">
                                                <div class="input-group-btn">
                                                    <button type="button" class="btn btn-default" tabindex="-1">
                                                        <i class="glyph-icon icon-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="divider"></div>
                                    <div class="pad15A clearfix mrg10B">
                                        <div class="float-left"

                                        >
                                            <b <?php
                                            echo check_permission($currentUser,'contact.extra','NAME');
                                            ?>>{{$contact->NAME." ".$contact->SURNAME}}</b> <div<?php
                                            echo check_permission($currentUser,'contact.extra','EMAIL');
                                            ?>>({{$contact->EMAIL}})</div>
                                        </div>
                                        <div class="float-right opacity-80">
                                            <i class="glyph-icon icon-clock-o mrg5R"></i>
                                            {{$contact->IDATE}}
                                        </div>
                                    </div>
                                    <div class="mail-toolbar clearfix">
                                        <div class="float-left"
                                        <?php
                                        echo check_permission($currentUser,'contact.extra','SUBJECT');
                                        ?>>
                                            <h4>{{$contact->contact_subject->SUBJECT}}</h4>
                                        </div>
                                    </div>
                                    <div class="pad15A" style="word-wrap: break-word;" <?php
                                    echo check_permission($currentUser,'contact.extra','MESSAGE');
                                    ?>>
                                        {{$contact->MESSAGE}}
                                    </div>
                                    <div class="button-pane">
                                        <a href="javascript:void(0)" onclick="go_editor()" class="btn btn-blue-alt" title="Yanıtla">
                                            <i class="glyph-icon icon-mail-reply"></i>
                                            Yanıtla
                                        </a>
                                    </div>
                                    <div class="mail-toolbar clearfix">
                                        <div class="float-left">
                                            <h4>Konuşma Akışı</h4>
                                        </div>
                                    </div>
<?php $IS_ACTIVE=false;?>
                                    @foreach ($othermessages as $m)
                                        <?php
                                        if($m->IS_ACTIVE==0)
                                            $IS_ACTIVE=true;
                                        if (strpos($m->EMAIL, 'food.radonrad.com') !== false) {
                                           ?>

                                            <blockquote class="blockquote-reverse" style="border-style: inset; border-color:gray; border-width: 8px;" @if($m->IS_ACTIVE==0) disabled @endif>
                                                <h4
                                                <?php
                                                echo check_permission($currentUser,'contact.extra','SUBJECT');
                                                ?>
                                                >{{$m->contact_subject->SUBJECT}}</h4>
                                                <p>
                                                {{$m->MESSAGE}}
                                                </p>
                                                <footer>
                                                  <b <?php
                                                  echo check_permission($currentUser,'contact.extra','NAME');
                                                  ?>>{{$m->NAME." ".$m->SURNAME}}</b> <div<?php
                                                  echo check_permission($currentUser,'contact.extra','EMAIL');
                                                  ?>>({{$m->EMAIL}})</div>
                                                    <cite title="Source Title">{{$m->IDATE}}</cite></footer>

                                            </blockquote>
                                            <?php
                                        }
                                        else{?>
                                            <blockquote @if($m->IS_ACTIVE==0) disabled @endif>
                                                <h4
                                                <?php
                                                echo check_permission($currentUser,'contact.extra','SUBJECT');
                                                ?>>{{$m->contact_subject->SUBJECT}}</h4>
                                                <p>
                                                    {!! $m->MESSAGE !!}
                                                </p>
                                                <footer><b <?php
                                                echo check_permission($currentUser,'contact.extra','NAME');
                                                ?>>{{$m->NAME." ".$m->SURNAME}}</b> <div<?php
                                                echo check_permission($currentUser,'contact.extra','EMAIL');
                                                ?>>({{$m->EMAIL}})</div>
                                                    <cite title="Source Title">{{$m->IDATE}}</cite></footer>

                                            </blockquote>
                                       <?php }
                                        ?>

                                        <br/>


                                    @endforeach
<div @if($IS_ACTIVE) style="
" @endif>
                                    <div class="mail-toolbar clearfix">
                                        <div class="float-left">
                                            <h4>Cevap Yaz</h4>
                                        </div>
                                    </div>

                                    <div class="form-group" id="foofight">
                                        <textarea name="editor1" id="editor1" rows="50" cols="80"  >							</textarea>

                                    </div>

                                    <button type="button" onclick="ANSWER_MESSAGE({{$contact->CONTACT_ID}},{{$contact->CONTACT_ID}},{{$contact->CONTACT_SUBJECT_ID}})" style="width:100%;margin:20px 0" class="btn label-success"
                                      <?php
                                      echo check_permission($currentUser,'contact.extra','ANSWER');
                                      ?>
                                      >Gönder</button>


                                    <div class="button-pane"
                                    <?php
                                    echo check_permission($currentUser,'contact.extra','END');
                                    ?>
                                    >
                                        <a href="javascript:void(0);" onclick="END_SPEECH({{$contact->CONTACT_ID}},{{$contact->CONTACT_ID}},{{$contact->CONTACT_SUBJECT_ID}})" class="btn btn-default" title="Konuşmayı Sonlandır">
                                            Konuşmayı Sonlandır
                                            <i class="glyph-icon icon-paw"></i>
                                        </a>
                                    </div>

</div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
 <script type="text/javascript">
        $( document ).ready(function() {
            CKEDITOR.replace( 'editor1' );
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
                }
            });
        });
    </script>

    <script type="text/javascript">
        function go_editor(){

                $('html,body').animate({
                        scrollTop: $("#foofight").offset().top},
                    'slow');

        }
        $(function () {

        });
        function ANSWER_MESSAGE(parent_id,contact_id,contact_subject_id){
var text0=CKEDITOR.instances.editor1.getData();
            //alert("save "+textareas.id+"  "+textareas.value);
            $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                type: "POST",
                url: document.location.protocol +"//"+ document.location.hostname + document.location.pathname+"/send_me",
                data: {"parent_id": parent_id,
                    "contact_id" : contact_id,
                "text" :text0,
                "contact_subject_id":contact_subject_id},
                dataType: "text",
                cache:false,
                success:
                    function(data){
                        location.reload();


                    }
            });
        }
        function END_SPEECH(parent_id,contact_id,contact_subject_id){

            //alert("save "+textareas.id+"  "+textareas.value);
            $.ajax({
                beforeSend: function (xhr) {
                    var token = $('meta[name="csrf_token"]').attr('content');

                    if (token) {
                        return xhr.setRequestHeader('X-CSRF-TOKEN', token);
                    }
                },
                type: "POST",
                url: document.location.protocol +"//"+ document.location.hostname + document.location.pathname+"/end_me",
                data: {"parent_id": parent_id,
                    "contact_id" : contact_id,
                "contact_subject_id":contact_subject_id
                },
                dataType: "text",
                cache:false,
                success:
                    function(data){
                        window.location.href = '{{route('admin.contact.contact.index')}}';


                    }
            });
        }
    </script>
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')

@stop

@section('scripts')
   
@stop
