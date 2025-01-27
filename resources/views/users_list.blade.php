@auth
@extends('layouts.dashboard')
@section('page_heading','User List')

@section('section')
<div class="col-sm-12">

<div class="row">
	<div class="col-sm-12">
	
		@section ('cotable_panel_title','')
		@section ('cotable_panel_body')

		<table class="table table-bordered">
			<thead>
				<tr>
					<th>No.</th>
					<th>Name of User</th>

					
				</tr>
			</thead>
			<tbody id="instructor_details">
				
			</tbody>
		</table>
		<script>
			$( document ).ready(function() {
				       
				$.ajax({
						url: "/MCQ/public/get_user_list",  
						type: 'GET',
						data: {
								  format: 'json'
							},
						contentType: "application/json; charset=utf-8",
						dataType: "json",
                        success: function(data) {
								var bodyData = '';
								var i=1;
								$.each(data,function(index,row){
									bodyData+="<tr>"
									bodyData+="<td>"+ i++ +"</td><td>"+row.name+"</td>";
									bodyData+="</tr>";
									
								})
								$("#instructor_details").append(bodyData);

						
                }}); 
			});

		</script>
		@endsection
		@include('widgets.panel', array('header'=>true, 'as'=>'cotable'))
	</div>

</div>
</div>
@stop
@endauth