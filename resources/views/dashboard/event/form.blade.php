@extends('dashboard')

@section('sub-title')
| Event
@stop


@section('content-title')
	Form Event

	<a href="{{route('event.index')}}" type="button" class="pull-right btn  btn-primary btn-flat"><i class="glyphicon glyphicon-arrow-left"></i> <b>Back</b> </a>
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

            <form class="form-horizontal"  method="post" action="@if($model->exists) {{ route('event.update', $model->id) }} @else {{ route('event.store') }} @endif" enctype="multipart/form-data">
                {{csrf_field()}}
                {{method_field($model->exists ? 'PUT' : 'POST')}}
                <div class="box-body">

                    <div class="form-group">
                        <label class="col-sm-3 control-label">Title <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="judul" class="form-control" value="{{old('judul', $model->judul_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Image <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="file" name="image" class="form-control"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Total Quota <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input type="text" name="quota" class="form-control" value="{{old('quota', $model->quota_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Detail <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                        <textarea class="textarea editor" name="detail_event" id="editor" rows='10'>{{old('detail_event', $model->detail_event)}}</textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Terakhir Mendaftar <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input required type="date" name="tgl_akhir_daftar" class="form-control" value="{{old('tgl_akhir_daftar', $model->tgl_akhir_daftar)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Mulai Event <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input required type="date" name="tgl_mulai_event" class="form-control" value="{{old('tgl_mulai_event', $model->tgl_mulai_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam Mulai Event <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input required type="time" name="jam_mulai_event" class="form-control" value="{{old('jam_mulai_event', $model->jam_mulai_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Tanggal Selesai Event <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input required type="date" name="tgl_selesai_event" class="form-control" value="{{old('tgl_selesai_event', $model->tgl_selesai_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jam Selesai Event <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <input required type="time" name="jam_selesai_event" class="form-control" value="{{old('jam_selesai_event', $model->jam_selesai_event)}}"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Jenis Event <span class="text-red">*</span></label>
                        <div class="col-sm-8">
                            <p class="btn btn-default"> 
                                <label class="checkbox-inline ">
                                    <input type="checkbox" name="jenis_event" {{ ($model->jenis_event == 1)? 'checked="checked"' : ''}}> Event untuk internal
                                </label>
                            </p>              
                        
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