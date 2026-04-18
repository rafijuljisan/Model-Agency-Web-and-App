<x-app-layout title="Choose Your Plan">

<style>
/* ═══════════════════════════════════════════
   PRICING / PAYMENT PAGE
═══════════════════════════════════════════ */
@font-face {
        font-family: 'SolaimanLipi';
        src: local('SolaimanLipi'),
             url('/fonts/SolaimanLipi.woff2') format('woff2'),
             url('/fonts/SolaimanLipi.ttf') format('truetype');
        font-weight: normal;
        font-style: normal;
        font-display: swap;
    }
/* Page hero */
.pricing-hero {
    background: var(--bg-secondary);
    border-bottom: 1px solid var(--border);
    padding: 80px 40px 72px;
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
    font-size: 1.1rem;
    font-weight: 600;
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
    font-family: 'SolaimanLipi', sans-serif;
    font-size: clamp(2.5rem, 5vw, 4rem);
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.15;
    position: relative;
}
.pricing-hero-title strong { font-weight: 600; }
.pricing-hero-sub {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.5rem;
    color: var(--text-muted);
    margin-top: 16px;
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

/* Selected state */
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
.package-popular {
    position: absolute;
    top: -1px; left: 32px;
    background: var(--gold);
    color: #faf8f5;
    font-size: 0.95rem;
    font-weight: 700;
    text-transform: uppercase;
    padding: 4px 12px;
}

.package-name {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
    margin-bottom: 4px;
}
.package-duration {
    font-size: 1.05rem;
    font-weight: 500;
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
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.5rem;
    font-weight: 400;
    color: var(--gold);
}
.package-price {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 3.5rem;
    font-weight: 600;
    color: var(--text-primary);
    line-height: 1;
}
.package-price-sub {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.3rem;
    color: var(--text-muted);
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
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.4rem;
    color: var(--text-secondary);
    line-height: 1.5;
}
.package-feature-check {
    color: var(--gold);
    flex-shrink: 0;
    margin-top: 3px;
    width: 18px;
    height: 18px;
}

/* ── Payment section ── */
.payment-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    transition: background 0.4s, border-color 0.4s;
    border-radius: 8px;
    overflow: hidden;
}
.payment-section-header {
    padding: 22px 32px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
    background: var(--bg-primary);
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
    border-radius: 4px;
}
.payment-section-title {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
}
.payment-section-body {
    padding: 32px;
}

/* ── NEW: Payment Instruction Box (Fixes the broken icon) ── */
.payment-instruction {
    display: flex;
    align-items: flex-start;
    gap: 16px;
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    padding: 20px;
    border-radius: 6px;
    margin-bottom: 24px;
}
.payment-instruction-icon {
    flex-shrink: 0;
    color: var(--gold);
    margin-top: 2px;
}
.payment-instruction-text {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.5rem;
    color: var(--text-secondary);
    line-height: 1.6;
}
.payment-instruction-number {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.75rem;
    font-weight: 600;
    color: var(--gold);
    display: block;
    margin-top: 4px;
}

/* ── Payment method tabs ── */
.payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 16px;
    margin-bottom: 24px;
}
.payment-method-label {
    display: block;
    cursor: pointer;
    position: relative;
}
.payment-method-label input[type="radio"] {
    position: absolute;
    opacity: 0;
    width: 0;
    height: 0;
    pointer-events: none;
}
.payment-method-tab {
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px 12px;
    border: 1.5px solid var(--border-strong);
    background: var(--bg-primary);
    color: var(--text-secondary);
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.2rem;
    font-weight: 600;
    text-transform: uppercase;
    border-radius: 6px;
    transition: all 0.25s ease;
    user-select: none;
}
.payment-method-label:hover .payment-method-tab {
    border-color: var(--gold);
}
.payment-method-label input[type="radio"]:checked ~ .payment-method-tab {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}

/* ── NEW: Form Fields Spacing (Fixes cramped inputs) ── */
.pay-field {
    margin-bottom: 24px;
}
.pay-label {
    display: block;
    font-size: 1.05rem;
    font-weight: 600;
    color: var(--text-secondary);
    margin-bottom: 8px;
}
.pay-input {
    width: 100%;
    padding: 14px 16px;
    background: var(--bg-primary);
    border: 1px solid var(--border-strong);
    color: var(--text-primary);
    font-family: 'Jost', sans-serif;
    font-size: 1.05rem;
    font-weight: 400;
    outline: none;
    border-radius: 6px;
    transition: border-color 0.22s, box-shadow 0.22s;
}
.pay-input:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px var(--gold-bg);
}
.pay-hint {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.4rem;
    color: var(--text-muted);
    margin-top: 8px;
}

