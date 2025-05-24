<div class="tab-pane active fade in" id="global_setting">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.general') }}</h3>
    <div class="col-md-10">
        <div class="form-group">
            <label class="col-md-2">
              {{ __('setting::dashboard.settings.form.locales') }}
            </label>
            <div class="col-md-9">
                <select name="locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,array_keys(config('laravellocalization.supportedLocales'))))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.rtl_locales') }}
            </label>
            <div class="col-md-9">
                <select name="rtl_locales[]" id="single" class="form-control select2" multiple="">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (in_array($key,config('rtl_locales')))
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_language') }}
            </label>
            <div class="col-md-9">
                <select name="default_locale" id="single" class="form-control select2">
                    @foreach (config('core.available-locales') as $key => $language)
                    <option value="{{ $key }}"
                    @if (config('default_locale') == $key)
                    selected
                    @endif>
                        {{ $language['native'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
              {{ __('setting::dashboard.settings.form.currencies') }}
            </label>
            <div class="col-md-9">
                <select name="currencies[]" id="single" class="form-control select2" multiple="">
                    @foreach (CountriesList::currencies() as $code => $currency)
                      <option value=""></option>
                      <option value="{{$code}}"
                      @if (collect(setting('currencies'))->contains($code))
                      selected=""
                      @endif>
                          {{ $currency->name }}
                      </option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_currency') }}
            </label>
            <div class="col-md-9">
                <select name="default_currency" id="single" class="form-control select2">
                    @foreach (CountriesList::currencies() as $code => $currency)
                      <option value="{{ $code }}"
                      @if (setting('default_currency') == $code)
                      selected
                      @endif>
                        {{ $currency->name }}
                      </option>
                    @endforeach
                </select>
            </div>
        </div>

        @inject('countries','Modules\Area\Entities\Country')
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_country') }}
            </label>
            <div class="col-md-9">
                <select name="default_country" id="single" class="form-control select2">
                    @foreach ($countries::all() as  $country)
                      <option value=""></option>
                      <option value="{{ $country->id }}"
                      @if (setting('default_country') == $country->id)
                      selected
                      @endif>
                        {{ $country->title }}
                      </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2">
               Andriod
            </label>
            <div class="col-md-9">
                <input type="text" value="#" class="form-control" name="other[andriod]" value="{{ setting('other', 'andriod' ) }}" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
               Ios
            </label>
            <div class="col-md-9">
                <input type="text" value="#" class="form-control" name="other[ios]" value="{{ setting('other', 'ios' ) }}" />
            </div>
        </div>



    </div>
</div>
