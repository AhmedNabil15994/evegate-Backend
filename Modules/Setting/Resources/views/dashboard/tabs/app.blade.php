 <div class="tab-pane fade" id="app">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.app') }}</h3>
    <div class="col-md-10">
        {{--  tab for lang --}}
        <ul class="nav nav-tabs">
            @foreach (config('translatable.locales') as $code)
                 <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#app_{{$code}}">{{ $code }}</a></li>
            @endforeach
        </ul>
        {{--  tab for content --}}
        <div class="tab-content">
            @foreach (config('translatable.locales') as $code)
            <div id="app_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">
                <div class="form-group">
                    <label class="col-md-2">
                        {{ __('setting::dashboard.settings.form.app_name') }} - {{ $code }}
                    </label>
                    <div class="col-md-9">
                        <input type="text" class="form-control" name="app_name[{{$code}}]" value="{{ setting('app_name',$code) }}" />
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="col-md-2">
                        {{ __('setting::dashboard.settings.form.how_its_work') }} - {{ $code }}
                    </label>
                    <div class="col-md-9">
                        <textarea type="text" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" name="how_its_work[{{$code}}]">{{ setting('how_its_work',$code) }}</textarea>
                    </div>
                </div>

                

            </div>
        @endforeach
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.contacts_email') }}
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="contact_us[email]" value="{{ setting('contact_us','email') }}" />
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.contacts_whatsapp') }}
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="contact_us[whatsapp]" value="{{ setting('contact_us','whatsapp') }}" />
            </div>
        </div>
{{-- 
         <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.location') }}
            </label>
            <div class="col-md-9">
                <input type="text" class="form-control" name="location" value="{{ setting('location') ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3654.3406974350205!2d90.48469931445422!3d23.663771197998262!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b0d5983f048d%3A0x754f30c82bcad3cd!2sJalkuri%20Bus%20Stop!5e0!3m2!1sen!2sbd!4v1605354966349!5m2!1sen!2sbd' }}" />
            </div>
        </div> --}}

       
        

    </div>
</div>
