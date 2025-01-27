@if($_COOKIE["user_id"])
@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
            <br /><br />
			<h1>Question Paper</h1>
						{{ csrf_field() }}
			@foreach ($data['results'] as $key => $question_details)
			<div>
				<li>{{$question_details['category']}}</li>
				<ul>
					<li>{{$question_details['question']}}</li>
						<input type="radio" id="{{$question_details['correct_answer']}}" name="ans{{$key}}" value="{{$question_details['correct_answer']}}">
						<label for="male">{{$question_details['correct_answer']}}</label>
						@for($i=0; $i<count($question_details['incorrect_answers']); $i++)
						<input type="radio" id="{{$question_details['correct_answer']}}" name="ans{{$key}}" value="{{$question_details['incorrect_answers'][$i]}}">
						<label for="male">{{$question_details['incorrect_answers'][$i]}}</label>
						@endfor
				</ul>
			</div>
			@endforeach 
			<input type="button" class="btn btn-primary" id="submit" value="Submit">
            </div>
        </div>
    </div>

  <script type="text/javascript">
  
  $(document).ready(function() {
	$('#submit').click(function(e){
			
			var i;
			var score = 0;
			var unsolved = 0;
			var user_details = [];
			for(i=0; i<10; i++)
			{
				var correct_ans = $("input[name='ans"+i+"']:first").val();
				var users_ans = $("input[name='ans"+i+"']:checked").val();
				
				if( correct_ans == users_ans)
				{
					score++;
					user_details.push([correct_ans, users_ans,1]);
				}
				else
				{
					if(users_ans == null)
					{
						unsolved++
					}
					else
					{
						user_details.push([correct_ans, users_ans,0]);
					}

				}
				
			}
			if(unsolved  > 0)
			{
				alert("Please answer all questions");
			}	
			else
			{
				console.log(score);
				alert("Gongratulations...Your score is "+score);			
				$.ajax({
						url: "/MCQ/public/store_ans",  
						type: 'POST',
						data: { _token: "{{ csrf_token()}}" , data: user_details},
						dataType: "json",
						success: function(data) {
						console.log(data);	
						window.location.href = 'http://localhost/MCQ/public/user_login'; //Will take you to xyz.


						}
				});
			}
	});
  });
	</script>
@endsection
@endif
