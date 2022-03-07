@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة الطلبات</h1>
					</a>
					<br><br>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات  الطلبات</h5>
								</div>
								<div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المستخدم </th>
                                        <th>  المطعم </th>
                                        <th>الملاحظة </th>
																				<th>وقت التوصيل</th>
                                        <th>العمليات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($orders as $index=>$order)
									<tr>
                    										<td>{{$index+1}}</td>
                                        <td>{{$order->user->name}}</td>
																				<td>{{$order->restaurant->name}}</td>
																				<td>{{$order->note}}</td>
																				<td>{{$order->delivered_time}}</td>
																				<td>
																				<a type="button" href="{{route('restaurantOrdersDetails', $order->id)}}" class="btn btn-primary">
																				عرض
																			</a>
																			@if($order->status == 1)
																			<a type="button" class="btn btn-success" href="{{route('chaneStatus', $order->id)}}">
																			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check align-middle"><polyline points="20 6 9 17 4 12"></polyline></svg>
																		</a>
																			@endif
																			</td>
                                    </tr>
																		@endforeach
                                    </tbody>
                                </table>
																{{$orders->links()}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
