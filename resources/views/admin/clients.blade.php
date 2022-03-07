@extends('admin.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة العملاء</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات العملاء</h5>
								</div>
								<div class="card-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>الاسم </th>
                                        <th>البريد الالكتروني </th>
                                        <th>التليفون </th>
                                        <th>الحالة </th>
                                        <th>الاعدادات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($clients as $index=>$client)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$client->name}}</td>
																				<td>{{$client->email}}</td>
																				<td>{{$client->phone}}</td>
                                        <td>مفعل</td>
                                        <td>
																					<a type="button" class="btn btn-info" href="{{route('clientslist.show', $client->id)}}">
	                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye align-middle"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
																				  </a>
                                        <button type="button" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-check align-middle"><polyline points="20 6 9 17 4 12"></polyline></svg>
                                        </button>
                                        <button type="button" class="btn btn-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-slash align-middle"><circle cx="12" cy="12" r="10"></circle><line x1="4.93" y1="4.93" x2="19.07" y2="19.07"></line></svg>
                                        </button>
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
