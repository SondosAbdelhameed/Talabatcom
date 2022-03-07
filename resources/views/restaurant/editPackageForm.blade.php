@extends('restaurant.layouts.header')

			@section('content')

			<main class="content">
				<div class="container-fluid p-0">

					<h1 class="h3 mb-3"> إدارة قاىمة الطعام</h1>

	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h5 class="card-title mb-0">بيانات القائمة</h5>
				</div>
		<div class="card-body">
		<div class="row">
		<div class="col-6">
				<form method="post" action="{{route('restaurantPackages.update', $package->id)}}">
							@csrf
							@method('PUT')
					<div class="form-group">
						<label for="email">العنوان (en)</label>
							@error('title_en')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="title_en" value="{{$package->title_en}}" required>
					</div>
					<div class="form-group">
						<label for="email">العنوان (ar)</label>
							@error('title_ar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="title_ar" value="{{$package->title_ar}}" required>
					</div>
					<div class="form-group">
						<label for="email">الوصف (en)</label>
							@error('description_en')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="description_en" value="{{$package->description_en}}" required>
					</div>
					<div class="form-group">
						<label for="email">الوصف (ar)</label>
							@error('description_ar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="description_ar" value="{{$package->description_ar}}" required>
					</div>
					<div class="form-group">
						<label for="email">السعر</label>
						@error('price')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="price" value="{{$package->price}}" required>
					</div>
					<div class="form-group">
						<label for="email">الصورة</label>
							@error('image')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="file" class="form-control" name="image">
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
