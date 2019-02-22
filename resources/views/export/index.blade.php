@extends('voyager::master')


@section('page_header')
<div class="container-fluid">
  <h1 class="page-title"> Export to Document </h1>
  <form action="{{ route('select.want.to.export') }}" method="get">
    <label id="select-export"> Select want to Export </label>
    <select id="select-export" name="select-export" onchange="this.form.submit();">
      @php
      $exports = \App\Models\Export::all();
      @endphp
      @foreach ($exports as $key => $value)
      <option value="{{ $key }}" @if($value['active']) selected @endif>{{$value['type'] }}</option>
        @endforeach
    </select>
  </form>
</div>
@endsection

@section('content')
<div class="page-content browse container-fluid">
  <div class="table-responsive">
    <table id="dataTable" class="table table-hover">
      <thead>
        <tr>
          <th> Users </th>
          <th> Blogs </th>
          <th> Products </th>
          <th> Orders </th>
        </tr>
      </thead>
      <tbody>
        <tr>
          @foreach ($exports as $export)
          @if($export['type'] === 'EXCEL' && $export['active'] === 1)
          <td> <a class="btn btn-primary" href="{{ route('download.users.excel') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.blogs.excel') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.products.excel') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.orders.excel') }}"> Download </a> </td>
          @endif
          @if($export['type'] === 'PDF' && $export['active'] === 1)
          <td> <a class="btn btn-primary" href="{{ route('download.users.pdf') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.blogs.pdf') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.products.pdf') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.orders.pdf') }}"> Download </a> </td>
          @endif
          @if($export['type'] === 'CSV' && $export['active'] === 1)
          <td> <a class="btn btn-primary" href="{{ route('download.users.csv') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.blogs.csv') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.products.csv') }}"> Download </a> </td>
          <td> <a class="btn btn-primary" href="{{ route('download.orders.csv') }}"> Download </a> </td>
          @endif
          @endforeach
        </tr>
      </tbody>
    </table>
  </div>
</div>
@endsection
