<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    public static array $fieldLabels = [
        'name' => 'Name',
        'first_name' => 'First Name',
        'last_name' => 'Last Name',
        'email' => 'Email',
        'subject' => 'Subject',
        'message' => 'Message',
    ];

    public static array $preferredOrder = [
        'name', 'first_name', 'last_name', 'email', 'subject', 'message',
    ];

    protected function casts(): array
    {
        return [
            'data' => 'array',
        ];
    }

    protected $guarded = [];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }

    public function getName(): string
    {
        return $this->data['name'] ?? '—';
    }

    public function getSubject(): string
    {
        $subject = $this->data['subject'] ?? null;
        if ($subject && trim($subject) !== '') {
            return $subject;
        }

        // Use a translatable fallback string
        return __('Submission #:id', ['id' => $this->id]);
    }

    public function getMessage(): string
    {
        return $this->data['message'] ?? '—';
    }

    public function formattedCreatedAt(): Attribute
    {
        return Attribute::get(function () {
            $created = $this->created_at;
            if (! $created) {
                return '';
            }
            if ($created->isToday()) {
                return $created->format('H:i');
            } elseif ($created->isCurrentYear()) {
                return $created->format('M j');
            } else {
                return $created->format('M j, Y');
            }
        });
    }

    public function getDisplayFields(): array
    {
        $data = $this->data ?? [];

        return collect($data)
            ->sortBy(function ($v, $k) {
                $idx = array_search($k, self::$preferredOrder);

                return $idx === false ? 999 : $idx;
            })
            ->filter(function ($value) {
                return is_array($value) ? ! empty($value) : (trim((string) $value) !== '');
            })
            ->map(function ($value, $field) {
                $label = self::$fieldLabels[$field] ?? ucfirst(str_replace('_', ' ', $field));

                $type = match (true) {
                    $field === 'email' && filter_var($value, FILTER_VALIDATE_EMAIL) => 'email',
                    is_array($value) => 'array',
                    $field === 'message' && strlen($value) > 80 => 'longtext',
                    default => 'text',
                };

                return [
                    'key' => $field,
                    'label' => $label,
                    'value' => $value,
                    'type' => $type,
                ];
            })
            ->values()
            ->toArray();
    }
}
