<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Portal Login | YONBUS Tax & Accounting Services</title>
    <meta name="description" content="Secure System Administrator Console for YONBUS Platform Management.">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&family=Outfit:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html, body { min-height: 100vh; font-family: 'Inter', sans-serif; }
        
        body {
            min-height: 100vh;
            background: #ffffff;
            background-image: 
                radial-gradient(at 0% 0%, rgba(0, 93, 255, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(0, 43, 138, 0.05) 0px, transparent 50%),
                radial-gradient(at 50% 50%, rgba(248, 250, 252, 0.8) 0px, transparent 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 20px;
            color: #1e293b;
        }

        .admin-auth-container {
            width: 100%;
            max-width: 480px;
            margin: auto;
        }

        @keyframes adminCardEntrance {
            0% {
                opacity: 0;
                transform: translateY(24px) scale(0.96);
            }
            100% {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .admin-card {
            background: #ffffff;
            border: 1px solid #E2E8F0;
            border-radius: 28px;
            padding: 40px;
            box-shadow: 0 20px 50px rgba(0, 43, 138, 0.08), 0 2px 8px rgba(0, 0, 0, 0.04);
            position: relative;
            overflow: hidden;
            animation: adminCardEntrance 0.55s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        .admin-card::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, #005DFF, #00A3FF, #002B8A);
        }

        .brand-header {
            text-align: center;
            margin-bottom: 28px;
        }
        .brand-logo-img {
            max-width: 220px;
            height: auto;
            object-fit: contain;
            margin-bottom: 16px;
            display: inline-block;
        }

        .security-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            background: rgba(0, 93, 255, 0.08);
            border: 1px solid rgba(0, 93, 255, 0.2);
            border-radius: 30px;
            font-size: 11px;
            font-weight: 700;
            color: #005DFF;
            letter-spacing: 0.8px;
            text-transform: uppercase;
            margin-bottom: 12px;
        }

        .card-title {
            font-family: 'Outfit', sans-serif;
            font-size: 26px;
            font-weight: 800;
            color: #0B1F4B;
            margin-bottom: 6px;
            letter-spacing: -0.4px;
        }
        .card-sub {
            font-size: 13px;
            color: #64748b;
            margin-bottom: 24px;
        }

        /* Default Credentials Box */
        .cred-box {
            background: #f8fafc;
            border: 1px dashed #cbd5e1;
            border-radius: 16px;
            padding: 16px;
            margin-bottom: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .cred-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            font-size: 12px;
            font-weight: 700;
            color: #005DFF;
        }
        .cred-items {
            font-family: monospace;
            font-size: 13px;
            color: #334155;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }
        .btn-autofill {
            width: 100%;
            padding: 8px 12px;
            background: #eff6ff;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            color: #005DFF;
            font-size: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            margin-top: 4px;
        }
        .btn-autofill:hover {
            background: #dbeafe;
            border-color: #005DFF;
            color: #002B8A;
        }

        .status-alert {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.25);
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 13px;
            color: #b91c1c;
            margin-bottom: 20px;
        }

        .form-group { margin-bottom: 20px; text-align: left; }
        .form-label { display: block; font-size: 12px; font-weight: 700; color: #475569; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px; }
        .form-input {
            width: 100%;
            padding: 14px 16px;
            font-size: 14px;
            font-family: 'Inter', sans-serif;
            color: #0f172a;
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            outline: none;
            transition: all 0.2s;
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-input:focus {
            border-color: #005DFF;
            box-shadow: 0 0 0 4px rgba(0, 93, 255, 0.1);
            background: #ffffff;
        }
        .form-input.is-error { border-color: #ef4444; }
        .form-error { font-size: 12px; color: #ef4444; margin-top: 5px; }

        .pw-wrap { position: relative; }
        .pw-toggle {
            position: absolute; right: 14px; top: 50%; transform: translateY(-50%);
            background: none; border: none; cursor: pointer; color: #94a3b8;
            display: flex; align-items: center; padding: 4px;
        }
        .pw-toggle:hover { color: #005DFF; }

        .btn-admin-submit {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, #002B8A 0%, #005DFF 100%);
            color: #ffffff;
            font-size: 15px;
            font-weight: 800;
            font-family: 'Inter', sans-serif;
            border: none;
            border-radius: 14px;
            cursor: pointer;
            transition: all 0.2s;
            box-shadow: 0 8px 24px rgba(0, 93, 255, 0.35);
            margin-top: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        .btn-admin-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 30px rgba(0, 93, 255, 0.45);
            background: linear-gradient(135deg, #001f66 0%, #0045d8 100%);
        }

        .admin-footer {
            margin-top: 24px;
            text-align: center;
            font-size: 13px;
            color: #64748b;
        }
        .admin-footer a {
            color: #005DFF;
            font-weight: 600;
            text-decoration: none;
        }
        .admin-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>

<div class="admin-auth-container">
    <div class="admin-card">
        <div class="brand-header">
            <img src="/images/logo.png" alt="YONBUS Logo" class="brand-logo-img">
            <div>
                <span class="security-badge">🛡️ Executive Admin Access</span>
            </div>
            <h1 class="card-title">Administrator Console</h1>
            <p class="card-sub">Authorized personnel authentication portal.</p>
        </div>

        @if (session('status'))
            <div class="status-alert">{{ session('status') }}</div>
        @endif

        @if ($errors->any())
            <div class="status-alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="form-group">
                <label class="form-label" for="admin_email">Admin Email</label>
                <input
                    id="admin_email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="form-input {{ $errors->has('email') ? 'is-error' : '' }}"
                    placeholder="Enter administrator email"
                    required
                    autofocus
                    autocomplete="username"
                >
            </div>

            <div class="form-group">
                <label class="form-label" for="admin_password">Password</label>
                <div class="pw-wrap">
                    <input
                        id="admin_password"
                        type="password"
                        name="password"
                        class="form-input {{ $errors->has('password') ? 'is-error' : '' }}"
                        placeholder="••••••••"
                        required
                        autocomplete="current-password"
                    >
                    <button type="button" class="pw-toggle" onclick="togglePw('admin_password', this)">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            <input type="hidden" name="remember" value="1">

            <button type="submit" class="btn-admin-submit">
                <span>Unlock Administrator Portal</span>
                <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
            </button>
        </form>

        <div class="admin-footer">
            Need initial setup? <a href="{{ route('admin.register') }}" style="color: #34d399; font-weight: 700; margin-right: 8px;">Register Admin Account</a> |
            Return to <a href="{{ route('home') }}">Public Site</a>
        </div>
    </div>
</div>

<script>
    function togglePw(id, btn) {
        const input = document.getElementById(id);
        const isText = input.type === 'text';
        input.type = isText ? 'password' : 'text';
        btn.style.color = isText ? '' : '#38bdf8';
    }

    function autofillAdmin() {
        document.getElementById('admin_email').value = 'admin@admin.com';
        document.getElementById('admin_password').value = 'admin';
    }
</script>
</body>
</html>
