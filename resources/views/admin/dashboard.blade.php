<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard</title>

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
</head>

<body>
    @include('layout.header')

    <main class="dashboard-container">
        <h2 class="dashboard-title">📬 Contact Submissions</h2>

        <div class="table-wrapper">
            <table class="contact-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Purpose</th>
                        <th>Submitted At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($contacts as $index => $contact)
                        <tr>
                            <td>{{ $contacts->firstItem() + $index }}</td>
                            <td>{{ $contact->name }}</td>
                            <td>{{ \App\Helpers\EncryptionHelper::decrypt($contact->email) ?? 'Invalid or Corrupt Data' }}</td>
                            <td>{{ $contact->subject }}</td>
                            <td>{{ ucfirst($contact->purpose) }}</td>
                            <td>{{ $contact->created_at->format('d M Y, h:i A') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrapper">
                {{ $contacts->links() }}
            </div>
        </div>
    </main>

    @include('layout.footer')
</body>
</html>
