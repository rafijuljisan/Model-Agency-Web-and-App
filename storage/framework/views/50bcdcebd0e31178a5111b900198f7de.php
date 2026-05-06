<div>
<style>
/* ═══════════════════════════════════════════
   CONTACT PAGE SPECIFIC STYLES
   (Inherits your core form-page structure)
═══════════════════════════════════════════ */

.form-page {
    max-width: 1200px; /* Slightly wider for the map layout */
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
    font-size: 0.58rem;
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
    font-family: 'Jost', sans-serif;
    font-size: 2.8rem; /* Slightly larger for public page */
    font-weight: 300;
    color: var(--text-primary);
    line-height: 1.1;
}
.form-page-title strong { font-weight: 600; }
.form-page-sub {
    font-size: 0.95rem; /* Slightly larger for public page */
    color: var(--text-muted);
    margin-top: 10px;
    letter-spacing: 0.04em;
    max-width: 600px;
}

/* Section block (Matches your profile form) */
.form-section {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    margin-bottom: 24px;
    transition: background 0.4s, border-color 0.4s;
    display: flex;
    flex-direction: column;
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
    font-family: 'Jost', sans-serif;
    font-size: 1.15rem;
    font-weight: 600;
    color: var(--text-primary);
    letter-spacing: 0.02em;
}
.form-section-body {
    padding: 32px;
    flex-grow: 1; /* Allows sections to stretch evenly in grid */
}

/* Grid layout */
.form-grid-2 {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 24px;
}

/* Contact Info specific */
.contact-block { margin-bottom: 28px; }
.contact-block:last-child { margin-bottom: 0; }

.contact-label {
    display: flex;
    align-items: center;
    gap: 6px;
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--text-secondary);
    margin-bottom: 8px;
}
.contact-label svg {
    color: var(--gold);
}
.contact-text {
    font-size: 1rem;
    color: var(--text-primary);
    line-height: 1.6;
    font-weight: 400;
}
.contact-text a {
    color: var(--text-primary);
    transition: color 0.25s;
    text-decoration: none;
}
.contact-text a:hover {
    color: var(--gold);
}

/* Social Buttons */
.contact-socials { display: flex; gap: 10px; margin-top: 10px; }
.contact-social-btn {
    width: 38px; height: 38px;
    border: 1px solid var(--border-strong);
    background: var(--bg-primary);
    display: flex; align-items: center; justify-content: center;
    color: var(--text-muted);
    transition: all 0.3s ease;
}
.contact-social-btn:hover {
    border-color: var(--gold);
    color: var(--gold);
    background: var(--gold-bg);
}

/* Animations */
@keyframes fade-up {
    from { opacity: 0; transform: translateY(16px); }
    to   { opacity: 1; transform: translateY(0); }
}
.anim-fade-up { animation: fade-up 0.65s ease both; }
.anim-d1 { animation-delay: 0.08s; }
.anim-d2 { animation-delay: 0.18s; }

/* Dark mode map inversion trick */
[data-theme="dark"] .google-map-iframe {
    filter: contrast(0.85) opacity(0.85) invert(0.9) hue-rotate(180deg);
    transition: filter 0.4s ease;
}

/* Responsive */
@media (max-width: 900px) {
    .form-grid-2 { grid-template-columns: 1fr; }
}
@media (max-width: 768px) {
    .form-page { padding: 32px 20px 80px; }
    .form-section-body { padding: 24px 20px; }
    .form-section-header { padding: 16px 20px; }
}
</style>

