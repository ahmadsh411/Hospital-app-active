<div class="main-content-body main-content-body-chat">
    @if($conversation)
        <!-- عنوان المحادثة -->
        <div class="main-chat-header border-bottom pb-2 mb-3 d-flex justify-content-between">
            <h6 class="font-weight-bold">
                {{ __('messages.conversation_with') }}:
                {{ $conversation->sender_email === auth('doctor')->user()->email
                    ? \App\Models\Conversations\Conversation::getUserNameByEmail($conversation->resiver_email)
                    : \App\Models\Conversations\Conversation::getUserNameByEmail($conversation->sender_email) }}
            </h6>
            <small class="text-muted">{{ $conversation->created_at->format('Y-m-d') }}</small>
        </div>

        <!-- منطقة الرسائل -->
        <div class="main-chat-body" id="ChatBody" style="max-height: 400px; overflow-y: auto;" wire:poll.1s="loadMessages">
            <div class="content-inner">
                @foreach($messages as $message)
                    <div class="d-flex mb-3 {{ $message->sender_email === auth('doctor')->user()->email ? 'justify-content-end' : 'justify-content-start' }}">
                        <!-- تصميم الرسالة حسب المرسل -->
                        <div class="message-item p-3 rounded-lg shadow-sm"
                             style="max-width: 70%; background-color: {{ $message->sender_email === auth('doctor')->user()->email ? '#d1e7dd' : '#f8f9fa' }};">
                            <p class="mb-1 font-weight-bold text-dark" style="font-size: 0.9rem;">
                                {{ $message->sender_email === auth('doctor')->user()->email ? __('messages.you') : '' }}
                            </p>
                            <p class="mb-0 text-dark" style="font-size: 0.85rem; line-height: 1.4;">
                                {{ $message->body }}
                            </p>
                            <small class="text-muted d-block mt-1" style="font-size: 0.75rem;">
                                {{ $message->created_at->diffForHumans() }}
                            </small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- إدخال الرسالة الجديدة وزر الإرسال -->
        <div class="main-chat-footer d-flex align-items-center mt-3">
            <input type="text" class="form-control mr-2" placeholder="{{ __('messages.type_your_message') }}"
                   wire:model.defer="messageContent"
                   wire:keydown.enter="send_messageDoctor('{{ $conversation->resiver_email == auth('doctor')->user()->email ? $conversation->sender_email : $conversation->resiver_email }}')">
            <button class="btn btn-primary"
                    wire:click="send_messageDoctor('{{ $conversation->resiver_email == auth('doctor')->user()->email ? $conversation->sender_email : $conversation->resiver_email }}')">
                <i class="far fa-paper-plane"></i>
            </button>
        </div>
    @else
        <div class="text-center p-5 text-muted">
            <p>{{ __('messages.select_conversation') }}</p>
        </div>
    @endif
</div>
