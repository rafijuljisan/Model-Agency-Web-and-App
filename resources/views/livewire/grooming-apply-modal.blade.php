{{--
    ══════════════════════════════════════════════════════════
    Livewire View: resources/views/livewire/grooming-apply-modal.blade.php
    Component:    App\Livewire\GroomingApplyModal
    Usage:        @livewire('grooming-apply-modal', ['batchId' => $batch->id])
                  or @livewire('grooming-apply-modal') for batch-agnostic
    Open modal:   $dispatch('open-grooming-modal') from JS/Alpine
    ══════════════════════════════════════════════════════════
--}}

<div
    x-data="{ open: false }"
    x-on:open-grooming-modal.window="open = true"
    x-on:keydown.escape.window="open = false"
    x-on:close-modal.window="open = false"
>

{{-- ══════════════════════════════════════════════════════════
     INLINE STYLES — scoped to this modal only
══════════════════════════════════════════════════════════ --}}
<style>
/* ── Spin animation (for loading spinners) ── */
@keyframes gam-spin { from{transform:rotate(0deg)} to{transform:rotate(360deg)} }

/* ── Overlay ── */
.gam-overlay {
    position: fixed;
    inset: 0;
    background: rgba(0,0,0,0.72);
    z-index: 9999;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 16px;
    overflow-y: auto;
    backdrop-filter: blur(2px);
}

