<?php

namespace App\Notifications;

use App\Models\Form;
use App\Models\Submission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FormSubmissionReceived extends Notification
{
    use Queueable;

    public function __construct(
        public readonly Form $form,
        public readonly Submission $submission,
    ) {}


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject(__('New Submission Received: :form', ['form' => $this->form->name ?? 'Form']))
            ->line(__('You’ve received a new submission for your form: :form', ['form' => $this->form->name ?? 'Untitled Form']))
            ->action(__('View Form'), route('forms.show', $this->form))
            ->line(__('Thank you for using Terrific Form!'));

    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
