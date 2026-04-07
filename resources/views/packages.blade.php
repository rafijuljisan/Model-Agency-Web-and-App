<x-app-layout title="Choose Your Plan">

<style>
/* ═══════════════════════════════════════════
   PRICING / PAYMENT PAGE
═══════════════════════════════════════════ */

/* Page hero */
/* Page hero */
.pricing-hero {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border);
    padding: 80px 40px 72px; /* Slightly increased padding to balance larger text */
    text-align: center;
    position: relative;
    overflow: hidden;
    transition: background 0.4s;
}
.pricing-hero::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image:
        radial-gradient(circle at 20% 50%, var(--gold-bg) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, var(--gold-bg) 0%, transparent 50%);
    pointer-events: none;
}
.pricing-hero-eyebrow {
    font-size: 0.875rem; /* Increased from 0.58rem */
    font-weight: 600;
    letter-spacing: 0.2em; /* Reduced spacing slightly for cleaner look */
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
}
.pricing-hero-eyebrow::before,
.pricing-hero-eyebrow::after {
    content: '';
    width: 32px; height: 1px;
    background: var(--gold);
}
.pricing-hero-title {
    font-family: 'Jost', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem); /* Increased scaling for better impact */
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.15;
    position: relative;
}
.pricing-hero-title strong { font-weight: 600; }
.pricing-hero-sub {
    font-size: 1.125rem; /* Increased from 0.88rem */
    color: var(--text-muted);
    margin-top: 16px;
    letter-spacing: 0.02em;
    position: relative;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* Page body */
.pricing-page {
    max-width: 900px;
    margin: 0 auto;
    padding: 52px 40px 80px;
}

/* ── Package cards ── */
.packages-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 3px;
    margin-bottom: 40px;
    background: var(--border);
    border: 1px solid var(--border);
}

.package-label {
    cursor: pointer;
    display: block;
}
.package-label input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0; height: 0;
    pointer-events: none;
}

.package-card {
    background: var(--bg-surface);
    padding: 36px 32px;
    position: relative;
    transition: background 0.25s;
    border: 2px solid transparent;
    margin: -1px;
}
.package-card:hover { background: var(--gold-bg); }

/* Selected state via sibling selector on checked input */
.package-label input:checked ~ .package-card {
    background: var(--gold-bg);
    border-color: var(--gold);
    z-index: 1;
}
.package-label input:checked ~ .package-card .package-select-ring {
    background: var(--gold);
    border-color: var(--gold);
}
.package-label input:checked ~ .package-card .package-select-ring::after {
    opacity: 1;
}

