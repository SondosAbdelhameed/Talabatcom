<div class="modal fade" id="exampleModal{{$cmss->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
	  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h5 class="modal-title" id="exampleModalLabel">تعديل المحتوي</h5>

      </div>
      <div class="modal-body">
	  <form method="post" action="{{route('cms.update', $cmss->id)}}" enctype="multipart/form-data">
			@csrf
			@method('PUT')
	  <div class="form-group">
    <label for="cat">المحتوي (en)</label>
    <textarea class="form-control" name="content_en" id="cat" required>{{$cmss->content_en}}</textarea>
 	</div>
	<div class="form-group">
	<label for="cat">المحتوي (ar)</label>
	<textarea class="form-control" name="content_ar" id="cat" required>{{$cmss->content_ar}}</textarea>
</div>
	 <br>
	  <button type="submit" class="btn btn-primary">حفظ</button>
	  </form>
      </div>

    </div>
  </div>
</div>
