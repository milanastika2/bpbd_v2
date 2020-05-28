@extends('dashboard')

@section('sub-title')
| Form Peserta
@stop


@section('content-title')
    Form Peserta | {{$event->judul_event}}

	<a href="{{url('peserta?id='.$event->id)}}" type="button" class="pull-right btn  btn-primary btn-flat"><i class="glyphicon glyphicon-arrow-left"></i> <b>Back</b> </a>
@stop

@section('style')



@stop

@section('content')

<div class="row">
    <div class="col-xs-10 col-xs-offset-1">
    		
        <div class="box box-info">
            <div class="box-header with-border">
                @include('errors.errors')
            </div>

            <form class="form-horizontal"  method="post" action="@if($model->exists) {{ route('peserta.update', $model->id) }} @else {{ route('peserta.store') }} @endif" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field($model->exists ? 'PUT' : 'POST')}}
                <div class="box-body">
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Nama <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="hidden" name="id_event" class="form-control" value="{{old('id_event', $event->id)}}"/>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" name="nama_peserta" class="form-control" value="{{old('nama_peserta', $model->nama_peserta)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Email <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="email_peserta" class="form-control" value="{{old('email_peserta', $model->email_peserta)}}"/>
                        </div>
                    </div> 
                    <div class="form-group">
                        <label class="col-sm-3 control-label">No Hp <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="no_hp_peserta" class="form-control" value="{{old('no_hp_peserta', $model->no_hp_peserta)}}"/>
                        </div>
                    </div>   
                </div>

                <div class="box-footer">
                    <button type="submit" class="btn btn-success col-sm-8 col-sm-offset-3">Save</button>
                </div>
            </form>
        </div>
         
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@stop


@section('script')

<link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.css" rel="stylesheet">
<script src="{{ asset('public/assets/admin/js/bootstrap-toggle.min.js') }}"></script>
<script src="{{ asset('public/assets/admin/js/bootstrap-fileinput.js') }}"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.11/summernote.js"></script>
<script>
        $(document).ready(function() {
            $('.editor').summernote({
                height: 200
            });
        });
</script>


<script>
$(document).ready(function () {
    $('#bootstrapTagsInputForm')
        .find('[name="source"]')
            .change(function (e) {
                $('#bootstrapTagsInputForm').formValidation('revalidateField', 'source');
            })
            .end()
        
        .formValidation({
            framework: 'bootstrap',
            excluded: ':disabled',
            icon: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                source: {
                    validators: {
                        notEmpty: {
                            message: 'Please enter at least one tag you like the most.'
                        }
                    }
                }
            }
        });
});
</script>
@stop