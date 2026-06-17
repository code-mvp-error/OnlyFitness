<!DOCTYPE html>
<html>
<head><title>New Contact Inquiry</title></head>
<body style="font-family: sans-serif; padding: 24px; background: #f4f4f4;">
    <div style="max-width: 600px; margin: 0 auto; background: #fff; border-radius: 12px; padding: 32px;">
        <h1 style="color: #0A0A0A; font-size: 24px; margin: 0 0 8px;">New Contact Inquiry</h1>
        <p style="color: #666;">A new message has been submitted via the Only Fitness website.</p>
        <hr style="border: none; border-top: 1px solid #eee; margin: 24px 0;">
        <table style="width: 100%; border-collapse: collapse;">
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Name</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333;">{{ $contact->name }}</td></tr>
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Email</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333;">{{ $contact->email }}</td></tr>
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Phone</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333;">{{ $contact->phone }}</td></tr>
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Goal</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333;">{{ str_replace('_', ' ', ucfirst($contact->goal)) }}</td></tr>
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Plan</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333;">{{ ucfirst($contact->plan) }}</td></tr>
            <tr><td style="padding: 8px 0; color: #999; font-size: 12px; text-transform: uppercase; letter-spacing: 1px;">Message</td></tr>
            <tr><td style="padding: 0 0 16px; color: #333; white-space: pre-wrap;">{{ $contact->message }}</td></tr>
        </table>
        <hr style="border: none; border-top: 1px solid #eee; margin: 24px 0;">
        <p style="color: #999; font-size: 12px;">Sent via Only Fitness contact form.</p>
    </div>
</body>
</html>
