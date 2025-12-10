<style>
body {
    font-family: Arial, sans-serif;
    background-color: #fef7f1;
    margin:0; padding:0;
}

.container {
    max-width:480px;
    margin:4rem auto;
    padding:2rem;
    background:#fff;
    border-radius:.5rem;
    box-shadow:0 4px 10px rgba(0,0,0,.1);
}

h2 {
    text-align:center;
    margin-bottom:1.5rem;
    font-size:1.75rem;
    color:#d97706;
}

input[type="email"] {
    width:100%;
    padding:.6rem .8rem;
    border:1px solid #e0a35b;
    border-radius:.3rem;
    margin-bottom:1rem;
    font-size:1rem;
    background:#fff9f3;
}

input[type="email"]:focus {
    border-color:#FF9800;
    outline:none;
    box-shadow:0 0 4px rgba(255,152,0,.4);
}

.btn-submit {
    width:100%;
    background:#FF9800;
    color:#fff;
    padding:.6rem;
    font-weight:bold;
    border:none;
    border-radius:.3rem;
    cursor:pointer;
    transition:.2s;
}

.btn-submit:hover {
    background:#FB8C00;
}

.alert {
    padding:.75rem 1rem;
    border-radius:.3rem;
    margin-bottom:1rem;
    text-align:center;
    font-weight:bold;
}

.alert-success {
    background:#ffa726;
    color:#fff;
}

.alert-error {
    background:#f57c00;
    color:#fff;
}

.key-box {
    background:#fff6e9;
    padding:1rem;
    border-radius:.3rem;
    border:1px solid #f2c283;
    margin-top:1rem;
}

.key-row {
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:.5rem;
    flex-wrap:wrap;
}

.key-code {
    font-family: monospace;
    font-size:1.1rem;
    background:#ffedd3;
    padding:.5rem .75rem;
    border-radius:.3rem;
    border:1px solid #f3b46a;
    word-break:break-all;
    flex:1;
    user-select:none;
}

.btn-copy {
    background:#FF9800;
    color:#fff;
    padding:.5rem .75rem;
    border-radius:.3rem;
    font-weight:bold;
    border:none;
    transition:.2s;
    white-space:nowrap;
    cursor:pointer;
}

.btn-copy:hover {
    background:#FB8C00;
}

p.info {
    margin-bottom:.5rem;
    font-size:.95rem;
    color:#aa6b15;
}
</style>

<div class="container">

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-error">{{ session('error') }}</div>
    @endif

    <h2>Check Your API Key</h2>

    <form method="POST" action="{{ route('pickup.check') }}">
        @csrf
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        <button type="submit" class="btn-submit">Check Key</button>
    </form>

    @if(session('pending_key'))
        <div class="key-box">
            <p class="info">It can be copied once and used forever!</p>
            <p>Use the button below to activate it:</p>
            <div class="key-row">
                <code id="key-{{ session('pending_email') }}" class="key-code">{{ session('pending_key') }}</code>

                <form method="POST" action="{{ route('pickup.copy') }}">
                    @csrf
                    <input type="hidden" name="email" value="{{ session('pending_email') }}">
                    <button type="submit"
                            onclick="copyAndSubmit(event)"
                            class="btn-copy">
                        Activate & Copy
                    </button>
                </form>
            </div>
        </div>
    @endif
</div>

<script>
function copyAndSubmit(e) {
    e.preventDefault();
    const key = e.target.closest('.key-row').querySelector('.key-code').innerText;
    navigator.clipboard.writeText(key).then(() => {
        e.target.closest('form').submit();
    });
}
</script>
