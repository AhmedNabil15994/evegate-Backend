
@inject("apple_tiers","Modules\QSale\Entities\AppleTier")
{!! field()->langNavTabs() !!}

<div class="tab-content">
    @foreach (config('laravellocalization.supportedLocales') as $code => $lang)
        <div class="tab-pane fade in {{ ($code == locale()) ? 'active' : '' }}"
             id="first_{{$code}}">
            {!! field()->text('title['.$code.']',
            __('qsale::dashboard.coins.form.title').'-'.$code ,
                    $model->getTranslation('title' , $code),
                  ['data-name' => 'title.'.$code]
             ) !!}
            {!! field()->textarea('description['.$code.']',
            __('qsale::dashboard.coins.form.description').'-'.$code ,
                    $model->getTranslation('description' , $code),
                  ['data-name' => 'description.'.$code]
             ) !!}
        </div>
    @endforeach
</div>

{!! field()->number('coins_number', __('qsale::dashboard.coins.form.coins_number')) !!}
{!! field()->number('sort', __('qsale::dashboard.coins.form.sort')) !!}

{!! field()->select('apple_tier_id', __('qsale::dashboard.coins.form.tier'), $apple_tiers->pluck("price","id")->toArray()) !!}
{!! field()->checkBox('status', __('qsale::dashboard.coins.form.status')) !!}