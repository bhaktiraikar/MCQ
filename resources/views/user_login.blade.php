@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Login as Guest')
			   @if($errors->any())
					<div class="alert alert-danger">
					 <ul>
					  @foreach($errors->all() as $error)
					  <li>{{ $error }}</li>
					  @endforeach
					 </ul>
					</div>
				@endif
				@if (Session::has('success'))
				 <div class="alert alert-success">
					{{Session::get('success')}}
				</div>
				@endif


               @section ('login_panel_body')
                        <form role="form" method="post" action="{{ url('/do_login') }}">
						{{ csrf_field() }}
                            <fieldset>
								<div class="form-group">
                                    <input class="form-control" placeholder="Name" name="name" type="text" autofocus>
                                </div>
                                
                                <!-- Change this to a button or input when using this as a form -->
								<input type="submit" name="add" class="btn btn-lg btn-success btn-block" value="Login as a guest" />
                            </fieldset>
                        </form>
      
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop
