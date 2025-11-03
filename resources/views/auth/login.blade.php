@extends('layouts.app')
<!-- Session Status -->
<x-auth-session-status class="mb-4" :status="session('status')" />
@section('content')

<style>
    :root {
        --main-color: #ff0000;
        /* primary red */
        --second-color: #780116;
        /* deep maroon */
        --section-bg: #fffffc;
        /* very light off-white */
        --muted: #6b6b6b;
        --glass: rgba(255, 255, 255, 0.75);
        --card-shadow: 0 8px 30px rgba(15, 15, 15, 0.12);
        --radius-lg: 18px;
        --radius-md: 10px;
        --max-width: 980px;
        font-family: Inter, ui-sans-serif, system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial;
    }


    /* Right panel: login card */
    .login-form-card {
        background: white;
        border-radius: var(--radius-lg);
        padding: 28px;
        box-shadow: var(--card-shadow);
        width: 60%;
    }

    .login-form-card h2 {
        margin: 0 0 6px 0
    }

    .login-form-card p.lead {
        margin: 0 0 18px 0;
        color: var(--muted)
    }

    form {
        display: flex;
        flex-direction: column;
        gap: 14px
    }

    .field {
        display: flex;
        flex-direction: column;
        gap: 8px
    }

    label {
        font-size: 13px;
        color: var(--muted)
    }

    input[type="email"],
    input[type="password"] {
        height: 48px;
        border-radius: 10px;
        border: 1px solid rgba(16, 16, 16, 0.06);
        padding: 12px 14px;
        font-size: 15px;
        outline: none;
        transition: box-shadow .18s, border-color .18s, transform .06s;
        background: #fff;
    }

    input:focus {
        box-shadow: 0 6px 18px rgba(120, 1, 22, 0.06);
        border-color: rgba(120, 1, 22, 0.12)
    }

    .actions {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 10px
    }

    .remember {
        display: flex;
        gap: 8px;
        align-items: center;
        font-size: 14px;
        color: var(--muted)
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        height: 48px;
        padding: 0 18px;
        border-radius: 12px;
        border: none;
        cursor: pointer;
        font-weight: 600;
        font-size: 15px;
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--main-color), var(--second-color));
        color: white;
        box-shadow: 0 8px 22px rgba(120, 1, 22, 0.12);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(16, 16, 16, 0.06);
    }

    .alt-actions {
        display: flex;
        gap: 10px;
        margin-top: 6px
    }

    .divider {
        display: flex;
        align-items: center;
        gap: 12px;
        margin: 6px 0
    }

    .divider span {
        flex: 1;
        height: 1px;
        background: rgba(16, 16, 16, 0.04)
    }

    .divider small {
        color: var(--muted);
        font-size: 13px;
        padding: 0 6px
    }

    .socials {
        display: flex;
        gap: 8px
    }

    .socials button {
        flex: 1;
        height: 44px
    }

    .meta {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 8px;
        font-size: 14px
    }

    .meta a {
        color: var(--main-color);
        text-decoration: none;
        font-weight: 600
    }

    .note {
        font-size: 13px;
        color: var(--muted)
    }

    /* small screen adjustments */
    @media (max-width:980px) {
        .container {
            grid-template-columns: 1fr;
            padding: 18px
        }

        .brand-panel {
            order: 2
        }

        .card {
            order: 1
        }
    }

    @media (max-width:420px) {
        .benefits {
            grid-template-columns: 1fr
        }

        .logo {
            width: 56px;
            height: 56px
        }
    }

    /* subtle entrance animation */
    .enter {
        transform: translateY(6px);
        opacity: 0;
        animation: enter .6s cubic-bezier(.2, .9, .2, 1) both
    }

    @keyframes enter {
        to {
            transform: none;
            opacity: 1
        }
    }

    /* small form validation styles */
    .invalid {
        border-color: #d33 !important
    }

    .error {
        color: #b32;
        font-size: 13px
    }
</style>

<div class="login-form-card enter" aria-labelledby="login-title">
    <div style="display:flex; align-items:center; justify-content:space-between; gap:12px">
        <div>
            <h2 id="login-title">Welcome back</h2>
            <p class="lead">Sign in to continue to your Runstar dashboard</p>
        </div>
        <div style="text-align:right">
            <small class="note">Not a member?</small>
            <div><a href="{{ route('register') }}" class="note"
                    style="font-weight:700; color:var(--main-color); text-decoration:none">Create
                    account</a></div>
        </div>
    </div>

    <form id="loginForm" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="field">
            <label for="email">Userename or Email</label>
            <input name="login" value="{{ old('login') }}" required />
            @error('login')<div>{{ $message }}</div>@enderror
        </div>

        <div class="field">
            <label for="password">Password</label>
            <div style="position:relative; display:flex; align-items:center">
                <input id="password" type="password" name="password" placeholder="••••••••" required />
                <button type="button" id="togglePwd" aria-label="Show password" title="Show password"
                    style="position:absolute; right:8px; height:34px; padding:0 8px; border-radius:8px; border:none; background:transparent; cursor:pointer">👁️</button>
            </div>
            @error('password')<div>{{ $message }}</div>@enderror
        </div>

        <div class="actions">
            <label class="remember"><input type="checkbox" id="remember" /> Remember me</label>
            <a href="{{ route('password.request') }}" class="note">Forgot password?</a>
        </div>

        <button class="btn btn-primary" type="submit">Sign in</button>

        <div class="divider"><span></span><small>or continue with</small><span></span></div>

        <div class="socials">
            <button type="button" class="btn btn-outline" aria-label="Sign in with Google">Google</button>
            <button type="button" class="btn btn-outline" aria-label="Sign in with Apple">Apple</button>
        </div>

        <div class="meta">
            <div class="note">By signing in you accept our <a href="#">Terms</a></div>
            <div style="text-align:right"><a href="#">Need help?</a></div>
        </div>

    </form>
</div>
</div>
<script>
    (function(){
      const pwd = document.getElementById('password');
      const toggle = document.getElementById('togglePwd');

      toggle.addEventListener('click', ()=>{
        const type = pwd.type === 'password' ? 'text' : 'password';
        pwd.type = type;
        toggle.textContent = type === 'password' ? '👁️' : '🙈';
        toggle.setAttribute('aria-label', type === 'password' ? 'Show password' : 'Hide password');
      });
    })();
</script>
@endsection