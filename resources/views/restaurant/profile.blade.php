@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة الحساب الشخصي</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات المطعم</h5>
								</div>
								<div class="card-body">

<a href="{{route('restaurantProfile.edit', $restaurant->id)}}" class="btn btn-info" >
   تعديل البيانات
</a>
<br><br>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
									<th>الاسم </th>
									<th>{{$restaurant->name}}</th>
									</tr>
									<tr>
									<th>العنوان </th>
									<th>{{$restaurant->address}}</th>
									</tr>
									<tr>
									<th>الجوال </th>
									<th>{{$restaurant->phone}}</th>
									</tr>
									<tr>
									<th>اللوجو </th>
									<th>
									<img src="{{$restaurant->logo}}" class="rounded-circle" width="40px">
								
									</th>
									</tr>
									<tr>
									<th>القسم </th>
									<th>
										@foreach ($restaurant->categories as $category)
										    {{$category->name}} <br>
										@endforeach
									</th>
									</tr>
									<tr>
									<th>المدينة </th>
									<th>{{$restaurant->area->name}}</th>
									</tr>
									<tr>
									<th>عدد الاماكن </th>
									<th>{{$restaurant->table_count}}</th>
									</tr>
									<tr>
									<th>عدد الافراد </th>
									<th>{{$restaurant->people_limit}}</th>
								  </tr>
									<tr>
									<th>الصور</th>
									<th>
									@if(!empty($restaurant->logo))
									@foreach($restaurant->images as $restImage)
									<img src="{{url('admin/images/' . $restImage->image)}}" class="rounded-circle" width="40px">
									@endforeach
									@endif
									</th>
									</tr>
                                    </thead>

                                </table>
								</div>
								<div class="row text-center">
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
