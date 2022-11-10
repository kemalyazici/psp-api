<?php

namespace Tests\Unit;

use App\Models\User;
use Tests\TestCase;
use Tymon\JWTAuth\Facades\JWTAuth;


class TransactionTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function test_transaction_report()
    {
        $user = User::where('email','test@testuser')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer ".$token])->json('POST','/api/v3/transactions/report',[
            'apiKey' => $user->apiKey,
            "fromDate"=> "2011-01-01",
            "toDate"=> "2020-01-01"

        ]);

        $response->assertStatus(200);

    }

    public function test_transaction_list()
    {
        $user = User::where('email','test@testuser')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer ".$token])->json('POST','/api/v3/transactions/list',[
            'apiKey' => $user->apiKey,
            "fromDate"=> "2011-01-01",
            "toDate"=> "2020-01-01",
            "currency"=> "GBP",
            "status" => "APPROVED",
            "operation"=> "DIRECT",
            "paymentMethod"=>"GIROPAY"

        ]);

        $response->assertStatus(200);

    }

    public function test_transaction()
    {
        $user = User::where('email','test@testuser')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer ".$token])->json('POST','/api/v3/transactions',[
            'apiKey' => $user->apiKey,
            "transactionId" => "560-350247001668048542-4"

        ]);

        $response->assertStatus(200);

    }
    public function test_client()
    {
        $user = User::where('email','test@testuser')->first();
        $token = JWTAuth::fromUser($user);
        $response = $this->withHeaders(['Authorization' => "Bearer ".$token])->json('POST','/api/v3/client',[
            'apiKey' => $user->apiKey,
            "transactionId" => "560-350247001668048542-4"

        ]);

        $response->assertStatus(200);

    }
}
