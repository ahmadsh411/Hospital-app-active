<div>
    <style>
        /* مركز المحتوى */
        .text-center {
            text-align: center;
        }

        /* تأثيرات للبطاقات */
        .card {
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* ألوان مخصصة للأطباء والمدراء */
        .doctor-card {
            border: 2px solid #4CAF50;
        }

        .admin-card {
            border: 2px solid #2196F3;
        }

        /* عناصر القائمة */
        .list-group-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 15px;
            border-left: 4px solid transparent;
            transition: background-color 0.3s, border-color 0.3s;
            position: relative; /* ضرورية للزر الشفاف */
        }

        .doctor-item:hover {
            background-color: #e8f5e9;
            border-color: #4CAF50;
        }

        .admin-item:hover {
            background-color: #e3f2fd;
            border-color: #2196F3;
        }

        /* زر شفاف */
        .invisible-button {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
            background: transparent;
            cursor: pointer;
            z-index: 1; /* يجب أن يكون فوق النص لضمان النقر */
        }

        /* رأس البطاقات */
        .card-header {
            background-color: #f1f1f1;
            font-weight: bold;
            color: #333;
        }

        /* تأثير التظليل */
        .shadow {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>

    <div class="container mt-5">
        <h3 class="mb-4 text-center">{{ __('messages.create_new_conversation') }}</h3>

        {{-- قائمة الأطباء --}}
        <div class="card mb-4 shadow doctor-card">
            <div class="card-header">
                <h5>{{ __('messages.doctors') }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($doctors as $doctor)
                    <li class="list-group-item doctor-item">
                        <!-- زر شفاف -->
                        <button wire:click="createConversation('{{ $doctor->email }}')" class="invisible-button"></button>
                        <!-- اسم الطبيب والبريد الإلكتروني -->
                        {{ $doctor->name }}
                        <span class="text-muted">{{ $doctor->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- قائمة المدراء --}}
        <div class="card shadow admin-card">
            <div class="card-header">
                <h5>{{ __('messages.admins') }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($admins as $admin)
                    <li class="list-group-item admin-item">
                        <!-- زر شفاف -->
                        <button wire:click="createConversation('{{ $admin->email }}')" class="invisible-button"></button>
                        <!-- اسم المدير والبريد الإلكتروني -->
                        {{ $admin->name }}
                        <span class="text-muted">{{ $admin->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>

        {{-- قائمة الموظفين --}}
        <div class="card shadow admin-card">
            <div class="card-header">
                <h5>{{ __('messages.staff') }}</h5>
            </div>
            <ul class="list-group list-group-flush">
                @foreach($staffs as $staff)
                    <li class="list-group-item admin-item">
                        <!-- زر شفاف -->
                        <button wire:click="createConversation('{{ $staff->email }}')" class="invisible-button"></button>
                        <!-- اسم الموظف والبريد الإلكتروني -->
                        {{ $staff->name }}
                        <span class="text-muted">{{ $staff->email }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