/* ── NEW: Order Summary Box ── */
.order-summary {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: var(--bg-secondary);
    border: 1px solid var(--border);
    padding: 24px;
    border-radius: 6px;
    margin-bottom: 32px;
    margin-top: 16px;
}
.order-summary-label {
    font-size: 1.1rem;
    font-weight: 600;
    color: var(--text-primary);
}
.order-summary-note {
    font-size: 0.95rem;
    color: var(--text-secondary);
    margin-top: 4px;
}
.order-summary-amount {
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 2rem;
    font-weight: 600;
    color: var(--gold);
}
.order-summary-amount sup {
    font-size: 1.2rem;
    margin-right: 4px;
}

/* Submit button */
.pay-submit {
    width: 100%;
    padding: 18px 32px;
    background: var(--gold);
    color: #fff;
    font-family: 'SolaimanLipi', sans-serif;
    font-size: 1.3rem;
    font-weight: 600;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    transition: background 0.25s, transform 0.2s;
}
.pay-submit:hover {
    background: #b8860b;
}
.secure-note {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
    margin-top: 20px;
    font-size: 0.95rem;
    color: var(--text-muted);
}

/* Responsive */
@media (max-width: 640px) {
    .pricing-page { padding: 32px 20px 60px; }
    .pricing-hero { padding: 48px 20px 40px; }
    .packages-grid { grid-template-columns: 1fr; }
    .payment-section-body { padding: 20px; }
    .payment-section-header { padding: 16px 20px; }
    .package-card { padding: 24px 20px; }
    .payment-methods { grid-template-columns: 1fr; }
    .order-summary { flex-direction: column; text-align: center; gap: 16px; }
}
</style>

