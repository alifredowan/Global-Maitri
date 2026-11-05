@extends('layouts.app')

@section('title', 'Conversation - Global Maitri')

@section('content')
<div class="py-6 bg-[var(--bg-canvas)] min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 space-y-4">

        <!-- Top Navigation & Details -->
        <div class="card-ledger bg-[var(--bg-surface)] p-4 border border-[var(--border-default)] flex items-center justify-between">
            <div class="flex items-center gap-3">
                <a href="{{ route('chat.index') }}" class="text-xs font-bold text-[var(--text-secondary)] hover:text-[var(--accent-primary)] inline-flex items-center gap-1">
                    <svg class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m15 18-6-6 6-6"/></svg>
                    <span>Inbox</span>
                </a>
                <div class="h-4 w-px bg-[var(--border-default)]"></div>
                <div>
                    <h2 class="font-bold text-sm text-[var(--text-primary)] flex items-center gap-2 flex-wrap">
                        @if($waliObserver && Auth::id() === $waliObserver->id)
                            {{ $conversation->participants->where('pivot.role', 'seeker')->pluck('name')->join(' & ') }}
                            <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">Observing as Family Rep</span>
                        @else
                            {{ $otherUser?->name ?? 'Candidate' }}
                            @if($otherUser?->is_verified)
                                <span class="badge-verified text-[10px]">✓</span>
                            @endif
                            @if($waliObserver)
                                <span class="badge-status text-[10px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">
                                    Family Rep: {{ $waliObserver->name }}
                                </span>
                            @endif
                        @endif
                    </h2>
                    <p class="text-[11px] text-[var(--text-muted)]">Mindful Matrimonial Communication</p>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex items-center gap-2">
                @if($marriage)
                    <a href="{{ route('marriages.celebration') }}" class="btn-secondary text-xs !py-1.5 !px-3 text-[var(--accent-primary)]">
                        @if($marriage->isConfirmed())
                            <span>Mangala Vivaha ↗</span>
                        @else
                            <span>Vivaha Pending ↗</span>
                        @endif
                    </a>
                @elseif($otherUser && !Auth::user()->isMarried() && !$otherUser->isMarried() && $conversation->status !== 'locked' && (!$waliObserver || Auth::id() !== $waliObserver->id))
                    <button type="button" onclick="document.getElementById('declareVivahaModal').classList.remove('hidden')" class="btn-primary text-xs !py-1.5 !px-3">
                        <span>Mangala Vivaha Milestone</span>
                    </button>
                @endif

                <!-- Report User Button -->
                <button type="button" onclick="document.getElementById('reportChatModal').classList.remove('hidden')" class="text-xs font-semibold text-[var(--color-danger)] hover:underline cursor-pointer">
                    Report
                </button>
            </div>
        </div>

        <!-- Chaperone Banner (FR-4.3, 6.2) -->
        @if($waliObserver)
            <div class="card-ledger bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 p-3.5 flex items-center gap-3">
                <div class="w-8 h-8 rounded-[var(--radius-sm)] bg-[var(--accent-primary)] text-white flex items-center justify-center text-sm shrink-0">
                    <svg class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                </div>
                <div class="text-xs text-[var(--text-primary)]">
                    <strong class="font-bold block">Family Representative Observer Active</strong>
                    <span class="text-[var(--text-secondary)]">{{ $waliObserver->name }} is present as a family representative to offer mindful guidance and respectful communication support (FR-4.3).</span>
                </div>
            </div>
        @endif

        <!-- Message Scanning Reminder Notice (FR-4.4, 7.4) -->
        <div class="card-ledger bg-[var(--bg-subtle)] border border-[var(--border-default)] px-4 py-2.5 text-[11px] text-[var(--text-secondary)] flex items-center gap-2">
            <svg class="w-4 h-4 text-[var(--accent-primary)] shrink-0" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3Z"/><line x1="12" x2="12" y1="9" y2="13"/><line x1="12" x2="12.01" y1="17" y2="17"/></svg>
            <span><strong>Safety &amp; Anti-Dowry Scanner Active:</strong> Sharing phone numbers or personal handles is restricted until verified. Zero tolerance for dowry or financial demands (FR-7.4).</span>
        </div>

        <!-- Message Thread Box -->
        <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] p-5 min-h-[420px] flex flex-col justify-between">
            <div id="chat-messages-container" class="space-y-4 mb-4 overflow-y-auto max-h-[500px] pr-2 scroll-smooth">
                @forelse($conversation->messages as $msg)
                    @php
                        $isMe = $msg->sender_id === Auth::id();
                        $isWali = $msg->sender?->isWali() || ($waliObserver && $msg->sender_id === $waliObserver->id);
                    @endphp

                    <div class="flex flex-col {{ $isMe ? 'items-end' : 'items-start' }}" data-message-id="{{ $msg->id }}">
                        <div class="flex items-center gap-1 text-[11px] text-[var(--text-muted)] mb-1 px-1">
                            <span class="font-bold text-[var(--text-primary)]">{{ $msg->sender->name }}</span>
                            @if($isWali)
                                <span class="badge-status text-[9px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">Family Rep</span>
                            @endif
                            <span>&bull; {{ $msg->created_at->format('h:i A') }}</span>
                        </div>

                        <div class="max-w-md rounded-[var(--radius-md)] px-4 py-2.5 text-xs leading-relaxed {{ $isMe ? 'bg-[var(--accent-primary)] text-white rounded-br-none' : ($isWali ? 'bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 text-[var(--text-primary)] rounded-bl-none' : 'bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-primary)] rounded-bl-none') }}">
                            <p class="whitespace-pre-line">{{ $msg->body }}</p>
                        </div>

                        @if($msg->is_flagged)
                            <div class="text-[10px] text-[var(--color-warning)] font-semibold mt-1 flex items-center gap-1">
                                <span>Filtered:</span> {{ $msg->flag_reason }}
                            </div>
                        @endif
                    </div>
                @empty
                    <div id="chat-empty-state" class="py-12 text-center text-[var(--text-muted)] text-xs">
                        No messages yet. Send an opening greeting with loving-kindness (Metta)!
                    </div>
                @endforelse
            </div>

            @php
                $myPivot = $conversation->participants->firstWhere('id', Auth::id())?->pivot;
                $isViewOnlyWali = false;
                if ($myPivot && $myPivot->role === 'wali_chaperone') {
                    $isViewOnlyWali = \App\Models\WaliLink::where('wali_user_id', Auth::id())
                        ->whereIn('seeker_user_id', $conversation->participants->pluck('id'))
                        ->where('permission_level', 'view_only')
                        ->exists();
                }
            @endphp

            @if($conversation->status === 'locked')
                <div class="pt-4 border-t border-[var(--border-subtle)] text-center py-3 px-4 text-xs text-[var(--text-muted)] bg-[var(--bg-subtle)] rounded-[var(--radius-sm)] flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-[var(--text-muted)]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect width="18" height="11" x="3" y="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0 1 10 0v4"/></svg>
                    <span>This conversation is locked ({{ $conversation->locked_reason === 'candidate_married' ? 'Participant completed Mangala Vivaha milestone' : 'Archived' }}). Messages are read-only.</span>
                </div>
            @elseif($isViewOnlyWali)
                <div class="pt-4 border-t border-[var(--border-subtle)] text-center py-3 text-xs text-[var(--accent-primary)] bg-[var(--accent-subtle)] rounded-[var(--radius-sm)]">
                    You are observing this conversation with <strong>View Only</strong> representative permissions.
                </div>
            @else
                <!-- Send Message Input Form -->
                <form id="chat-send-form" action="{{ route('chat.send', $conversation->id) }}" method="POST" class="pt-3 border-t border-[var(--border-subtle)]">
                    @csrf
                    <div class="flex items-end gap-3">
                        <div class="flex-1">
                            <textarea id="chat-message-input" name="body" rows="2" required
                                      class="input-field text-xs w-full resize-none"
                                      placeholder="Type your message with mindfulness and Metta (Press Enter to send)..."></textarea>
                        </div>
                        <button type="submit" id="chat-submit-btn" class="btn-primary text-xs !py-2.5 !px-4 shrink-0 flex items-center gap-1.5">
                            <span>Send</span>
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                            </svg>
                        </button>
                    </div>
                </form>
            @endif
        </div>

    </div>