/* Selection ring */
.package-select-ring {
    position: absolute;
    top: 20px; right: 20px;
    width: 20px; height: 20px;
    border: 1.5px solid var(--border-strong);
    border-radius: 50%;
    background: var(--bg-primary);
    transition: background 0.2s, border-color 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.package-select-ring::after {
    content: '';
    width: 8px; height: 8px;
    border-radius: 50%;
    background: #fff;
    opacity: 0;
    transition: opacity 0.2s;
}

/* Popular badge */
/* Popular badge */
.package-popular {
    position: absolute;
    top: -1px; left: 32px;
    background: var(--gold);
    color: #faf8f5;
    font-size: 0.75rem; /* Increased from 0.52rem */
    font-weight: 700;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 4px 12px;
}

.package-name {
    font-family: 'Jost', sans-serif;
    font-size: 1.75rem; /* Increased from 1.4rem */
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 4px;
    letter-spacing: 0.02em;
}
.package-duration {
    font-size: 0.875rem; /* Increased from 0.62rem */
    font-weight: 500;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-bottom: 24px;
}
.package-price-row {
    display: flex;
    align-items: baseline;
    gap: 6px;
    margin-bottom: 4px;
}
.package-currency {
    font-family: 'Jost', sans-serif;
    font-size: 1.5rem; /* Increased from 1.2rem */
    font-weight: 400;
    color: var(--gold);
}
.package-price {
    font-family: 'Jost', sans-serif;
    font-size: 3.5rem; /* Increased from 3rem */
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1;
}
.package-price-sub {
    font-size: 0.875rem; /* Increased from 0.65rem */
    color: var(--text-muted);
    letter-spacing: 0.05em;
    margin-bottom: 28px;
}

/* Feature list */
.package-features {
    list-style: none;
    display: flex;
    flex-direction: column;
    gap: 12px;
}
.package-feature {
    display: flex;
    align-items: flex-start;
    gap: 12px;
    font-size: 1rem; /* Increased from 0.8rem for standard readability */
    color: var(--text-secondary);
    line-height: 1.5;
}
.package-feature-check {
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 3px;
    width: 18px; /* Slightly larger checkmark */
    height: 18px;
}

/* ── Payment section ── */
.payment-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    transition: background 0.4s, border-color 0.4s;
}
.payment-section-header {
    padding: 22px 32px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
}
.payment-section-icon {
    width: 32px; height: 32px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    flex-shrink: 0;
}
.payment-section-title {
    font-family: 'Jost', sans-serif;
    font-size: 1.5rem; /* Increased from 1.15rem */
    font-weight: 600;
    color: var(--text-primary);
}
.payment-instruction-text {
    font-size: 1rem; /* Increased from 0.82rem */
    color: var(--text-secondary);
    line-height: 1.6;
}
.payment-instruction-number {
    font-family: 'Jost', sans-serif;
    font-size: 1.75rem; /* Increased from 1.4rem */
    font-weight: 600;
    color: var(--gold);
    display: block;
    margin-top: 4px;
    letter-spacing: 0.02em;
}

/* ── Payment method tabs ── */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Puts them neatly side-by-side */
    gap: 16px;
    margin-bottom: 24px;
}

.payment-method-label {
    display: block;
    cursor: pointer;
    position: relative;
}

/* CRITICAL FIX: Completely hide the default browser radio dot */
.payment-method-label input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
}

/* The actual box that the user clicks */
.payment-method-tab {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px 12px;
    border: 1.5px solid var(--border-strong);
    background: var(--bg-primary);
    color: var(--text-secondary);
    font-family: 'Jost', sans-serif;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    border-radius: 6px;
    transition: all 0.25s ease;
    user-select: none;
}

/* Subtle hover effect */
.payment-method-label:hover .payment-method-tab {
    border-color: var(--gold);
}

/* Selected state (Turns the box gold/red when clicked) */
.payment-method-label input[type="radio"]:checked ~ .payment-method-tab {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}

/* Fields */
.pay-label {
    display: block;
    font-size: 0.875rem; /* Increased from 0.62rem */
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 8px;
}
.pay-input,
.pay-select {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg-primary);
    border: 1px solid var(--border-strong);
    color: var(--text-primary);
    font-family: 'Jost', sans-serif;
    font-size: 1rem; /* Increased from 0.88rem - STOPS IOS ZOOM BUG */
    font-weight: 400; /* Increased from 300 to match cleaner inputs */
    outline: none;
    appearance: none;
    -webkit-appearance: none;
    border-radius: 0;
    transition: border-color 0.22s, background 0.4s, color 0.4s, box-shadow 0.22s;
}
.pay-hint {
    font-size: 0.85rem; /* Increased from 0.66rem */
    color: var(--text-muted);
    margin-top: 6px;
    letter-spacing: 0.02em;
}

/* Order summary strip */
.order-summary-label {
    font-size: 0.875rem; /* Increased from 0.62rem */
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--text-muted);
}
.order-summary-note {
    font-size: 1rem; /* Increased from 0.78rem */
    color: var(--text-secondary);
    margin-top: 4px;
}

/* Submit button */
.pay-submit {
    width: 100%;
    padding: 18px 32px;
    background: var(--btn-fill-bg);
    color: var(--btn-fill-color);
    font-family: 'Jost', sans-serif;
    font-size: 1rem; /* Increased from 0.75rem */
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    border: none;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: background 0.25s, transform 0.2s;
}
.secure-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 16px;
    font-size: 0.85rem; /* Increased from 0.66rem */
    color: var(--text-muted);
    letter-spacing: 0.05em;
}

