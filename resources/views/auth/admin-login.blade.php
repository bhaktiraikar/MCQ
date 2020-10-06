@extends ('layouts.plane')
@section ('body')
<div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
            <br /><br /><br />
               @section ('login_panel_title','Please Sign In as Instructor')
			   @if($errors->any())
					<div class="alert alert-danger">
					 <ul>
					  @foreach($errors->all() as $error)
					  <li>{{ $error }}</li>
					  @endforeach
					 </ul>
					</div>
				@endif
               @section ('login_panel_body')
                        <form role="form" method="post" action="{{ route('instructor.login.submit') }}">
						{{ csrf_field() }}
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" >
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <input type="submit" name="add" class="btn btn-lg btn-success btn-block" value="Sign In" />
                            </fieldset>
                        </form>
                    
                @endsection
                @include('widgets.panel', array('as'=>'login', 'header'=>true))
            </div>
        </div>
    </div>
@stop