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
                'team_id' => auth()->user()->team_id,
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
        return \DB::transaction(function () use ($client) {
            \File::delete($client->logo);
            $client->delete();

            event(new ClientDeleted($client));
        });
    }

    public function extractCsvFile($filename)
    {
        $data = csv_to_array($filename);
        $clients = [];
        foreach ($data as $row) {
            $client = [
                'company_name' => null,
                'first_name' => null,
                'last_name' => null,
                'email' => null,
                'address_line1' => null,
                'address_line2' => null,
                'city' => null,
                'zipcode' => null,
                'state' => null,
                'phone1' => null,
                'phone2' => null,
                'fax' => null,

            ];
            $client = array_intersect_key($row, $client);


            if (!isset($row["company_name"]) || !$row["company_name"]) {
                continue;
            }

            $clients[] = $client;
        }
        //unset($billboard, $data, $face, $filename, $i, $o, $optional, $r, $required, $row, $time, $valid);

        return $clients;
    }

    public function import($data)
    {
        return \DB::transaction(function () use ($data) {
            $events = [];
            $clients = $data['clients'];
            $savedClients = [];

            foreach ($clients as $cli) {
                //create  client
                $client = Client::query()->create([
                    'company_name' => $cli['company_name'],
                    'first_name' => $cli['first_name'],
                    'last_name' => $cli['last_name'],
                    'email' => $cli['email'],
                    'address_line1' => $cli['address_line1'],
                    'address_line2' => $cli['address_line2'],
                    'city' => $cli['city'],
                    'zipcode' => $cli['zipcode'],
                    'state' => $cli['state'],
                    'phone1' => $cli['phone1'],
                    'phone2' => $cli['phone2'],
                    'fax' => $cli['fax'],
                    'team_id' => $data['team_id']
                ]);
                $events[] = new ClientCreated($client);
                $savedClients = $client;
            }

            foreach ($events as $event) {
                event($event);
            }
            return $savedClients;
        });
    }

}