@if(Session::has('message-delete'))
<div class="alert alert-warning">
  <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <strong>{{Session::get('message-delete')}}.</strong>
</div>
@endif