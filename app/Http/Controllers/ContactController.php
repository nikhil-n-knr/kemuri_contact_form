<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use App\Helpers\ContactLogger;
use App\Services\MailService;
use App\Helpers\EncryptionHelper;
use Illuminate\Support\Str; 
use App\Models\Contact;

class ContactController extends Controller
{
    public function index()
    {
        $contacts = Contact::latest()->paginate(10); // paginate for larger data
        return view('admin.dashboard', compact('contacts'));
    }
    public function submit(Request $request, MailService $mailService)
    {
        $validated = $request->validate([
            'name' => 'required|min:1',
            'email' => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
            'purpose' => 'required|string',
            'short_description' => 'nullable|string',
            'contacting_from' => 'nullable|string',
            'company_name' => 'required_if:contacting_from,company|string|nullable',
        ]);

        $data = $validated;
        $data['id'] = Str::uuid();
        $data['email'] = EncryptionHelper::encrypt($validated['email']);
    
        Contact::create($data);
        $sent = $mailService->sendContactMail($validated);
    
        if ($sent) {
            return response()->json([
                'message' => "✅ Thank you, {$validated['name']}! We’ve received your message and a confirmation has been sent to your email: ". EncryptionHelper::decrypt($data['email']) .". Our team will review your query and get back to you shortly.",
                'status' => 'success'
            ]);
        }
    
        return response()->json([
            'message' => 'Failed to send message. Please try again later.'
        ], 500);
    }

    public function showForm()
    {
        return view('contact'); // This loads resources/views/contact.blade.php
    }
}
