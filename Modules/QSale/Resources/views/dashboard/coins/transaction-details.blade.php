@if ($transaction->admin_id)
    
     @lang("Edited by admin")
     , {{optional($transaction->admin)->name}}

@elseif(!is_null($transaction->data))
     @if(!is_array($transaction->data['ads_id']) && !is_null($transaction->data['ads_id']))
          @if(isset($transaction->data['type']))
               @if($transaction->data['type'] == "ad")
                    @lang("Add ads"):
                    @php $ads = Modules\QSale\Entities\Ads::find($transaction->data['ads_id']); @endphp
               @elseif($transaction->data['type'] == "ad_order")
                    @lang("Ads order"):
                    @php $ads = optional(Modules\QSale\Entities\AdsOrder::find($transaction->data['ads_id']))->ads; @endphp
               @endif
               <a href="{{$ads ? route("dashboard.ads.show",optional($ads)->id) : '#'}}">(#{{$transaction->data['ads_id']}}) {{optional($ads)->title}}</a>
          @endif
     @endif
@elseif(!is_null($transaction->payment_id))
     @lang("Charge Coins Balance") : {{optional($transaction->paymentTransaction)->transaction_provider}}
     <br>
     #{{optional($transaction->paymentTransaction)->transaction_id}}
     <br>
     @lang("status"): {{optional($transaction->paymentTransaction)->status}}
     <br>
@endif