/* ── Modal Box ── */
.gam-modal {
    background: var(--bg-secondary, #1a1a1a);
    border: 1px solid var(--border-strong, #444);
    width: 100%;
    max-width: 560px;
    max-height: 92vh;
    overflow-y: auto;
    display: flex;
    flex-direction: column;
    border-radius: 12px;
    position: relative;
    box-shadow: 0 32px 80px rgba(0,0,0,0.5);
}

/* ── Sticky Header ── */
.gam-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 18px 24px;
    border-bottom: 1px solid var(--border, #333);
    position: sticky;
    top: 0;
    background: var(--bg-secondary, #1a1a1a);
    z-index: 20;
    border-radius: 12px 12px 0 0;
    flex-shrink: 0;
}
.gam-header-left {
    display: flex;
    align-items: center;
    gap: 10px;
}
.gam-header-icon {
    width: 32px;
    height: 32px;
    border-radius: 8px;
    background: var(--gold-bg, rgba(197,0,0,0.1));
    display: flex;
    align-items: center;
    justify-content: center;
    color: var(--gold, #c50000);
    flex-shrink: 0;
}
.gam-title {
    font-size: 1rem;
    font-weight: 700;
    color: var(--text-primary, #fff);
    letter-spacing: 0.01em;
}
.gam-subtitle {
    font-size: 0.72rem;
    color: var(--text-muted, #888);
    font-weight: 400;
    margin-top: 1px;
}
.gam-close {
    width: 32px;
    height: 32px;
    border: 1px solid var(--border-strong, #444);
    background: transparent;
    color: var(--text-muted, #888);
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: all 0.15s;
    flex-shrink: 0;
}
.gam-close:hover {
    border-color: var(--gold, #c50000);
    color: var(--gold, #c50000);
    background: var(--gold-bg, rgba(197,0,0,0.08));
}

/* ── Progress Steps Bar ── */
.gam-progress {
    padding: 16px 24px 14px;
    border-bottom: 1px solid var(--border, #333);
    background: var(--bg-secondary, #1a1a1a);
    flex-shrink: 0;
}
.gam-steps-track {
    display: flex;
    align-items: center;
    gap: 0;
    margin-bottom: 10px;
}
.gam-step-node {
    width: 28px;
    height: 28px;
    border-radius: 50%;
    border: 2px solid var(--border-strong, #444);
    background: var(--bg-primary, #111);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.78rem;
    font-weight: 700;
    color: var(--text-muted, #888);
    flex-shrink: 0;
    transition: all 0.25s;
    position: relative;
    z-index: 2;
}
.gam-step-node.active {
    border-color: var(--gold, #c50000);
    color: var(--gold, #c50000);
    background: var(--gold-bg, rgba(197,0,0,0.1));
    box-shadow: 0 0 0 4px var(--gold-bg, rgba(197,0,0,0.12));
}
.gam-step-node.done {
    border-color: #16a34a;
    background: #16a34a;
    color: #fff;
}
.gam-step-line {
    flex: 1;
    height: 2px;
    background: var(--border-strong, #444);
    transition: background 0.3s;
    min-width: 10px;
}
.gam-step-line.done { background: #16a34a; }

/* Step labels row */
.gam-step-labels {
    display: flex;
    justify-content: space-between;
    padding: 0 2px;
}
.gam-step-label {
    font-size: 0.62rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.04em;
    color: var(--text-muted, #666);
    transition: color 0.2s;
    text-align: center;
    flex: 1;
}
.gam-step-label.active { color: var(--gold, #c50000); }
.gam-step-label.done   { color: #16a34a; }

/* ── Member Pre-fill Badge ── */
.gam-member-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 9px 20px;
    background: rgba(22,163,74,0.07);
    border-bottom: 1px solid rgba(22,163,74,0.18);
    font-size: 0.77rem;
    font-weight: 600;
    color: #16a34a;
    flex-shrink: 0;
}

/* ── Modal Body ── */
.gam-body {
    padding: 24px;
    flex: 1;
    overflow-y: auto;
}

/* ── Sticky Footer ── */
.gam-footer {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    padding: 14px 24px;
    border-top: 1px solid var(--border, #333);
    background: var(--bg-secondary, #1a1a1a);
    position: sticky;
    bottom: 0;
    z-index: 20;
    flex-shrink: 0;
    border-radius: 0 0 12px 12px;
}
.gam-footer-info {
    font-size: 0.7rem;
    color: var(--text-muted, #666);
    text-align: center;
    flex: 1;
}

/* ── Buttons ── */
.gam-btn-prev {
    padding: 10px 18px;
    border: 1px solid var(--border-strong, #444);
    background: transparent;
    color: var(--text-secondary, #bbb);
    font-size: 0.88rem;
    font-weight: 600;
    cursor: pointer;
    border-radius: 8px;
    transition: all 0.15s;
    white-space: nowrap;
    display: flex;
    align-items: center;
    gap: 6px;
    font-family: inherit;
}
.gam-btn-prev:hover {
    border-color: var(--gold, #c50000);
    color: var(--gold, #c50000);
}
.gam-btn-next {
    padding: 10px 22px;
    background: var(--gold, #c50000);
    color: #fff;
    font-size: 0.92rem;
    font-weight: 700;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.15s, transform 0.15s;
    white-space: nowrap;
    font-family: inherit;
}
.gam-btn-next:hover { opacity: 0.88; transform: translateY(-1px); }
.gam-btn-next:active { transform: translateY(0); }

.gam-btn-gold {
    padding: 13px 24px;
    background: var(--gold, #c50000);
    color: #fff;
    font-weight: 700;
    font-size: 0.95rem;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    display: flex;
    align-items: center;
    gap: 8px;
    transition: opacity 0.15s;
    font-family: inherit;
    white-space: nowrap;
}
.gam-btn-gold:hover { opacity: 0.88; }
.gam-btn-ghost {
    padding: 13px 24px;
    background: transparent;
    border: 1px solid var(--border-strong, #444);
    color: var(--text-secondary, #bbb);
    font-weight: 600;
    font-size: 0.88rem;
    cursor: pointer;
    border-radius: 8px;
    font-family: inherit;
    transition: all 0.15s;
    white-space: nowrap;
}
.gam-btn-ghost:hover { border-color: var(--gold, #c50000); color: var(--gold, #c50000); }

/* ── Form Fields ── */
.gam-field {
    margin-bottom: 18px;
}
.gam-field:last-child { margin-bottom: 0; }
.gam-label {
    display: block;
    font-size: 0.8rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted, #888);
    margin-bottom: 7px;
}
.gam-label .req { color: var(--gold, #c50000); margin-left: 2px; }
.gam-label .opt {
    font-weight: 400;
    text-transform: none;
    font-size: 0.72rem;
    color: var(--text-muted, #888);
    margin-left: 4px;
}
.gam-field input,
.gam-field select,
.gam-field textarea {
    width: 100%;
    padding: 11px 14px;
    background: var(--bg-primary, #111);
    border: 1.5px solid var(--border-strong, #444);
    color: var(--text-primary, #fff);
    font-size: 1rem;
    outline: none;
    border-radius: 8px;
    transition: border-color 0.2s, box-shadow 0.2s;
    box-sizing: border-box;
    font-family: inherit;
}
.gam-field input:focus,
.gam-field select:focus,
.gam-field textarea:focus {
    border-color: var(--gold, #c50000);
    box-shadow: 0 0 0 3px var(--gold-bg, rgba(197,0,0,0.12));
}
.gam-field input::placeholder { color: var(--text-muted, #666); }
.gam-field select option { background: var(--bg-secondary, #1a1a1a); }
.gam-field-error {
    font-size: 0.8rem;
    color: #ef4444;
    margin-top: 5px;
    font-weight: 500;
    display: flex;
    align-items: center;
    gap: 4px;
}
.gam-field-hint {
    font-size: 0.77rem;
    color: var(--text-muted, #777);
    margin-top: 5px;
}
.gam-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 14px;
}

/* ── Step Section Title ── */
.gam-step-heading {
    margin-bottom: 20px;
    padding-bottom: 14px;
    border-bottom: 1px dashed var(--border, #333);
}
.gam-step-heading h3 {
    font-size: 1.05rem;
    font-weight: 700;
    color: var(--text-primary, #fff);
    margin: 0 0 3px;
}
.gam-step-heading p {
    font-size: 0.82rem;
    color: var(--text-muted, #888);
    margin: 0;
    line-height: 1.5;
}

/* ── Step 0: Quick Start ── */
.gam-qs-body {
    padding: 40px 28px;
    text-align: center;
}
.gam-qs-icon {
    width: 64px;
    height: 64px;
    background: var(--gold-bg, rgba(197,0,0,0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    border: 1px solid var(--border-strong, #444);
}
.gam-qs-title {
    font-size: 1.18rem;
    font-weight: 700;
    color: var(--text-primary, #fff);
    margin-bottom: 8px;
}
.gam-qs-sub {
    color: var(--text-muted, #888);
    font-size: 0.88rem;
    line-height: 1.65;
    margin-bottom: 28px;
    max-width: 340px;
    margin-left: auto;
    margin-right: auto;
}
.gam-qs-actions {
    display: flex;
    gap: 12px;
    justify-content: center;
    flex-wrap: wrap;
}

/* ── Member info hint box ── */
.gam-info-box {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding: 12px 14px;
    background: var(--bg-primary, #111);
    border: 1px solid var(--border, #333);
    border-left: 3px solid var(--gold, #c50000);
    border-radius: 8px;
    margin-bottom: 16px;
    font-size: 0.83rem;
    color: var(--text-secondary, #bbb);
    line-height: 1.5;
}
.gam-info-box svg { flex-shrink: 0; margin-top: 1px; }

/* ── Step 3: Career Interest Checkboxes ── */
.gam-interest-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
}
.gam-interest-card {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 2px solid var(--border-strong, #444);
    background: var(--bg-primary, #111);
    border-radius: 8px;
    cursor: pointer;
    font-size: 0.92rem;
    font-weight: 600;
    color: var(--text-secondary, #bbb);
    transition: all 0.18s;
    user-select: none;
}
.gam-interest-card.selected {
    border-color: #16a34a;
    background: rgba(22,163,74,0.08);
    color: #16a34a;
}
.gam-interest-card input[type="checkbox"] {
    width: 15px; height: 15px;
    accent-color: #16a34a;
    cursor: pointer;
    flex-shrink: 0;
    margin: 0; padding: 0;
}
.gam-interest-check { margin-left: auto; flex-shrink: 0; }

/* ── Step 3: Experience Level ── */
.gam-exp-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
}
.gam-exp-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 4px;
    padding: 16px 6px;
    border: 2px solid var(--border-strong, #444);
    background: var(--bg-primary, #111);
    border-radius: 8px;
    cursor: pointer;
    text-align: center;
    transition: all 0.18s;
    user-select: none;
}
.gam-exp-card.selected { border-color: #16a34a; background: rgba(22,163,74,0.08); }
.gam-exp-card input[type="radio"] { display: none; }
.gam-exp-icon { font-size: 1.4rem; line-height: 1; }
.gam-exp-label { font-size: 0.85rem; font-weight: 700; color: var(--text-primary, #fff); }
.gam-exp-card.selected .gam-exp-label { color: #16a34a; }
.gam-exp-sub { font-size: 0.75rem; color: var(--text-muted, #777); }

/* ── Step 4: Batch Cards ── */
.gam-batch-grid { display: flex; flex-direction: column; gap: 10px; }
.gam-batch-card {
    display: flex;
    align-items: center;
    gap: 12px;
    padding: 14px 16px;
    border: 2px solid var(--border-strong, #444);
    background: var(--bg-primary, #111);
    border-radius: 8px;
    cursor: pointer;
    transition: all 0.18s;
    position: relative;
}
.gam-batch-card:hover { border-color: var(--gold, #c50000); }
.gam-batch-card.selected {
    border-color: var(--gold, #c50000);
    background: var(--gold-bg, rgba(197,0,0,0.07));
}
.gam-batch-card-body { flex: 1; min-width: 0; }
.gam-batch-card-name {
    font-size: 0.97rem;
    font-weight: 700;
    color: var(--text-primary, #fff);
    margin-bottom: 4px;
}
.gam-batch-card-meta {
    font-size: 0.8rem;
    color: var(--text-muted, #888);
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.gam-batch-card-meta span { display: flex; align-items: center; gap: 4px; }
.gam-batch-card-fee {
    font-size: 1.15rem;
    font-weight: 700;
    color: var(--gold, #c50000);
    white-space: nowrap;
    flex-shrink: 0;
}
.gam-batch-card-seats {
    font-size: 0.7rem;
    font-weight: 700;
    text-transform: uppercase;
    white-space: nowrap;
    flex-shrink: 0;
    padding: 3px 8px;
    border-radius: 20px;
}
.gam-batch-card-seats.open { background: rgba(22,163,74,0.1); color: #16a34a; }
.gam-batch-card-seats.filling_fast { background: rgba(234,179,8,0.1); color: #ca8a04; }
.gam-batch-card-seats.full { background: rgba(197,0,0,0.1); color: var(--gold, #c50000); }

/* Seat mini-bar inside batch card */
.gam-seat-mini {
    height: 3px;
    background: var(--border-strong, #444);
    border-radius: 99px;
    overflow: hidden;
    margin-top: 6px;
}
.gam-seat-mini-fill {
    height: 100%;
    background: var(--gold, #c50000);
    border-radius: 99px;
    transition: width 0.4s ease;
}

/* ── Step 5: Payment ── */
.gam-batch-summary {
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 12px;
    background: var(--gold-bg, rgba(197,0,0,0.07));
    border: 1px solid var(--border-strong, #444);
    padding: 14px 16px;
    border-radius: 8px;
    margin-bottom: 20px;
    flex-wrap: wrap;
}
.gam-summary-label {
    font-size: 0.72rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted, #888);
    margin-bottom: 3px;
}
.gam-summary-name { font-weight: 700; font-size: 1rem; color: var(--text-primary, #fff); }
.gam-summary-fee { font-size: 1.4rem; font-weight: 700; color: var(--gold, #c50000); white-space: nowrap; }

.gam-payment-methods {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
    margin-bottom: 18px;
}
.gam-pm-label { display: block; cursor: pointer; position: relative; }
.gam-pm-label input[type="radio"] {
    position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;
}
.gam-pm-tab {
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    gap: 8px;
    padding: 14px 8px;
    border: 2px solid var(--border-strong, #444);
    background: var(--bg-primary, #111);
    border-radius: 8px;
    transition: all 0.2s;
    user-select: none;
}
.gam-pm-label:hover .gam-pm-tab { border-color: var(--gold, #c50000); }
.gam-pm-label input[type="radio"]:checked ~ .gam-pm-tab {
    border-color: var(--gold, #c50000);
    background: var(--gold-bg, rgba(197,0,0,0.08));
}
.gam-pm-img {
    width: 40px; height: 40px;
    border-radius: 8px;
    overflow: hidden;
    object-fit: cover;
    display: block;
}
.gam-pm-text {
    font-size: 0.95rem;
    font-weight: 700;
    color: var(--text-secondary, #bbb);
    font-family: 'SolaimanLipi', sans-serif;
    transition: color 0.18s;
}
.gam-pm-label input[type="radio"]:checked ~ .gam-pm-tab .gam-pm-text { color: var(--gold, #c50000); }

.gam-pay-to-box {
    display: flex;
    align-items: center;
    gap: 14px;
    background: var(--bg-primary, #111);
    border: 1px solid var(--border-strong, #444);
    border-left: 3px solid var(--gold, #c50000);
    padding: 14px 16px;
    border-radius: 8px;
    margin-bottom: 18px;
}
.gam-pay-to-label {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--text-muted, #888);
    margin-bottom: 3px;
    font-family: 'SolaimanLipi', sans-serif;
}
.gam-pay-to-number { font-size: 1.4rem; font-weight: 700; color: var(--gold, #c50000); letter-spacing: 0.04em; }

/* File input styling */
.gam-file-wrap {
    position: relative;
    border: 2px dashed var(--border-strong, #444);
    border-radius: 8px;
    padding: 20px 16px;
    text-align: center;
    transition: border-color 0.2s;
    cursor: pointer;
}
.gam-file-wrap:hover { border-color: var(--gold, #c50000); }
.gam-file-wrap input[type="file"] {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    opacity: 0;
    cursor: pointer;
    border: none;
    background: transparent;
    box-shadow: none;
    padding: 0;
}
.gam-file-label {
    font-size: 0.85rem;
    color: var(--text-muted, #888);
    pointer-events: none;
}
.gam-file-label strong { color: var(--gold, #c50000); }

/* ── Submit Error ── */
.gam-submit-error {
    margin: 0 24px 16px;
    padding: 12px 16px;
    background: rgba(239,68,68,0.08);
    border: 1px solid rgba(239,68,68,0.3);
    border-radius: 8px;
    color: #ef4444;
    font-size: 0.85rem;
    font-weight: 500;
    flex-shrink: 0;
}

/* ── Success Screen ── */
.gam-success {
    padding: 48px 28px;
    text-align: center;
}
.gam-success-ring {
    width: 72px; height: 72px;
    background: rgba(22,163,74,0.1);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 22px;
    border: 2px solid rgba(22,163,74,0.3);
    color: #16a34a;
}
.gam-success-title { font-size: 1.3rem; font-weight: 700; color: var(--text-primary, #fff); margin-bottom: 10px; }
.gam-success-id {
    display: inline-block;
    padding: 6px 18px;
    background: var(--bg-primary, #111);
    border: 1px solid var(--border-strong, #444);
    border-radius: 6px;
    font-size: 1rem;
    font-weight: 700;
    color: var(--gold, #c50000);
    letter-spacing: 0.1em;
    margin: 10px 0 16px;
    font-family: monospace;
}
.gam-success-sub {
    font-size: 0.88rem;
    color: var(--text-muted, #888);
    line-height: 1.7;
    margin-bottom: 24px;
    max-width: 340px;
    margin-left: auto;
    margin-right: auto;
}
.gam-success-actions { display: flex; flex-direction: column; align-items: center; gap: 10px; }

/* ── Divider ── */
.gam-divider {
    height: 1px;
    background: var(--border, #333);
    margin: 18px 0;
}

/* ─────────────────────────────────────
   RESPONSIVE
───────────────────────────────────── */
@media (max-width: 600px) {
    .gam-overlay { padding: 0; align-items: flex-end; }
    .gam-modal {
        max-height: 96vh;
        border-radius: 16px 16px 0 0;
        border-bottom: none;
    }
    .gam-header, .gam-footer { padding: 14px 18px; border-radius: 0; }
    .gam-header { border-radius: 16px 16px 0 0; }
    .gam-progress { padding: 12px 18px; }
    .gam-body { padding: 18px; }
    .gam-qs-body { padding: 32px 18px; }
    .gam-success { padding: 36px 18px; }
    .gam-grid-2 { grid-template-columns: 1fr; gap: 0; }
    .gam-interest-grid { grid-template-columns: 1fr; }
    .gam-qs-actions { flex-direction: column; }
    .gam-btn-gold, .gam-btn-ghost { width: 100%; justify-content: center; }
    .gam-step-label { font-size: 0.55rem; }
    .gam-exp-label { font-size: 0.72rem; }
    .gam-exp-sub { font-size: 0.65rem; }
    .gam-pm-img { width: 32px; height: 32px; }
    .gam-pm-text { font-size: 0.82rem; }
    .gam-pm-tab { padding: 10px 6px; gap: 6px; }
    .gam-batch-card { flex-wrap: wrap; }
    .gam-batch-card-fee { width: 100%; text-align: right; }
    .gam-btn-prev, .gam-btn-next { font-size: 0.82rem; padding: 10px 14px; }
}
@media (max-width: 380px) {
    .gam-exp-grid { gap: 6px; }
    .gam-payment-methods { gap: 6px; }
    .gam-pm-img { width: 28px; height: 28px; border-radius: 6px; }
    .gam-title { font-size: 0.9rem; }
}
</style>

{{-- ══════════════════════════════════════════════════════════
     MODAL OVERLAY (controlled by Alpine `open`)
══════════════════════════════════════════════════════════ --}}
<div
    class="gam-overlay"
    x-show="open"
    x-transition:enter="transition ease-out duration-200"
    x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0"
    style="display:none;"
    @click.self="open = false; $wire.resetModal()"
>
    <div
        class="gam-modal"
        x-transition:enter="transition ease-out duration-200"
        x-transition:enter-start="opacity-0 scale-95 translate-y-4"
        x-transition:enter-end="opacity-100 scale-100 translate-y-0"
        x-transition:leave="transition ease-in duration-150"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95 translate-y-2"
        @click.stop
    >

    {{-- ══════════════════════════════════
         A) SUCCESS STATE
    ══════════════════════════════════ --}}
    @if ($submitted)

        <div class="gam-success">
            <div class="gam-success-ring">
                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
            </div>
            <div class="gam-success-title">Application Submitted! 🎉</div>
            <p class="gam-success-sub">
                Your application has been received. Our team will verify your payment and confirm your seat shortly.
            </p>
            <div class="gam-success-id">{{ $applicationId }}</div>
            <p style="font-size:0.78rem; color:var(--text-muted); margin-bottom: 22px;">
                Keep this number for your records.
            </p>

            <div class="gam-success-actions">
                @if($settings?->contact_phone)
                    @php $wa = preg_replace('/[^0-9]/', '', $settings->contact_phone); @endphp
                    <a href="https://wa.me/{{ $wa }}?text=আমি%20গ্রুমিং%20ক্লাসে%20আবেদন%20করেছি।%20আমার%20আবেদন%20নম্বর%20%23{{ $applicationId }}"
                       target="_blank"
                       style="display:inline-flex;align-items:center;gap:10px;padding:12px 26px;background:#25D366;color:#fff;font-weight:700;font-size:0.88rem;border-radius:8px;text-decoration:none;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.422-.272.347-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                        </svg>
                        Confirm on WhatsApp
                    </a>
                @endif
                <button
                    class="gam-btn-ghost"
                    @click="open = false; $wire.resetModal()"
                    style="margin-top:4px;"
                >
                    Close
                </button>
            </div>
        </div>

    {{-- ══════════════════════════════════
         B) STEP 0 — MEMBER LOOKUP
    ══════════════════════════════════ --}}
    @elseif ($step === 0)

        {{-- Header --}}
        <div class="gam-header">
            <div class="gam-header-left">
                <div class="gam-header-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                </div>
                <div>
                    <div class="gam-title">Grooming Application</div>
                    <div class="gam-subtitle">Step 0 of 5 — Quick Start</div>
                </div>
            </div>
            <button class="gam-close" @click="open = false; $wire.resetModal()" aria-label="Close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <div class="gam-qs-body">

            @if(! $isMemberCheck)
                {{-- Choice: Member or Guest --}}
                <div class="gam-qs-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold,#c50000)" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/>
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>
                    </svg>
                </div>
                <div class="gam-qs-title">Are you a Verified DMA Member?</div>
                <p class="gam-qs-sub">
                    Verified members can skip ahead — we'll auto-fill your personal and physical details instantly, saving you time.
                </p>
                <div class="gam-qs-actions">
                    <button wire:click="$set('isMemberCheck', true)" class="gam-btn-gold">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                        Yes, I'm a Member
                    </button>
                    <button wire:click="skipMemberLookup" class="gam-btn-ghost">
                        Continue as Guest →
                    </button>
                </div>

            @else
                {{-- Member lookup input --}}
                <div class="gam-qs-icon">
                    <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="var(--gold,#c50000)" stroke-width="2">
                        <circle cx="11" cy="11" r="8"/><path d="m21 21-4.35-4.35"/>
                    </svg>
                </div>
                <div class="gam-qs-title">Enter Your Member ID or Phone</div>
                <p class="gam-qs-sub">
                    We'll instantly auto-fill your details and take you straight to Step 3.
                </p>

                <div class="gam-field" style="max-width:320px; margin: 0 auto 6px; text-align:left;">
                    <input
                        type="text"
                        wire:model.defer="memberLookupInput"
                        wire:keydown.enter="lookupMember"
                        placeholder="e.g. DMA-261001 or 01XXXXXXXXX"
                        style="text-align:center; letter-spacing:0.05em;"
                    >
                    @error('memberLookupInput')
                        <div class="gam-field-error">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $message }}
                        </div>
                    @enderror
                    @if($memberLookupError)
                        <div class="gam-field-error" style="margin-top:6px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                            {{ $memberLookupError }}
                        </div>
                    @endif
                </div>

                <div class="gam-qs-actions" style="margin-top:22px;">
                    <button wire:click="lookupMember" class="gam-btn-gold" style="min-width:160px; justify-content:center;">
                        <span wire:loading.remove wire:target="lookupMember">Find My Profile →</span>
                        <span wire:loading wire:target="lookupMember" style="display:flex;align-items:center;gap:6px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:gam-spin 0.8s linear infinite;">
                                <circle cx="12" cy="12" r="10" opacity="0.25"/><path d="M12 2a10 10 0 0110 10" stroke-linecap="round"/>
                            </svg>
                            Searching...
                        </span>
                    </button>
                    <button wire:click="skipMemberLookup" class="gam-btn-ghost">← Back</button>
                </div>
            @endif

        </div>

    {{-- ══════════════════════════════════
         C) STEPS 1–5 — MAIN FORM
    ══════════════════════════════════ --}}
    @else

        {{-- ── Header ── --}}
        <div class="gam-header">
            <div class="gam-header-left">
                <div class="gam-header-icon">
                    @if($step === 1)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    @elseif($step === 2)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 20V10"/><path d="M12 20V4"/><path d="M6 20v-6"/></svg>
                    @elseif($step === 3)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/></svg>
                    @elseif($step === 4)
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                    @else
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                    @endif
                </div>
                <div>
                    <div class="gam-title">
                        @if($step === 1) Personal Information
                        @elseif($step === 2) Physical Information
                        @elseif($step === 3) Career Interest
                        @elseif($step === 4) Select a Batch
                        @else Payment
                        @endif
                    </div>
                    <div class="gam-subtitle">Step {{ $step }} of {{ $totalSteps }}</div>
                </div>
            </div>
            <button class="gam-close" @click="open = false; $wire.resetModal()" aria-label="Close">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        {{-- ── Progress Bar ── --}}
        <div class="gam-progress">
            <div class="gam-steps-track">
                @for ($i = 1; $i <= $totalSteps; $i++)
                    <div class="gam-step-node {{ $i < $step ? 'done' : ($i === $step ? 'active' : '') }}">
                        @if ($i < $step)
                            <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        @else
                            {{ $i }}
                        @endif
                    </div>
                    @if ($i < $totalSteps)
                        <div class="gam-step-line {{ $i < $step ? 'done' : '' }}"></div>
                    @endif
                @endfor
            </div>
            <div class="gam-step-labels">
                @php $stepLabels = ['Info', 'Physical', 'Career', 'Batch', 'Payment']; @endphp
                @for ($i = 1; $i <= $totalSteps; $i++)
                    <div class="gam-step-label {{ $i < $step ? 'done' : ($i === $step ? 'active' : '') }}" style="flex-basis:{{ 100/$totalSteps }}%">
                        {{ $stepLabels[$i-1] }}
                    </div>
                @endfor
            </div>
        </div>

        {{-- ── Member Pre-fill Badge ── --}}
        @if ($isPreFilled && in_array($step, [3, 4, 5]))
            <div class="gam-member-badge">
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                Member profile auto-filled — Steps 1 &amp; 2 are already completed.
            </div>
        @endif

        {{-- ── Submit Error ── --}}
        @error('submit')
            <div class="gam-submit-error">
                <strong>⚠ Error:</strong> {{ $message }}
            </div>
        @enderror

        {{-- ══ FORM BODY ══ --}}
        <div class="gam-body">

            {{-- ─────────────────────────────
                 STEP 1: Personal Info
            ───────────────────────────── --}}
            @if ($step === 1)
            <div wire:key="step-1">
                <div class="gam-step-heading">
                    <h3>Tell us about yourself</h3>
                    <p>Please fill in your personal contact details below.</p>
                </div>

                <div class="gam-field">
                    <label class="gam-label">Full Name <span class="req">*</span></label>
                    <input type="text" wire:model.defer="full_name" placeholder="Your full name" autocomplete="name">
                    @error('full_name') <div class="gam-field-error">{{ $message }}</div> @enderror
                </div>

                <div class="gam-grid-2">
                    <div class="gam-field">
                        <label class="gam-label">Mobile Number <span class="req">*</span></label>
                        <input type="tel" wire:model.defer="phone" placeholder="01XXXXXXXXX" autocomplete="tel">
                        @error('phone') <div class="gam-field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="gam-field">
                        <label class="gam-label">WhatsApp <span class="opt">(if different)</span></label>
                        <input type="tel" wire:model.defer="whatsapp" placeholder="01XXXXXXXXX">
                    </div>
                </div>

                <div class="gam-field" style="margin-bottom:0;">
                    <label class="gam-label">Email <span class="opt">(optional)</span></label>
                    <input type="email" wire:model.defer="email" placeholder="you@example.com" autocomplete="email">
                    @error('email') <div class="gam-field-error">{{ $message }}</div> @enderror
                </div>
            </div>

            {{-- ─────────────────────────────
                 STEP 2: Physical Info
            ───────────────────────────── --}}
            @elseif ($step === 2)
            <div wire:key="step-2">
                <div class="gam-step-heading">
                    <h3>Physical Details</h3>
                    <p>All fields are optional but help us better understand your profile.</p>
                </div>

                <div class="gam-grid-2">
                    <div class="gam-field">
                        <label class="gam-label">Age</label>
                        <input type="number" wire:model.defer="age" placeholder="e.g. 22" min="14" max="65">
                        @error('age') <div class="gam-field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="gam-field">
                        <label class="gam-label">Gender</label>
                        <select wire:model.defer="gender">
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>
                    <div class="gam-field">
                        <label class="gam-label">Height</label>
                        <input type="text" wire:model.defer="height" placeholder="e.g. 5 ft 6 in">
                    </div>
                    <div class="gam-field">
                        <label class="gam-label">Weight</label>
                        <input type="text" wire:model.defer="weight" placeholder="e.g. 55 kg">
                    </div>
                </div>

                <div class="gam-field" style="margin-bottom:0;">
                    <label class="gam-label">Address</label>
                    <input type="text" wire:model.defer="address" placeholder="Your full address" autocomplete="street-address">
                </div>
            </div>

            {{-- ─────────────────────────────
                 STEP 3: Career Interest
            ───────────────────────────── --}}
            @elseif ($step === 3)
            <div wire:key="step-3">
                <div class="gam-step-heading">
                    <h3>Career Interests</h3>
                    <p>What areas are you interested in? Select all that apply.</p>
                </div>

                <div class="gam-field">
                    <div class="gam-interest-grid">
                        @foreach (['Modeling', 'Acting', 'Personality Development', 'Fashion Industry'] as $interest)
                            <label class="gam-interest-card {{ in_array($interest, $career_interests) ? 'selected' : '' }}">
                                <input type="checkbox" wire:model.live="career_interests" value="{{ $interest }}">
                                <span>{{ $interest }}</span>
                                @if (in_array($interest, $career_interests))
                                    <span class="gam-interest-check">
                                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                    </span>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="gam-divider"></div>

                <div class="gam-field" style="margin-bottom:0;">
                    <label class="gam-label">Experience Level</label>
                    <div class="gam-exp-grid">
                        @foreach ([
                            'Beginner'     => ['icon' => '🌱', 'sub' => 'নতুন'],
                            'Intermediate' => ['icon' => '⭐', 'sub' => 'কিছুটা অভিজ্ঞ'],
                            'Experienced'  => ['icon' => '🏆', 'sub' => 'অভিজ্ঞ'],
                        ] as $val => $info)
                            <label class="gam-exp-card {{ $experience_level === $val ? 'selected' : '' }}">
                                <input type="radio" wire:model.live="experience_level" value="{{ $val }}">
                                <span class="gam-exp-icon">{{ $info['icon'] }}</span>
                                <span class="gam-exp-label">{{ $val }}</span>
                                <span class="gam-exp-sub">{{ $info['sub'] }}</span>
                                @if ($experience_level === $val)
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- ─────────────────────────────
                 STEP 4: Batch Selection
            ───────────────────────────── --}}
            @elseif ($step === 4)
            <div wire:key="step-4">
                <div class="gam-step-heading">
                    <h3>Choose a Batch</h3>
                    <p>Select the batch that suits your schedule best.</p>
                </div>

                <div class="gam-batch-grid">
                    @forelse ($batches as $batch)
                        @php
                            $pct = $batch->fill_percentage ?? 0;
                            $statusCls = $batch->status ?? 'open';
                        @endphp
                        <div
                            class="gam-batch-card {{ $batch_id == $batch->id ? 'selected' : '' }}"
                            wire:click="$set('batch_id', '{{ $batch->id }}')"
                        >
                            <div class="gam-batch-card-body">
                                <div class="gam-batch-card-name">{{ $batch->title }}</div>
                                <div class="gam-batch-card-meta">
                                    <span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                                        {{ $batch->start_date->format('d M Y') }}
                                    </span>
                                    @if($batch->venue)
                                    <span>
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                        {{ $batch->venue }}
                                    </span>
                                    @endif
                                    @if($batch->show_seats_public)
                                    <span>{{ $batch->remaining_seats }} seats left</span>
                                    @endif
                                </div>
                                @if($batch->show_seats_public)
                                <div class="gam-seat-mini">
                                    <div class="gam-seat-mini-fill" style="width:{{ $pct }}%"></div>
                                </div>
                                @endif
                            </div>
                            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:6px; flex-shrink:0;">
                                <div class="gam-batch-card-fee">৳{{ number_format($batch->fee) }}</div>
                                <div class="gam-batch-card-seats {{ $statusCls }}">
                                    @if($statusCls === 'open') Open
                                    @elseif($statusCls === 'filling_fast') Filling Fast
                                    @else Full
                                    @endif
                                </div>
                            </div>
                            {{-- Selected check --}}
                            @if($batch_id == $batch->id)
                            <div style="position:absolute;top:10px;left:10px;width:18px;height:18px;background:#16a34a;border-radius:50%;display:flex;align-items:center;justify-content:center;">
                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                            </div>
                            @endif
                        </div>
                    @empty
                        <div style="text-align:center; padding:32px; color:var(--text-muted); font-size:0.9rem; border:1px dashed var(--border-strong); border-radius:8px;">
                            No batches currently available. Please check back soon.
                        </div>
                    @endforelse
                </div>

                @error('batch_id')
                    <div class="gam-field-error" style="margin-top:10px;">{{ $message }}</div>
                @enderror
            </div>

            {{-- ─────────────────────────────
                 STEP 5: Payment
            ───────────────────────────── --}}
            @elseif ($step === 5)
            <div wire:key="step-5">

                {{-- Selected batch summary --}}
                @if ($this->selectedBatch)
                    <div class="gam-batch-summary">
                        <div>
                            <div class="gam-summary-label">Selected Batch</div>
                            <div class="gam-summary-name">{{ $this->selectedBatch->title }}</div>
                        </div>
                        <div class="gam-summary-fee">৳{{ number_format($this->selectedBatch->fee) }}</div>
                    </div>
                @endif

                {{-- Payment method --}}
                <div class="gam-field">
                    <label class="gam-label">Payment Method <span class="req">*</span></label>
                    <div class="gam-payment-methods">

                        @if($settings?->bkash_number)
                        <label class="gam-pm-label">
                            <input type="radio" wire:model.live="payment_method" value="bKash">
                            <div class="gam-pm-tab">
                                <img src="https://play-lh.googleusercontent.com/1CRcUfmtwvWxT2g-xJF8s9_btha42TLi6Lo-qVkVomXBb_citzakZX9BbeY51iholWs" alt="bKash" class="gam-pm-img">
                                <span class="gam-pm-text">বিকাশ</span>
                            </div>
                        </label>
                        @endif

                        @if($settings?->nagad_number)
                        <label class="gam-pm-label">
                            <input type="radio" wire:model.live="payment_method" value="Nagad">
                            <div class="gam-pm-tab">
                                <img src="https://play-lh.googleusercontent.com/9ps_d6nGKQzfbsJfMaFR0RkdwzEdbZV53ReYCS09Eo5MV-GtVylFD-7IHcVktlnz9Mo" alt="Nagad" class="gam-pm-img">
                                <span class="gam-pm-text">নগদ</span>
                            </div>
                        </label>
                        @endif

                        @if($settings?->rocket_number)
                        <label class="gam-pm-label">
                            <input type="radio" wire:model.live="payment_method" value="Rocket">
                            <div class="gam-pm-tab">
                                <img src="https://play-lh.googleusercontent.com/sDY6YSDobbm_rX-aozinIX5tVYBSea1nAyXYI4TJlije2_AF5_5aG3iAS7nlrgo0lk8" alt="Rocket" class="gam-pm-img">
                                <span class="gam-pm-text">রকেট</span>
                            </div>
                        </label>
                        @endif

                    </div>
                    @error('payment_method') <div class="gam-field-error" style="margin-top:-10px;margin-bottom:12px;">{{ $message }}</div> @enderror
                </div>

                {{-- Send-money-to box (shows once method is selected) --}}
                @if ($payment_method && $settings)
                    @php
                        $payNumber = match($payment_method) {
                            'bKash'  => $settings->bkash_number,
                            'Nagad'  => $settings->nagad_number,
                            'Rocket' => $settings->rocket_number,
                            default  => null,
                        };
                        $payType = match($payment_method) {
                            'bKash'  => $settings->bkash_type,
                            'Nagad'  => $settings->nagad_type,
                            'Rocket' => $settings->rocket_type,
                            default  => 'Send Money',
                        };
                    @endphp
                    @if ($payNumber)
                        <div class="gam-pay-to-box">
                            <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="var(--gold,#c50000)" stroke-width="2" style="flex-shrink:0;">
                                <rect x="1" y="4" width="22" height="16" rx="2"/><line x1="1" y1="10" x2="23" y2="10"/>
                            </svg>
                            <div>
                                <div class="gam-pay-to-label">
                                    এই নম্বরে <span style="color:red;font-weight:800;">{{ $payType }}</span> করুন
                                </div>
                                <div class="gam-pay-to-number">{{ $payNumber }}</div>
                            </div>
                        </div>
                    @endif
                @endif

                {{-- Sender number + Transaction ID --}}
                <div class="gam-grid-2">
                    <div class="gam-field">
                        <label class="gam-label">Sender Number <span class="req">*</span></label>
                        <input type="tel" wire:model.defer="sender_number" placeholder="01XXXXXXXXX">
                        @error('sender_number') <div class="gam-field-error">{{ $message }}</div> @enderror
                    </div>
                    <div class="gam-field">
                        <label class="gam-label">Transaction ID <span class="req">*</span></label>
                        <input type="text" wire:model.defer="transaction_id" placeholder="e.g. 9J5A6B8C" style="letter-spacing:0.08em;">
                        @error('transaction_id') <div class="gam-field-error">{{ $message }}</div> @enderror
                    </div>
                </div>

                {{-- Screenshot upload --}}
                <div class="gam-field" style="margin-bottom:0;">
                    <label class="gam-label">
                        Payment Screenshot
                        <span class="opt">(optional)</span>
                    </label>
                    <div class="gam-file-wrap">
                        <input type="file" wire:model="payment_screenshot" accept="image/*">
                        <div class="gam-file-label">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin:0 auto 8px;display:block;color:var(--text-muted);">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/>
                            </svg>
                            <strong>Click to upload</strong> or drag &amp; drop<br>
                            <span style="font-size:0.72rem;">JPG, PNG — Max 3MB</span>
                        </div>
                    </div>
                    @error('payment_screenshot') <div class="gam-field-error">{{ $message }}</div> @enderror
                    <div wire:loading wire:target="payment_screenshot" style="font-size:0.78rem;color:var(--gold);margin-top:6px;display:flex;align-items:center;gap:6px;">
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="animation:gam-spin 0.8s linear infinite;"><circle cx="12" cy="12" r="10" opacity="0.25"/><path d="M12 2a10 10 0 0110 10" stroke-linecap="round"/></svg>
                        Uploading...
                    </div>
                </div>

            </div>
            @endif

        </div>{{-- /gam-body --}}

        {{-- ── Footer ── --}}
        <div class="gam-footer">
            <button class="gam-btn-prev" wire:click="prevStep">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
                Previous
            </button>

            <div class="gam-footer-info">
                @if($step < $totalSteps)
                    {{ $totalSteps - $step }} step{{ ($totalSteps - $step) > 1 ? 's' : '' }} remaining
                @else
                    Final step
                @endif
            </div>

            @if ($step < $totalSteps)
                <button class="gam-btn-next" wire:click="nextStep">
                    Next
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="9 18 15 12 9 6"/>
                    </svg>
                </button>
            @else
                <button class="gam-btn-next" wire:click="submit" style="background:#16a34a;">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Submit Application
                </button>
            @endif
        </div>

    @endif {{-- end steps 1–5 --}}

    </div>{{-- /gam-modal --}}
</div>{{-- /gam-overlay --}}

</div>{{-- /x-data --}}
