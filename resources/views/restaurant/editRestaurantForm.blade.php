@extends('restaurant.layouts.header')
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
			<form method="post" action="{{route('restaurantProfile.update', $restaurant->id)}}" enctype="multipart/form-data">
						@csrf
						@method('PUT')
					<div class="form-group">
						<label for="email">عدد الاماكن</label>
						@error('table_count')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="table_count" value="{{$restaurant->table_count}}" required>
					</div>
					<div class="form-group">
						<label for="email">عدد الافراد</label>
						@error('people_limit')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="people_limit" value="{{$restaurant->people_limit}}" required>
					</div>
					<div class="form-group">
						<label for="email">صورة ١ (الافتراضية)</label>
							@error('images')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="images[]">
					</div>
					<div class="form-group">
						<label for="email">صورة ٢</label>
							@error('images')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="images[]">
					</div>
					<div class="form-group">
						<label for="email">صورة ٣</label>
							@error('images')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="images[]">
					</div>
					<div class="form-group">
						<label for="email">صورة ٤</label>
							@error('images')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="images[]">
					</div>
					<div class="form-group">
						<label for="email">صورة ٥</label>
							@error('images')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="images[]">
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
