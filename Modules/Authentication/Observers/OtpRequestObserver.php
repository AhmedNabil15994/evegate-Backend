<?php
  
namespace Modules\Authentication\Observers;
  
use IlluminateAgnostic\Collection\Support\Carbon;
use Modules\Authentication\Entities\OtpRequest;
use Modules\QSale\Ws\WsSender;
  
class OtpRequestObserver
{
    /**
     * Handle the OtpRequest "created" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function creating(OtpRequest $request)
    {
        $request->otp = generateRandomCode(5);
    }
  
    /**
     * Handle the OtpRequest "created" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function created(OtpRequest $request)
    {
        $this->sendOtp($request->phone_code,$request->mobile, $request->otp);
    }
  
    /**
     * Handle the OtpRequest "updating" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function updating(OtpRequest $request)
    {
        $request->otp = generateRandomCode(5);
        $request->updated_at = Carbon::now()->toDateTimeString();
    }
  
    /**
     * Handle the OtpRequest "updated" event.
     *
     * @param  \Modules\Authentication\Entities\OtpRequest  $request
     * @return void
     */
    public function updated(OtpRequest $request)
    {
        $this->sendOtp($request->phone_code,$request->mobile, $request->otp);
    }

    private  function sendOtp($phoneCode,$mobile,$otp)
    {
        if($phoneCode == '20'){
            $phone = $phoneCode . ((int)$mobile);
        }else{
            $phone = $phoneCode . $mobile;
        }
        
        (new WsSender)->sendOtp($otp, $phone);
    }
  
}

