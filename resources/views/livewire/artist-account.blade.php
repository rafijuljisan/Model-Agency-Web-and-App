<div>

<style>
/* ═══════════════════════════════════════════
   PROFILE EDIT FORM PAGE
═══════════════════════════════════════════ */

.form-page {
    max-width: 1000px;
    margin: 0 auto;
    padding: 48px 40px 80px;
}

/* Page header */
.form-page-header {
    margin-bottom: 40px;
    padding-bottom: 28px;
    border-bottom: 1px solid var(--border);
}
.form-page-eyebrow {
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.32em;
    text-transform: uppercase;
    color: var(--gold);
    margin-bottom: 8px;
    display: flex;
    align-items: center;
    gap: 10px;
}
.form-page-eyebrow::before {
    content: '';
    width: 24px; height: 1px;
    background: var(--gold);
}
.form-page-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 2.8rem;
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.1;
}
.form-page-title strong { font-weight: 600; }
.form-page-sub {
    font-size: 1rem;
    color: var(--text-muted);
    margin-top: 6px;
    letter-spacing: 0.04em;
}

/* Progress steps */
.form-steps {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 40px;
    overflow-x: auto;
    padding-bottom: 4px;
}
.form-step {
    display: flex;
    align-items: center;
    gap: 0;
    flex-shrink: 0;
}
.form-step-dot {
    width: 32px; height: 32px;
    border: 1px solid var(--border-strong);
    background: var(--bg-surface);
    color: var(--text-muted);
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.05em;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
    transition: background 0.3s, border-color 0.3s, color 0.3s;
}
.form-step.is-active .form-step-dot {
    background: var(--gold);
    border-color: var(--gold);
    color: #fff;
}
.form-step.is-done .form-step-dot {
    background: var(--bg-surface);
    border-color: var(--gold);
    color: var(--gold);
}
.form-step-label {
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    color: var(--text-muted);
    margin-left: 8px;
    white-space: nowrap;
    transition: color 0.3s;
}
.form-step.is-active .form-step-label { color: var(--text-primary); }
.form-step-line {
    width: 36px; height: 1px;
    background: var(--border-strong);
    margin: 0 8px;
    flex-shrink: 0;
}

/* Section block */
.form-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 24px;
    transition: background 0.4s, border-color 0.4s;
}
.form-section-header {
    padding: 22px 32px;
    border-bottom: 1px solid var(--border);
    display: flex;
    align-items: center;
    gap: 12px;
}
.form-section-icon {
    width: 32px; height: 32px;
    background: var(--gold-bg);
    border: 1px solid var(--border-strong);
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold);
    flex-shrink: 0;
}
.form-section-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: 1.4rem;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: 0.02em;
}
.form-section-desc {
    font-size: 0.9rem;
    color: var(--text-muted);
    margin-left: auto;
    letter-spacing: 0.06em;
}
.form-section-body {
    padding: 28px 32px;
}

/* Grid layouts */
.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
}
.form-grid-full { grid-column: 1 / -1; }

/* Field */
.form-field {}
.form-field-label {
    display: flex;
    align-items: center;
    gap: 5px;
    font-size: 0.875rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 8px;
}
.form-field-label .required {
    color: var(--gold);
    font-size: 0.875rem;
}

/* Inputs */
.form-input,
.form-select,
.form-textarea {
    width: 100%;
    padding: 12px 16px;
    background: var(--bg-primary);
    border: 1px solid var(--border-strong);
    color: var(--text-primary);
    font-family: 'Jost', sans-serif;
    font-size: 1rem;
    font-weight: 300;
    outline: none;
    transition: border-color 0.25s, background 0.4s, color 0.4s, box-shadow 0.25s;
    appearance: none;
    -webkit-appearance: none;
    border-radius: 0;
}
.form-input::placeholder,
.form-textarea::placeholder { color: var(--text-muted); opacity: 0.7; }
.form-input:focus,
.form-select:focus,
.form-textarea:focus {
    border-color: var(--gold);
    box-shadow: 0 0 0 3px var(--gold-bg);
}

