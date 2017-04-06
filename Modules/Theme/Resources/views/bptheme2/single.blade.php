@extends('theme::bptheme2.layouts.app')
@section('content')
	<div class="col-md-12 main_bg">
		<div class="col-md-1"></div>
		<div class="col-md-10 asideleft">
			<div class="col-md-2 ">	
				<h4>CATEGORIES<hr></h4>		
				<ul>
					@foreach(bp_cat() as $category)
				 		<a href="{{url('/cat/'.$category->tax_link) }}"><li class="list-group-item">{{ $category->tax_name }} </li></a>
				 	@endforeach
				</ul>
			</div>
			<div class="col-md-10 asideright">
				<div class="col-md-12">
					<div class="row firstrow">
						<div class="col-md-10">
							<a href="{{url('/detail/'.$post->post_link) }}" name="" ><h2>{{ $post->title }}</h2></a>
						</div>
						<div class="col-md-2"></div>
					</div>
					<div class="col-md-12 toolbar">
						<div class="col-md-10 html">
							{!! $post->body !!}
						</div>
						<div class="col-md-2">
							
						</div>
					</div>
				</div>
				<hr>		
				</div>
		</div>
		<div class="col-md-1"></div>
	</div>	
<div class="col-md-12"><br> </div>
@stop

@push('scripts')

	<script type="text/javascript">
        // alert("test");
    </script>

@endpush