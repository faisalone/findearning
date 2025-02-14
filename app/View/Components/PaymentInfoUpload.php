<?php

namespace App\View\Components;

use Illuminate\View\Component;

class PaymentInfoUpload extends Component
{
    public $paymentMethod;
    public $paymentDetails;

    public function __construct($paymentMethod)
    {
        $this->paymentMethod = $paymentMethod;
        $this->paymentDetails = [
            'payeer' => 'Payeer: P12345678',
            'nagad' => 'Nagad: 01XXXXXXXXX',
            'rocket' => 'Rocket: 01XXXXXXXXX',
            'litecoin' => 'Litecoin Address: LKJHGFDSAQWERTYUIOP',
            'bitcoin' => 'Bitcoin Address: 1234567890ABCDEFGHIJKL',
            'binance' => 'Binance Address: BNBMNBVCXZASDFGHJKLQWERTYUIOP',
        ];
    }

    public function render()
    {
        return view('components.payment-info-upload');
    }
}
