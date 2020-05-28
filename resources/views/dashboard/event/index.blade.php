@extends('dashboard')

@section('sub-title')
 | Event
@stop

@section('content-title')
    Event

	<a href="{{route('event.create')}}" type="button" class="pull-right btn  btn-info btn-flat"><i class="fa fa-plus"></i> <b>Add</b> </a>
@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
    	<div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title"></h3> -->      
            <!-- /.box-header -->
            <div class="box-body">
              
                <table data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc">
                    <thead>
                        <tr>
                            <th data-field="id" data-checkbox="true" ></th>
                            <th data-field="title" data-sortable="true" >Judul</th>
                            <th data-field="image" data-sortable="true">Gambar</th>
                            <th data-field="quota" data-sortable="true">Quota</th>
                            <th data-field="tgl_mulai" data-sortable="true">Tgl Mulai</th>
                            <th data-field="tgl_selesai" data-sortable="true">Tgl Selesai</th>
                            <th data-field="jenis" data-sortable="true">Jenis Event</th>
                            <th data-field="Actions" width="30%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                        	<td class="text-center"></td>
                            <td>{{$data->judul_event}}</td> 
                            <td><img src='{{ asset("uploads/event/$data->image") }}' width="100px" ></td>
                            <td>{{$data->quota_event}}</td> 
                            <td>{{$data->tgl_mulai_event}}</td> 
                            <td>{{$data->tgl_selesai_event}}</td> 
                            <td>{{ ($data->jenis_event == 1)? 'Internal' : 'Publik'}}</td> 
                            <td>
                            	<a class="btn btn-primary btn-xs" href="{{route('event.edit',['id'=> $data->id])}}">
                                    <span class="glyphicon glyphicon-edit"></span>  Edit
                                </a>
                                <a class="btn btn-primary btn-xs" href="{{route('peserta.index',['id'=> $data->id])}}">
                                    <span class="glyphicon glyphicon-user"></span>  Peserta
                                </a>
                                <a class="btn btn-danger btn-xs" href="{{route('event.destroy', ['id'=> $data->id])}}" onclick="return checkDelete()">
                                    <span class="glyphicon glyphicon-trash"></span>  Delete
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
	</div>
	<!-- /.col -->
</div>
<!-- /.row -->
@stop


@section('scripts')

@stop