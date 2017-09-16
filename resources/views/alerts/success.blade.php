@if(Session::has('message-success'))
<div class="alert alert-success">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{Session::get('message-success')}}.</strong>
</div>
@endif