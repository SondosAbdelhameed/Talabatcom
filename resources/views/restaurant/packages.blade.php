@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة المناسبات</h1>

					<a href="{{route('restaurantPackages.create')}}" class="btn btn-info" >
				إضافة مناسبة
					</a>
					<br><br>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات  المناسبات</h5>
								</div>
								<div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>عنوان المناسبة </th>
                                        <th>  الوصف </th>
                                        <th>السعر </th>
																				<th>الصورة</th>
                                        <th>العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($packages as $index=>$package)
									<tr>
                    										<td>{{$index+1}}</td>
                                        <td>{{$package->title}}</td>
																				<td>{{$package->description}}</td>
																				<td>{{$package->price}}</td>
																				<td>
																				@if(!empty($package->image))
																				<img src="{{url('admin/images/' . $package->image)}}" class="rounded-circle" width="40px">
																				@else
																				<img src="{{url('admin/images/avatar.png')}}" class="rounded-circle" width="40px">
																				@endif
																			</td>
																				<td>
																				<a type="button" href="{{route('restaurantPackages.edit', $package->id)}}" class="btn btn-success">
																				تعديل
																			</a>
																			</td>
                                    </tr>
																		@endforeach
                                    </tbody>
                                </table>
																{{$packages->links()}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