/* Select arrow */
.form-select-wrap { position: relative; }
.form-select-wrap::after {
    content: '';
    position: absolute;
    right: 14px; top: 50%;
    transform: translateY(-50%);
    width: 0; height: 0;
    border-left: 4px solid transparent;
    border-right: 4px solid transparent;
    border-top: 5px solid var(--text-muted);
    pointer-events: none;
}
.form-select { padding-right: 36px; cursor: pointer; }

/* Textarea */
.form-textarea { resize: vertical; min-height: 110px; line-height: 1.7; }

/* Input with prefix icon */
.form-input-wrap { position: relative; }
.form-input-wrap .form-input { padding-left: 38px; }
.form-input-icon {
    position: absolute;
    left: 12px; top: 50%;
    transform: translateY(-50%);
    color: var(--text-muted);
    pointer-events: none;
}

/* Hint text */
.form-hint {
    font-size: 0.85rem;
    color: var(--text-muted);
    margin-top: 5px;
    letter-spacing: 0.04em;
    line-height: 1.5;
}

/* ── Portfolio upload zone ── */
.upload-zone {
    display: block; /* CRITICAL FIX: Forces the label to take up full width */
    width: 100%;
    border: 1.5px dashed var(--border-strong);
    background: var(--bg-primary);
    padding: 40px 20px;
    text-align: center;
    cursor: pointer;
    transition: border-color 0.25s, background 0.25s;
    position: relative;
    border-radius: 4px;
}
.upload-zone:hover {
    border-color: var(--gold);
    background: var(--gold-bg);
}
.upload-zone input[type="file"] {
    position: absolute;
    inset: 0;
    opacity: 0;
    cursor: pointer;
    width: 100%;
    height: 100%;
    z-index: 2;
}
.upload-zone-icon {
    color: var(--text-muted);
    margin: 0 auto 12px;
    opacity: 0.5;
    transition: opacity 0.25s, color 0.25s;
}
.upload-zone:hover .upload-zone-icon {
    opacity: 0.85;
    color: var(--gold);
}
.upload-zone-title {
    font-size: 1rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 4px;
}
.upload-zone-sub {
    font-size: 0.875rem;
    color: var(--text-muted);
}
.upload-zone-sub span {
    color: var(--gold);
    font-weight: 500;
}
.upload-loading {
    display: flex;
    align-items: center;
    gap: 7px;
    font-size: 0.875rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--gold);
    margin-top: 10px;
}
.upload-loading svg { animation: spin 0.8s linear infinite; }
@keyframes spin { to { transform: rotate(360deg); } }

/* ── Portfolio thumbnails ── */
.portfolio-thumbs {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
    margin-top: 24px;
}
.portfolio-thumb {
    position: relative;
    aspect-ratio: 1;
    overflow: hidden;
    background: var(--bg-secondary);
    border-radius: 4px;
}
.portfolio-thumb img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.4s;
}
.portfolio-thumb:hover img { 
    transform: scale(1.06); 
}
.portfolio-thumb-del {
    position: absolute;
    top: 8px; right: 8px;
    width: 28px; height: 28px;
    background: rgba(220, 38, 38, 0.9);
    border: none;
    border-radius: 50%;
    color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transform: scale(0.8);
    transition: opacity 0.2s, transform 0.2s;
    z-index: 10;
}

/* Show delete button on hover for desktop users */
@media (hover: hover) and (pointer: fine) {
    .portfolio-thumb:hover .portfolio-thumb-del {
        opacity: 1;
        transform: scale(1);
    }
}

/* CRITICAL MOBILE FIX: Always show delete button on touch devices */
@media (hover: none), (max-width: 768px) {
    .portfolio-thumb-del {
        opacity: 1;
        transform: scale(1);
        background: rgba(220, 38, 38, 0.75); 
    }
}

/* ── Submit bar ── */
.form-submit-bar {
    position: sticky;
    bottom: 0;
    left: 0; right: 0;
    background: var(--bg-surface);
    border-top: 1px solid var(--border);
    padding: 16px 32px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    z-index: 100;
    margin: 0 -40px;
    transition: background 0.4s;
}
.form-submit-status {
    font-size: 0.9rem;
    color: var(--text-muted);
    letter-spacing: 0.06em;
}

