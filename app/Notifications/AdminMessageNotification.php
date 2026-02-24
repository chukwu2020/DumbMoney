<!DOCTYPE html>
<html lang="{{ $languageCode ?? 'en' }}">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
<title>{{ $subject }} - {{ config('app.name') }}</title>

<style>
@media only screen and (max-width: 600px) {
  .email-container { width: 100% !important; }
  .mobile-padding { padding: 25px !important; }
  .stack-column { display: block !important; width: 100% !important; text-align: left !important; }
}
</style>
</head>

<body style="margin:0; padding:0; background-color:#f4f8f5; font-family: Arial, Helvetica, sans-serif; color:#0C3A30;">

<!-- Hidden Preview Text -->
<div style="display:none; max-height:0; overflow:hidden;">
  {{ $previewText ?? 'You have a new update from MarketMind.' }}
</div>

<table width="100%" cellpadding="0" cellspacing="0" border="0" bgcolor="#f4f8f5">
<tr>
<td align="center" style="padding:40px 15px;">

<!-- Email Card -->
<table class="email-container" width="600" cellpadding="0" cellspacing="0" border="0" bgcolor="#ffffff" style="border-radius:14px; overflow:hidden; box-shadow:0 6px 20px rgba(0,0,0,0.06);">

<!-- Language Badge -->
<tr>
<td style="padding:15px 45px 0 45px; text-align:right;">
    <span style="background:#f0fdf4; color:#8bc905; font-size:12px; padding:4px 12px; border-radius:20px; display:inline-block;">
        🌐 {{ $translatedLabels['translated_to'] ?? 'Translated to' }}: {{ strtoupper($languageCode) }} @if($country)({{ $country }})@endif
    </span>
</td>
</tr>

<!-- Header -->
<tr>
<td style="background:#8bc905; padding:30px 20px; text-align:center;">
<img src="https://res.cloudinary.com/dswwq3xks/image/upload/v1752508147/mymarketmindmainlogo_qonmlk.png"
     alt="MarketMind Logo"
     style="height:55px; margin-bottom:12px; display:block; margin-left:auto; margin-right:auto;">
</td>
</tr>

<!-- Body -->
<tr>
<td class="mobile-padding" style="padding:40px 45px; font-size:15px; line-height:1.7;">
<h2 style="margin:0 0 25px 0; font-size:18px; color:#0C3A30; font-weight:500; letter-spacing:1px; text-transform:uppercase;">
  {{ $subject }}
</h2>

<p style="margin-top:0; font-size:16px;">
  {{ $translatedLabels['hello'] ?? 'Hello' }} {{ $userName ?? ($translatedLabels['valued_investor'] ?? 'Valued Investor') }},
</p>

<p style="margin:20px 0; font-weight:500; letter-spacing:0.4px;">
  {{ $translatedLabels['update_intro'] ?? 'This is an official update from the MarketMind trading desk regarding your account activity' }}:
</p>

<!-- Highlighted Message Box -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin:25px 0;">
<tr>
<td style="background:#f0fdf4; border-left:4px solid #8bc905; padding:20px; border-radius:6px;">
  <p style="margin:0; font-size:15px; line-height:1.7;">
    {{ $messageBody }}
  </p>
</td>
</tr>
</table>

<!-- ===== FIXED: ADD THIS MISSING SECTION ===== -->
<!-- Optional: Show original message in English -->
@if(isset($originalTitle) && $originalTitle != $subject)
<details style="margin:20px 0; background:#f8f9fa; padding:15px; border-radius:8px;">
    <summary style="color:#0C3A30; cursor:pointer; font-weight:500;">📝 {{ $translatedLabels['view_original'] ?? 'View Original English Message' }}</summary>
    <p style="margin-top:15px; color:#4a5f55;"><strong>{{ $originalTitle }}</strong></p>
    <p style="color:#4a5f55;">{{ $originalMessage ?? $messageBody }}</p>
</details>
@endif
<!-- ===== END OF MISSING SECTION ===== -->

<!-- CTA Button -->
@if(!empty($actionUrl))
<table width="100%" cellpadding="0" cellspacing="0" style="margin:35px 0;">
<tr>
<td align="center">
<a href="{{ $actionUrl }}"
   style="background:#8bc905; color:#ffffff; text-decoration:none; padding:14px 28px; border-radius:6px; font-weight:bold; display:inline-block;">
   {{ $actionText ?? ($translatedLabels['view_account'] ?? 'View My Account') }}
</a>
</td>
</tr>
</table>
@endif

<p style="margin-top:30px; font-size:14px; color:#4a5f55;">
  {{ $translatedLabels['help_text'] ?? 'If you have any questions, simply reply to this email - our trading team is here to help' }}.
</p>

<!-- Signature -->
<table width="100%" cellpadding="0" cellspacing="0" style="margin-top:35px; border-top:1px solid #e5efe9; padding-top:20px;">
<tr>
<td>
<p style="margin:0; font-size:14px;">
  {{ $translatedLabels['farewell'] ?? 'Warm regards' }},
</p>
<p style="margin:5px 0 0; font-size:16px; font-weight:600; color:#8bc905;">
  {{ $translatedLabels['team_signature'] ?? 'The MarketMind Team' }}
</p>
</td>
</tr>
</table>

</td>
</tr>

<!-- Footer -->
<tr>
<td bgcolor="#f0fdf4" style="padding:25px; text-align:center; font-size:12px; color:#5a6d5a;">
<p style="margin:0 0 10px;">
  © {{ date('Y') }} MarketMind. {{ $translatedLabels['rights_reserved'] ?? 'All rights reserved' }}.
</p>
<p style="margin:0;">
  {{ $translatedLabels['received_reason'] ?? 'You are receiving this email because you have an active MarketMind account' }}.
</p>
<p style="margin:15px 0 0;">
  <a href="#" style="color:#8bc905; text-decoration:none;">{{ $translatedLabels['help_center'] ?? 'Help Center' }}</a>
  &nbsp;•&nbsp;
  <a href="#" style="color:#8bc905; text-decoration:none;">{{ $translatedLabels['privacy_policy'] ?? 'Privacy Policy' }}</a>
  &nbsp;•&nbsp;
  <a href="#" style="color:#8bc905; text-decoration:none;">{{ $translatedLabels['unsubscribe'] ?? 'Unsubscribe' }}</a>
</p>
</td>
</tr>

</table>

</td>
</tr>
</table>

</body>
</html>