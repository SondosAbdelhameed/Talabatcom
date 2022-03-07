@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3">  بيانات الطلب</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0"></h5>
								</div>
								<div class="card-body">
									<p>رقم الطلب: {{$order->order_number}}</p>
									<p>اسم المستخدم: {{$order->user->name}}</p>
									<p>اسم المطعم: {{$order->restaurant->name}}</p>
									<p>التكلفة قبل الضريبة: {{$order->cost_before_tax}}</p>
									<p>الضريبة: {{$order->tax}}</p>
									<p>وقت التوصيل: {{$order->delivered_time}}</p>
									<p>ملاحظات: {{$order->notes}}</p>
									<p>الحالة:{{ $order->status}}</p>
									<table class="table table-striped table-bordered">
											<thead>
											<tr>
													<th>الصنف</th>
													<th>  السعر</th>
													<th>الكمية</th>
											</tr>
											</thead>
											<tbody>
												@foreach($order->orderItem as $orders)
                     		<tr>
													<td>{{$orders->menu->item}}</td>
													<td>{{$orders->price}}</td>
													<td>{{$orders->quantity}}</td>
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
