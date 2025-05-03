<!DOCTYPE html>
<html>
<head>
    <title>Contact Form</title>
</head>
<body>
@if (session('success'))
    <p>{{ session('success') }}</p>
@endif

<form action="{{ route('contact.send') }}" method="POST">
    @csrf
    <div>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
    </div>

    <div>
        <label for="message">Message:</label>
        <textarea id="message" name="message" required>{{ old('message') }}</textarea>
    </div>

    <button type="submit">Send</button>
</form>
</body>
</html>