{{-- ══════════════════════════════════
     PAGE HERO
══════════════════════════════════ --}}
<div class="pricing-hero">
    <div class="pricing-hero-eyebrow">মেম্বারশিপ প্ল্যানসমূহ</div>
    <h1 class="pricing-hero-title">আপনার <strong>প্ল্যান</strong> নির্বাচন করুন</h1>
    <p class="pricing-hero-sub">ভেরিফাইড ট্যালেন্ট ডিরেক্টরিতে আপনার প্রোফাইল সম্পূর্ণভাবে আনলক করুন।</p>
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

                        @if($index === 1)
                            <div class="package-popular">সবচেয়ে জনপ্রিয়</div>
                        @endif

                        <div class="package-select-ring"></div>

                        <div class="package-name">{{ $package->name }}</div>
                        <div class="package-duration">{{ $package->duration_months }} মাসের অ্যাক্সেস</div>

                        <div class="package-price-row">
                            <span class="package-currency">৳</span>
                            <span class="package-price">{{ number_format($package->price) }}</span>
                        </div>
                        <div class="package-price-sub">এককালীন পেমেন্ট &nbsp;·&nbsp; কোনো লুকানো চার্জ নেই</div>

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
                <div class="payment-section-title">পেমেন্ট নির্দেশিকা</div>
            </div>
            <div class="payment-section-body">

                {{-- Instruction banner --}}
                <div class="payment-instruction">
                    <svg class="payment-instruction-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <div class="payment-instruction-text">
                        আপনার নির্বাচিত প্ল্যানের নির্দিষ্ট পরিমাণ টাকা নিচের মেথড ব্যবহার করে 
                        <strong id="payment-send-type">সেন্ড মানি (Send Money)</strong> 
                        করুন। পেমেন্ট সম্পন্ন হলে নিচের ফর্মে আপনার মোবাইল নম্বর এবং ট্রানজেকশন আইডি (TrxID) প্রদান করুন।
                    </div>
                </div>

                {{-- Payment method tabs --}}
                <div class="payment-methods">
                    @if($settings?->bkash_number)
                        <label class="payment-method-label">
                            <input type="radio" name="payment_method" value="bKash" required>
                            <div class="payment-method-tab">বিকাশ</div>
                        </label>
                    @endif

                    @if($settings?->nagad_number)
                        <label class="payment-method-label">
                            <input type="radio" name="payment_method" value="Nagad" required>
                            <div class="payment-method-tab">নগদ</div>
                        </label>
                    @endif

                    @if($settings?->rocket_number)
                        <label class="payment-method-label">
                            <input type="radio" name="payment_method" value="Rocket" required>
                            <div class="payment-method-tab">রকেট</div>
                        </label>
                    @endif
                </div>

                {{-- Dynamic number display --}}
                <div class="payment-instruction" id="payment-number-display">
                    <svg class="payment-instruction-icon" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                    </svg>
                    <div class="payment-instruction-text">
                        এই নম্বরে টাকা পাঠান:
                        <span class="payment-instruction-number" id="payment-number-shown">—</span>
                        <span id="payment-account-type" style="font-size:1.1rem; color:var(--text-muted); text-transform:uppercase; margin-top:2px; display:block;"></span>
                    </div>
                </div>

                {{-- Sender number field --}}
                <div class="pay-field">
                    <label class="pay-label" for="p-sender">
                        আপনার মোবাইল নম্বর <span style="color:var(--gold)">*</span>
                    </label>
                    <input
                        id="p-sender"
                        type="tel"
                        name="sender_number"
                        class="pay-input"
                        required
                        placeholder="যেমন: 01XXXXXXXXX"
                        autocomplete="tel"
                    >
                    <div class="pay-hint">যে নম্বর থেকে আপনি পেমেন্ট পাঠিয়েছেন।</div>
                </div>
                
                {{-- TrxID field --}}
                <div class="pay-field">
                    <label class="pay-label" for="p-trxid">
                        ট্রানজেকশন আইডি (TrxID) <span style="color:var(--gold)">*</span>
                    </label>
                    <input
                        id="p-trxid"
                        type="text"
                        name="trx_id"
                        class="pay-input"
                        required
                        placeholder="যেমন: 9J5A6B8C"
                        autocomplete="off"
                        style="letter-spacing:0.1em;"
                    >
                    <div class="pay-hint">এটি আপনার পেমেন্ট হিস্টোরিতে বা এসএমএস-এ পাবেন।</div>
                </div>

                {{-- Order summary --}}
                <div class="order-summary">
                    <div>
                        <div class="order-summary-label">আপনার সর্বমোট পেমেন্ট</div>
                        <div class="order-summary-note">আপনার পেমেন্ট ২৪ ঘণ্টার মধ্যে ভেরিফাই করা হবে।</div>
                    </div>
                    <div class="order-summary-amount" id="order-summary-amount">
                        <sup>৳</sup>—
                    </div>
                </div>

                {{-- Submit --}}
                <button type="submit" class="pay-submit">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
                    </svg>
                    ভেরিফিকেশনের জন্য পেমেন্ট সাবমিট করুন
                </button>

                <div class="secure-note">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="3" y="11" width="18" height="11" rx="1"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                    </svg>
                    সকল সাবমিশন ম্যানুয়ালি চেক করা হয় এবং ২৪ ঘণ্টার মধ্যে ভেরিফাই করা হয়
                </div>

            </div>
        </div>

    </form>
</div>

{{-- Live order summary update --}}
<script>
(function () {
    const radios  = document.querySelectorAll('input[name="package_id"]');
    const amtEl   = document.getElementById('order-summary-amount');

    const prices = {
        @foreach($packages as $package)
        '{{ $package->id }}': '{{ number_format($package->price) }}',
        @endforeach
    };

    function updateSummary() {
        const checked = document.querySelector('input[name="package_id"]:checked');
        if (checked && prices[checked.value]) {
            // Converts English numbers to Bangla dynamically
            const englishNumbers = ['0','1','2','3','4','5','6','7','8','9'];
            const banglaNumbers = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
            let banglaPrice = prices[checked.value];
            
            englishNumbers.forEach((num, index) => {
                banglaPrice = banglaPrice.split(num).join(banglaNumbers[index]);
            });

            amtEl.innerHTML = '<sup>৳</sup>' + banglaPrice;
        }
    }

    radios.forEach(function (r) { r.addEventListener('change', updateSummary); });
    updateSummary(); // init
})();
</script>

<script>
(function () {
    // Numbers loaded from PHP
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