/* Flash message */
.form-flash {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 14px 20px;
    background: var(--badge-ok-bg);
    border: 1px solid;
    border-color: var(--badge-ok-color);
    color: var(--badge-ok-color);
    font-size: 1rem;
    font-weight: 500;
    letter-spacing: 0.06em;
    margin-bottom: 24px;
}
/* Container for the buttons */
.submit-actions {
    display: flex;
    gap: 10px;
    align-items: center;
}
/* Responsive */
/* Responsive */
@media (max-width: 768px) {
    .form-page { padding: 32px 20px 120px; }
    .form-grid-2 { grid-template-columns: 1fr; }
    .form-section-body { padding: 20px; }
    .form-section-header { padding: 16px 20px; }
    .portfolio-thumbs { grid-template-columns: repeat(3, 1fr); }
    .form-section-desc { display: none; }
    
    /* ── Mobile Sticky Bar Fixes ── */
    .form-submit-bar { 
        margin: 0 -20px; 
        padding: 16px 20px; 
        flex-direction: column; /* Stack the bar vertically */
        gap: 12px;
    }
    
    .form-submit-status {
        display: none; /* Hide the helper text on mobile to save space */
    }
    
    .submit-actions {
        width: 100%;
        display: flex;
        flex-direction: row; /* Keep buttons side-by-side on tablets */
    }
    
    .submit-actions > * {
        flex: 1; /* Make both buttons take up exactly 50% of the width */
        justify-content: center;
    }
}

@media (max-width: 480px) {
    .portfolio-thumbs { grid-template-columns: repeat(2, 1fr); }
    
    /* On very small phones, stack the buttons on top of each other */
    .submit-actions {
        flex-direction: column-reverse; /* Puts the Save button on top of View Profile */
    }
    
    .submit-actions > * {
        width: 100%;
    }
}
.form-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 24px;
    transition: background 0.4s, border-color 0.4s;
    overflow: visible; /* ← ADD THIS */
}
</style>