<div class="form-page">

    
    <div class="form-page-header anim-fade-up">
        <div class="form-page-eyebrow">Contact Us</div>
        <h1 class="form-page-title">Get In <strong>Touch</strong></h1>
        <p class="form-page-sub">Whether you are a brand looking to hire talent or an artist looking for representation, we would love to hear from you.</p>
    </div>

    
    <div class="form-grid-2">

        
        <div class="form-section anim-fade-up anim-d1">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <path d="M22 16.92v3a2 2 0 01-2.18 2 19.79 19.79 0 01-8.63-3.07A19.5 19.5 0 013.07 9.81 19.79 19.79 0 01.05 2.18 2 2 0 012 0h3a2 2 0 012 1.72c.127.96.361 1.903.7 2.81a2 2 0 01-.45 2.11L6.09 7.91a16 16 0 006 6l1.27-1.27a2 2 0 012.11-.45c.907.339 1.85.573 2.81.7A2 2 0 0122 14.92z"/>
                    </svg>
                </div>
                <div class="form-section-title">Contact Details</div>
            </div>
            <div class="form-section-body">
                
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->contact_address): ?>
                    <div class="contact-block">
                        <div class="contact-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Visit Us
                        </div>
                        <div class="contact-text whitespace-pre-line"><?php echo e($settings->contact_address); ?></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="contact-block">
                    <div class="contact-label">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                        Direct Contact
                    </div>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->contact_email): ?>
                        <div class="contact-text mb-1"><a href="mailto:<?php echo e($settings->contact_email); ?>"><?php echo e($settings->contact_email); ?></a></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->contact_phone): ?>
                        <div class="contact-text"><a href="tel:<?php echo e($settings->contact_phone); ?>"><?php echo e($settings->contact_phone); ?></a></div>
                    <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>

                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->business_hours): ?>
                    <div class="contact-block">
                        <div class="contact-label">
                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            Business Hours
                        </div>
                        <div class="contact-text"><?php echo e($settings->business_hours); ?></div>
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                <div class="contact-block mt-8">
                    <div class="contact-label">Follow Us</div>
                    <div class="contact-socials">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->facebook_url): ?>
                            <a href="<?php echo e($settings->facebook_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-social-btn" aria-label="Facebook">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"/></svg>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->instagram_url): ?>
                            <a href="<?php echo e($settings->instagram_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-social-btn" aria-label="Instagram">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="2" width="20" height="20" rx="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->youtube_url): ?>
                            <a href="<?php echo e($settings->youtube_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-social-btn" aria-label="YouTube">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M22.54 6.42a2.78 2.78 0 00-1.95-1.96C18.88 4 12 4 12 4s-6.88 0-8.59.46A2.78 2.78 0 001.46 6.42 29 29 0 001 12a29 29 0 00.46 5.58 2.78 2.78 0 001.95 1.96C5.12 20 12 20 12 20s6.88 0 8.59-.46a2.78 2.78 0 001.95-1.96A29 29 0 0023 12a29 29 0 00-.46-5.58z"/><polygon points="9.75 15.02 15.5 12 9.75 8.98 9.75 15.02" fill="var(--bg-surface)"/></svg>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->linkedin_url): ?>
                            <a href="<?php echo e($settings->linkedin_url); ?>" target="_blank" rel="noopener noreferrer" class="contact-social-btn" aria-label="LinkedIn">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor"><path d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2zM4 6a2 2 0 100-4 2 2 0 000 4z"/></svg>
                            </a>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
                </div>

            </div>
        </div>

        
        <div class="form-section anim-fade-up anim-d2">
            <div class="form-section-header">
                <div class="form-section-icon">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7">
                        <polygon points="3 6 9 3 15 6 21 3 21 18 15 21 9 18 3 21"/><line x1="9" y1="3" x2="9" y2="21"/><line x1="15" y1="3" x2="15" y2="21"/>
                    </svg>
                </div>
                <div class="form-section-title">Office Location</div>
            </div>
            
            
            <div class="form-section-body" style="padding: 0; position: relative; min-height: 400px;">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($settings->google_map_embed_url): ?>
                    <iframe 
                        src="<?php echo e($settings->google_map_embed_url); ?>" 
                        class="absolute inset-0 w-full h-full google-map-iframe"
                        style="border:0;" 
                        allowfullscreen="" 
                        loading="lazy" 
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                <?php else: ?>
                    <div class="absolute inset-0 flex items-center justify-center" style="color: var(--text-muted); font-size: 0.85rem;">
                        Map location not configured.
                    </div>
                <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>

    </div>

</div>
</div><?php /**PATH /home/dhakamodel/dhakamodel/resources/views/livewire/contact-page.blade.php ENDPATH**/ ?>