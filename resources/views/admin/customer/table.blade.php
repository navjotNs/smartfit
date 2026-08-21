           <tr>    
                     <th> </th> 
                     <th style="text-align:left;">ID</th> 
                      <th style="text-align:left;">Worker Name</th> 
                         
                       <th style="text-align:left;">Mobile</th> 
                       <th style="text-align:left;">Construction site</th>
        </tr>
        @foreach($alloted_users as $alloted_user)
            
            <tr>
                                        <td><input type="checkbox" class="unallot_id" name="unallot_id[]" value="{{ $alloted_user->id }}"></td>
                                        <td>{{ $alloted_user->unique_id }}</td>
                                        <td>{{ $alloted_user->name }}</td>
                                    
                                      <td>{{ $alloted_user->mobile }}</td>
                                          <td>{{ $alloted_user->company }}</td>
                                    </tr> 
           </tr> 
         @endforeach