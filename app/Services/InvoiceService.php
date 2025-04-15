<?php

namespace App\Services;

use App\Classes\Tinkoff\TinkoffAPIClient;
use App\Models\Invoice;
use App\Models\Requisites;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use stdClass;

class InvoiceService
{
    const ACCOUNT_NUMBER = "40802810600002050260";

    public static function send(Invoice $invoice): ?array
    {
        $data = InvoiceService::prepareInvoiceData($invoice);
        $client = new TinkoffAPIClient();
        return $client->sendInvoice($data);
    }

    public static function store(array $data): Invoice
    {
        if (empty($data['due_date'])) {
            $data['due_date'] = Carbon::now()->addWeek()->timestamp;
        }
        if (empty($data['comment'])) {
            $data['comment'] = 'Пополнение баланса личного кабинета';
        }
        if (empty($data['account_number'])) {
            $data['account_number'] = self::ACCOUNT_NUMBER;
        }

        return Invoice::create($data);
    }

    public static function update(Invoice $invoice, array $data): bool
    {
       return $invoice->update($data);
    }

    public static function prepareInvoiceData(Invoice $invoice): array
    {
        $data = [
            'invoiceNumber' => (string) $invoice->id,
            'dueDate' => $invoice->due_date->format('Y-m-d'),
            'accountNumber' => $invoice->account_number,
            'payer' => [
                'name' => $invoice->payer_name,
                'inn' => (string) $invoice->payer_inn,
            ],
            'items' => [[
                'name' => 'Пополнение баланса личного кабинета',
                'price' => $invoice->amount,
                'unit' => 'штука',
                'vat' => "0",
                'amount' => 1,
            ]]
        ];

        if (!empty($invoice->payer_kpp)) {
            $data['payer']['kpp'] = $invoice->payer_kpp;
        }

        if (!empty($invoice->contact_email)) {
            $data['contacts'] = [['email' => $invoice->contact_email]];
        }

        if (!empty($invoice->contact_phone)) {
            $data['contactPhone'] = $invoice->contact_phone;
        }

        if (!empty($invoice->comment)) {
            $data['comment'] = $invoice->comment;
        }
        return $data;
    }
}