/* Responsive */
@media (max-width: 640px) {
    .pricing-page { padding: 32px 20px 60px; }
    .pricing-hero { padding: 48px 20px 40px; }
    .packages-grid { grid-template-columns: 1fr; }
    .pay-grid-2 { grid-template-columns: 1fr; }
    .payment-section-body { padding: 20px; }
    .payment-section-header { padding: 16px 20px; }
    .package-card { padding: 24px 20px; }
    .payment-methods {
        grid-template-columns: 1fr; /* Forces them to stack vertically on small screens */
    }
}
</style>

{{-- ══════════════════════════════════
     PAGE HERO
══════════════════════════════════ --}}
<div class="pricing-hero">
    <div class="pricing-hero-eyebrow">Membership Plans</div>
    <h1 class="pricing-hero-title">Choose Your <strong>Plan</strong></h1>
    <p class="pricing-hero-sub">Unlock full visibility in the verified talent directory.</p>
</div>

<div class="pricing-page">
    <form action="{{ route('packages.pay') }}" method="POST">
        @csrf

        {{-- ══════════════════════════════════
             PACKAGE CARDS
        ══════════════════════════════════ --}}
        <div class="packages-grid anim-fade-up">
            @foreach($packages as $index => $package)
                <label class="package-label">
                    <input
                        type="radio"
                        name="package_id"
                        value="{{ $package->id }}"
                        required
                        {{ $index === 0 ? 'checked' : '' }}
                    >
                    <div class="package-card">

                        {{-- Popular badge on second package (or add is_popular flag) --}}
                        @if($index === 1)
                            <div class="package-popular">Most Popular</div>
                        @endif

                        <div class="package-select-ring"></div>

                        <div class="package-name">{{ $package->name }}</div>
                        <div class="package-duration">{{ $package->duration_months }} {{ $package->duration_months == 1 ? 'month' : 'months' }} access</div>

                        <div class="package-price-row">
                            <span class="package-currency">৳</span>
                            <span class="package-price">{{ number_format($package->price) }}</span>
                        </div>
                        <div class="package-price-sub">One-time payment &nbsp;·&nbsp; No hidden fees</div>

                        @if($package->features)
                            <ul class="package-features">
                                @foreach($package->features as $feature)
                                    <li class="package-feature">
                                        <svg class="package-feature-check" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                                            <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                                        </svg>
                                        {{ $feature }}
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                </label>
            @endforeach
        </div>

        {{-- ══════════════════════════════════
             PAYMENT DETAILS
        ══════════════════════════════════ --}}
        <div class="payment-section anim-fade-up anim-d2">
            <div class="payment-section-header">
                <div class="payment-section-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                </div>
                <div class="payment-section-title">Payment Instructions</div>
            </div>
            <div class="payment-section-body">

                {{-- Instruction banner --}}
<div class="payment-instruction">
    <svg class="payment-instruction-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
    </svg>
    <div class="payment-instruction-text">
        Send the exact amount for your selected plan via
        <strong id="payment-send-type">Send Money</strong>
        to the number shown after selecting your payment method below.
        Then enter your Transaction ID to complete submission.
    </div>
</div>

{{-- Payment method tabs — now dynamic --}}
<div class="payment-methods">
    @if($settings?->bkash_number)
        <label class="payment-method-label">
            <input type="radio" name="payment_method" value="bKash" required>
            <div class="payment-method-tab">bKash</div>
        </label>
    @endif

    @if($settings?->nagad_number)
        <label class="payment-method-label">
            <input type="radio" name="payment_method" value="Nagad" required>
            <div class="payment-method-tab">Nagad</div>
        </label>
    @endif

    @if($settings?->rocket_number)
        <label class="payment-method-label">
            <input type="radio" name="payment_method" value="Rocket" required>
            <div class="payment-method-tab">Rocket</div>
        </label>
    @endif
</div>

