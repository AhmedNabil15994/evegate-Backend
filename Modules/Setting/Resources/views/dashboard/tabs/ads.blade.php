<div class="tab-pane fade" id="ads">
    <h3 class="page-title">{{ __('setting::dashboard.settings.form.tabs.ads') }}</h3>
    <div class="col-md-10">
       

         {{--  tab for lang --}}
         <ul class="nav nav-tabs">
            @foreach (config('translatable.locales') as $code)
                 <li class="@if($loop->first) active @endif"><a data-toggle="tab" href="#note_{{$code}}">{{ $code }}</a></li>
            @endforeach
        </ul>

        {{--  tab for content --}}
        <div class="tab-content">
            @foreach (config('translatable.locales') as $code)
            <div id="note_{{$code}}" class="tab-pane fade @if($loop->first) in active @endif">
                <div class="form-group">
                    <label class="col-md-2">
                        {{ __('setting::dashboard.settings.form.general_note') }} - {{ $code }}
                    </label>
                    <div class="col-md-9">
                        <textarea type="text" rows="8" cols="80" class="form-control {{is_rtl($code)}}Editor" name="general_note[{{$code}}]" >{{ setting('general_note',$code) }}</textarea>
                    </div>
                </div>
            </div>
            @endforeach
            
        </div>
        

        {{-- <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.number_of_free') }}
            </label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="other[number_of_free]" value="{{ setting('other','number_of_free') ?? 2 }}" autocomplete="off" />
            </div>
        </div> --}}

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_price') }}
            </label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="other[default_price]"  value="{{ setting('other','default_price') ?? 0  }}" autocomplete="off" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.company_coins_number_for_ad') }}
            </label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="other[company_coins_number_for_ad]"  value="{{ setting('other','company_coins_number_for_ad') ?? 0  }}" autocomplete="off" />
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.default_duration') }}
            </label>
            <div class="col-md-9">
                <input type="number" class="form-control" name="other[default_duration]"  value="{{ setting('other','default_duration') ?? 5  }}" autocomplete="off" />
            </div>
        </div>


        {{-- <div class="form-group"> --}}
            {{-- <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.service') }}
            </label>
            <div class="col-md-9">
                
                <select name="other[service_id]" id="single" class="form-control select2">
                    @foreach ($mainCategories as $category)
                    <option value="{{ $category->id }}"
                    @if (setting('other','service_id') == $category->id)
                    selected
                    @endif>
                        {{ $category->translateOrDefault(locale())->title}}
                    </option>
                    @endforeach
                </select>

            </div>
        </div> --}}

        {{-- <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.home_category_id') }}
            </label>
            <div class="col-md-9">
               
                <select name="other[home_category_id]" id="single" class="form-control select2">
                    @foreach ($mainCategories as $category)
                    <option value="{{ $category->id }}"
                    @if (setting('other','home_category_id') == $category->id)
                    selected
                    @endif>
                        {{ $category->translateOrDefault(locale())->title}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div> --}}

{{-- 
        <div class="form-group">
            <label class="col-md-2">
                {{ __('setting::dashboard.settings.form.protected_cat') }}
            </label>
            <div class="col-md-9">
               
                <select name="protected_cat[]" id="single" multiple class="form-control select2">
                    @foreach ($mainCategories as $category)
                    <option value="{{ $category->id }}"
                    @if (in_array( $category->id , setting('protected_cat') ?? []))
                    selected
                    @endif>
                        {{ $category->translateOrDefault(locale())->title}}
                    </option>
                    @endforeach
                </select>
            </div>
        </div> --}}



      
    </div>
</div>
