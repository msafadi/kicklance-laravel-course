<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PaymentsController extends Controller
{
    /*public function form(Order $order)
    {
        return view('payments.form', [
            'order' => $order,
        ]);
    }*/

    public function callback(Order $order)
    {
        /*$text = 'line 1
line 2 with numbers
0566546621
0598124545
email@domnain.com';

        $lines = explode("\n", $text);
        foreach ($lines as $i => $line) {
            if (preg_match('/^[a-z-A-Z0-9\._]+@[a-z-A-Z0-9\._]+$/', $line)) {
                echo ($i+1) . ': ' .$line;
            }

            if (preg_match('/^05(6|9)[0-9]{7}$/', $line)) {
                echo ($i+1) . ': ' .$line;
            }
        }

        exit;*/


        $id = request()->query('id');

        $token = base64_encode(config('services.moyasar.secret') . ':');

        $payment = Http::baseUrl('https://api.moyasar.com/v1')
            /*->withHeaders([
                'Authorization' => "Basic {$token}",
                'Content-Type' => 'application/json',
                'x-api-key' => '',
            ])*/
            ->withBasicAuth(config('services.moyasar.secret'), '')
            ->get("payments/{$id}")
            ->json();

        if (isset($payment['type']) && $payment['type'] == 'invalid_request_error') {
            return redirect()->route('orders.show', [$order->id])->with('error', $payment['message']);
        }

        if ($payment['status'] == 'paid') {
            $order->status = 'paid';
            $order->save();

            $capture = Http::baseUrl('https://api.moyasar.com/v1')
                ->withHeaders([
                    'Authorization' => "Basic {$token}",
                ])
                ->post("payments/{$id}/capture")
                ->json();
            
            if (isset($payment['type']) && $payment['type'] == 'invalid_request_error') {
                return redirect()->route('orders.show', [$order->id])->with('error', $payment['message']);
            }

            if ($capture['status'] == 'captured') {
                $order->status = 'paid';
                $order->save();
            }
        }

        return redirect()->route('orders.show', [$order->id])->with('success', 'Order paid!');
    }
}
