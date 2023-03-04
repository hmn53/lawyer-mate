@extends('layouts/app')

@section('content')
<?php
  $user_id = auth()->user()->id;
  $case_info = DB::table('case_table')->select('*')->where('lawyer_id',$user_id)->get();
  $clients_name = DB::table('client_table')->select('client_name')->where('lawyer_id',$user_id)->get();
  $result = json_decode($case_info, true);
?>
<div class="container">
    <div class="jumbotron">
        <table class="table" style="text-align: center">
            <thead>
              <tr>
                <th scope="col">Client Name</th>
                <th scope="col">Case Number</th>
                <th scope="col">Description</th>
                <th scope="col">Case Category</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($result as $info)
                    @if ($info['status']=="In Progress")
                    <td>{{$info['id']}} </td>
                    <?php $client_name = DB::table('client_table')->select('client_name')->where('client_id',$info['client_id'])->get();
                     $name = json_decode($client_name,true); ?>
                    @foreach ($name as $item)
                      <td>{{$item['client_name']}} </td>
                    @endforeach
                    <td>{{$info['description']}} </td>
                    <td>{{$info['category']}} </td>
                    @endif
                @endforeach
              </tr>
              
            </tbody>
          </table>
    </div>
</div>
@endsection
