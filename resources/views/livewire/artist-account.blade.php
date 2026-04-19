<div>

    <style>
        /* ═══════════════════════════════════════════
   PROFILE EDIT FORM PAGE
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
            width: 24px;
            height: 1px;
            background: var(--gold);
        }

        .form-page-title {
            font-family: 'Jost', sans-serif;
            font-size: 2.8rem;
            font-weight: 300;
            color: var(--text-primary);
            line-height: 1.1;
        }

        .form-page-title strong {
            font-weight: 600;
        }

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
            width: 32px;
            height: 32px;
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
            text-transform: uppercase;
            color: var(--text-muted);
            margin-left: 8px;
            white-space: nowrap;
            transition: color 0.3s;
        }

        .form-step.is-active .form-step-label {
            color: var(--text-primary);
        }

        .form-step-line {
            width: 36px;
            height: 1px;
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
            width: 32px;
            height: 32px;
            background: var(--gold-bg);
            border: 1px solid var(--border-strong);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gold);
            flex-shrink: 0;
        }

        .form-section-title {
            font-family: 'Jost', sans-serif;
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

        .form-grid-full {
            grid-column: 1 / -1;
        }

        /* Field */
        .form-field {}

        .form-field-label {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 1.2rem;
            font-weight: 600;
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
        .form-textarea::placeholder {
            color: var(--text-muted);
            opacity: 0.7;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--gold);
            box-shadow: 0 0 0 3px var(--gold-bg);
        }

        /* Select arrow */
        .form-select-wrap {
            position: relative;
        }

        .form-select-wrap::after {
            content: '';
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            width: 0;
            height: 0;
            border-left: 4px solid transparent;
            border-right: 4px solid transparent;
            border-top: 5px solid var(--text-muted);
            pointer-events: none;
        }

        .form-select {
            padding-right: 36px;
            cursor: pointer;
        }

        /* Textarea */
        .form-textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.7;
        }

        /* Input with prefix icon */
        .form-input-wrap {
            position: relative;
        }

        .form-input-wrap .form-input {
            padding-left: 38px;
        }

        .form-input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
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
            display: block;
            /* CRITICAL FIX: Forces the label to take up full width */
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

        .upload-loading svg {
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

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
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s;
        }

        .portfolio-thumb:hover img {
            transform: scale(1.06);
        }

        .portfolio-thumb-del {
            position: absolute;
            top: 8px;
            right: 8px;
            width: 28px;
            height: 28px;
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
        @media (hover: none),
        (max-width: 768px) {
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
            left: 0;
            right: 0;
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
            .form-page {
                padding: 32px 20px 120px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
            }

            .form-section-body {
                padding: 20px;
            }

            .form-section-header {
                padding: 16px 20px;
            }

            .portfolio-thumbs {
                grid-template-columns: repeat(3, 1fr);
            }

            .form-section-desc {
                display: none;
            }

            /* ── Mobile Sticky Bar Fixes ── */
            .form-submit-bar {
                margin: 0 -20px;
                padding: 16px 20px;
                flex-direction: column;
                /* Stack the bar vertically */
                gap: 12px;
            }

            .form-submit-status {
                display: none;
                /* Hide the helper text on mobile to save space */
            }

            .submit-actions {
                width: 100%;
                display: flex;
                flex-direction: row;
                /* Keep buttons side-by-side on tablets */
            }

            .submit-actions>* {
                flex: 1;
                /* Make both buttons take up exactly 50% of the width */
                justify-content: center;
            }
        }

        @media (max-width: 480px) {
            .portfolio-thumbs {
                grid-template-columns: repeat(2, 1fr);
            }

            /* On very small phones, stack the buttons on top of each other */
            .submit-actions {
                flex-direction: column-reverse;
                /* Puts the Save button on top of View Profile */
            }

            .submit-actions>* {
                width: 100%;
            }
        }

        .form-section {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            margin-bottom: 24px;
            transition: background 0.4s, border-color 0.4s;
            overflow: visible;
            /* ← ADD THIS */
        }

        /* ── Experience Section Font Standardization ── */

        /* 1. Base Table Size */
        .form-section-body table {
            font-size: 0.95rem !important;
        }

        /* 2. Table Headers (Year, Title, Role, etc.) */
        .form-section-body th {
            font-size: 0.8rem !important;
        }

        /* 3. Standard Cell Text */
        .form-section-body td {
            font-size: 0.95rem !important;
        }

        /* 4. Jury text and specific table notes */
        .form-section-body span[style*="font-size: 0.85rem"],
        .form-section-body span[style*="font-size: 0.8rem"],
        .form-section-body td[style*="font-size: 0.8rem"] {
            font-size: 0.9rem !important;
        }

        /* 5. Edit & Delete Buttons */
        .form-section-body button[wire\:click*="editExperience"],
        .form-section-body button[wire\:click*="deleteExperience"] {
            font-size: 0.85rem !important;
        }

        /* 6. Result Badges (Won / Nominated) */
        .form-section-body span[style*="border-radius: 999px"][style*="font-size: 0.7rem"] {
            font-size: 0.75rem !important;
            padding: 4px 10px !important;
        }

        /* ── Mobile Submit Bar: Single Row Force ── */
        @media (max-width: 768px) {
            .form-submit-bar {
                flex-direction: row !important;
                padding: 12px 16px !important;
                gap: 8px !important;
                align-items: center !important;
            }

            .submit-actions {
                flex-direction: row !important;
                width: auto !important;
                gap: 8px !important;
                flex: 1;
            }

            /* Hide text strings on mobile, keep only icons */
            .hide-on-mobile {
                display: none !important;
            }

            /* Make secondary buttons square and compact */
            .btn-mobile-icon {
                min-width: 44px !important;
                width: 44px !important;
                height: 44px !important;
                padding: 0 !important;
                justify-content: center !important;
            }

            /* Let Save button stretch to fill the rest of the screen */
            .btn-mobile-save {
                flex: 1 !important;
                min-width: 0 !important;
                height: 44px !important;
                padding: 0 10px !important;
                font-size: 0.85rem !important;
                white-space: nowrap;
            }

            .form-submit-bar>div:first-child {
                flex-shrink: 0;
            }
        }

        /* ── Mobile Progress Steps Fix ── */
        @media (max-width: 768px) {
            .form-steps {
                /* Disable horizontal scroll, force them to fit */
                flex-wrap: nowrap !important;
                justify-content: space-between !important;
                width: 100% !important;
                overflow: hidden !important;
                gap: 0 !important;
            }

            .form-step {
                flex-shrink: 1 !important;
            }

            .form-step-line {
                /* Make the lines shrink/grow dynamically */
                flex: 1 !important;
                width: auto !important;
                min-width: 8px !important;
                margin: 0 6px !important;
            }

            .form-step-label {
                /* Hide all labels by default to save space */
                display: none !important;
            }

            .form-step.is-active .form-step-label {
                /* Show ONLY the active label */
                display: block !important;
                font-size: 0.75rem !important;
                margin-left: 6px !important;
            }

            .form-step-dot {
                /* Make the circles slightly smaller on mobile */
                width: 30px !important;
                height: 30px !important;
                font-size: 0.75rem !important;
            }
        }
    </style>

    <div class="form-page">

        {{-- Error flash --}}
        @if(session()->has('error'))
            <div class="form-flash" style="border-color: #c0392b; color: #c0392b; background: rgba(192,57,43,0.07);">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10" />
                    <line x1="12" y1="8" x2="12" y2="12" />
                    <line x1="12" y1="16" x2="12.01" y2="16" />
                </svg>
                {{ session('error') }}
            </div>
        @endif
        {{-- ═════════════════════════════════════════
        GATE 0: DOCUMENT UPLOAD
        ═════════════════════════════════════════ --}}

        @if($currentStep === 'document_upload')
            <div class="text-center py-10 anim-fade-up max-w-2xl mx-auto" style="font-family: 'SolaimanLipi', sans-serif;">
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; background: var(--gold-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; color: var(--gold);">
                    <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="12" y1="18" x2="12" y2="12"></line>
                        <line x1="9" y1="15" x2="15" y2="15"></line>
                    </svg>
                </div>

                <h2 class="form-page-title mb-2">Verify Your <strong>Identity</strong></h2>
                <p class="form-page-sub mx-auto mb-8" style="font-size: 1.1rem; line-height: 1.5;">
                    To verify your identity, please upload your National ID (NID), Birth Certificate, or Passport.
                </p>

                <form wire:submit.prevent="submitDocuments" class="text-left"
                    style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 32px; box-shadow: var(--shadow-sm);">

                    {{-- FRONT SIDE --}}
                    @if(in_array(Auth::user()->verification_status, ['unverified', 'rejected', null, '']))
                        <div style="margin-bottom: 24px;">
                            <label class="form-field-label" style="font-size: 1.1rem; letter-spacing: normal;">
                                NID / Birth Certificate / Passport (Front Side) <span class="required">*</span>
                            </label>

                            <input type="file" wire:model="nidImage" class="form-input" accept="image/*">

                            <div wire:loading wire:target="nidImage"
                                style="color: var(--gold); font-size: 0.95rem; margin-top: 4px;">
                                Uploading image...
                            </div>

                            @error('nidImage')
                                <span style="color: #dc2626; font-size: 0.95rem; display: block; margin-top: 4px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif

                    {{-- BACK SIDE --}}
                    @if(in_array(Auth::user()->verification_status, ['unverified', 'rejected', null, '']))
                        <div style="margin-bottom: 32px;">
                            <label class="form-field-label" style="font-size: 1.1rem; letter-spacing: normal;">
                                NID / Birth Certificate / Passport (Back Side) <span class="required">*</span>
                            </label>

                            <input type="file" wire:model="nidBackImage" class="form-input" accept="image/*">

                            <div wire:loading wire:target="nidBackImage"
                                style="color: var(--gold); font-size: 0.95rem; margin-top: 4px;">
                                Uploading image...
                            </div>

                            @error('nidBackImage')
                                <span style="color: #dc2626; font-size: 0.95rem; display: block; margin-top: 4px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif

                    {{-- PROFILE PHOTO --}}
                    @if(in_array(Auth::user()->verification_status, ['unverified', 'rejected', null, '']))
                        <div style="margin-bottom: 32px;">
                            <label class="form-field-label" style="font-size: 1.1rem; letter-spacing: normal;">
                                Profile Photo <span style="color: var(--text-muted); font-weight: 400;">(Required)</span>
                            </label>
                            <p style="font-size: 0.9rem; color: var(--text-muted); margin-bottom: 10px;">
                                Upload a clear photo of your face. You can also add or change this later from your profile.
                            </p>

                            {{-- Preview --}}
                            @if($profilePhotoUpload)
                                <div style="margin-bottom: 12px;">
                                    <img src="{{ $profilePhotoUpload->temporaryUrl() }}"
                                        style="width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 2px solid var(--border-strong);">
                                </div>
                            @endif

                            <input type="file" wire:model="profilePhotoUpload" class="form-input" accept="image/*">

                            <div wire:loading wire:target="profilePhotoUpload"
                                style="color: var(--gold); font-size: 0.95rem; margin-top: 4px;">
                                Uploading photo...
                            </div>

                            @error('profilePhotoUpload')
                                <span style="color: #dc2626; font-size: 0.95rem; display: block; margin-top: 4px;">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                    @endif
                    <button type="submit" class="btn-fill"
                        style="width: 100%; justify-content: center; padding: 14px; font-size: 1.15rem; font-family: 'SolaimanLipi', sans-serif;">
                        <span wire:loading.remove wire:target="submitDocuments">Submit Documents</span>
                        <span wire:loading wire:target="submitDocuments">Uploading and Saving...</span>
                    </button>

                </form>
            </div>
        @elseif($currentStep === 'basic_info')
            <div class="anim-fade-up max-w-2xl mx-auto" style="font-family: 'SolaimanLipi', sans-serif;">

                {{-- Header --}}
                <div style="text-align: center; padding: 40px 0 28px;">
                    <div
                        style="width: 80px; height: 80px; border-radius: 50%; background: var(--gold-bg); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px; color: var(--gold);">
                        <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <h2 class="form-page-title mb-2">Complete Your <strong>Basic Info</strong></h2>
                    <p class="form-page-sub mx-auto" style="font-size: 1.1rem; line-height: 1.5; max-width: 480px;">
                        Almost there! Fill in a few details to complete your registration and submit for review.
                    </p>
                </div>

                {{-- Step progress --}}
                <div style="display: flex; align-items: center; gap: 0; margin-bottom: 32px;">
                    <div
                        style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-family: 'Jost', sans-serif;">
                        <span
                            style="width: 24px; height: 24px; border-radius: 50%; background: var(--gold); color: #000; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.7rem;">✓</span>
                        <span style="color: var(--text-muted);">Payment</span>
                    </div>
                    <div style="flex: 1; height: 1px; background: var(--gold); margin: 0 10px;"></div>
                    <div
                        style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-family: 'Jost', sans-serif;">
                        <span
                            style="width: 24px; height: 24px; border-radius: 50%; background: var(--gold); color: #000; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.7rem;">✓</span>
                        <span style="color: var(--text-muted);">Documents</span>
                    </div>
                    <div style="flex: 1; height: 1px; background: var(--gold); margin: 0 10px;"></div>
                    <div
                        style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-family: 'Jost', sans-serif;">
                        <span
                            style="width: 24px; height: 24px; border-radius: 50%; background: var(--gold); color: #000; display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.7rem;">3</span>
                        <span style="color: var(--text-primary); font-weight: 600;">Basic Info</span>
                    </div>
                    <div style="flex: 1; height: 1px; background: var(--border); margin: 0 10px;"></div>
                    <div
                        style="display: flex; align-items: center; gap: 8px; font-size: 0.8rem; font-family: 'Jost', sans-serif;">
                        <span
                            style="width: 24px; height: 24px; border-radius: 50%; background: var(--bg-secondary); color: var(--text-muted); display: inline-flex; align-items: center; justify-content: center; font-weight: 700; font-size: 0.7rem;">4</span>
                        <span style="color: var(--text-muted);">Under Review</span>
                    </div>
                </div>

                <form wire:submit.prevent="submitBasicInfo"
                    style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 32px; box-shadow: var(--shadow-sm);">

                    <div class="form-grid">

                        {{-- Name --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-name">
                                Full Name <span class="required">*</span>
                            </label>
                            <input id="bi-name" type="text" class="form-input" wire:model.defer="name"
                                placeholder="Your full name">
                            @error('name')
                                <span style="color:#dc2626;font-size:0.8rem;margin-top:4px;display:block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Phone --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-phone">Phone Number</label>
                            <input id="bi-phone" type="text" class="form-input" wire:model.defer="phone"
                                placeholder="e.g. 01700000000">
                            @error('phone')
                                <span style="color:#dc2626;font-size:0.8rem;margin-top:4px;display:block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Gender --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-gender">Gender</label>
                            <div class="form-select-wrap">
                                <select id="bi-gender" class="form-select" wire:model.defer="gender">
                                    <option value="">Prefer not to say</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                    <option value="Other">Other</option>
                                </select>
                            </div>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-dob">Date of Birth</label>
                            <input id="bi-dob" type="date" class="form-input" wire:model.defer="date_of_birth">
                            @error('date_of_birth')
                                <span style="color:#dc2626;font-size:0.8rem;margin-top:4px;display:block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Height --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-height">Height (ft/cm)</label>
                            <input id="bi-height" type="text" class="form-input" wire:model.defer="height_cm"
                                placeholder="e.g. 5'8&quot; or 172">
                        </div>

                        {{-- Languages --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-languages">Languages Spoken</label>
                            <input id="bi-languages" type="text" class="form-input" wire:model.defer="languages"
                                placeholder="e.g. Bengali, English">
                            <div class="form-hint">Separate with commas</div>
                        </div>

                        {{-- Experience Level --}}
                        <div class="form-field">
                            <label class="form-field-label">Experience Level</label>
                            <div class="form-select-wrap">
                                <select class="form-select" wire:model.defer="experience_level">
                                    <option value="">Select level</option>
                                    <option value="Fresher">Fresher (No Experience)</option>
                                    <option value="1-3 Years">1–3 Years</option>
                                    <option value="Professional">Professional (3+ Years)</option>
                                </select>
                            </div>
                        </div>

                        {{-- Availability --}}
                        <div class="form-field">
                            <label class="form-field-label">Availability</label>
                            <div class="form-select-wrap">
                                <select class="form-select" wire:model.defer="availability">
                                    <option value="">Select</option>
                                    <option value="Full-time">Full-time</option>
                                    <option value="Part-time">Part-time</option>
                                    <option value="Weekends Only">Weekends Only</option>
                                    <option value="Flexible">Flexible</option>
                                </select>
                            </div>
                        </div>

                        {{-- District --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-district">
                                District <span class="required">*</span>
                            </label>
                            <input id="bi-district" type="text" class="form-input" wire:model.defer="district"
                                placeholder="e.g. Dhaka">
                            @error('district')
                                <span style="color:#dc2626;font-size:0.8rem;margin-top:4px;display:block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Upazila --}}
                        <div class="form-field">
                            <label class="form-field-label" for="bi-upazila">
                                Thana / Upazila <span class="required">*</span>
                            </label>
                            <input id="bi-upazila" type="text" class="form-input" wire:model.defer="upazila"
                                placeholder="e.g. Mirpur">
                            @error('upazila')
                                <span style="color:#dc2626;font-size:0.8rem;margin-top:4px;display:block;">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Street Address — full width, private --}}
                        <div class="form-field form-grid-full">
                            <label class="form-field-label" for="bi-street">
                                Street / Full Address
                                <span
                                    style="font-size: 0.65rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: #fff; background: #6b7280; padding: 2px 7px; border-radius: 999px; margin-left: 8px; vertical-align: middle;">
                                    🔒 Private
                                </span>
                            </label>
                            <textarea id="bi-street" class="form-input form-textarea" wire:model.defer="street_address"
                                placeholder="e.g. House 12, Road 4, Block B, Mirpur-10" rows="2"></textarea>
                            <div class="form-hint">Never shown publicly. Used for verification only.</div>
                        </div>

                        {{-- Talent Categories & Skills --}}
                        <div class="form-field form-grid-full">   {{-- ← form-grid-full makes it span both columns --}}
                            <label class="form-field-label">
                                Talent Categories & Skills <span class="required">*</span>
                            </label>
                            <div class="form-hint mb-4">Select all areas where you have professional experience.</div>

                            @error('categories')
                                <span style="color: #dc2626; font-size: 0.75rem; display: block; margin-bottom: 16px;">{{ $message }}</span>
                            @enderror

                            <div style="display: grid; gap: 24px;">
                                @foreach($groupedCategories as $groupName => $cats)
                                    <div style="background: var(--bg-primary); border: 1px solid var(--border); border-radius: 6px; padding: 16px;">
                                        <h4 style="font-size: 0.85rem; font-weight: 600; color: var(--gold); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px; border-bottom: 1px solid var(--border-strong); padding-bottom: 8px;">
                                            {{ $groupName }}
                                        </h4>
                                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px;">
                                            @foreach($cats as $cat)
                                                <label style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer; font-size: 0.9rem; color: var(--text-primary);">
                                                    <input type="checkbox" wire:model.defer="categories"
                                                        value="{{ $cat->name }}"
                                                        style="margin-top: 4px; accent-color: var(--gold); width: 16px; height: 16px; cursor: pointer;">
                                                    <span style="line-height: 1.4;">{{ $cat->name }}</span>
                                                </label>
                                            @endforeach
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                    </div>

                    {{-- Submit --}}
                    <button type="submit" class="btn-fill"
                        style="width: 100%; justify-content: center; padding: 14px; font-size: 1.15rem; margin-top: 8px; font-family: 'SolaimanLipi', sans-serif;">
                        <span wire:loading.remove wire:target="submitBasicInfo">
                            Save & Continue
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="margin-left: 8px;">
                                <line x1="5" y1="12" x2="19" y2="12" />
                                <polyline points="12 5 19 12 12 19" />
                            </svg>
                        </span>
                        <span wire:loading wire:target="submitBasicInfo">Saving...</span>
                    </button>

                </form>
            </div>


            {{-- ═════════════════════════════════════════
            GATE 1: PAYMENT FAILED
            ═════════════════════════════════════════ --}}
        @elseif($currentStep === 'payment_failed')
            <div class="text-center py-20 anim-fade-up" style="font-family: 'SolaimanLipi', sans-serif;">
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; background: rgba(220, 38, 38, 0.1); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#dc2626" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="15" y1="9" x2="9" y2="15" />
                        <line x1="9" y1="9" x2="15" y2="15" />
                    </svg>
                </div>
                <h2 class="form-page-title mb-4">Payment <strong>Failed</strong></h2>
                <p class="form-page-sub mx-auto mb-8" style="max-width: 480px; font-size: 1.1rem; line-height: 1.5;">
                    We could not verify your payment. Please check your transaction ID (TrxID) and mobile number, then
                    submit the form again.<br><br>
                    If you are sure the payment was successful, please contact our support team.
                </p>
                <div style="display: flex; gap: 16px; justify-content: center;">
                    <a href="/contact" class="btn-outline" style="font-size: 1rem;">Contact Support</a>
                    <a href="{{ route('packages.index') }}" class="btn-fill" style="font-size: 1rem;">
                        Submit Payment Again
                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            style="margin-left:8px;">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </div>

            {{-- ═════════════════════════════════════════
            GATE 2: PAYMENT EXPIRED (BANGLA)
            ═════════════════════════════════════════ --}}
        @elseif($currentStep === 'payment_expired')
            <div class="text-center py-20 anim-fade-up" style="font-family: 'SolaimanLipi', sans-serif;">
                <div
                    style="width: 80px; height: 80px; border-radius: 50%; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center; margin: 0 auto 24px;">
                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="12" cy="12" r="10" />
                        <polyline points="12 6 12 12 16 14" />
                    </svg>
                </div>
                <h2 class="form-page-title mb-4">Subscription <strong>Expired</strong></h2>
                <p class="form-page-sub mx-auto mb-8" style="max-width: 480px; font-size: 1.1rem; line-height: 1.5;">
                    Your verified talent subscription has expired. To reactivate your public profile and receive casting
                    calls, please renew your package.
                </p>
                <a href="{{ route('packages.index') }}" class="btn-fill" style="display: inline-flex; font-size: 1.1rem;">
                    Renew Subscription
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                        style="margin-left:8px;">
                        <path d="M21.5 2v6h-6M21.34 15.57a10 10 0 1 1-.92-10.26l3.08 2.69" />
                    </svg>
                </a>
            </div>

            {{-- ═════════════════════════════════════════
            GATE 3: PAYMENT PENDING (BANGLA)
            ═════════════════════════════════════════ --}}
        @elseif($currentStep === 'payment_pending')
            <div class="text-center py-20 anim-fade-up" style="font-family: 'SolaimanLipi', sans-serif;">
                <svg class="mx-auto h-16 w-16 text-yellow-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <h2 class="form-page-title mb-2">Payment <strong>Under Review</strong></h2>
                <p class="form-page-sub mx-auto" style="font-size: 1.1rem; line-height: 1.5; max-width: 480px;">
                    Our team is currently reviewing your transaction ID. This process typically takes a few hours.
                    Please check back later!
                </p>
            </div>

            {{-- ═════════════════════════════════════════
            GATE 3 & 4: EVERYTHING UNDER REVIEW (BANGLA)
            ═════════════════════════════════════════ --}}
        @elseif($currentStep === 'under_review')
            <div class="text-center py-20 anim-fade-up max-w-lg mx-auto" style="font-family: 'SolaimanLipi', sans-serif;">
                <svg class="mx-auto h-16 w-16 text-blue-500 mb-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                        d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                </svg>
                <h2 class="form-page-title mb-2">Account <strong>Under Review</strong></h2>
                <p class="form-page-sub mx-auto mb-8"
                    style="color: var(--text-secondary); font-size: 1.1rem; line-height: 1.5;">
                    Our team is currently reviewing your uploaded documents and payment transaction. Your profile will be
                    unlocked once everything is approved!
                </p>

                <div
                    style="background: var(--bg-surface); border: 1px solid var(--border); border-radius: 8px; padding: 20px; text-align: left; box-shadow: var(--shadow-sm);">

                    {{-- NID Status --}}
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
                        <span style="font-size: 1rem; font-weight: 600; color: var(--text-primary);">NID/Passport/Birth
                            Front</span>
                        <span
                            style="font-size: 0.75rem; padding: 4px 10px; border-radius: 999px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-family: 'Jost', sans-serif;
                                                {{ Auth::user()->verification_status === 'verified' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #eab308;' }}">
                            {{ Auth::user()->verification_status }}
                        </span>
                    </div>

                    {{-- Academic Cert Status --}}
                    <div
                        style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 16px; padding-bottom: 16px; border-bottom: 1px solid var(--border);">
                        <span style="font-size: 1rem; font-weight: 600; color: var(--text-primary);">NID/Passport/Birth
                            Back</span>
                        <span
                            style="font-size: 0.75rem; padding: 4px 10px; border-radius: 999px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-family: 'Jost', sans-serif;
            {{ Auth::user()->nid_back_verification_status === 'verified' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #eab308;' }}">
                            {{ Auth::user()->nid_back_verification_status }}
                        </span>
                    </div>

                    {{-- Payment Status --}}
                    @php $sub = Auth::user()->subscriptions()->latest()->first(); @endphp
                    <div style="display: flex; justify-content: space-between; align-items: center;">
                        <span style="font-size: 1rem; font-weight: 600; color: var(--text-primary);">Payment
                            Verification</span>
                        <span
                            style="font-size: 0.75rem; padding: 4px 10px; border-radius: 999px; font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; font-family: 'Jost', sans-serif;
                                                {{ $sub && $sub->status === 'active' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #eab308;' }}">
                            {{ $sub ? ($sub->status === 'active' ? 'verified' : $sub->status) : 'pending' }}
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
                <div class="form-page-eyebrow" style="display: flex; justify-content: space-between; width: 100%;">
                    <span>Your Profile</span>
                    @if(Auth::user()->member_id)
                        <span style="color: var(--text-muted); text-transform: none; letter-spacing: normal;">
                            Member ID: <strong style="color: var(--text-primary);">{{ Auth::user()->member_id }}</strong>
                        </span>
                    @endif
                </div>
                <h1 class="form-page-title">Build Your <strong>Talent Profile</strong></h1>
                <p class="form-page-sub">Complete your profile to appear in the verified talent directory and attract
                    clients.</p>
            </div>

            <form wire:submit="saveProfile" novalidate x-data="{ activeTab: 1 }">
                <div class="form-steps anim-fade-up anim-d1" aria-label="Form progress">
                    {{-- Tab 1 --}}
                    <button type="button" class="form-step" :class="activeTab === 1 ? 'is-active' : ''"
                        @click="activeTab = 1">
                        <div class="form-step-dot">01</div>
                        <span class="form-step-label">Basic Info</span>
                    </button>
                    <div class="form-step-line"></div>

                    {{-- Tab 2 --}}
                    <button type="button" class="form-step" :class="activeTab === 2 ? 'is-active' : ''"
                        @click="activeTab = 2">
                        <div class="form-step-dot">02</div>
                        <span class="form-step-label">Location</span>
                    </button>
                    <div class="form-step-line"></div>

                    {{-- Tab 3 --}}
                    <button type="button" class="form-step" :class="activeTab === 3 ? 'is-active' : ''"
                        @click="activeTab = 3">
                        <div class="form-step-dot">03</div>
                        <span class="form-step-label">About</span>
                    </button>
                    <div class="form-step-line"></div>

                    {{-- Tab 4 --}}
                    <button type="button" class="form-step" :class="activeTab === 4 ? 'is-active' : ''"
                        @click="activeTab = 4">
                        <div class="form-step-dot">04</div>
                        <span class="form-step-label">Portfolio</span>
                    </button>
                </div>

                {{-- Success flash --}}
                @if(session()->has('message'))
                    <div class="form-flash anim-fade-up">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            aria-hidden="true">
                            <path
                                d="M12 2L3 7v5c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7L12 2zm-2 15l-4-4 1.41-1.41L10 14.17l6.59-6.59L18 9l-8 8z" />
                        </svg>
                        {{ session('message') }}
                    </div>
                @endif


                <div x-show="activeTab === 1" x-transition>
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
                                    <div
                                        style="width: 130px; height: 130px; border-radius: 50%; padding: 4px; border: 2px dashed var(--border-strong); position: relative;">
                                        <div
                                            style="width: 100%; height: 100%; border-radius: 50%; overflow: hidden; background: var(--bg-secondary);">
                                            @if ($newAvatar)
                                                <img src="{{ $newAvatar->temporaryUrl() }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            @elseif(auth()->user()->getFirstMediaUrl('avatar'))
                                                <img src="{{ auth()->user()->getFirstMediaUrl('avatar') }}"
                                                    style="width: 100%; height: 100%; object-fit: cover;">
                                            @else
                                                <div
                                                    style="width: 100%; height: 100%; display: flex; align-items: center; justify-content: center; color: var(--text-muted);">
                                                    <svg width="40" height="40" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="1">
                                                        <circle cx="12" cy="8" r="4" />
                                                        <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
                                                    </svg>
                                                </div>
                                            @endif
                                        </div>
                                        {{-- Edit Badge --}}
                                        <button type="button" @click="menuOpen = !menuOpen"
                                            style="position: absolute; bottom: 0; right: 4px; background: var(--bg-surface); border: 1px solid var(--border-strong); border-radius: 50%; width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: var(--text-primary); box-shadow: 0 4px 12px rgba(0,0,0,0.1); cursor: pointer;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <path d="M12 20h9M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z" />
                                            </svg>
                                        </button>
                                    </div>

                                    {{-- Inline Menu (not absolutely positioned) --}}
                                    <div x-show="menuOpen" x-transition
                                        style="width: 200px; background: var(--bg-surface); border: 1px solid var(--border-strong); border-radius: 6px; box-shadow: 0 8px 24px rgba(0,0,0,0.12); overflow: hidden;">

                                        <a href="{{ route('artist.show', auth()->id()) }}" target="_blank"
                                            style="display: block; padding: 12px 16px; font-size: 0.85rem; color: var(--text-primary); text-decoration: none; border-bottom: 1px solid var(--border);"
                                            onmouseover="this.style.background='var(--bg-secondary)'"
                                            onmouseout="this.style.background=''">
                                            👁 View Public Profile
                                        </a>

                                        <label
                                            style="display: block; padding: 12px 16px; font-size: 0.85rem; color: var(--text-primary); cursor: pointer; border-bottom: 1px solid var(--border);"
                                            onmouseover="this.style.background='var(--bg-secondary)'"
                                            onmouseout="this.style.background=''">
                                            📷 Upload New Photo
                                            <input type="file" wire:model="newAvatar" accept="image/*"
                                                style="display: none;">
                                        </label>

                                        @if(auth()->user()->getMedia('avatar')->count() > 0)
                                            <button type="button" wire:click="deleteAvatar"
                                                onclick="return confirm('Remove your profile picture?')"
                                                style="width: 100%; text-align: left; padding: 12px 16px; font-size: 0.85rem; color: #dc2626; background: none; border: none; cursor: pointer;"
                                                onmouseover="this.style.background='rgba(220,38,38,0.05)'"
                                                onmouseout="this.style.background=''">
                                                🗑 Remove Photo
                                            </button>
                                        @endif
                                    </div>

                                </div>

                                {{-- Right: Status messages --}}
                                <div style="flex: 1; min-width: 200px; padding-top: 8px;">
                                    @if($newAvatar)
                                        <div
                                            style="background: rgba(201,169,110,0.1); border: 1px solid rgba(201,169,110,0.3); padding: 16px; border-radius: 6px;">
                                            <h4
                                                style="font-size: 0.9rem; font-weight: 600; color: var(--gold); margin-bottom: 8px;">
                                                Unsaved Photo</h4>
                                            <p style="font-size: 0.8rem; color: var(--text-secondary); margin-bottom: 12px;">
                                                Click save to update your profile picture.</p>
                                            <button type="button" wire:click="updateAvatar" class="btn-fill"
                                                style="font-size: 0.8rem; padding: 8px 16px;">
                                                <span wire:loading.remove wire:target="updateAvatar">Save Profile Picture</span>
                                                <span wire:loading wire:target="updateAvatar">Saving...</span>
                                            </button>
                                        </div>
                                    @else
                                        <p style="font-size: 0.9rem; color: var(--text-muted); line-height: 1.6;">
                                            Click the <strong>pencil icon</strong> on your avatar to upload a new photo, view
                                            your public profile, or remove your current picture.
                                        </p>
                                    @endif
                                    <div wire:loading wire:target="newAvatar"
                                        style="font-size: 0.8rem; color: var(--gold); margin-top: 8px;">Preparing image...
                                    </div>
                                    @error('newAvatar') <div style="color: #ff4a4a; font-size: 0.8rem; margin-top: 8px;">
                                        {{ $message }}
                                    </div> @enderror
                                    @if(session()->has('success'))
                                        <div style="color: #2a7d4f; font-size: 0.8rem; margin-top: 8px;">
                                            {{ session('success') }}
                                    </div> @endif
                                </div>

                            </div>
                        </div>
                    </div>
                    {{-- ── Section 01: Professional Details ── --}}
                    <div class="form-section anim-fade-up anim-d1">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7" aria-hidden="true">
                                    <circle cx="12" cy="8" r="4" />
                                    <path d="M4 20c0-4 3.58-7 8-7s8 3 8 7" />
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
                                    <div class="form-hint mb-4">Select all areas where you have professional experience.
                                    </div>

                                    @error('categories') <span
                                        style="color: #dc2626; font-size: 0.75rem; display: block; margin-bottom: 16px;">{{ $message }}</span>
                                    @enderror

                                    <div style="display: grid; gap: 24px;">
                                        @foreach($groupedCategories as $groupName => $cats)
                                            <div
                                                style="background: var(--bg-primary); border: 1px solid var(--border); border-radius: 6px; padding: 16px;">
                                                <h4
                                                    style="font-size: 0.85rem; font-weight: 600; color: var(--gold); text-transform: uppercase; letter-spacing: 0.1em; margin-bottom: 12px; border-bottom: 1px solid var(--border-strong); padding-bottom: 8px;">
                                                    {{ $groupName }}
                                                </h4>
                                                <div
                                                    style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px;">

                                                    @foreach($cats as $cat)
                                                        <label
                                                            style="display: flex; align-items: flex-start; gap: 8px; cursor: pointer; font-size: 0.9rem; color: var(--text-primary); transition: color 0.2s;">
                                                            <input type="checkbox" wire:model.defer="categories"
                                                                value="{{ $cat->name }}"
                                                                style="margin-top: 4px; accent-color: var(--gold); width: 16px; height: 16px; cursor: pointer;">
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
                                        <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                            <circle cx="12" cy="12" r="10" />
                                            <path d="M9 8h6M9 12h6M9 16h4" />
                                        </svg>
                                        <input id="f-rate" type="number" class="form-input" wire:model.defer="hourly_rate"
                                            placeholder="e.g. 1500" min="0">
                                    </div>
                                    <div class="form-hint">Leave blank to show "Negotiable"</div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-name">Full Name</label>
                                    <input id="f-name" type="text" class="form-input" wire:model.defer="name"
                                        placeholder="e.g. Tanvir Ahmed" autocomplete="name">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-phone">Phone Number</label>
                                    <div class="form-input-wrap">
                                        <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                            <path
                                                d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z" />
                                        </svg>
                                        <input id="f-phone" type="text" class="form-input" wire:model.defer="phone"
                                            placeholder="e.g. 017XXXXXXXX" autocomplete="tel">
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-email">Email Address</label>
                                    <div class="form-input-wrap">
                                        <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                            <path
                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z" />
                                            <polyline points="22,6 12,13 2,6" />
                                        </svg>
                                        <input id="f-email" type="email" class="form-input" wire:model.defer="email"
                                            placeholder="you@example.com" autocomplete="email">
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
                                    <label class="form-field-label" for="f-height">Height (ft)</label>
                                    <div class="form-input-wrap">
                                        <svg class="form-input-icon" width="14" height="14" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                            <path d="M8 3v18M5 6h3M5 10h3M5 14h3M5 18h3M16 3l4 4-4 4M20 7H8" />
                                        </svg>
                                        <input id="f-height" type="number" class="form-input" wire:model.defer="height_cm"
                                            placeholder="e.g. 165" min="100" max="250">
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-languages">Languages Spoken</label>
                                    <input id="f-languages" type="text" class="form-input" wire:model.defer="languages"
                                        placeholder="e.g. Bengali, English">
                                    <div class="form-hint">Separate multiple languages with commas</div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Measurements & Appearance ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M8 3v18M5 6h3M5 10h3M5 14h3M5 18h3M16 3l4 4-4 4M20 7H8" />
                                </svg>
                            </div>
                            <div class="form-section-title">Measurements & Appearance</div>
                            <div class="form-section-desc">For casting accuracy</div>
                        </div>
                        <div class="form-section-body">
                            <div class="form-grid-2">

                                <div class="form-field">
                                    <label class="form-field-label">Height (ft)</label>
                                    <input type="number" class="form-input" wire:model.defer="height_cm"
                                        placeholder="e.g. 170">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Weight (kg)</label>
                                    <input type="number" class="form-input" wire:model.defer="weight_kg"
                                        placeholder="e.g. 65">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Chest / Bust (inches)</label>
                                    <input type="number" class="form-input" wire:model.defer="chest_bust_inches"
                                        placeholder="e.g. 36">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Waist (inches)</label>
                                    <input type="number" class="form-input" wire:model.defer="waist_inches"
                                        placeholder="e.g. 30">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Hips (inches)</label>
                                    <input type="number" class="form-input" wire:model.defer="hips_inches"
                                        placeholder="e.g. 38">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Shoulder (inches) — Male</label>
                                    <input type="number" class="form-input" wire:model.defer="shoulder_inches"
                                        placeholder="e.g. 18">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Shoe Size</label>
                                    <input type="text" class="form-input" wire:model.defer="shoe_size"
                                        placeholder="e.g. EU 42 / UK 8">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Dress Size</label>
                                    <div class="form-select-wrap">
                                        <select class="form-select" wire:model.defer="dress_size">
                                            <option value="">Select size</option>
                                            <option value="XS">XS</option>
                                            <option value="S">S</option>
                                            <option value="M">M</option>
                                            <option value="L">L</option>
                                            <option value="XL">XL</option>
                                            <option value="XXL">XXL</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Skin Tone</label>
                                    <div class="form-select-wrap">
                                        <select class="form-select" wire:model.defer="skin_tone">
                                            <option value="">Select</option>
                                            <option value="Fair">Fair</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Dusky">Dusky</option>
                                            <option value="Deep">Deep</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Eye Color</label>
                                    <input type="text" class="form-input" wire:model.defer="eye_color"
                                        placeholder="e.g. Brown">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Hair Color</label>
                                    <input type="text" class="form-input" wire:model.defer="hair_color"
                                        placeholder="e.g. Black">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Hair Length</label>
                                    <div class="form-select-wrap">
                                        <select class="form-select" wire:model.defer="hair_length">
                                            <option value="">Select</option>
                                            <option value="Bald">Bald</option>
                                            <option value="Short">Short</option>
                                            <option value="Medium">Medium</option>
                                            <option value="Long">Long</option>
                                        </select>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Experience & Availability ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            </div>
                            <div class="form-section-title">Experience & Availability</div>
                        </div>
                        <div class="form-section-body">
                            <div class="form-grid-2">

                                <div class="form-field">
                                    <label class="form-field-label">Experience Level</label>
                                    <div class="form-select-wrap">
                                        <select class="form-select" wire:model.defer="experience_level">
                                            <option value="">Select level</option>
                                            <option value="Fresher">Fresher (No Experience)</option>
                                            <option value="1-3 Years">1–3 Years</option>
                                            <option value="Professional">Professional (3+ Years)</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label">Availability</label>
                                    <div class="form-select-wrap">
                                        <select class="form-select" wire:model.defer="availability">
                                            <option value="">Select</option>
                                            <option value="Full-time">Full-time</option>
                                            <option value="Part-time">Part-time</option>
                                            <option value="Weekends">Weekends Only</option>
                                            <option value="Flexible">Flexible</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-field form-grid-full">
                                    <label class="form-field-label">Special Skills</label>
                                    <input type="text" class="form-input" wire:model.defer="special_skills_input"
                                        placeholder="e.g. Driving, Swimming, Dancing, Horse Riding">
                                    <div class="form-hint">Separate skills with commas</div>
                                </div>

                                <div class="form-field form-grid-full">
                                    <label class="form-field-label">Intro Video / Showreel URL</label>
                                    <input type="url" class="form-input" wire:model.defer="showreel_url"
                                        placeholder="https://youtube.com/watch?v=...">
                                    <div class="form-hint">YouTube or Vimeo link to your demo reel</div>
                                </div>

                                <div class="form-field form-grid-full">
                                    <label style="display:flex; align-items:center; gap:12px; cursor:pointer;">
                                        <input type="checkbox" wire:model.defer="willing_to_travel"
                                            style="width:18px; height:18px; accent-color:var(--gold); cursor:pointer;">
                                        <span class="form-field-label" style="margin:0;">Willing to Travel for
                                            Projects</span>
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 2" x-transition style="display: none;">
                    {{-- ── Section 02: Location ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7z" />
                                    <circle cx="12" cy="9" r="2.5" />
                                </svg>
                            </div>
                            <div class="form-section-title">Location</div>
                            <div class="form-section-desc">Helps clients find local talent</div>
                        </div>
                        <div class="form-section-body">
                            <div class="form-grid-2">

                                <div class="form-field">
                                    <label class="form-field-label" for="f-district">
                                        District <span class="required">*</span>
                                    </label>
                                    <input id="f-district" type="text" class="form-input" wire:model.defer="district"
                                        placeholder="e.g. Dhaka">
                                    @error('district')
                                        <span
                                            style="color: #dc2626; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-upazila">
                                        Thana / Upazila <span class="required">*</span>
                                    </label>
                                    <input id="f-upazila" type="text" class="form-input" wire:model.defer="upazila"
                                        placeholder="e.g. Mirpur">
                                    @error('upazila')
                                        <span
                                            style="color: #dc2626; font-size: 0.8rem; margin-top: 4px; display: block;">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Street address — private, full width --}}
                                <div class="form-field form-grid-full">
                                    <label class="form-field-label" for="f-street">
                                        Street / Full Address
                                        <span
                                            style="font-size: 0.65rem; font-weight: 600; letter-spacing: 0.1em; text-transform: uppercase; color: #fff; background: #6b7280; padding: 2px 7px; border-radius: 999px; margin-left: 8px; vertical-align: middle;">
                                            🔒 Private
                                        </span>
                                    </label>
                                    <textarea id="f-street" class="form-input form-textarea"
                                        wire:model.defer="street_address"
                                        placeholder="e.g. House 12, Road 4, Block B, Mirpur-10" rows="2"></textarea>
                                    <div class="form-hint">
                                        This is <strong>never shown publicly</strong> on your profile. Used only for
                                        internal
                                        verification purposes.
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div x-show="activeTab === 3" x-transition style="display: none;">
                    {{-- ── Section 03: About / Bio ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7" aria-hidden="true">
                                    <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                    <line x1="16" y1="13" x2="8" y2="13" />
                                    <line x1="16" y1="17" x2="8" y2="17" />
                                    <polyline points="10 9 9 9 8 9" />
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
                                <div class="form-hint">A well-written bio significantly increases your chances of being
                                    hired.</div>
                            </div>
                        </div>
                    </div>

                    {{-- ── Section: Social & Portfolio Links ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                                    <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                                </svg>
                            </div>
                            <div class="form-section-title">Social Media & Portfolio</div>
                            <div class="form-section-desc">Optional</div>
                        </div>
                        <div class="form-section-body">
                            <div class="form-grid-2">

                                {{-- Facebook --}}
                                <div class="form-field">
                                    <label class="form-field-label" for="f-facebook">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="color:var(--gold)">
                                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z" />
                                        </svg>
                                        Facebook URL
                                    </label>
                                    <input id="f-facebook" type="url" class="form-input" wire:model.defer="facebook_url"
                                        placeholder="https://facebook.com/yourpage">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-fb-followers">Facebook Followers</label>
                                    <input id="f-fb-followers" type="number" class="form-input"
                                        wire:model.defer="facebook_followers" placeholder="e.g. 10000" min="0">
                                </div>

                                {{-- Instagram --}}
                                <div class="form-field">
                                    <label class="form-field-label" for="f-instagram">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" style="color:var(--gold)">
                                            <rect x="2" y="2" width="20" height="20" rx="5" />
                                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z" />
                                            <line x1="17.5" y1="6.5" x2="17.51" y2="6.5" />
                                        </svg>
                                        Instagram URL
                                    </label>
                                    <input id="f-instagram" type="url" class="form-input" wire:model.defer="instagram_url"
                                        placeholder="https://instagram.com/yourusername">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-ig-followers">Instagram Followers</label>
                                    <input id="f-ig-followers" type="number" class="form-input"
                                        wire:model.defer="instagram_followers" placeholder="e.g. 25000" min="0">
                                </div>

                                {{-- TikTok --}}
                                <div class="form-field">
                                    <label class="form-field-label" for="f-tiktok">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="color:var(--gold)">
                                            <path
                                                d="M19.59 6.69a4.83 4.83 0 01-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 01-2.88 2.5 2.89 2.89 0 01-2.89-2.89 2.89 2.89 0 012.89-2.89c.28 0 .54.04.79.1V9.01a6.34 6.34 0 00-.79-.05 6.34 6.34 0 00-6.34 6.34 6.34 6.34 0 006.34 6.34 6.34 6.34 0 006.33-6.34V8.69a8.17 8.17 0 004.78 1.52V6.76a4.85 4.85 0 01-1.01-.07z" />
                                        </svg>
                                        TikTok URL
                                    </label>
                                    <input id="f-tiktok" type="url" class="form-input" wire:model.defer="tiktok_url"
                                        placeholder="https://tiktok.com/@yourusername">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-tk-followers">TikTok Followers</label>
                                    <input id="f-tk-followers" type="number" class="form-input"
                                        wire:model.defer="tiktok_followers" placeholder="e.g. 50000" min="0">
                                </div>

                                {{-- YouTube & LinkedIn --}}
                                <div class="form-field">
                                    <label class="form-field-label" for="f-youtube">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="color:var(--gold)">
                                            <path
                                                d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z" />
                                            <polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="white" />
                                        </svg>
                                        YouTube
                                    </label>
                                    <input id="f-youtube" type="url" class="form-input" wire:model.defer="youtube_url"
                                        placeholder="https://youtube.com/@yourchannel">
                                </div>

                                <div class="form-field">
                                    <label class="form-field-label" for="f-linkedin">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="currentColor"
                                            style="color:var(--gold)">
                                            <path
                                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                        LinkedIn
                                    </label>
                                    <input id="f-linkedin" type="url" class="form-input" wire:model.defer="linkedin_url"
                                        placeholder="https://linkedin.com/in/yourprofile">
                                </div>

                                {{-- Portfolio Website (Full Width) --}}
                                <div class="form-field form-grid-full">
                                    <label class="form-field-label" for="f-portfolio">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                            stroke-width="2" style="color:var(--gold)">
                                            <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71" />
                                            <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71" />
                                        </svg>
                                        Portfolio Website
                                    </label>
                                    <input id="f-portfolio" type="url" class="form-input" wire:model.defer="portfolio_url"
                                        placeholder="https://yourportfolio.com">
                                    <div class="form-hint">Your external portfolio, Behance, or personal website</div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div x-show="activeTab === 4" x-transition style="display: none;">
                    {{-- ── Section 04: Portfolio ── --}}
                    <div class="form-section anim-fade-up anim-d3">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7" aria-hidden="true">
                                    <rect x="3" y="3" width="18" height="18" rx="1" />
                                    <circle cx="8.5" cy="8.5" r="1.5" />
                                    <path d="M21 15l-5-5L5 21" />
                                </svg>
                            </div>
                            <div class="form-section-title">Portfolio Images</div>
                            <div class="form-section-desc">Max 12 images · JPG/PNG/WEBP</div>
                        </div>
                        <div class="form-section-body">

                            <label class="upload-zone" aria-label="Upload portfolio images">
                                <input type="file" wire:model.live="newPhotos" multiple accept="image/*"
                                    aria-label="Choose portfolio images">
                                <svg class="upload-zone-icon" width="36" height="36" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="1" aria-hidden="true">
                                    <polyline points="16 16 12 12 8 16" />
                                    <line x1="12" y1="12" x2="12" y2="21" />
                                    <path d="M20.39 18.39A5 5 0 0018 9h-1.26A8 8 0 103 16.3" />
                                </svg>
                                <div class="upload-zone-title">Drop images here or click to browse</div>
                                <div class="upload-zone-sub">Accepts JPG, PNG, WEBP &nbsp;·&nbsp; <span>Up to 12
                                        files</span></div>
                            </label>

                            <div wire:loading wire:target="newPhotos" class="upload-loading">
                                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2" aria-hidden="true">
                                    <circle cx="12" cy="12" r="10" opacity="0.25" />
                                    <path d="M12 2a10 10 0 0110 10" stroke-linecap="round" />
                                </svg>
                                Processing uploads…
                            </div>

                            @if(count($portfolioImages) > 0)
                                <div class="portfolio-thumbs">
                                    @foreach($portfolioImages as $image)
                                        <div class="portfolio-thumb">
                                            <img src="{{ $image->getUrl() }}" alt="Portfolio image" loading="lazy">
                                            <button type="button" class="portfolio-thumb-del"
                                                wire:click="deletePhoto({{ $image->id }})"
                                                onclick="return confirm('Delete this photo from your portfolio?')"
                                                aria-label="Delete photo">
                                                <svg width="10" height="10" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                    stroke-width="2.5" aria-hidden="true">
                                                    <line x1="18" y1="6" x2="6" y2="18" />
                                                    <line x1="6" y1="6" x2="18" y2="18" />
                                                </svg>
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    </div>
                    {{-- ── Section: Credits & Experience ── --}}
                    <div class="form-section anim-fade-up anim-d2">
                        <div class="form-section-header">
                            <div class="form-section-icon">
                                <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.7">
                                    <path d="M15 3h6v6M9 21H3v-6M21 3l-7 7M3 21l7-7" />
                                </svg>
                            </div>
                            <div class="form-section-title">Credits & Experience</div>
                            <div class="form-section-desc">Films, Awards, TV Shows & More</div>
                        </div>
                        <div class="form-section-body">

                            {{-- Existing entries grouped by type --}}
                            @php
                                $groupedExp = collect($experiences)->groupBy('type');
                                $typeLabels = [
                                    'film' => 'Films',
                                    'tv_drama' => 'TV / Drama',
                                    'commercial' => 'Commercials',
                                    'theater' => 'Theater',
                                    'music_video' => 'Music Videos',
                                    'award' => 'Awards',
                                    'jury' => 'Jury Activity',
                                    'other' => 'Other',
                                ];
                            @endphp

                            @if($groupedExp->isNotEmpty())
                                @foreach($groupedExp as $type => $entries)
                                    <div style="margin-bottom: 24px;">
                                        <h4
                                            style="font-size: 0.75rem; font-weight: 700; letter-spacing: 0.2em; text-transform: uppercase; color: var(--gold); margin-bottom: 12px; padding-bottom: 8px; border-bottom: 1px solid var(--border);">
                                            {{ $typeLabels[$type] ?? ucfirst($type) }}
                                        </h4>

                                        @if(in_array($type, ['award']))
                                            {{-- Awards Table --}}
                                            <div style="overflow-x: auto;">
                                                <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                                                    <thead>
                                                        <tr style="border-bottom: 1px solid var(--border);">
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Year</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Award</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Category</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                For</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Result</th>
                                                            <th style="padding: 8px 12px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($entries as $exp)
                                                            <tr style="border-bottom: 1px solid var(--border);">
                                                                <td style="padding: 10px 12px; color: var(--text-muted);">
                                                                    {{ $exp['year'] ?? '—' }}
                                                                </td>
                                                                <td
                                                                    style="padding: 10px 12px; color: var(--text-primary); font-weight: 500;">
                                                                    {{ $exp['title'] }}
                                                                </td>
                                                                <td style="padding: 10px 12px; color: var(--text-secondary);">
                                                                    {{ $exp['award_category'] ?? '—' }}
                                                                </td>
                                                                <td style="padding: 10px 12px; color: var(--text-secondary);">
                                                                    {{ $exp['award_work'] ?? '—' }}
                                                                </td>
                                                                <td style="padding: 10px 12px;">
                                                                    <span
                                                                        style="font-size: 0.7rem; font-weight: 700; padding: 3px 8px; border-radius: 999px; {{ ($exp['award_result'] ?? '') === 'Won' ? 'background: rgba(22,163,74,0.1); color: #16a34a;' : 'background: rgba(234,179,8,0.1); color: #ca8a04;' }}">
                                                                        {{ $exp['award_result'] ?? '—' }}
                                                                    </span>
                                                                </td>
                                                                <td style="padding: 10px 12px; white-space: nowrap;">
                                                                    <button type="button" wire:click="editExperience({{ $exp['id'] }})"
                                                                        style="background: none; border: none; color: var(--gold); cursor: pointer; font-size: 0.75rem; margin-right: 8px;">Edit</button>
                                                                    <button type="button" wire:click="deleteExperience({{ $exp['id'] }})"
                                                                        onclick="return confirm('Delete this entry?')"
                                                                        style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 0.75rem;">Delete</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @elseif($type === 'jury')
                                            {{-- Jury List --}}
                                            @foreach($entries as $exp)
                                                <div
                                                    style="display: flex; justify-content: space-between; align-items: flex-start; padding: 10px 0; border-bottom: 1px solid var(--border);">
                                                    <div>
                                                        <span
                                                            style="font-weight: 600; color: var(--text-primary);">{{ $exp['title'] }}</span>
                                                        @if($exp['jury_festival'])
                                                            <span style="color: var(--text-muted); font-size: 0.85rem;"> ·
                                                                {{ $exp['jury_festival'] }}</span>
                                                        @endif
                                                        @if($exp['jury_location'])
                                                            <span style="color: var(--text-muted); font-size: 0.85rem;">,
                                                                {{ $exp['jury_location'] }}</span>
                                                        @endif
                                                        @if($exp['year'])
                                                            <span
                                                                style="color: var(--text-muted); font-size: 0.8rem; margin-left: 8px;">({{ $exp['year'] }})</span>
                                                        @endif
                                                    </div>
                                                    <div style="white-space: nowrap; margin-left: 16px;">
                                                        <button type="button" wire:click="editExperience({{ $exp['id'] }})"
                                                            style="background: none; border: none; color: var(--gold); cursor: pointer; font-size: 0.75rem; margin-right: 8px;">Edit</button>
                                                        <button type="button" wire:click="deleteExperience({{ $exp['id'] }})"
                                                            onclick="return confirm('Delete this entry?')"
                                                            style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 0.75rem;">Delete</button>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            {{-- Films / TV / Others Table --}}
                                            <div style="overflow-x: auto;">
                                                <table style="width: 100%; border-collapse: collapse; font-size: 0.85rem;">
                                                    <thead>
                                                        <tr style="border-bottom: 1px solid var(--border);">
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Year</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Title</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Role</th>
                                                            <th
                                                                style="text-align: left; padding: 8px 12px; color: var(--text-muted); font-size: 0.7rem; letter-spacing: 0.1em; text-transform: uppercase;">
                                                                Notes</th>
                                                            <th style="padding: 8px 12px;"></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($entries as $exp)
                                                            <tr style="border-bottom: 1px solid var(--border);">
                                                                <td style="padding: 10px 12px; color: var(--text-muted);">
                                                                    {{ $exp['year'] ?? '—' }}
                                                                </td>
                                                                <td
                                                                    style="padding: 10px 12px; color: var(--text-primary); font-weight: 500;">
                                                                    {{ $exp['title'] }}
                                                                </td>
                                                                <td style="padding: 10px 12px; color: var(--text-secondary);">
                                                                    {{ $exp['role'] ?? '—' }}
                                                                </td>
                                                                <td
                                                                    style="padding: 10px 12px; color: var(--text-muted); font-size: 0.8rem;">
                                                                    {{ $exp['notes'] ?? '' }}
                                                                </td>
                                                                <td style="padding: 10px 12px; white-space: nowrap;">
                                                                    <button type="button" wire:click="editExperience({{ $exp['id'] }})"
                                                                        style="background: none; border: none; color: var(--gold); cursor: pointer; font-size: 0.75rem; margin-right: 8px;">Edit</button>
                                                                    <button type="button" wire:click="deleteExperience({{ $exp['id'] }})"
                                                                        onclick="return confirm('Delete this entry?')"
                                                                        style="background: none; border: none; color: #dc2626; cursor: pointer; font-size: 0.75rem;">Delete</button>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @endif
                                    </div>
                                @endforeach
                            @endif
                            {{-- ═══════════════════════════════════════════════════════════
                            EXPERIENCE & CREDITS SECTION
                            Matches ArtistExperience::$typeLabels & ArtistAccount.php
                            ═══════════════════════════════════════════════════════════ --}}

                            {{-- Existing entries list --}}
                            @if(!empty($experiences))
                                <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 24px;">
                                    @foreach($experiences as $exp)
                                        @php
                                            $typeLabels = [
                                                'acting_screen' => 'Acting & Screen',
                                                'modeling_fashion' => 'Modeling & Fashion',
                                                'photography_media' => 'Photography & Media',
                                                'advertising_promotion' => 'Advertising & Promotion',
                                                'event_hosting' => 'Event & Hosting',
                                                'digital_content' => 'Digital Content Creation',
                                                'competitions_pageants' => 'Competitions & Pageants',
                                                'awards_achievements' => 'Awards & Achievements',
                                                'workshop_training' => 'Workshop & Training',
                                                'other' => 'Other',
                                                'custom' => $exp['custom_type_label'] ?? 'Custom',
                                            ];
                                            $typeLabel = $typeLabels[$exp['type']] ?? ucfirst($exp['type']);
                                        @endphp

                                        <div style="display: flex; align-items: flex-start; justify-content: space-between; gap: 16px;
                                                            padding: 14px 16px; border: 1px solid var(--border); background: var(--bg-surface);
                                                            border-radius: 4px; transition: border-color 0.2s;"
                                            onmouseover="this.style.borderColor='var(--border-strong)'"
                                            onmouseout="this.style.borderColor='var(--border)'">

                                            <div style="flex: 1; min-width: 0;">
                                                {{-- Row 1: Year badge + Title --}}
                                                <div
                                                    style="display: flex; align-items: center; gap: 10px; flex-wrap: wrap; margin-bottom: 4px;">
                                                    @if(!empty($exp['year']))
                                                        <span
                                                            style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.08em;
                                                                                color: var(--gold); background: color-mix(in srgb, var(--gold) 12%, transparent);
                                                                                padding: 2px 8px; border-radius: 2px; white-space: nowrap;">
                                                            {{ $exp['year'] }}
                                                        </span>
                                                    @endif
                                                    <span
                                                        style="font-size: 0.92rem; font-weight: 600; color: var(--text-primary);
                                                                        white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $exp['title'] }}
                                                    </span>
                                                </div>

                                                {{-- Row 2: Type tag + Role/Category --}}
                                                <div style="display: flex; align-items: center; gap: 8px; flex-wrap: wrap;">
                                                    <span
                                                        style="font-size: 0.7rem; font-weight: 600; letter-spacing: 0.06em;
                                                                        text-transform: uppercase; color: var(--text-muted);
                                                                        border: 1px solid var(--border); padding: 1px 7px; border-radius: 2px;">
                                                        {{ $typeLabel }}
                                                    </span>

                                                    @if(!empty($exp['role']))
                                                        <span style="font-size: 0.8rem; color: var(--text-secondary);">
                                                            · {{ $exp['role'] }}
                                                        </span>
                                                    @endif

                                                    @if(!empty($exp['award_category']))
                                                        <span style="font-size: 0.8rem; color: var(--text-secondary);">
                                                            · {{ $exp['award_category'] }}
                                                        </span>
                                                    @endif

                                                    @if(!empty($exp['award_result']))
                                                        <span
                                                            style="font-size: 0.7rem; font-weight: 700; letter-spacing: 0.05em;
                                                                                text-transform: uppercase;
                                                                                color: {{ $exp['award_result'] === 'Won' || $exp['award_result'] === 'Winner' ? 'var(--gold)' : 'var(--text-muted)' }};">
                                                            {{ $exp['award_result'] }}
                                                        </span>
                                                    @endif

                                                    @if(!empty($exp['production']))
                                                        <span style="font-size: 0.8rem; color: var(--text-muted);">
                                                            · {{ $exp['production'] }}
                                                        </span>
                                                    @endif

                                                    @if(!empty($exp['jury_location']))
                                                        <span style="font-size: 0.8rem; color: var(--text-muted);">
                                                            · {{ $exp['jury_location'] }}
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>

                                            {{-- Actions --}}
                                            <div style="display: flex; align-items: center; gap: 6px; flex-shrink: 0;">
                                                <button type="button" wire:click="editExperience({{ $exp['id'] }})" title="Edit"
                                                    style="display: flex; align-items: center; justify-content: center;
                                                                    width: 30px; height: 30px; border: 1px solid var(--border);
                                                                    background: var(--bg-primary); color: var(--text-muted);
                                                                    cursor: pointer; border-radius: 3px; transition: all 0.2s;"
                                                    onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
                                                    onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                                    </svg>
                                                </button>
                                                <button type="button" wire:click="deleteExperience({{ $exp['id'] }})"
                                                    wire:confirm="Delete this entry? This cannot be undone." title="Delete" style="display: flex; align-items: center; justify-content: center;
                                                                    width: 30px; height: 30px; border: 1px solid var(--border);
                                                                    background: var(--bg-primary); color: var(--text-muted);
                                                                    cursor: pointer; border-radius: 3px; transition: all 0.2s;"
                                                    onmouseover="this.style.borderColor='#ef4444';this.style.color='#ef4444'"
                                                    onmouseout="this.style.borderColor='var(--border)';this.style.color='var(--text-muted)'">
                                                    <svg width="13" height="13" viewBox="0 0 24 24" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <polyline points="3 6 5 6 21 6" />
                                                        <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                        <path d="M10 11v6M14 11v6" />
                                                        <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 20px;">
                                    No credits added yet. Add your films, TV shows, awards, and other experience below.
                                </p>
                            @endif

                            {{-- ── Toggle Button ── --}}
                            <button type="button" wire:click="$toggle('showExpForm')" style="display: flex; align-items: center; gap: 8px; padding: 10px 20px;
                                        border: 1px dashed var(--border-strong); background: var(--bg-primary);
                                        color: var(--text-secondary); font-family: 'Jost', sans-serif;
                                        font-size: 0.8rem; font-weight: 600; letter-spacing: 0.1em;
                                        text-transform: uppercase; cursor: pointer; margin-bottom: 20px;
                                        transition: border-color 0.2s, color 0.2s;"
                                onmouseover="this.style.borderColor='var(--gold)';this.style.color='var(--gold)'"
                                onmouseout="this.style.borderColor='var(--border-strong)';this.style.color='var(--text-secondary)'">
                                @if($showExpForm)
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    {{ $editingExpId ? 'Cancel Edit' : 'Cancel' }}
                                @else
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <line x1="12" y1="5" x2="12" y2="19" />
                                        <line x1="5" y1="12" x2="19" y2="12" />
                                    </svg>
                                    {{ $editingExpId ? 'Edit Entry' : 'Add Credit / Experience' }}
                                @endif
                            </button>

                            {{-- ── Add / Edit Form ── --}}
                            @if($showExpForm)
                                <div style="background: var(--bg-primary); border: 1px solid var(--border);
                                                padding: 24px; border-radius: 4px; margin-bottom: 20px;">

                                    <div class="form-grid-2" style="margin-bottom: 16px;">

                                        {{-- ── Type ── --}}
                                        <div class="form-field">
                                            <label class="form-field-label">Type <span class="required">*</span></label>
                                            <div class="form-select-wrap">
                                                <select class="form-select" wire:model.live="newExpType">
                                                    <option value="acting_screen">Acting & Screen</option>
                                                    <option value="modeling_fashion">Modeling & Fashion</option>
                                                    <option value="photography_media">Photography & Media</option>
                                                    <option value="advertising_promotion">Advertising & Promotion</option>
                                                    <option value="event_hosting">Event & Hosting</option>
                                                    <option value="digital_content">Digital Content Creation</option>
                                                    <option value="competitions_pageants">Competitions & Pageants</option>
                                                    <option value="awards_achievements">Awards & Achievements</option>
                                                    <option value="workshop_training">Workshop & Training</option>
                                                    <option value="other">Other</option>
                                                    <option value="custom">Custom (specify below)</option>
                                                </select>
                                            </div>
                                            @error('newExpType') <span class="form-error">{{ $message }}</span> @enderror
                                        </div>

                                        {{-- ── Year ── --}}
                                        <div class="form-field">
                                            <label class="form-field-label">Year</label>
                                            <input type="text" class="form-input" wire:model.defer="newExpYear"
                                                placeholder="e.g. 2021 or 2021–2023">
                                            @error('newExpYear') <span class="form-error">{{ $message }}</span> @enderror
                                        </div>

                                        {{-- ── Custom Type Label ── --}}
                                        @if($newExpType === 'custom')
                                            <div class="form-field form-grid-full">
                                                <label class="form-field-label">
                                                    Custom Type Label <span class="required">*</span>
                                                </label>
                                                <input type="text" class="form-input" wire:model.defer="newExpCustomType"
                                                    placeholder="e.g. Podcast, Voice Over, Brand Ambassador">
                                                @error('newExpCustomType') <span class="form-error">{{ $message }}</span> @enderror
                                            </div>
                                        @endif

                                        {{-- ── Title ── --}}
                                        <div class="form-field form-grid-full">
                                            <label class="form-field-label">
                                                @if($newExpType === 'awards_achievements') Award Name
                                                @elseif($newExpType === 'workshop_training') Workshop / Course Name
                                                @elseif($newExpType === 'competitions_pageants') Competition / Pageant Name
                                                @else Title / Name
                                                @endif
                                                <span class="required">*</span>
                                            </label>
                                            <input type="text" class="form-input" wire:model.defer="newExpTitle" placeholder="@if($newExpType === 'awards_achievements') e.g. National Film Award
                                            @elseif($newExpType === 'workshop_training') e.g. Advanced Acting Masterclass
                                                                    @elseif($newExpType === 'competitions_pageants') e.g. Lux Channel i Superstar
                                                                    @elseif($newExpType === 'event_hosting') e.g. Dhaka Fashion Week 2024
                                                                    @else e.g. Rehana Maryam Noor
                                                                    @endif">
                                            @error('newExpTitle') <span class="form-error">{{ $message }}</span> @enderror
                                        </div>

                                        {{-- ══════════════════════════════════════
                                        ACTING & SCREEN
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'acting_screen')
                                            <div class="form-field">
                                                <label class="form-field-label">Role / Character</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Lead Actor, Rehana">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Director</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpDirector"
                                                    placeholder="e.g. Abdullah Mohammad Saad">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Production House / Channel</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. Fable Pictures, Chorki">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Platform / Medium</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpPlatform"
                                                    placeholder="e.g. Cinema, Netflix, BTV">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Language</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpLanguage"
                                                    placeholder="e.g. Bangla, English">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. Debut Film, Main Lead">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        MODELING & FASHION
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'modeling_fashion')
                                            <div class="form-field">
                                                <label class="form-field-label">Role / Position</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Showstopper, Runway Model">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Brand / Agency / Designer</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. Aarong, Bibi Russell">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. Season Finale, Campaign Face">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        PHOTOGRAPHY & MEDIA
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'photography_media')
                                            <div class="form-field">
                                                <label class="form-field-label">Role</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Cover Model, Editorial Subject">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Photographer / Publication</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpDirector"
                                                    placeholder="e.g. Vogue India, Sagor Islam">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Production / Agency</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. Xposure Media">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. Magazine Cover, Lookbook">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        ADVERTISING & PROMOTION
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'advertising_promotion')
                                            <div class="form-field">
                                                <label class="form-field-label">Role</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Brand Ambassador, TVC Lead">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Director / Agency</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpDirector"
                                                    placeholder="e.g. Grey Dhaka, Asiatic JWT">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Brand / Client</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. Grameenphone, Pran">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Platform / Medium</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpPlatform"
                                                    placeholder="e.g. TV, Digital, OOH">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. National Campaign, Eid TVC">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        EVENT & HOSTING
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'event_hosting')
                                            <div class="form-field">
                                                <label class="form-field-label">Role / Position</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Host, Emcee, Anchor">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Organizer / Brand</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. Channel i, RTV">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Location</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpJuryLocation"
                                                    placeholder="e.g. Bashundhara Convention City, Dhaka">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. 5000+ audience, Live broadcast">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        DIGITAL CONTENT CREATION
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'digital_content')
                                            <div class="form-field">
                                                <label class="form-field-label">Role</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Host, Creator, Presenter">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Director / Collaborator</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpDirector"
                                                    placeholder="e.g. Banglalink Digital, Facto">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Channel / Brand</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpProduction"
                                                    placeholder="e.g. YouTube Channel Name, TikTok Brand">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Platform</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpPlatform"
                                                    placeholder="e.g. YouTube, TikTok, Facebook">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Language</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpLanguage"
                                                    placeholder="e.g. Bangla, English">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="e.g. 1M views, Viral Series">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        COMPETITIONS & PAGEANTS
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'competitions_pageants')
                                            <div class="form-field">
                                                <label class="form-field-label">Competition Category</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardCategory"
                                                    placeholder="e.g. Top Model, Best Talent">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Result / Placement</label>
                                                <div class="form-select-wrap">
                                                    <select class="form-select" wire:model.defer="newExpAwardResult">
                                                        <option value="">— Select —</option>
                                                        <option value="Winner">Winner</option>
                                                        <option value="Runner-up">Runner-up</option>
                                                        <option value="Participant">Participant</option>
                                                        <option value="Nominated">Nominated</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Organizer / Institution</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardOrganizer"
                                                    placeholder="e.g. Channel i, Star Jalsha">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Location</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpJuryLocation"
                                                    placeholder="e.g. Dhaka, Bangladesh">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        AWARDS & ACHIEVEMENTS
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'awards_achievements')
                                            <div class="form-field">
                                                <label class="form-field-label">Award Category</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardCategory"
                                                    placeholder="e.g. Best Actress, Best New Face">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">For the Work / Project</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardWork"
                                                    placeholder="e.g. Rehana Maryam Noor">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Result</label>
                                                <div class="form-select-wrap">
                                                    <select class="form-select" wire:model.defer="newExpAwardResult">
                                                        <option value="">— Select —</option>
                                                        <option value="Won">Won</option>
                                                        <option value="Nominated">Nominated</option>
                                                        <option value="Winner">Winner</option>
                                                        <option value="Runner-up">Runner-up</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Organizer / Institution</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardOrganizer"
                                                    placeholder="e.g. Bangladesh National Film Awards">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        WORKSHOP & TRAINING
                                        ══════════════════════════════════════ --}}
                                        @if($newExpType === 'workshop_training')
                                            <div class="form-field">
                                                <label class="form-field-label">Organizer / Institution</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpAwardOrganizer"
                                                    placeholder="e.g. Method Acting School, Nuhash Pictures">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Location</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpJuryLocation"
                                                    placeholder="e.g. Dhaka, Bangladesh">
                                            </div>
                                        @endif

                                        {{-- ══════════════════════════════════════
                                        OTHER / CUSTOM
                                        ══════════════════════════════════════ --}}
                                        @if(in_array($newExpType, ['other', 'custom']))
                                            <div class="form-field">
                                                <label class="form-field-label">Role / Position</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpRole"
                                                    placeholder="e.g. Host, Performer">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Notes</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpNotes"
                                                    placeholder="Any relevant detail">
                                            </div>
                                            <div class="form-field">
                                                <label class="form-field-label">Language</label>
                                                <input type="text" class="form-input" wire:model.defer="newExpLanguage"
                                                    placeholder="e.g. Bangla, English">
                                            </div>
                                        @endif

                                        {{-- ── Description (always shown) ── --}}
                                        <div class="form-field form-grid-full">
                                            <label class="form-field-label">Description</label>
                                            <textarea class="form-input" wire:model.defer="newExpDescription" rows="3"
                                                placeholder="Any additional details about this entry..."
                                                style="resize: vertical;"></textarea>
                                            @error('newExpDescription') <span class="form-error">{{ $message }}</span> @enderror
                                        </div>

                                    </div>{{-- end form-grid-2 --}}

                                    {{-- ── Form Actions ── --}}
                                    <div style="display: flex; gap: 12px; justify-content: flex-end;">
                                        <button type="button" wire:click="resetExpForm" style="padding: 10px 20px; border: 1px solid var(--border-strong);
                                                        background: var(--bg-surface); color: var(--text-secondary);
                                                        font-family: 'Jost', sans-serif; font-size: 0.8rem;
                                                        cursor: pointer; border-radius: 3px; transition: all 0.2s;"
                                            onmouseover="this.style.background='var(--bg-primary)'"
                                            onmouseout="this.style.background='var(--bg-surface)'">
                                            Cancel
                                        </button>
                                        <button type="button" wire:click="saveExperience" class="btn-fill"
                                            style="font-size: 0.85rem; padding: 10px 24px;">
                                            <span wire:loading.remove wire:target="saveExperience">
                                                {{ $editingExpId ? 'Update Entry' : 'Save Entry' }}
                                            </span>
                                            <span wire:loading wire:target="saveExperience">Saving...</span>
                                        </button>
                                    </div>

                                </div>
                            @endif

                        </div>
                    </div>
                </div>

                {{-- ── Sticky submit bar ── --}}
                <div class="form-submit-bar">

                    {{-- Left Side: View Profile Icon --}}
                    <div>
                        <a href="{{ route('artist.show', auth()->id()) }}" target="_blank"
                            class="btn-outline btn-mobile-icon"
                            style="padding: 10px 16px; font-size: 0.85rem; display: flex; align-items: center; gap: 8px; border-color: var(--border-strong);"
                            title="View Public Profile">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="flex-shrink: 0;">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                <circle cx="12" cy="12" r="3"></circle>
                            </svg>
                            <span class="hide-on-mobile">View Profile</span>
                        </a>
                    </div>

                    {{-- Right Side: Navigation & Universal Save --}}
                    <div class="submit-actions" style="display: flex; gap: 10px; width: 100%; justify-content: flex-end;">

                        {{-- Previous --}}
                        <button type="button" class="btn-outline btn-mobile-icon" x-show="activeTab > 1"
                            @click="activeTab--; window.scrollTo({top: 0, behavior: 'smooth'})"
                            style="min-width: 100px; justify-content: center; gap: 6px;" title="Previous Step">
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="flex-shrink: 0;">
                                <line x1="19" y1="12" x2="5" y2="12"></line>
                                <polyline points="12 19 5 12 12 5"></polyline>
                            </svg>
                            <span class="hide-on-mobile">Previous</span>
                        </button>

                        {{-- Next --}}
                        <button type="button" class="btn-outline btn-mobile-icon" x-show="activeTab < 4"
                            @click="activeTab++; window.scrollTo({top: 0, behavior: 'smooth'})"
                            style="min-width: 100px; justify-content: center; background: var(--bg-secondary); gap: 6px;"
                            title="Next Step">
                            <span class="hide-on-mobile">Next Step</span>
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2" style="flex-shrink: 0;">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>

                        {{-- Universal Save Button --}}
                        <button type="submit" class="btn-fill btn-mobile-save" wire:loading.attr="disabled"
                            style="min-width: 180px; justify-content: center; display: flex; align-items: center; gap: 6px;">
                            <svg class="hide-on-mobile" width="15" height="15" viewBox="0 0 24 24" fill="none"
                                stroke="currentColor" stroke-width="2" style="flex-shrink: 0;">
                                <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                <polyline points="7 3 7 8 15 8"></polyline>
                            </svg>
                            <span wire:loading.remove>
                                <span x-text="activeTab === 4 ? 'Save & Publish' : 'Save'"></span>
                            </span>
                            <span wire:loading>Saving...</span>
                        </button>
                    </div>
                </div>

            </form>
        @endif
    </div>

</div>