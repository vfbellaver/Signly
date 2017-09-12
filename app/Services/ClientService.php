<?php

namespace App\Services;

use App\Events\ClientCreated;
use App\Events\ClientDeleted;
use App\Events\ClientUpdated;
use App\Forms\ClientForm;
use App\Models\Client;

class ClientService
{
    public function create(ClientForm $form): Client
    {
        return \DB::transaction(function () use ($form) {
            $data = [
				'company_name' => $form->companyName(),
				'first_name' => $form->firstName(),
				'last_name' => $form->lastName(),
				'email' => $form->email(),
				'address_line1' => $form->addressLine1(),
				'address_line2' => $form->addressLine2(),
				'state' => $form->state(),
				'city' => $form->city(),
				'logo' => $form->logo(),
				'phone_1' => $form->phone1(),
				'phone_2' => $form->phone2(),
				'fax' => $form->fax(),
				'zipcode' => $form->zipcode(),
            ];

            $client = new Client($data);

            $client->save();

            event(new ClientCreated($client));

            return $client;
        });
    }

    public function update(ClientForm $form, Client $client): Client
    {
        return \DB::transaction(function () use ($form, $client) {
            
			$client->company_name = $form->companyName();
			$client->first_name = $form->firstName();
			$client->last_name = $form->lastName();
			$client->email = $form->email();
			$client->address_line1 = $form->addressLine1();
			$client->address_line2 = $form->addressLine2();
			$client->state = $form->state();
			$client->city = $form->city();
			$client->logo = $form->logo();
			$client->phone_1 = $form->phone1();
			$client->phone_2 = $form->phone2();
			$client->fax = $form->fax();
			$client->zipcode = $form->zipcode();

            $client->save();

            event(new ClientUpdated($client));

            return $client;
        });
    }

    public function delete(Client $client)
    {
        return \DB::transaction(function() use ($client) {
           $client->delete();

           event(new ClientDeleted($client));
        });
    }
}