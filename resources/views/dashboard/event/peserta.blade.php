@extends('dashboard')

@section('sub-title')
 | Peserta
@stop

@section('content-title')
    Peserta | {{$event->judul_event}}
    
	<a href="{{route('peserta.create', ['id'=> $event->id])}}" type="button" class="pull-right btn  btn-info btn-flat"><i class="fa fa-plus"></i> <b>Add Peserta</b> </a>

    <a href="{{route('event.index')}}" type="button" class="pull-right btn  btn-primary btn-flat"><i class="glyphicon glyphicon-arrow-left"></i> <b>Back</b> </a>

@stop

@section('content')

<div class="row">
    <div class="col-xs-12">
    	<div class="box">
            <div class="box-header">
              <!-- <h3 class="box-title"></h3> -->      
            <!-- /.box-header -->
            <div class="box-body">
              
                <table data-toggle="table"   data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="name" data-sort-order="desc" data-show-export="true">
                    <thead>
                        <tr>
                            <th data-field="id" data-checkbox="true" ></th>
                            <th data-field="title" data-sortable="true" >Event</th>
                            <th data-field="nama" data-sortable="true">Nama</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="no_tlp" data-sortable="true">No Tlp</th>
                            <th data-field="Actions" width="30%">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($datas as $data)
                        <tr>
                        	<td class="text-center"></td>
                            <td>{{$data->judul_event}}</td> 
                            <td>{{$data->nama_peserta}}</td> 
                            <td>{{$data->email_peserta}}</td> 
                            <td>
                            	<a class="btn btn-primary btn-xs" href="{{route('event.edit',['id'=> $data->id])}}">
                                    <span class="glyphicon glyphicon-edit"></span>  Edit
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