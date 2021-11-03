<table class="table table-striped"> 	
					<tr>
					<td>
						<div class="form-group">
							<label>Email Address</label>
							<input type="email" name="email" id="email" class="form-control" required>
							@error('email')
                   			
							<em class="text-danger"> {{ $message }}</em>
                  			 
              			  	@enderror
						</div>
					</td>
					<td>
						<div class="form-group">
							<label>Password</label>
							<input type="password" name="password" id="password"  class="form-control" required>
							@error('password')
                   			
							<em class="text-danger"> {{ $message }}</em>
                  		
              			  	@enderror
						</div>
					</td>
					
					</tr>
					<tr>
					<td>
						<div class="form-group">
							<label>First Name</label>
							<input type="text" class="form-control" id="fname" name="fname" value="{{ old('fname') }}" required>
							@error('fname')
                   			 
							<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
           
						</div>
					</td>
					
					<td>
						<div class="form-group">
							<label>Last Name</label>
							<input type="text" class="form-control" id="lname" name="lname" value="{{ old('lname') }}" required>
							@error('lname')
                   			 
                    		<em class="text-danger"> {{ $message }}</em>
                  			
              			  	@enderror
						</div>
					</td>
					</tr>
					
					<tr>
                    <td>
						<div class="form-group">
							<label>Role</label>
							<br>
							<select name="role" id="role" class="form-control" required>
								<option value="3">Student</option>
								<option value="1">Administrator</option>
								<option value="2">Manager</option>
						
							</select>
						</div>
					</td>
					<td>
						<div class="form-group">
							<label>Status</label>
							<br>
							<select name="status" id="status" class="form-control" required>
								<option value="active">Active</option>
								<option value="inactive">Inactive</option>
							 </select>
						</div>
					</td>
					<td>
					</td>
					<td>
					</td>
					</tr>
					</table>