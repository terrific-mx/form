<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Form Submission</title>
</head>
<body>
    <div>
        <h1>Test Form Submission</h1>
        @if(\App\Models\Form::first())
            <form method="POST" action="{{ route('form-submissions.store', ['form' => \App\Models\Form::first()->ulid]) }}">
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" required>
                </div>
                <div>
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <div>
                    <label for="subject">Subject</label>
                    <input type="text" name="subject" id="subject">
                </div>
                <div>
                    <label for="message">Message</label>
                    <textarea name="message" id="message" rows="4"></textarea>
                </div>
                <button type="submit">Submit</button>
            </form>
        @else
            <div>No form found in the database.</div>
        @endif
    </div>
</body>
</html>
