<table class="table table-striped"> 	
					<tr>
					<td colspan="2">
						<div class="form-group">
							<label>Title</label>
							<input type="text" name="title" id="title" class="form-control" value="{{ old('title') }}" required >
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
							<input type="text" name="category" id="category"  class="form-control"  value="{{ old('category') }}" required>
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
							<input type="text" class="form-control" id="desc" name="desc" value="{{ old('desc') }}" required>
							@error('desc')
                   			 
							<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
           
						</div>
					</td>
                    </tr>
					<td>

                    <div class="form-outline">
                    <label class="form-label" for="textAreaExample2">Content</label>
                          <textarea class="form-control" id="content" name = "content" rows="8" value="{{ old('content') }}"></textarea>
                         
                          @error('content')
                   			 
                    		<em class="text-danger"> {{ $message }}</em>
                  			
              			@enderror
                    </div>

						
					</td>
                    </tr>
					</table>