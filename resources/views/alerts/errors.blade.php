@if(Session::has('message-error'))
<div class="alert alert-danger">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{Session::get('message-error')}}.</strong>
</div>
@endif