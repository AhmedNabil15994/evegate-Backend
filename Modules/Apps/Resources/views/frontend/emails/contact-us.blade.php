@component('mail::message')

<h2> <center> @if($request->type == "suggest") 
  {{ __('apps::frontend.contact_us.suggest.header',[],"en") }}
  @else
  {{ __('apps::frontend.contact_us.mail.header', [], "en") }}
  @endif
 </center> </h2>


<ul>
  <li>Username : {{ $request['username'] }}</li>
  <li>Mobile : {{ $request['mobile'] ?? "-----" }}</li>
  <li>Email : {{ $request['email'] ?? "------"}}</li>
  <li>Message : {{ $request['message'] }}</li>
</ul>


@endcomponent
