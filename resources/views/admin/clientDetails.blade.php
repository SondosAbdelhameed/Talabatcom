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
									<p>اسم المستخدم: {{$client->name}}</p>
									<p>البريد الالكتروني: {{$client->email}}</p>
									<p>التليفون: {{$client->phone}}</p>
									<table class="table table-striped table-bordered">
											<thead>
											<tr>
												<th>رقم الطلب</th>
												<th>  السعر قبل الضريبة</th>
												<th>الضريبة</th>
												<th>الملاحظة </th>
												<th>وقت التوصيل</th>
											</tr>
											</thead>
											<tbody>
												@foreach($client->order as $orders)
                     		<tr>
													<td>{{$orders->order_number}}</td>
													<td>{{$orders->cost_before_tax}}</td>
													<td>{{$orders->tax}}%</td>
													<td>{{$orders->notes}}</td>
													<td>{{$orders->delivered_time}}</td>
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
