@extends('layout')

@section('content')
<style>
  .uper {
    margin-top: 40px;
  }
</style>
<div class="uper">
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Stock Name</td>
          <td>Stock Price</td>
          <td>Stock Quantity</td>
          <td colspan="2">Action</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>{{$share->id}}</td>
            <td>{{$share->share_name}}</td>
            <td>{{$share->share_price}}</td>
            <td>{{$share->share_qty}}</td>
            <td><a href="{{ route('shares.edit',$share->id)}}" class="btn btn-primary">Edit</a></td>
            <td>
                <form action="{{ route('shares.destroy', $share->id)}}" method="post">
                  @csrf
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
    </tbody>
  </table>
<div>
@endsection