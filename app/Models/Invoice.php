<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Invoice extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'price',
        'type',
        'invoice_id',
        'pdf_url',
        'incoming_invoice_url',
        'invoice_number',
        'due_date',
        'account_number',
        'payer_name',
        'payer_inn',
        'payer_kpp',
        'items',
        'contacts',
        'contact_phone',
        'comment',
        'status',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'due_date' => 'datetime',
        'items' => 'array', // Если items хранится как JSON
        'contacts' => 'array', // Если contacts хранится как JSON
    ];

    /**
     * Get the user that owns the invoice.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Check if invoice has a PDF document.
     */
    public function hasPdf(): bool
    {
        return !empty($this->pdf_url);
    }

    /**
     * Check if invoice has an incoming invoice document.
     */
    public function hasIncomingInvoice(): bool
    {
        return !empty($this->incoming_invoice_url);
    }

    /**
     * Check if invoice is overdue.
     */
    public function isOverdue(): bool
    {
        return now()->greaterThan($this->due_date);
    }

    /**
     * Get formatted price with currency symbol.
     */
    public function formattedPrice(): string
    {
        return number_format($this->price, 2, '.', ' ') . ' ₽';
    }

    /**
     * Scope a query to only include overdue invoices.
     */
    public function scopeOverdue($query)
    {
        return $query->where('due_date', '<', now());
    }

    /**
     * Scope a query to only include upcoming invoices.
     */
    public function scopeUpcoming($query)
    {
        return $query->where('due_date', '>', now());
    }
}
