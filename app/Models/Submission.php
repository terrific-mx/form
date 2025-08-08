<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

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
        return __("Submission #:id", ['id' => $this->id]);
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
}
