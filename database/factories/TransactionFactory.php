<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $status = array( "APPROVED", "WAITING", "DECLINED", "ERROR" );
        $operation = [ "DIRECT", "REFUND", "3D", "3DAUTH", "STORED" ];
        $method = [ "CREDITCARD", "CUP", "IDEAL", "GIROPAY", "MISTERCASH", "STORED", "PAYTOCARD", "CEPBANK", "CITADEL" ];
        $currency = ['EUR','USD','TRY','GBP'];
        $time = str_replace('0.','',microtime());
        $time = str_replace(' ','', $time);
        return [
            'transactionId' => rand(100,999).'-'.$time.'-'.rand(1,9),
            'status' => $status[rand(0,3)],
            'operation' => $operation[rand(0,4)],
            'paymentMethod' => $method[rand(0,8)],
            'currency' => $currency[rand(0,3)],
            'amount' => rand(1,999),
            'date' => $this->faker->dateTimeBetween($startDate = '-20 years', $endDate = 'now', $timezone = null),
            'user_id' => 1,
            'customer_id' => rand(1,100)
        ];
    }
}
