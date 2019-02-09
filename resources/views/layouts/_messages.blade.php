@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
       <strong>Success! {{ session('success') }}</strong>
       <button type="button" class="close" data-dismiss="alert" aria-lebel="close">
        <span area-hidden="true">&times;</span>
       </button>
    </div>
@endif