@if (count($errors) >0)
    @foreach ($errors->all() as $error)
        <div class="alert alert-dismissible alert-danger">
            {{$error}}
        </div>
    @endforeach

@endif

@if (session('success'))
<div class="container text-center">
<div class="alert alert-success alert-dismissible">
    {{session('success')}}
</div>
</div>

@endif

@if (session('error'))
<div class="alert alert-danger alert-dismissible">
    {{session('error')}}
</div>
@endif


