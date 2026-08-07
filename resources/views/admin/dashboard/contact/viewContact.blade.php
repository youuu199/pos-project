@extends('admin.layouts.master')

@section('content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">ဆက်သွယ်မှု အသေးစိတ်</h1>

    @if(session('deleteSuccess'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'အောင်မြင်ပါသည်',
                text: '{{ session('deleteSuccess') }}',
                timer: 2000,
                showConfirmButton: false
            });
        </script>
    @endif

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">ဆက်သွယ်မှု အချက်အလက်များ</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 30%">အမည်</th>
                                <td>{{ $contact->name }}</td>
                            </tr>
                            <tr>
                                <th>အီးမေးလ်</th>
                                <td>{{ $contact->email }}</td>
                            </tr>
                            <tr>
                                <th>ခေါင်းစဉ်</th>
                                <td>{{ $contact->subject }}</td>
                            </tr>
                            <tr>
                                <th>မက်ဆေ့</th>
                                <td>{!! nl2br(e($contact->message)) !!}</td>
                            </tr>
                            <tr>
                                <th>နေ့စွဲ</th>
                                <td>{{ $contact->created_at->format('d/m/Y H:i:s') }}</td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Delete Contact -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-danger">ဆက်သွယ်မှု ဖျက်ရန်</h6>
                </div>
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.contacts.delete', $contact->id) }}" id="deleteContactForm">
                        <button type="button" class="btn btn-danger btn-block" onclick="confirmDeleteContact()">
                            <i class="fas fa-trash"></i> ဖျက်ရန်
                        </button>
                    </form>
                </div>
            </div>

            <a href="{{ route('admin.contacts') }}" class="btn btn-secondary btn-block">
                <i class="fas fa-arrow-left"></i> ပြန်သွားရန်
            </a>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function confirmDeleteContact() {
            Swal.fire({
                title: 'ဖျက်မှာလား?',
                text: "ဒီဆက်သွယ်မှုကို ဖျက်ပါမလား?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ဖျက်ရန်',
                cancelButtonText: 'ပယ်ဖျက်ရန်'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteContactForm').submit();
                }
            });
        }
    </script>
@endsection
