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
                                        <th>الاعدادات </th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($cms as $index=>$cmss)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$cmss->section}}</td>
                                        <td>
																				@include('admin.cms_modal')
                                        <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal{{$cmss->id}}">Edit</button>
                                        </td>
                                    </tr>
																		@endforeach
                                    </tbody>
                                </table>
								</div>
								<div class="row text-center">
									{{$cms->links()}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
