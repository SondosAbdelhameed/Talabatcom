@extends('admin.layouts.header')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>
			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة المطاعم</h1>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">بيانات المطاعم</h5>
				</div>
		<div class="card-body">
		<div class="row">
		<div class="col-6">
			<form action="{{route('restaurants.store')}}" method="post" enctype="multipart/form-data">
						@csrf
						<div class="form-group">
							<label for="email">اسم المستخدم(ar)</label>
								@error('username_ar')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							<input type="text" class="form-control" name="username_ar" required>
						</div>
						<div class="form-group">
							<label for="email">اسم المستخدم(en)</label>
								@error('username_en')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							<input type="text" class="form-control" name="username_en" required>
						</div>
						<div class="form-group">
							<label for="email">البريد الالكتروني</label>
								@error('email')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							<input type="email" class="form-control" name="email" required>
						</div>
						<div class="form-group">
							<label for="email">المحمول</label>
								@error('phone')
								<div class="alert alert-danger">{{ $message }}</div>
								@enderror
							<input type="number" class="form-control" name="phone" required>
						</div>
					<div class="form-group">
						<label for="email">الاسم en</label>
							@error('name_en')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="name_en" required>
					</div>
					<div class="form-group">
						<label for="email">الاسم ar</label>
							@error('name_ar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="name_ar" required>
					</div>
					<div class="form-group">
						<label for="email">العنوان</label>
							@error('address')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="address" required>
					</div>
					<div class="form-group">
						<label for="email">رقم هاتف</label>
							@error('phone')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="number" class="form-control" name="phone" required>
					</div>
					<div class="form-group">
						<label>اسم المدينة</label>
						@error('area')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<select class="form-control" name="area">
							<option value="">....</option>
							@foreach($areas as $area)
							<option value="{{$area->id}}">{{$area->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="form-group">
					<label>اسم القسم</label>
					@error('category')
					<div class="alert alert-danger">{{ $message }}</div>
					@enderror
					<select name="category[]" class="selectpicker form-control" multiple required>
						@foreach($categories as $category)
						<option value="{{$category->id}}">{{$category->name}}</option>
						@endforeach
					</select>
					</div>
					<div class="form-group">
						<label for="email">عدد الاماكن</label>
						@error('table_count')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="table_count" required>
					</div>
					<div class="form-group">
						<label for="email">عدد الافراد</label>
						@error('people_limit')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="people_limit" required>
					</div>
					<div class="form-group">
						<label for="email">لوجو</label>
							@error('logo')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="logo" required>
					</div>
						<br>
			<button type="submit" class="btn btn-primary"> حفظ البيانات</button>
			</form>
		</div>
		</div>

		</div>
				</div>
			</div>
		</div>

	</div>
</main>

			@endsection