{{-- Dynamic number display — updates on tab switch --}}
<div class="payment-instruction" id="payment-number-display" style="margin-top: 12px;">
    <svg class="payment-instruction-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
        <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
    </svg>
    <div class="payment-instruction-text">
        Send to this number:
        <span class="payment-instruction-number" id="payment-number-shown">—</span>
        <span id="payment-account-type" style="font-size:0.7rem; color:var(--text-muted); letter-spacing:0.1em; text-transform:uppercase; margin-top:2px; display:block;"></span>
    </div>
</div>

                {{-- TrxID field --}}
                {{-- Sender number field ← add this --}}
                <div class="pay-field" style="grid-column:1/-1;">
                    <label class="pay-label" for="p-sender">
                        Your Mobile Number <span style="color:var(--gold)">*</span>
                    </label>
                    <input
                        id="p-sender"
                        type="tel"
                        name="sender_number"
                        class="pay-input"
                        required
                        placeholder="e.g. 01XXXXXXXXX"
                        autocomplete="tel"
                    >
                    <div class="pay-hint">The number you used to send the payment.</div>
                </div>
                {{-- TrxID field --}}
                <div class="pay-field" style="grid-column:1/-1;">
                    <label class="pay-label" for="p-trxid">
                        Transaction ID (TrxID) <span style="color:var(--gold)">*</span>
                    </label>
                    <input
                        id="p-trxid"
                        type="text"
                        name="trx_id"
                        class="pay-input"
                        required
                        placeholder="e.g. 9J5A6B8C"
                        autocomplete="off"
                        style="letter-spacing:0.1em; font-size:1rem;"
                    >
                    <div class="pay-hint">Find this in your transaction history.</div>
                </div>


                {{-- Order summary --}}
                <div class="order-summary">
                    <div>
                        <div class="order-summary-label">You are paying</div>
                        <div class="order-summary-note">Amount will be verified within 24 hours.</div>
                    </div>
                    <div class="order-summary-amount">
                        <sup>৳</sup>—
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="pay-submit">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                    </svg>
                    Submit Payment for Verification
                </button>

                <div class="secure-note">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="1"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    All submissions are manually reviewed &amp; verified within 24 hours
                </div>

            </div>
        </div>

    </form>
</div>

{{-- Live order summary update --}}
<script>
(function () {
    const radios  = document.querySelectorAll('input[name="package_id"]');
    const amtEl   = document.querySelector('.order-summary-amount');

    const prices = {
        @foreach($packages as $package)
        '{{ $package->id }}': '{{ number_format($package->price) }}',
        @endforeach
    };

    function updateSummary() {
        const checked = document.querySelector('input[name="package_id"]:checked');
        if (checked && prices[checked.value]) {
            amtEl.innerHTML = '<sup>৳</sup>' + prices[checked.value];
        }
    }

    radios.forEach(function (r) { r.addEventListener('change', updateSummary); });
    updateSummary(); // init
})();
</script>
<script>
(function () {
    // Numbers loaded from PHP — no hardcoding
    const methods = {
        bKash:  { number: '{{ $settings?->bkash_number }}',  type: '{{ $settings?->bkash_type }}' },
        Nagad:  { number: '{{ $settings?->nagad_number }}',  type: '{{ $settings?->nagad_type }}' },
        Rocket: { number: '{{ $settings?->rocket_number }}', type: '{{ $settings?->rocket_type }}' },
    };

    const numberEl = document.getElementById('payment-number-shown');
    const typeEl   = document.getElementById('payment-account-type');
    const radios   = document.querySelectorAll('input[name="payment_method"]');
    const sendLabel = document.getElementById('payment-send-type');

    function updateDisplay(selected) {
        const m = methods[selected];
        numberEl.textContent = m?.number || '—';
        typeEl.textContent   = m?.type   || '';
        sendLabel.textContent = m?.type   || 'Send Money';
    }

    radios.forEach(function (radio) {
        radio.addEventListener('change', function () {
            updateDisplay(this.value);
        });

        // Init on page load for whichever is checked
        if (radio.checked) updateDisplay(radio.value);
    });
})();
</script>
</x-app-layout>