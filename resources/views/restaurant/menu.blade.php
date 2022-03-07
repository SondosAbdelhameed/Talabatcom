@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة قائمة الطعام</h1>

					<a href="{{route('restaurantMenu.create')}}" class="btn btn-info" >
				إضافة قائمة الطعام
					</a>
					<br><br>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات قائمة الطعام</h5>
								</div>
								<div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>التصنيف </th>
                                        <th> اسم الصنف </th>
                                        <th>المكونات </th>
                                        <th>السعر </th>
                                        <th>وقت التحضير </th>
																				<th>الصورة</th>
                                        <th>العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($menus as $index=>$menu)
																		<tr>
																		   	<td>{{$index+1}}</td>
                                        <td>{{$menu->category->name}}</td>
																				<td>{{$menu->item}}</td>
																				<td>{{$menu->ingredients}}</td>
                                        <td>{{$menu->price}}</td>
                                        <td>{{$menu->ave_time}}</td>
																				<td>
																				@if(!empty($menu->image))
																				<img src="{{url('admin/images/' . $menu->image)}}" class="rounded-circle" width="40px">
																				@else
																				<img src="{{url('admin/images/avatar.png')}}" class="rounded-circle" width="40px">
																				@endif
																			</td>
                                        <td>
																			 	<a type="button" href="{{route('restaurantMenu.edit', $menu->id)}}" class="btn btn-success">
	                                      تعديل
																			</a>
																			</td>
                                    </tr>
																		@endforeach
                                    </tbody>
                                </table>
																{{$menus->links()}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
