@extends ('Layout')
@section ('content')


<h1>Send An Email</h1>

<form method="POST" action="/index">

    @CSRF

	<div class="field half">
	  <label class="label">Subject</label>
	  <div class="control">
	    <input name="subject" class="input" type="text" placeholder="Insert Subject Here">
	  </div>
	</div>
<br>

	<div class="field half">
	  <label class="label">Content</label>
	  <div class="control">
	    <textarea rows="8" name="content" class="textarea" type="text" placeholder="Write your email here"></textarea>
	  </div>
	</div>

	<div class="field is-grouped">
  <div class="control">
    <button class="button is-dark">Send Email</button>
  </div>

</div>

</form>
@endsection