<div class="row expanded column">
  @if(isset($errors) && count($errors))
    <div class="callout alert" data-closable>
      @foreach ($errors as $error_array) 
        @foreach ($error_array as $error_item) 
          {{ $error_item }} <br /> 
        @endforeach 
      @endforeach
      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif 
  @if(isset($success) )
    <div class="callout success" data-closable>
      {{ $success }}
      <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
        <span arial-hidden="true">&times;</span>
      </button>
    </div>
  @endif
  @if(\App\Classes\Session::has('success'))
  <div class="callout success" data-closable>
    {{ \App\Classes\Session::flash('success') }}
    <button class="close-button" arial-label="Dismiss Message" type="button" data-close>
      <span arial-hidden="true">&times;</span>
    </button>
  </div>
@endif

</div>