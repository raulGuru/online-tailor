<?php
namespace App\Handler;

use Exception;
use Illuminate\Http\Request;
use Spatie\WebhookClient\WebhookConfig;
use Spatie\WebhookClient\SignatureValidator\SignatureValidator;

class WebHookSignerHandlerForPayment implements SignatureValidator
{
    /**
     * Verify request signature
     * @param Request $request
     * @param WebhookConfig $config
     * @return bool
     */
    public function isValid(Request $request, WebhookConfig $config): bool
    {
        $signature = $request->mac;
        if (! $signature) {
            return false;
        }
        $signingSecret = $config->signingSecret;
        if (empty($signingSecret)) {
            throw InvalidConfig::signingSecretNotSet();
        }
       
        $data = $_POST;
        $data = $_POST;
        $data = $_POST;
        $mac_provided = $data['mac'];  // Get the MAC from the POST data
        unset($data['mac']);  // Remove the MAC key from the data.

        $ver = explode('.', phpversion());
        $major = (int) $ver[0];
        $minor = (int) $ver[1];

        if($major >= 5 and $minor >= 4){
            ksort($data, SORT_STRING | SORT_FLAG_CASE);
        }
        else{
            uksort($data, 'strcasecmp');
        }
        $computedSignature = hash_hmac("sha1", implode("|", $data), $signingSecret);
        return hash_equals($signature, $computedSignature);
    }
}