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
				<form method="post" action="{{route('restaurantMenu.update', $menu->id)}}">
							@csrf
							@method('PUT')
						<div class="form-group">
						<label>اسم القسم</label>
						@error('category')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<select class="form-control" name="category">
							<option value="">....</option>
							@foreach($menuCategory as $category)
							@if($menu->category_id == $category->id)
							<option value="{{$category->id}}" selected>{{ $category->name }}</option>
							@else
							<option value="{{$category->id}}">{{$category->name}}</option>
							@endif
							@endforeach
						</select>
						</div>
					<div class="form-group">
						<label for="email">اسم الصنف (en)</label>
							@error('item_en')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="item_en" value="{{$menu->item_en}}" required>
					</div>
					<div class="form-group">
						<label for="email">اسم الصنف (ar)</label>
							@error('item_ar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="item_ar" value="{{$menu->item_ar}}" required>
					</div>
					<div class="form-group">
						<label for="email">المكونات (en)</label>
							@error('ingredients_en')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="ingredients_en" value="{{$menu->ingredients_en}}" required>
					</div>
					<div class="form-group">
						<label for="email">المكونات (ar)</label>
							@error('ingredients_ar')
							<div class="alert alert-danger">{{ $message }}</div>
							@enderror
						<input type="text" class="form-control" name="ingredients_ar" value="{{$menu->ingredients_ar}}" required>
					</div>
					<div class="form-group">
						<label for="email">السعر</label>
						@error('price')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="price" value="{{$menu->price}}" required>
					</div>
					<div class="form-group">
						<label for="email">وقت التحضير</label>
						@error('ave_time')
						<div class="alert alert-danger">{{ $message }}</div>
						@enderror
						<input type="number" class="form-control" name="ave_time" value="{{$menu->ave_time}}" required>
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
