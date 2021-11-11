@extends('layouts.ManagerLayout')

@section('content')


<div class = "container-xxl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h1 class = text-xl><b>History Logs</b></h1>
                        </div>
                    </div>
             </div>
             <div>
            <table class="table table-sm  datatable" id = "example">
            <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>	
                        <th>Action</th>
                        <th>Content</th>
                        <th>Performed on</th>

                    </tr>
                </thead>
                <tbody>
                @foreach($data as $data)
                    <tr>
                        <td>{{$data->id}}</td>
                        <td>{{ $data->fname}} {{ $data->lname}}</td>
                        <td>{{ $data->Action}}</td>
                        <td>{{ $data->Content}}</td>
                        <td>{{ $data->created_at}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>
            <div>
        </div>    
    </div>

</div>

  





<script type="text/javascript">
  $(document).ready(function() {
    $('#example').DataTable();
} );
</script>


@endsection
