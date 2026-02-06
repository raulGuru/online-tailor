<?php

namespace App\Handler;
use Spatie\WebhookClient\Jobs\ProcessWebhookJob;
use DB;
class WebhookJobHandlerForPayment extends ProcessWebhookJob
{
    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 120;

    /**
     * Process a payment webhook payload and synchronize payment/order transaction state.
     *
     * The update is keyed by payment_request_id so repeated webhook deliveries overwrite
     * the same rows instead of creating duplicates.
     */
    public function handle()
    {
        $payload=$this->webhookCall->payload;
        $order_id = DB::table('payments')->where(['payment_request_id' =>$payload['payment_request_id']]
        )->value('order_id');
        $update_data=array('payment_id'=>$payload['payment_id'],'transaction_status'=>$payload['status']);
        $update_stats=DB::table('payments')->where('payment_request_id',$payload['payment_request_id'])->update($update_data);
        $order_status='failed';
        if(strtolower($payload['status'])==='credit')
        {
            $order_status='placed';
        }
        $update_der_stats=DB::table('orders')->where('id',$order_id)->update(array('status'=>$order_status));
    }
}
?>