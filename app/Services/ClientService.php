<?php

namespace App\Services;

use App\Events\ClientCreated;
use App\Events\ClientDeleted;
use App\Events\ClientUpdated;
use App\Forms\ClientForm;
use App\Models\Client;
use Storage;

class ClientService
{
    public function create(ClientForm $form): Client
    {
        return \DB::transaction(function () use ($form) {
            $data = [
				'company_name' => $form->companyName(),
				'logo' => $form->logo(),
				'first_name' => $form->firstName(),
				'last_name' => $form->lastName(),
				'email' => $form->email(),
				'address_line1' => $form->addressLine1(),
				'address_line2' => $form->addressLine2(),
				'city' => $form->city(),
				'zipcode' => $form->zipcode(),
				'state' => $form->state(),
				'phone1' => $form->phone1(),
				'phone2' => $form->phone2(),
				'fax' => $form->fax(),
            ];

            $client = new Client($data);
            $client->user()->associate($form->user());
            $client->save();

            event(new ClientCreated($client));

            return $client;
        });
    }

    public function update(ClientForm $form, Client $client): Client
    {
        return \DB::transaction(function () use ($form, $client) {
            
			$client->company_name = $form->companyName();
			$client->logo = $form->logo();
			$client->first_name = $form->firstName();
			$client->last_name = $form->lastName();
			$client->email = $form->email();
			$client->address_line1 = $form->addressLine1();
			$client->address_line2 = $form->addressLine2();
			$client->city = $form->city();
			$client->zipcode = $form->zipcode();
			$client->state = $form->state();
			$client->phone1 = $form->phone1();
			$client->phone2 = $form->phone2();
			$client->fax = $form->fax();

            $client->save();

            event(new ClientUpdated($client));

            return $client;
        });
    }

    public function delete(Client $client)
    {
        return \DB::transaction(function() use ($client) {
           \File::delete($client->logo);
           $client->delete();

           event(new ClientDeleted($client));
        });
    }
}