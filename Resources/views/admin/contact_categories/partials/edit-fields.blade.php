<div class="box-body">
    <p>
        {!! Form::normalInput('SUBJECT', trans('contact::contact_categories.SUBJECT'), $errors,$contact_categories) !!}
    </p>
</div>
<label>Oluşturulma Tarihi: <label id="idate">{{$contact_categories->IDATE}}</label></label>
<br/>
<label>Son Güncelleme: <label id="udate">{{$contact_categories->UDATE}}</label></label>
<br/>
<script>
    $(document).ready(function(){
        $('form').validate({

            rules: {
                SUBJECT: {
                    minlength: 1,
                    required: true
                }
            },
          
        });
    });

</script>
