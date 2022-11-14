<!DOCTYPE html>
<html>
<head>
    <title>Test</title>
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script src="https://cdn.ckeditor.com/4.12.1/standard/ckeditor.js"></script>
</head>
<body>
  
<form action="{{route('ckeditor.content_upload')}}" method="Post">
    @csrf
     <div class="form-group">
       <textarea name="editor1"></textarea>
     </div>
    <button type="submit">Submit</button>
</form>
@if(count($allContents)>0)
<table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Content</th>
      <th scope="col">Image</th>
    </tr>
  </thead>
  <tbody>
    <?php $sr=0;?>
    @foreach($allContents as $key => $value)
    <tr>
      <th scope="row">{{++$sr}}</th>
      <td>{!! $value->content !!}</td>
      <td>{{$value->image}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
@endif
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.1/classic/ckeditor.js"></script>
<script>
    CKEDITOR.replace('editor1', {
        filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
        filebrowserUploadMethod: 'form'
    });
</script>
</body>
</html>