<div class="form-page">

        {{-- Error flash --}}
    @if(session()->has('error'))
        <div class="form-flash" style="border-color: #c0392b; color: #c0392b; background: rgba(192,57,43,0.07);">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
            </svg>
            {{ session('error') }}
        </div>
    @endif
    {{-- ═════════════════════════════════════════
         GATE 1: PAYMENT FAILED
    ═════════════════════════════════════════ --}}
    @if($currentStep === 'payment_failed')
        <div class="text-center py-20 anim-fade-up">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: rgba(220, 38, 38, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <h2 class="form-page-title mb-4">Payment <strong>Failed</strong></h2>
            <p class="form-page-sub mx-auto mb-8" style="max-width: 480px; font-size: 1rem;">
                We could not verify your payment. Please double-check your Transaction ID (TrxID) and mobile number, and submit the form again.<br><br>
                If you are certain you paid successfully, please contact our support team.
            </p>
            <div style="display: flex; gap: 16px; justify-content: center;">
                <a href="/contact" class="btn-outline">Contact Support</a>
                <a href="{{ route('packages.index') }}" class="btn-fill">
                    Submit Payment Again
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:8px;"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>
                </a>
            </div>
        </div>

    {{-- ═════════════════════════════════════════
         GATE 2: PAYMENT EXPIRED
    ═════════════════════════════════════════ --}}
    @elseif($currentStep === 'payment_expired')
        <div class="text-center py-20 anim-fade-up">
            <div style="width: 80px; height: 80px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <h2 class="form-page-title mb-4">Subscription <strong>Expired</strong></h2>
            <p class="form-page-sub mx-auto mb-8" style="max-width: 480px; font-size: 1rem;">
                Your verified talent subscription has expired. Please renew your package to restore your public profile and keep receiving casting calls.
            </p>
            <a href="{{ route('packages.index') }}" class="btn-fill" style="display: inline-flex;">
                Renew Subscription
                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="margin-left:8px;"><path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.92-10.26l3.08 2.69"/></svg>
            </a>
        </div>

    {{-- ═════════════════════════════════════════
         GATE 3: PAYMENT PENDING (Change your existing @if to @elseif)
    ═════════════════════════════════════════ --}}
    @elseif($currentStep === 'payment_pending')
        <div class="text-center py-20 anim-fade-up">
        <div class="text-center py-20 anim-fade-up">
            <svg class="mx-auto h-16 w-16 text-yellow-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            <h2 class="form-page-title mb-2">Payment <strong>Pending Verification</strong></h2>
            <p class="form-page-sub mx-auto">Our accounts team is currently verifying your transaction ID. This usually takes a few hours. Please check back soon!</p>
        </div>

    {{-- ═════════════════════════════════════════
         GATE 3: DOCUMENT UPLOAD
    ═════════════════════════════════════════ --}}
    @elseif($currentStep === 'document_upload')
        <div class="form-section anim-fade-up">
            <div class="form-section-header">
                <div class="form-section-title">Step 2: Identity & Academic Verification</div>
            </div>
            <div class="form-section-body">
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 24px; line-height: 1.6;">
                    To maintain the highest quality of talent, we require both a National ID and an Academic/Acting Certificate. Please upload the required documents below.
                </p>
                
                <form wire:submit.prevent="submitDocuments" class="space-y-6">
                    
                    {{-- NID Upload Box --}}
                    @if(Auth::user()->verification_status === 'unverified')
                        <div style="padding: 20px; background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 6px; margin-bottom: 20px;">
                            <h3 style="font-weight: 600; color: var(--text-primary); margin-bottom: 12px; font-size: 0.95rem;">1. National ID (NID)</h3>
                            @if(Auth::user()->nid_path)
                                <p style="font-size: 0.75rem; color: #dc2626; margin-bottom: 12px; font-weight: 600;">Your previous NID was rejected. Please upload a clearer, original copy.</p>
                            @endif
                            <label class="upload-zone">
                                <input type="file" wire:model="nidImage" accept="image/*" required>
                                <svg class="upload-zone-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M4 22h14a2 2 0 002-2V7.5L14.5 2H6a2 2 0 00-2 2v4"/><polyline points="14 2 14 8 20 8"/><path d="M2 15h10"/><path d="M2 18h10"/><path d="M2 12h10"/></svg>
                                <div class="upload-zone-title">Upload NID (Front & Back merged or clear photo)</div>
                            </label>
                            @error('nidImage') <span style="color: #dc2626; font-size: 0.7rem; margin-top: 6px; display: block;">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="nidImage" style="color: var(--gold); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; margin-top: 8px;">Uploading Preview...</div>
                        </div>
                    @else
                        <div style="padding: 16px 20px; background: rgba(22, 163, 74, 0.05); border: 1px solid rgba(22, 163, 74, 0.2); border-radius: 6px; display: flex; align-items: center; gap: 12px; margin-bottom: 20px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #16a34a;">National ID Verified</span>
                        </div>
                    @endif

                    {{-- Academic Upload Box --}}
                    @if(Auth::user()->academic_verification_status === 'unverified')
                        <div style="padding: 20px; background: var(--bg-secondary); border: 1px solid var(--border); border-radius: 6px; margin-bottom: 24px;">
                            <h3 style="font-weight: 600; color: var(--text-primary); margin-bottom: 12px; font-size: 0.95rem;">2. Academic / Training Certificate</h3>
                            @if(Auth::user()->academic_certificate_path)
                                <p style="font-size: 0.75rem; color: #dc2626; margin-bottom: 12px; font-weight: 600;">Your previous certificate was rejected. Please upload a valid original document.</p>
                            @endif
                            <label class="upload-zone">
                                <input type="file" wire:model="academicImage" accept="image/*" required>
                                <svg class="upload-zone-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M22 10v6M2 10l10-5 10 5-10 5z"/><path d="M6 12v5c3 3 9 3 12 0v-5"/></svg>
                                <div class="upload-zone-title">Upload Certificate or Portfolio Document</div>
                            </label>
                            @error('academicImage') <span style="color: #dc2626; font-size: 0.7rem; margin-top: 6px; display: block;">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="academicImage" style="color: var(--gold); font-size: 0.7rem; font-weight: 700; text-transform: uppercase; margin-top: 8px;">Uploading Preview...</div>
                        </div>
                    @else
                        <div style="padding: 16px 20px; background: rgba(22, 163, 74, 0.05); border: 1px solid rgba(22, 163, 74, 0.2); border-radius: 6px; display: flex; align-items: center; gap: 12px; margin-bottom: 24px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path><polyline points="22 4 12 14.01 9 11.01"></polyline></svg>
                            <span style="font-size: 0.85rem; font-weight: 600; color: #16a34a;">Academic Certificate Verified</span>
                        </div>
                    @endif

                    <button type="submit" class="btn-fill w-full justify-center">Submit Documents</button>
                </form>
            </div>
        </div>

    {{-- ═════════════════════════════════════════
         GATE 4: DOCUMENTS PENDING
    ═════════════════════════════════════════ --}}
    @elseif($currentStep === 'document_pending')
        <div class="text-center py-20 anim-fade-up max-w-lg mx-auto">
            <svg class="mx-auto h-16 w-16 text-blue-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
            <h2 class="form-page-title mb-2">Documents <strong>Under Review</strong></h2>
            <p class="form-page-sub mx-auto mb-8" style="color: var(--text-secondary);">Our team is reviewing your uploaded documents. Your profile will unlock once both are approved.</p>
            
            <div style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 20px; text-align: left; box-shadow: var(--shadow-sm);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary);">National ID</span>
                    <span style="font-size: 0.7rem; padding: 4px 10px; border-radius: 999px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; 
                        {{ Auth::user()->verification_status === 'verified' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #eab308;' }}">
                        {{ Auth::user()->verification_status }}
                    </span>
                </div>
                <div style="display: flex; justify-content: space-between; align-items: center;">
                    <span style="font-size: 0.85rem; font-weight: 600; color: var(--text-primary);">Academic Certificate</span>
                    <span style="font-size: 0.7rem; padding: 4px 10px; border-radius: 999px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; 
                        {{ Auth::user()->academic_verification_status === 'verified' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #eab308;' }}">
                        {{ Auth::user()->academic_verification_status }}
                    </span>
                </div>
            </div>
        </div>

        {{-- ═════════════════════════════════════════
         GATE 5: FULL PROFILE ACCESS (APPROVED)
    ═════════════════════════════════════════ --}}
    @elseif($currentStep === 'profile')
    {{-- Page header --}}
    <div class="form-page-header anim-fade-up">
        <div class="form-page-eyebrow">Your Profile</div>
        <h1 class="form-page-title">Build Your <strong>Talent Profile</strong></h1>
        <p class="form-page-sub">Complete your profile to appear in the verified talent directory and attract clients.</p>
    </div>

    {{-- Progress steps --}}
    <div class="form-steps anim-fade-up anim-d1" aria-label="Form progress">
        <div class="form-step is-active">
            <div class="form-step-dot">01</div>
            <span class="form-step-label">Basic Info</span>
        </div>
        <div class="form-step-line"></div>
        <div class="form-step">
            <div class="form-step-dot">02</div>
            <span class="form-step-label">Location</span>
        </div>
        <div class="form-step-line"></div>
        <div class="form-step">
            <div class="form-step-dot">03</div>
            <span class="form-step-label">About</span>
        </div>
        <div class="form-step-line"></div>
        <div class="form-step">
            <div class="form-step-dot">04</div>
            <span class="form-step-label">Portfolio</span>
        </div>
    </div>

    {{-- Success flash --}}
    @if(session()->has('message'))
        <div class="form-flash anim-fade-up">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                <path d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z"/>
            </svg>
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit="saveProfile" novalidate>

        {{-- ── AVATAR UPLOAD SECTION ── --}}
<div class="form-section anim-fade-up" x-data="{ menuOpen: false }">
    <div class="form-section-header">
        <div class="form-section-title">Profile Picture</div>
    </div>
    
    <div class="form-section-body">
        <div style="display: flex; align-items: flex-start; gap: 32px; flex-wrap: wrap;">
            
            {{-- Left: Avatar + inline menu --}}
            <div style="display: flex; flex-direction: column; align-items: center; gap: 12px;">
                
                {{-- Avatar Circle --}}
                <div style="width: 130px; height: 130px; border-radius: 50%; padding: 4px; border: 2px dashed var(--border-strong); position: relative;">
                    <div style="width: 100%; height: 100%; border-radius: 50%; overflow: hidden; background: var(--bg-secondary);">
                        @if ($newAvatar)
                            <img src="{{ $newAvatar->temporaryUrl() }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @elseif(auth()->user()->getFirstMediaUrl('avatar'))
                            <img src="{{ auth()->user()->getFirstMediaUrl('avatar') }}" style="width: 100%; height: 100%; object-fit: cover;">
                        @else
                            <div style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                                </svg>
                            </div>
                        @endif
                    </div>
                    {{-- Edit Badge --}}
                    <button type="button" @click="menuOpen = !menuOpen"
                        style="position: absolute; bottom: 0; right: 4px; background: var(--bg-surface); border: 1px solid var(--border-strong); border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: var(--text-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M12 20h9M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/>
                        </svg>
                    </button>
                </div>

                {{-- Inline Menu (not absolutely positioned) --}}
                <div x-show="menuOpen" x-transition style="width: 200px; background: var(--bg-surface); border: 1px solid var(--border-strong); border-radius: 6px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); overflow: hidden;">
                    
                    <a href="{{ route('artist.show', auth()->id()) }}" target="_blank"
                        style="display: block; padding: 12px 16px; font-size: 0.85rem; color: var(--text-primary); text-decoration: none; border-bottom: 1px solid var(--border);"
                        onmouseover="this.style.background='var(--bg-secondary)'" onmouseout="this.style.background=''">
                        👁 View Public Profile
                    </a>

                    <label style="display: block; padding: 12px 16px; font-size: 0.85rem; color: var(--text-primary); cursor: pointer; border-bottom: 1px solid var(--border);"
                        onmouseover="this.style.background='var(--bg-secondary)'" onmouseout="this.style.background=''">
                        📷 Upload New Photo
                        <input type="file" wire:model="newAvatar" accept="image/*" style="display: none;">
                    </label>

                    @if(auth()->user()->getMedia('avatar')->count() > 0)
                        <button type="button" wire:click="deleteAvatar"
                            onclick="return confirm('Remove your profile picture?')"
                            style="width: 100%; text-align: left; padding: 12px 16px; font-size: 0.85rem; color: #dc2626; background: none; border: none; cursor: pointer;"
                            onmouseover="this.style.background='rgba(220,38,38,0.05)'" onmouseout="this.style.background=''">
                            🗑 Remove Photo
                        </button>
                    @endif
                </div>

            </div>

            {{-- Right: Status messages --}}
            <div style="flex: 1; min-width: 200px; padding-top: 8px;">
                @if($newAvatar)
                    <div style="background: rgba(201,169,110,0.1); border: 1px solid rgba(201,169,110,0.3); padding: 16px; border-radius: 6px;">
                        <h4 style="font-size: 0.9rem; font-weight: 600; color: var(--gold); margin-bottom: 8px;">Unsaved Photo</h4>
                        <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 12px;">Click save to update your profile picture.</p>
                        <button type="button" wire:click="updateAvatar" class="btn-fill" style="font-size: 0.8rem; padding: 8px 16px;">
                            <span wire:loading.remove wire:target="updateAvatar">Save Profile Picture</span>
                            <span wire:loading wire:target="updateAvatar">Saving...</span>
                        </button>
                    </div>
                @else
                    <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                        Click the <strong>pencil icon</strong> on your avatar to upload a new photo, view your public profile, or remove your current picture.
                    </p>
                @endif
                <div wire:loading wire:target="newAvatar" style="font-size: 0.8rem; color: var(--gold); margin-top: 8px;">Preparing image...</div>
                @error('newAvatar') <div style="color: #ff4a4a; font-size: 0.8rem; margin-top: 8px;">{{ $message }}</div> @enderror
                @if(session()->has('success')) <div style="color: #2a7d4f; font-size: 0.8rem; margin-top: 8px;">{{ session('success') }}</div> @endif
            </div>

        </div>
    </div>
</div>
        {{-- ── Section 01: Professional Details ── --}}
        <div class="form-section anim-fade-up anim-d1">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.58-7 8-7s8 3 8 7"/>
                    </svg>
                </div>
                <div class="form-section-title">Professional Details</div>
                <div class="form-section-desc">Required</div>
            </div>
            <div class="form-section-body">
                <div class="form-grid-2">

                    <div class="form-grid-full">
                        <label class="form-field-label">
                            Talent Categories & Skills <span class="required">*</span>
                        </label>
                        <div class="form-hint mb-4">Select all areas where you have professional experience.</div>
                        
                        @error('categories') <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-bottom: 16px;">{{ $message }}</span> @enderror

                        <div style="display: grid; gap: 24px;">
                            @foreach($groupedCategories as $groupName => $cats)
                                <div style="background: var(--bg-primary); border: 1px solid var(--border); border-radius: 6px; padding: 16px;">
                                    <h4 style="font-size: 0.85rem; font-weight: 600; color: var(--gold); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px; border-bottom: 1px solid var(--border-strong); padding-bottom: 8px;">
                                        {{ $groupName }}
                                    </h4>
                                    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px;">
                                        
                                        @foreach($cats as $cat)
                                            <label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer; font-size: 0.9rem; color: var(--text-primary); transition: color 0.2s;">
                                                <input 
                                                    type="checkbox" 
                                                    wire:model.defer="categories" 
                                                    value="{{ $cat->name }}"
                                                    style="margin-top: 4px; accent-color: var(--gold); width: 16px; height: 16px; cursor: pointer;"
                                                >
                                                <span style="line-height: 1.4;">{{ $cat->name }}</span>
                                            </label>
                                        @endforeach

                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-rate">Starting Rate (BDT/hr)</label>
                        <div class="form-input-wrap">
                            <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <circle cx="12" cy="12" r="10"/><path d="M9 8h6M9 12h6M9 16h4"/>
                            </svg>
                            <input id="f-rate" type="number" class="form-input" wire:model.defer="hourly_rate" placeholder="e.g. 1500" min="0">
                        </div>
                        <div class="form-hint">Leave blank to show "Negotiable"</div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-name">Full Name</label>
                        <input id="f-name" type="text" class="form-input" wire:model.defer="name" placeholder="e.g. Tanvir Ahmed" autocomplete="name">
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-phone">Phone Number</label>
                        <div class="form-input-wrap">
                            <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                            </svg>
                            <input id="f-phone" type="text" class="form-input" wire:model.defer="phone" placeholder="e.g. 017XXXXXXXX" autocomplete="tel">
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-email">Email Address</label>
                        <div class="form-input-wrap">
                            <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                            </svg>
                            <input id="f-email" type="email" class="form-input" wire:model.defer="email" placeholder="you@example.com" autocomplete="email">
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-gender">Gender</label>
                        <div class="form-select-wrap">
                            <select id="f-gender" class="form-select" wire:model.defer="gender">
                                <option value="">Prefer not to say</option>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-dob">Date of Birth</label>
                        <input id="f-dob" type="date" class="form-input" wire:model.defer="date_of_birth">
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-height">Height (cm)</label>
                        <div class="form-input-wrap">
                            <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path d="M8 3v18M5 6h3M5 10h3M5 14h3M5 18h3M16 3l4 4-4 4M20 7H8"/>
                            </svg>
                            <input id="f-height" type="number" class="form-input" wire:model.defer="height_cm" placeholder="e.g. 165" min="100" max="250">
                        </div>
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-languages">Languages Spoken</label>
                        <input id="f-languages" type="text" class="form-input" wire:model.defer="languages" placeholder="e.g. Bengali, English">
                        <div class="form-hint">Separate multiple languages with commas</div>
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Section 02: Location ── --}}
        <div class="form-section anim-fade-up anim-d2">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z"/><circle cx="12" cy="9" r="2.5"/>
                    </svg>
                </div>
                <div class="form-section-title">Location</div>
                <div class="form-section-desc">Helps clients find local talent</div>
            </div>
            <div class="form-section-body">
                <div class="form-grid-2">

                    <div class="form-field">
                        <label class="form-field-label" for="f-district">District</label>
                        <input id="f-district" type="text" class="form-input" wire:model.defer="district" placeholder="e.g. Dhaka">
                    </div>

                    <div class="form-field">
                        <label class="form-field-label" for="f-upazila">Thana / Upazila</label>
                        <input id="f-upazila" type="text" class="form-input" wire:model.defer="upazila" placeholder="e.g. Mirpur">
                    </div>

                </div>
            </div>
        </div>

        {{-- ── Section 03: About / Bio ── --}}
        <div class="form-section anim-fade-up anim-d2">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/><polyline points="10 9 9 9 8 9"/>
                    </svg>
                </div>
                <div class="form-section-title">About Me</div>
                <div class="form-section-desc">Your public bio</div>
            </div>
            <div class="form-section-body">
                <div class="form-field">
                    <label class="form-field-label" for="f-bio">Bio</label>
                    <textarea id="f-bio" class="form-textarea" wire:model.defer="bio" rows="5"
                        placeholder="Tell clients about your experience, specialties, and what makes you unique…"></textarea>
                    <div class="form-hint">A well-written bio significantly increases your chances of being hired.</div>
                </div>
            </div>
        </div>

        {{-- ── Section 04: Portfolio ── --}}
        <div class="form-section anim-fade-up anim-d3">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                        <rect x="3" y="3" width="18" height="18" rx="1"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/>
                    </svg>
                </div>
                <div class="form-section-title">Portfolio Images</div>
                <div class="form-section-desc">Max 10 images · JPG/PNG/WEBP</div>
            </div>
            <div class="form-section-body">

                <label class="upload-zone" aria-label="Upload portfolio images">
                    <input
                        type="file"
                        wire:model.live="newPhotos"
                        multiple
                        accept="image/*"
                        aria-label="Choose portfolio images"
                    >
                    <svg class="upload-zone-icon" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" aria-hidden="true">
                        <polyline points="16 16 12 12 8 16"/><line x1="12" y1="12" x2="12" y2="21"/>
                        <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3"/>
                    </svg>
                    <div class="upload-zone-title">Drop images here or click to browse</div>
                    <div class="upload-zone-sub">Accepts JPG, PNG, WEBP &nbsp;·&nbsp; <span>Up to 10 files</span></div>
                </label>

                <div wire:loading wire:target="newPhotos" class="upload-loading">
                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" aria-hidden="true">
                        <circle cx="12" cy="12" r="10" opacity="0.25"/><path d="M12 2a10 10 0 0110 10" stroke-linecap="round"/>
                    </svg>
                    Processing uploads…
                </div>

                @if(count($portfolioImages) > 0)
                    <div class="portfolio-thumbs">
                        @foreach($portfolioImages as $image)
                            <div class="portfolio-thumb">
                                <img src="{{ $image->getUrl() }}" alt="Portfolio image" loading="lazy">
                                <button
                                    type="button"
                                    class="portfolio-thumb-del"
                                    wire:click="deletePhoto({{ $image->id }})"
                                    onclick="return confirm('Delete this photo from your portfolio?')"
                                    aria-label="Delete photo"
                                >
                                    <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" aria-hidden="true">
                                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>

        {{-- ── Sticky submit bar ── --}}
        {{-- ── Sticky submit bar ── --}}
            <div class="form-submit-bar">
                <span class="form-submit-status">
                    All changes are saved automatically on submit.
                </span>

                <div class="submit-actions">
                    {{-- View public profile button --}}
                    <a href="{{ route('artist.show', $user->id) }}" class="btn-outline" target="_blank">
                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                        </svg>
                        View Profile
                    </a>

                    {{-- Save button --}}
                    <button 
                        type="submit" 
                        class="btn-fill"
                        wire:loading.attr="disabled"
                        style="min-width:200px; justify-content:center; display: flex; align-items: center;"
                    >
                        <span wire:loading.remove>
                            Save Profile &amp; Publish
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" style="display:inline;margin-left:6px;" aria-hidden="true">
                                <path d="M1 5h8M5 1l4 4-4 4" stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        
                        
                        
                    </button>

                </div>
            </div>

    </form>
    @endif
</div>

</div>
