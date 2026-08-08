<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Administrator | YONBUS Tax & Accounting Services</title>
    <meta name="description" content="Initial Administrator Registration Console for YONBUS Platform.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100vh; font-family: 'Inter', sans-serif; }
        
        body {
            min-height: 100vh;
            background: radial-gradient(circle at top, #0f172a 0%, #020617 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            color: #f8fafc;
        }

        .admin-auth-container {
            width: 100%;
            max-width: 520px;
            margin: auto;
        }

        .admin-card {
            background: rgba(15, 23, 42, 0.85);
            border: 1px solid rgba(59, 130, 246, 0.25);
            backdrop-filter: blur(24px);
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6), 0 0 40px rgba(0, 93, 255, 0.15);
            position: relative;
            overflow: hidden;
        }

        .admin-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #005DFF, #38bdf8, #f59e0b, #005DFF);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 24px;
        }
        .brand-logo-img {
            max-width: 200px;
            height: auto;
            object-fit: contain;
            margin-bottom: 14px;
            background: rgba(255, 255, 255, 0.95);
            padding: 8px 16px;
            border-radius: 14px;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(16, 185, 129, 0.15);
            border: 1px solid rgba(16, 185, 129, 0.35);
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            color: #34d399;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 6px;
        }
        .card-sub {
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 20px;
        }

        .status-alert {
            background: rgba(239, 68, 68, 0.15);
            border: 1px solid rgba(239, 68, 68, 0.3);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            color: #fca5a5;
            margin-bottom: 20px;
        }

        .grid-2 { display: grid; grid-template-columns: 1fr 1fr; gap: 14px; }
        .form-group { margin-bottom: 16px; text-align: left; }
        .form-label { display: block; font-size: 11px; font-weight: 700; color: #cbd5e1; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            width: 100%;
            padding: 12px 14px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #ffffff;
            background: rgba(15, 23, 42, 0.6);
            border: 1.5px solid rgba(148, 163, 184, 0.2);
            border-radius: 12px;
            outline: none;
            transition: all 0.2s;
        }
        .form-input:focus {
            border-color: #38bdf8;
            box-shadow: 0 0 0 4px rgba(56, 189, 248, 0.15);
            background: rgba(15, 23, 42, 0.9);
        }
        .form-error { font-size: 12px; color: #f87171; margin-top: 4px; }

        .btn-admin-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, #005DFF 0%, #002B8A 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 8px 24px rgba(0, 93, 255, 0.4);
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-admin-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 93, 255, 0.5);
            background: linear-gradient(135deg, #00A3FF 0%, #005DFF 100%);
        }

        .admin-footer {
            margin-top: 20px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .admin-footer a {
            color: #38bdf8;
            font-weight: 600;
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="admin-auth-container">
    <div class="admin-card">
        <div class="brand-header">
            <img src="/images/logo.png" alt="YONBUS Logo" class="brand-logo-img">
            <div>
                <span class="security-badge">🔑 Register Administrator</span>
            </div>
            <h1 class="card-title">Create Admin Account</h1>
            <p class="card-sub">Setup executive administrator credentials.</p>
        </div>

        @if ($errors->any())
            <div class="status-alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('admin.register.store') }}">
            @csrf

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label" for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" class="form-input" placeholder="Admin" required autofocus>
                    @error('first_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" class="form-input" placeholder="User" required>
                    @error('last_name') <div class="form-error">{{ $message }}</div> @enderror
                </div>
            </div>

            <div class="form-group">
                <label class="form-label" for="email">Admin Email Address</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" class="form-input" placeholder="admin@yonbustax.com" required>
                @error('email') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="form-group">
                <label class="form-label" for="phone">Phone Number (Optional)</label>
                <input id="phone" type="text" name="phone" value="{{ old('phone') }}" class="form-input" placeholder="+1 (647) 723-0990">
                @error('phone') <div class="form-error">{{ $message }}</div> @enderror
            </div>

            <div class="grid-2">
                <div class="form-group">
                    <label class="form-label" for="password">Password</label>
                    <input id="password" type="password" name="password" class="form-input" placeholder="••••••••" required>
                    @error('password') <div class="form-error">{{ $message }}</div> @enderror
                </div>
                <div class="form-group">
                    <label class="form-label" for="password_confirmation">Confirm Password</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" class="form-input" placeholder="••••••••" required>
                </div>
            </div>

            <button type="submit" class="btn-admin-submit">
                <span>Create Administrator Account</span>
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>

        <div class="admin-footer">
            Already registered? <a href="{{ route('admin.login') }}">Admin Login Portal</a>
        </div>
    </div>
</div>

</body>
</html>
