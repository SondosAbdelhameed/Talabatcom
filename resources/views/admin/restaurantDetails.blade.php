@extends('admin.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">  بيانات المطعم</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0"></h5>
								</div>
								<div class="card-body">
									<p>اسم المستخدم: {{$restaurant->user->name}}</p>
									<p>اسم المطعم: {{$restaurant->name}}</p>
									<p>العنوان: {{$restaurant->address}}</p>
									<p>التليفون: {{$restaurant->phone}}</p>
									<p>المدينة: {{$restaurant->area->name}}</p>
									<p>عدد الاماكن: {{$restaurant->table_count}}</p>
									<p>عدد الناس: {{$restaurant->people_limit}}</p>
									<p>التقييم: {{$restaurant->reviews->avg('rate')}}</p>
									<table class="table table-striped table-bordered">
											<thead>
											<tr>
													<th>المطعم</th>
													<th>  الفئة</th>
													<th>الاسم</th>
													<th>  المكونات</th>
													<th>  السعر</th>
													<th>  متوسط الوقت</th>
													<th>  الصورة</th>
											</tr>
											</thead>
											<tbody>
                        @foreach($restaurant->menu as $menus)
                     		<tr>
													<td>{{$menus->restaurant->name}} </td>
													<td>{{$menus->category->name}}</td>
													<td>{{$menus->item}}</td>
													<td>{{$menus->ingredients}}</td>
													<td>{{$menus->price}}</td>
													<td>{{$menus->ave_time}}</td>
													<td>
														@if(!empty($menus->image))
														<img src="{{url('admin/images/' . $menus->image)}}" class="rounded-circle" width="40px">
														@else
														<img src="{{url('admin/images/avatar.png')}}" class="rounded-circle" width="40px">
														@endif
													</td>
											</tr>
											 @endforeach
											</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
