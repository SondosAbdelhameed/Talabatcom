@extends('admin.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة الأقسام</h1>

					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h5 class="card-title mb-0">بيانات الأقسام</h5>
								</div>
								@if(session()->has('message'))
						<div class="alert alert-success">
								{{ session()->get('message') }}
						</div>
							 @endif
								<div class="card-body">
								<!-- Button to Open the Modal -->
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  اضافة قسم
</button>
<br><br>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h5 class="modal-title" id="exampleModalLabel">اضافة قسم جديد</h5>

      </div>
      <div class="modal-body">
	  <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
			@csrf
	  <div class="form-group">
    <label for="cat">اسم القسم (en)</label>
    <input type="text" class="form-control" name="name_en" id="cat" required>
 	</div>
	<div class="form-group">
	<label for="cat">اسم القسم (ar)</label>
	<input type="text" class="form-control" name="name_ar" id="cat" required>
  </div>
	<div class="form-group">
		<label for="cat">لوجو</label>
		<input type="file" class="form-control" name="icon" required>
	</div>
	 <br>
	  <button type="submit" class="btn btn-primary">حفظ</button>
	  </form>
      </div>

    </div>
  </div>
</div>
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>القسم (en) </th>
                                        <th>القسم (ar)</th>
										<th> الصورة</th>
                                    </tr>
                                    </thead>
                                    <tbody>
																			@foreach($categories as $index=>$category)
                                    <tr>
                                        <td>{{$index+1}}</td>
                                        <td>{{$category->name_en}}</td>
																				<td>{{$category->name_ar}}</td>
																				<td>
																				<img src="{{$category->icon}}" class="rounded-circle" width="40px">
																				</td>
                                    </tr>
																		@endforeach
                                    </tbody>
                                </table>
																{{$categories->links()}}
								</div>
							</div>
						</div>
					</div>

				</div>
			</main>

			@endsection