</div>

<!-- Report Modal -->
<div id="reportChatModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-md w-full p-6 shadow-2xl space-y-4">
        <h3 class="text-base font-bold text-[var(--text-primary)] font-heading">Report Conversation</h3>
        <form action="{{ route('reports.store') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="reported_id" value="{{ $otherUser?->id }}">
            <input type="hidden" name="conversation_id" value="{{ $conversation->id }}">
            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Reason</label>
                <select name="reason" required class="input-field text-xs w-full">
                    <option value="dowry_demand">Dowry demand / financial demand (Strict Zero Tolerance)</option>
                    <option value="inappropriate_language">Vulgar / disrespectful language</option>
                    <option value="unsolicited_contact_push">Pushing for external off-platform contact</option>
                    <option value="harassment">Harassment or coercion</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Details</label>
                <textarea name="details" rows="3" class="input-field text-xs w-full" placeholder="Explain the issue..."></textarea>
            </div>
            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('reportChatModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">Cancel</button>
                <button type="submit" class="btn-primary text-xs !py-1.5 !px-4 !bg-[var(--color-danger)] !text-white">Submit Report</button>
            </div>
        </form>
    </div>
</div>

@if($otherUser && !Auth::user()->isMarried() && !$otherUser->isMarried() && $conversation->status !== 'locked')
<!-- Declare Mangala Vivaha Modal -->
<div id="declareVivahaModal" class="hidden fixed inset-0 z-50 bg-black/60 backdrop-blur-xs flex items-center justify-center p-4">
    <div class="card-ledger bg-[var(--bg-surface)] border border-[var(--border-default)] max-w-lg w-full p-6 shadow-2xl space-y-4">
        <div class="flex items-start justify-between">
            <div>
                <span class="text-[10px] font-bold uppercase tracking-wider text-[var(--accent-primary)]">Auspicious Milestone</span>
                <h3 class="text-base font-bold text-[var(--text-primary)] font-heading mt-0.5">Declare Mangala Vivaha Milestone</h3>
                <p class="text-xs text-[var(--text-secondary)] mt-0.5">
                    Declare that you and {{ $otherUser->name }} have completed or scheduled your Mangala Vivaha (Wedding Milestone).
                </p>
            </div>
            <button type="button" onclick="document.getElementById('declareVivahaModal').classList.add('hidden')" class="text-[var(--text-muted)] hover:text-[var(--text-primary)] text-lg cursor-pointer leading-none">&times;</button>
        </div>

        <form action="{{ route('marriages.initiate') }}" method="POST" class="space-y-4">
            @csrf
            <input type="hidden" name="spouse_id" value="{{ $otherUser->id }}">

            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Marriage Date (dd/mm/yyyy)</label>
                <input type="text" name="marriage_date" value="{{ date('d/m/Y') }}" required
                       inputmode="numeric" placeholder="dd/mm/yyyy" maxlength="10"
                       pattern="\d{2}/\d{2}/\d{4}"
                       x-data
                       x-on:input="$el.value = $el.value.replace(/[^0-9]/g, '').replace(/^(\d{2})(\d)/, '$1/$2').replace(/^(\d{2})\/(\d{2})(\d)/, '$1/$2/$3').slice(0, 10)"
                       class="input-field text-xs w-full">
            </div>

            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Blessing Theme</label>
                <select name="blessing_theme" class="input-field text-xs w-full">
                    <option value="metta_blessing">Metta &amp; Loving-kindness Blessing</option>
                    <option value="traditional">Traditional Buddhist Ceremony</option>
                    <option value="simple">Simple Mindful Union</option>
                </select>
            </div>

            <div>
                <label class="flex items-center gap-2 text-xs text-[var(--text-secondary)] cursor-pointer select-none">
                    <input type="checkbox" name="monk_blessing_requested" value="1" class="rounded-[2px] text-[var(--accent-primary)] focus:ring-[var(--accent-primary)]">
                    <span>Request Sangha / Monk Blessing facilitation</span>
                </label>
            </div>

            <div>
                <label class="block text-xs font-bold text-[var(--text-primary)] mb-1">Personal Note / Details (Optional)</label>
                <textarea name="confirmation_notes" rows="3" placeholder="Share your wedding celebration date and words of loving-kindness..."
                          class="input-field text-xs w-full"></textarea>
            </div>

            <div class="p-3 rounded-[var(--radius-sm)] bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 text-[11px] text-[var(--text-secondary)]">
                Once submitted, a confirmation prompt will be sent to <strong>{{ $otherUser->name }}</strong>. Upon their confirmation, both accounts will be transitioned to Married and past inquiries closed with Metta.
            </div>

            <div class="flex items-center justify-end gap-2 pt-1">
                <button type="button" onclick="document.getElementById('declareVivahaModal').classList.add('hidden')" class="btn-secondary text-xs !py-1.5 !px-3.5">
                    Cancel
                </button>
                <button type="submit" class="btn-primary text-xs !py-2 !px-4">
                    Submit Vivaha Declaration
                </button>
            </div>
        </form>
    </div>
</div>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    const container = document.getElementById('chat-messages-container');
    const form = document.getElementById('chat-send-form');
    const input = document.getElementById('chat-message-input');
    const emptyState = document.getElementById('chat-empty-state');
    const currentUserId = {{ Auth::id() }};
    const conversationId = {{ $conversation->id }};
    const waliObserverId = {{ $waliObserver ? $waliObserver->id : 'null' }};

    // Track already rendered message IDs to guarantee zero duplicates
    const renderedMessageIds = new Set();
    document.querySelectorAll('[data-message-id]').forEach(el => {
        const id = parseInt(el.getAttribute('data-message-id'));
        if (id) renderedMessageIds.add(id);
    });

    function scrollToBottom() {
        if (container) {
            container.scrollTop = container.scrollHeight;
        }
    }
    scrollToBottom();

    function appendMessageBubble(message, isMe, isWali) {
        if (!message || !message.id || renderedMessageIds.has(message.id)) {
            return;
        }
        renderedMessageIds.add(message.id);

        if (emptyState) {
            emptyState.remove();
        }

        const msgDiv = document.createElement('div');
        msgDiv.className = 'flex flex-col ' + (isMe ? 'items-end' : 'items-start');
        msgDiv.setAttribute('data-message-id', message.id);

        const timeStr = message.created_at_human || (new Date()).toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
        const senderName = isMe ? 'You' : (message.sender_name || 'Participant');

        let waliBadge = '';
        if (isWali) {
            waliBadge = '<span class="badge-status text-[9px] bg-[var(--accent-subtle)] text-[var(--accent-primary)] border border-[var(--accent-primary)]/30">Family Rep</span>';
        }

        const headerHtml = '<div class="flex items-center gap-1 text-[11px] text-[var(--text-muted)] mb-1 px-1">' +
            '<span class="font-bold text-[var(--text-primary)]">' + senderName + '</span>' +
            waliBadge +
            '<span>&bull; ' + timeStr + '</span>' +
            '</div>';

        let bubbleClass = 'bg-[var(--bg-subtle)] border border-[var(--border-default)] text-[var(--text-primary)] rounded-bl-none';
        if (isMe) {
            bubbleClass = 'bg-[var(--accent-primary)] text-white rounded-br-none';
        } else if (isWali) {
            bubbleClass = 'bg-[var(--accent-subtle)] border border-[var(--accent-primary)]/30 text-[var(--text-primary)] rounded-bl-none';
        }

        const bubbleDiv = document.createElement('div');
        bubbleDiv.className = 'max-w-md rounded-[var(--radius-md)] px-4 py-2.5 text-xs leading-relaxed ' + bubbleClass;

        const p = document.createElement('p');
        p.className = 'whitespace-pre-line';
        p.textContent = message.body || '';
        bubbleDiv.appendChild(p);

        msgDiv.innerHTML = headerHtml;
        msgDiv.appendChild(bubbleDiv);

        if (message.is_flagged) {
            const flagNotice = document.createElement('div');
            flagNotice.className = 'text-[10px] text-[var(--color-warning)] font-semibold mt-1 flex items-center gap-1';
            flagNotice.innerHTML = '<span>Filtered:</span> ' + (message.flag_reason || 'Policy filter');
            msgDiv.appendChild(flagNotice);
        }

        container.appendChild(msgDiv);
        scrollToBottom();
    }

    // Ajax Form Submission
    if (form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            const text = input.value.trim();
            if (!text) return;

            const submitBtn = document.getElementById('chat-submit-btn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('opacity-60', 'cursor-not-allowed');
            }

            const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
            const headers = {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            };
            if (token) headers['X-CSRF-TOKEN'] = token;

            fetch(form.action, {
                method: 'POST',
                headers: headers,
                body: JSON.stringify({ body: text })
            })
            .then(res => {
                if (!res.ok) {
                    return res.json().then(errData => {
                        throw new Error(errData.error || errData.message || 'Server returned error ' + res.status);
                    });
                }
                return res.json();
            })
            .then(data => {
                if (data.success && data.message) {
                    input.value = '';
                    appendMessageBubble(data.message, true, false);
                } else if (data.error) {
                    alert(data.error);
                }
            })
            .catch(err => {
                console.error('Send message failed:', err);
                alert('Could not send message: ' + (err.message || 'Please check your connection and try again.'));
            })
            .finally(() => {
                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('opacity-60', 'cursor-not-allowed');
                }
                input.focus();
            });
        });

        // Submit on Enter without Shift
        input.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && !e.shiftKey) {
                e.preventDefault();
                form.dispatchEvent(new Event('submit', { cancelable: true }));
            }
        });
    }

    // Reverb WebSocket listener for live chat messages
    function setupConversationEcho() {
        if (!window.Echo) return;
        const handleIncoming = function(e) {
            if (!e) return;
            if (parseInt(e.sender_id) !== currentUserId) {
                const isWali = Boolean(e.is_wali) || (waliObserverId !== null && parseInt(e.sender_id) === waliObserverId);
                appendMessageBubble(e, false, isWali);
            }
        };

        window.Echo.private('conversation.' + conversationId)
            .listen('.MessageSentEvent', handleIncoming)
            .listen('MessageSentEvent', handleIncoming);
    }

    if (window.Echo) {
        setupConversationEcho();
    } else {
        window.addEventListener('echo:ready', setupConversationEcho);
        let echoTimer = setInterval(() => {
            if (window.Echo) {
                clearInterval(echoTimer);
                setupConversationEcho();
            }
        }, 200);
    }
});
</script>
@endsection
