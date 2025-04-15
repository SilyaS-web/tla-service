<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 *
 * @property int $id
 * @property int $amount
 * @property string $invoice_id
 * @property string $account_number
 * @property string $payer_name
 * @property string $payer_inn
 * @property string $payer_kpp
 * @property string $contact_email
 * @property string $contact_phone
 * @property string $comment
 * @property string $status
 * @property int $user_id
 * @property \Datetime $due_date
 * @property-read User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice query()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice withTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|Invoice withoutTrashed()
 * @mixin \Eloquent
 */
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
        'amount',
        'type',
        'invoice_id',
        'pdf_url',
        'incoming_invoice_url',
        'due_date',
        'account_number',
        'payer_name',
        'payer_inn',
        'payer_kpp',
        'items',
        'contact_email',
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
    ];

    /**
     * Get the user that owns the invoice.
     */
    public function user(): BelongsTo
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
