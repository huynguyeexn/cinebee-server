<?php

namespace App\Repositories\Payment;

use App\Models\Payment;
use App\Repositories\BaseRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentRepository extends BaseRepository implements PaymentRepositoryInterface
{
    public function getModel()
    {
        return Payment::class;
    }

    public function createPayment($attributes)
    {
        //
        $vnp_BankCode = $attributes['bank_code'];
        $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
        $vnp_Locale = 'vn';
        //Order info
        $vnp_TxnRef = $attributes['order_code'];
        $vnp_OrderInfo = 'Nội dung thanh toán';
        // Now add 5 minutes to current time
        $vnp_ExpireDate = date('YmdHis', strtotime('+5 minutes'));
        $vnp_Amount = $attributes['amount'] * 100;
        //Billing
        // $vnp_Bill_Mobile = $_POST['txt_billing_mobile'];
        // $vnp_Bill_Email = $_POST['txt_billing_email'];
        // $fullName = trim($_POST['txt_billing_fullname']);
        // if (isset($fullName) && trim($fullName) != '') {
        //     $name = explode(' ', $fullName);
        //     $vnp_Bill_FirstName = array_shift($name);
        //     $vnp_Bill_LastName = array_pop($name);
        // }
        // $vnp_Bill_Address=$_POST['txt_inv_addr1'];
        // $vnp_Bill_City=$_POST['txt_bill_city'];
        // $vnp_Bill_Country=$_POST['txt_bill_country'];
        // $vnp_Bill_State=$_POST['txt_bill_state'];
        // Invoice
        // $vnp_Inv_Phone=$_POST['txt_inv_mobile'];
        // $vnp_Inv_Email=$_POST['txt_inv_email'];
        // $vnp_Inv_Customer=$_POST['txt_inv_customer'];
        // $vnp_Inv_Address=$_POST['txt_inv_addr1'];
        // $vnp_Inv_Company=$_POST['txt_inv_company'];
        // $vnp_Inv_Taxcode=$_POST['txt_inv_taxcode'];
        // $vnp_Inv_Type=$_POST['cbo_inv_type'];

        $inputData = array(
            "vnp_Version" => "2.1.0", // Required
            "vnp_TmnCode" => env('VNP_TIME_CODE'), // Required
            "vnp_Amount" => $vnp_Amount, // Required
            "vnp_Command" => "pay", // Required
            "vnp_CreateDate" => date('YmdHis'), // Required
            "vnp_CurrCode" => "VND", // Required
            "vnp_IpAddr" => $vnp_IpAddr, // Required
            "vnp_ReturnUrl" => env('VNP_CALLBACK_URL'), // Required
            "vnp_TxnRef" => $vnp_TxnRef, // Required
            "vnp_Locale" => $vnp_Locale, // Required
            "vnp_OrderInfo" => $vnp_OrderInfo, // Required
            "vnp_BankCode" => $vnp_BankCode,
            "vnp_ExpireDate" => $vnp_ExpireDate,
        );

        ksort($inputData);
        $query = "";
        $i = 0;
        $hashData = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashData .= '&' . urlencode($key) . "=" . urlencode($value);
            } else {
                $hashData .= urlencode($key) . "=" . urlencode($value);
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = env('VNP_URL') . "?" . $query;
        if (env('VNP_HASH_SECRET')) {
            $vnpSecureHash =   hash_hmac('sha512', $hashData, env('VNP_HASH_SECRET')); // Required
            $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
        }

        Log::info('vnp_Url', [$vnp_Url]);

        return response()->json([
            'data' => $vnp_Url,
        ], 200);
    }

    public function getPayment(Request $request)
    {
        return response()->json([
            'data' => $request->all(),
        ], 200);
    }
}
