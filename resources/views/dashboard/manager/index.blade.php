@extends('layouts.ManagerLayout')

@section('content')


<div class = "container-xxl">
    <div class="table-responsive">
        <div class="table-wrapper">
            <div class="table-title">
                    <div class="row">
                        <div class="col-xs-6">
                            <h1 class = text-xl><b>Manage Guides</b></h1>
                         <a href="#addGuideModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Guide</span></a>
						 <a href="{{route('logs.list')}}" class="btn btn-success" ><i class="material-icons assignment">&#xe85d;</i> <span>View History Logs</span></a>                                             
                        </div>
                    </div>
                </div>
            <table class="table table-sm  datatable" id = "datatable1">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Author</th>
						<th>Updated</th>
						<th>Views</th>
						<th>Likes</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>    
    </div>

</div>



    <!-- Add  Modal HTML -->
    <div id="addGuideModal" class="modal fade bd-example-modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <form action="/manager/addGuide", method="POST"  class="border border-light p-5">
                    @csrf
                        <div class="modal-header">						
                            <h4 class="modal-title">Add Guide Form</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        </div>
                        @include('dashboard.manager.guideForm')
                        <div class="modal-footer">
                            <input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
                            <input type="submit" class="btn btn-success" value="Add">
                        </div>
                    </form>
                    @if (count($errors) > 0)
                    <script type="text/javascript">
                            $( document ).ready(function() {
                                $('#addGuideModal').modal('show');
                        });
                        </script>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    <!-- Edit Modal HTML -->
	<div id="editGuideModal" class="modal fade bd-example-modal-lg">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<form action ="{{ route('guides.update') }}" method="POST">
				@csrf
					<div class="modal-header">						
						<h4 class="modal-title">Edit Guide</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<input type="text"  hidden name="id" id="eid" required>
					<table class="table table-striped"> 	
					<tr>
					<td colspan="2">
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="title" id="etitle" class="form-control" value="{{ old('title') }}" required >
							@error('title')
                   			
							<em class="text-danger"> {{ $message }}</em>
                  			 
              			  	@enderror
						</div>
					</td>
					
					
					</tr>
					<tr>
                    <td colspan="2">
						<div class="form-group">
							<label>Category</label>
							<input type="text" name="category" id="ecategory"  class="form-control"  value="{{ old('category') }}" required>
							@error('category')
                   			
							<em class="text-danger"> {{ $message }}</em>
                  		
              			  	@enderror
						</div>
					</td>
					
					<tr>
                    <tr>
                    <td colspan="2">
						<div class="form-group">
							<label>Description</label>
							<input type="text" class="form-control" id="edesc" name="desc" value="{{ old('desc') }}" required>
							@error('desc')
                   			 
							<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
           
						</div>
					</td>
                    </tr>
					<td>

                    <div class="form-outline">
                    <label class="form-label" for="textAreaExample2">Content</label>
                          <textarea class="form-control" id="econtent" name = "content" rows="8" value="{{ old('content') }}"></textarea>
                         
                          @error('content')
                   			 
                    		<em class="text-danger"> {{ $message }}</em>
                  			
              			@enderror
                    </div>

						
					</td>
                    </tr>
					</table>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-info" value="Save Changes">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Delete Modal HTML -->
	<div id="deleteGuideModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="{{route('guides.delete')}}" method="POST">
				@csrf
				@method('DELETE')
					<div class="modal-header">						
						<h4 class="modal-title">Delete Guide</h4>
						<input type="text"  hidden name="id" id="deleteID" required>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" value="Delete">
					</div>
				</form>
			</div>
		</div>
	</div>






<script type="text/javascript">
  $(function () {
    
    var table = $("#datatable1").DataTable({
   

        "pageLength": 10,
        processing: true,
        serverSide: true,
        ajax: "{{ route('guides.list') }}",

        columns: [
            {data: 'id', name: 'id'},
            {data: 'title', name: 'title'},
            {data: 'category', name: 'category'},
            {data: 'description', name: 'description'},
            {data: 'fname', name: 'fname'}, 
			{data: 'updated_at', name: 'updated_at'}, 
			{data: 'views', name: 'created_at'}, 
			{data: 'likes', name: 'updated_at'},
            {
                data: 'action', 
                name: 'action', 
                orderable: true, 
                searchable: true
            },
        ]
		
       
    });
    
  });
</script>



<script>
$(document).on('click','.edit',function(){
	var guide_id = $(this).data('id');
	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
	$("#eid").val(data.details.id);
	$("#etitle").val(data.details.title);
	$("#ecategory").val(data.details.category);
	$("#edesc").val(data.details.description);
	$("#econtent").val(data.details.content);
	},'json');

 
})


$(document).on('click','.delete',function(){
	var guide_id = $(this).data('id');
	$.get("{{ route('guides.details')}}" ,{guide_id},function(data){
	$("#deleteID").val(data.details.id);
	
	},'json');

 
})

</script>
@endsection
