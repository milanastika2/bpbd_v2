@extends('welcome')

@section('event')

<div class="block category-listing category-style2" style="margin-top: 25px;">

	<h3 class="block-title"><span>e-Event Bpbd Provinsi Bali</span></h3>

	@foreach($datas as $data)
		<div class="post-block-style post-list clearfix">
			<div class="row">
				
				<div class="col-md-5 col-sm-6">
					<div class="post-thumb thumb-float-style">
						<a href="{{url('/e-event/'.$data->id .'/detail')}}">
						<img class="img-responsive" src="{{asset('/uploads/event/'.$data->image)}}" alt="bpbd">
						</a>
					</div>
				</div><!-- Img thumb col end -->

				<div class="col-md-7 col-sm-6">
					<div class="post-content">
			 			<h2 class="post-title title-large">
			 				<a href="{{url('/e-event/'.$data->id .'/detail')}}">{{substr($data->judul_event, 0, 200)}}</a>
			 			</h2>
			 			<div class="post-meta">
			 				<span class="post-author"><a>Kapasitas {{$data->quota_event}} Orang</a></span>
				 			<span class="post-date">Tanggal Mulai : {{$data->tgl_mulai_event}}</span>
			 			</div>
			 			<p>{!! str_limit(strip_tags($data->detail_event),200) !!}</p>
		 			</div><!-- Post content end -->
				</div><!-- Post col end -->
			</div><!-- 1st row end -->
		</div><!-- 1st Post list end -->
		
	@endforeach
</div>
<div class="text-center">{!! $datas->links('layouts.pagination') !!}</div> 

@stop



