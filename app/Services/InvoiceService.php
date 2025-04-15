<?php

namespace App\Services;

use App\Classes\Tinkoff\TinkoffAPIClient;
use App\Models\Invoice;
use App\Models\Requisites;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class InvoiceService
{
    public static function send(Invoice $invoice): ?array
    {
        $data = InvoiceService::prepareInvoiceData($invoice);
        $client = new TinkoffAPIClient();
        dd($client->sendInvoice($data));
    }

    public static function store(array $data): Invoice
    {
        if (empty($data['due_data'])) {
            $data['due_data'] = Carbon::now()->addWeek();
        }
        if (empty($data['comment'])) {
            $data['comment'] = 'Пополнение баланса личного кабинета';
        }

        return Invoice::create($data);
    }

    public static function prepareInvoiceData(Invoice $invoice): array
    {
        $data = [
            'invoiceNumber' => $invoice->id,
            'dueDate' => $invoice->due_date,
            'accountNumber' => $invoice->account_number,
            'payer' => [
                'name' => $invoice,
                'inn' => $invoice->payer_inn,
            ],
        ];

        if (!empty($invoice->payer_kpp)) {
            $data['payer']['kpp'] = $invoice->payer_kpp;
        }

        if (!empty($invoice->contact_email)) {
            $data['payer']['contacts'] = [['email' => $invoice->contact_email]];
        }

        if (!empty($invoice->contact_phone)) {
            $data['payer']['contactPhone'] = $invoice->contact_phone;
        }

        if (!empty($invoice->comment)) {
            $data['payer']['comment'] = $invoice->comment;
        }

        return $data;
    }
}
