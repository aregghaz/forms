
@extends('page.index')

@section('title')

@endsection

@section('content')

<form method="post" action="{{ route('submit') }}">
    <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="text" class="form-control" name="field1" id="exampleInputEmail1" placeholder="Email">
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="text" class="form-control" name="field2" id="exampleInputPassword1" placeholder="Password">
    </div>


    <input type="hidden" name="_token" value="{{  Session::token() }}">
    <button type="submit" class="btn btn-default">Submit</button>
</form>
</div>
@endsection