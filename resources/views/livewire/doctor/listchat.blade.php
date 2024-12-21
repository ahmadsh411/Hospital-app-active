<div class="col-xl-4 col-lg-5">
    <style>
        /* خلفية رمادية لجميع العناصر داخل قائمة جهات الاتصال */
        #chatmodel .list-group-item {
            background-color: #f5f5f5; /* لون رمادي فاتح */
        }

        /* تمييز العنصر عند التمرير فوقه */
        #chatmodel .list-group-item:hover {
            background-color: #b1dfbb; /* لون رمادي أغمق قليلًا عند التمرير */
        }
    </style>

    <div class="card shadow-sm border-0">
        <div class="main-content-left main-content-left-chat">
            <!-- شريط التنقل للمحادثات -->
            <nav class="nav main-nav-line main-nav-line-chat border-bottom">
                <a class="nav-link active text-dark" href="#">{{ __('messages.recent_chats') }}</a>
            </nav>

            <!-- قائمة جهات الاتصال -->
            <div class="main-chat-contacts-wrapper p-3">
                <!-- قائمة جهات الاتصال بميزة التمرير -->
                <ul class="list-group" id="chatmodel" style="max-height: 400px; overflow-y: auto;" wire:poll.1s="loadconversation">
                    @foreach($conversations as $conversation)
                        @php
                            $currentEmail = auth('doctor')->user()->email;
                            $contactEmail = $conversation->sender_email == $currentEmail
                                ? $conversation->resiver_email
                                : $conversation->sender_email;
                        @endphp

                            <!-- عنصر قائمة جهة الاتصال -->
                        <li class="list-group-item d-flex align-items-center border-0 py-3">
                            <!-- الحرف الأول من البريد الإلكتروني كصورة رمزية -->
                            <div class="contact-avatar bg-light text-dark rounded-circle d-flex align-items-center justify-content-center mr-3" style="width: 50px; height: 50px;">
                                {{ strtoupper(substr($contactEmail, 0, 1)) }}
                            </div>

                            <!-- تفاصيل جهة الاتصال -->
                            <div class="d-flex flex-column">
                                <button wire:click="userSelected('{{ $contactEmail }}')" style="border: none; background-color: transparent">
                                    <h6 class="mb-0 font-weight-bold text-dark">{{ \App\Models\Conversations\Conversation::getUserNameByEmail($contactEmail) }}</h6>
                                    <small class="text-muted">{{ $contactEmail }}</small>
                                    <small class="text-muted">
                                        {{ __('messages.last_message') }}:
                                        {{ $conversation->messages()->latest()->first() ? $conversation->messages()->latest()->first()->body : __('messages.no_messages') }}
                                    </small>
                                    <small class="text-muted">
                                        {{ $conversation->messages()->latest()->first() ? $conversation->messages()->latest()->first()->created_at->diffForHumans() : __('messages.no_messages') }}
                                    </small>
                                </button>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>

            <!-- عرض رسالة في حالة عدم وجود محادثات -->
            @if($conversations->isEmpty())
                <div class="main-chat-list text-center p-3" id="ChatList">
                    <p class="text-muted">{{ __('messages.no_chats') }}</p>
                </div>
            @endif
        </div>
    </div>

</div>
