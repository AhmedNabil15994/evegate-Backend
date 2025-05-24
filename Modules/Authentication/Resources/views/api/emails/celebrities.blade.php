@component('mail::message')

  <h2> <center> {{ __('authentication::api.workers.mail.header') }} </center> </h2>

  @component('mail::button', [
    'url' => url(route('dashboard.workers.edit',$celebrity['id']))
  ])

    {{ __('authentication::api.workers.mail.btn') }}

  @endcomponent

@endcomponent
