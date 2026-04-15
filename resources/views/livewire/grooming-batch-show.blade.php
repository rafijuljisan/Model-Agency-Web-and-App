<div>
    <style>
        .course-hero {
            background: var(--bg-secondary);
            padding: 60px 40px;
            border-bottom: 1px solid var(--border);
        }

        .course-title {
            font-family: 'SolaimanLipi', 'Jost', sans-serif;
            font-size: 2.8rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 16px;
        }

        .course-layout {
            max-width: 1440px;
            margin: 0 auto;
            padding: 56px 40px 80px;
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 48px;
            align-items: start;
        }

        /* Main Content */
        .course-section-title {
            font-family: 'SolaimanLipi', 'Jost', sans-serif;
            font-size: 1.8rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 24px;
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        .course-text {
            font-size: 1.1rem;
            color: var(--text-secondary);
            line-height: 1.7;
            margin-bottom: 48px;
        }

        /* Dynamic Benefits Grid */
        .course-benefits-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-bottom: 48px;
        }

        .c-benefit-card {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 24px;
            border-radius: 6px;
        }

        .c-benefit-title {
            font-family: 'SolaimanLipi', 'Jost', sans-serif;
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .c-benefit-title svg {
            color: var(--gold);
        }

        /* Dynamic Modules List */
        .course-module {
            background: var(--bg-surface);
            border: 1px solid var(--border);
            padding: 24px;
            margin-bottom: 16px;
            border-radius: 6px;
        }

        .c-module-name {
            font-family: 'Jost', sans-serif;
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 8px;
        }

        /* Sticky Sidebar */
        .course-sidebar {
            background: var(--bg-surface);
            border: 1px solid var(--border-strong);
            padding: 32px;
            position: sticky;
            top: 24px;
            border-radius: 8px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.05);
        }

        .sidebar-price {
            font-family: 'Jost', sans-serif;
            font-size: 2.4rem;
            font-weight: 700;
            color: var(--gold);
            margin-bottom: 24px;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--border);
        }

        .sidebar-meta {
            display: flex;
            flex-direction: column;
            gap: 16px;
            margin-bottom: 32px;
        }

        .sidebar-meta-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .sidebar-meta-item svg {
            color: var(--text-muted);
            margin-top: 3px;
        }

        .s-meta-label {
            font-size: 0.8rem;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-muted);
            font-weight: 600;
            margin-bottom: 2px;
        }

        .s-meta-value {
            font-size: 1rem;
            color: var(--text-primary);
            font-weight: 500;
        }

        @media(max-width: 992px) {
            .course-layout {
                grid-template-columns: 1fr;
            }

            .course-benefits-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>

    <div class="course-hero">
        <div style="max-width: 1440px; margin: 0 auto;">
            <a href="/grooming-lab"
                style="color: var(--gold); font-size: 0.9rem; text-decoration: none; font-weight: 600; display: inline-flex; align-items: center; gap: 6px; margin-bottom: 16px;">
                &larr; Back to All Courses
            </a>
            <h1 class="course-title">{{ $batch->title }}</h1>
            <div style="display: flex; gap: 16px; align-items: center;">
                <span
                    style="padding: 4px 12px; background: var(--gold-bg); color: var(--gold); font-weight: 600; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.1em;">
                    {{ $batch->status === 'open' ? 'Open for Admission' : ($batch->status === 'filling_fast' ? 'Filling Fast' : 'Admission Closed') }}
                </span>
            </div>
        </div>
    </div>

    <div class="course-layout">
        {{-- LEFT: MAIN CONTENT --}}
        <div>
            {{-- AD SLOT 1: Batch Content Top --}}
            <div style="margin-bottom: 32px;">
                <x-ad-banner position="batch_show_top" />
            </div>
            @if($batch->description)
                <h2 class="course-section-title">Course Overview</h2>
                <div class="course-text">
                    {!! $batch->description !!}
                </div>
            @endif

            @if(!empty($batch->benefits))
                <h2 class="course-section-title">What You Will Learn in This Class?</h2>
                <div class="course-benefits-grid">
                    @foreach($batch->benefits as $benefit)
                        <div class="c-benefit-card">
                            <div class="c-benefit-title">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                                    <polyline points="22 4 12 14.01 9 11.01" />
                                </svg>
                                {{ $benefit['title'] }}
                            </div>
                            <div style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.6;">
                                {{ $benefit['description'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            {{-- AD SLOT 2: Batch Content Middle --}}
            <div style="margin-bottom: 32px;">
                <x-ad-banner position="batch_show_middle" />
            </div>
            @if(!empty($batch->course_modules))
                <h2 class="course-section-title">Course Modules</h2>
                <div>
                    @foreach($batch->course_modules as $module)
                        <div class="course-module">
                            <div class="c-module-name">{{ $module['module_name'] }}</div>
                            <div style="color: var(--text-primary); font-size: 1.05rem; line-height: 1.6;">
                                {{ $module['topics'] }}
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
            
        </div>

        {{-- RIGHT: STICKY SIDEBAR --}}
        <div class="course-sidebar">
            <div class="sidebar-price">৳{{ number_format($batch->fee) }}</div>

            <div class="sidebar-meta">
                <div class="sidebar-meta-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <div>
                        <div class="s-meta-label">Start Date</div>
                        <div class="s-meta-value">{{ $batch->start_date->format('d F, Y') }}</div>
                    </div>
                </div>

                @if(!empty($batch->schedule_json))
                    <div class="sidebar-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10" />
                            <path d="M12 6v6l4 2" />
                        </svg>
                        <div>
                            <div class="s-meta-label">Class Schedule</div>
                            <div style="display: flex; flex-direction: column; gap: 6px; margin-top: 4px;">
                                @foreach($batch->schedule_json as $s)
                                    <div class="s-meta-value" style="display: flex; justify-content: space-between; gap: 16px;">
                                        <span>{{ $s['day'] ?? '' }}</span>
                                        <span style="color: var(--gold); font-weight: 600;">{{ $s['time'] ?? '' }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif
                @if($batch->trainer)
                    <div class="sidebar-meta-item">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                        <div>
                            <div class="s-meta-label">Lead Trainer</div>
                            <div class="s-meta-value">{{ $batch->trainer }}</div>
                        </div>
                    </div>
                @endif

                <div class="sidebar-meta-item">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    <div style="width: 100%;">
                        <div class="s-meta-label" style="display:flex; justify-content:space-between;">
                            <span>Seats</span>
                            <span>{{ $batch->filled_seats }}/{{ $batch->seat_limit }}</span>
                        </div>
                        <div
                            style="height: 4px; background: var(--border); border-radius: 4px; overflow: hidden; margin-top: 6px;">
                            <div
                                style="height: 100%; background: var(--gold); width: {{ $batch->fill_percentage ?? ($batch->filled_seats / $batch->seat_limit * 100) }}%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <a href="/grooming-lab" class="btn-fill"
                style="width: 100%; justify-content: center; padding: 16px; font-size: 1.1rem; font-family: 'SolaimanLipi', sans-serif;">
                Apply Now
            </a>
            {{-- AD SLOT 3: Sticky Sidebar (Rectangle Ad) --}}
            <div style="margin-top: 24px;">
                <x-ad-banner position="batch_show_sidebar" />
            </div>
        </div>
    </div>
</div>