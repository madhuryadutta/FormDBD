<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FormEntryController extends Controller
{
    public function index($formId)
    {
        $form = Form::findOrFail($formId);
        $entries = FormEntry::where('form_id', $formId)->get();

        return view('entries.index', compact('form', 'entries'));
    }

    public function viewAll()
    {
        $current_user = Auth::id();
        $form = Form::where('user_id', $current_user)->get();
        // $entries = FormEntry::where('form_id', $formId)->get();
        $entries = FormEntry::where('form_id', $formId)->get();

        return view('entries.index', compact('form', 'entries'));
    }

    public function store(Request $request)
    {
        $allowedDomain = '*';
        // $request->validate([
        //     'domain' => 'required|in:yourdomain.com',
        //     'publishableSecretKey' => 'required|in:yourpublishablesecretkey',
        // ]);
        $domain = $request->getHost(); // Gets the domain from the request URL
        // You can also fetch it from the referer header, if available
        // $referer = $request->headers->get('referer');
        // $domain = parse_url($referer, PHP_URL_HOST);

        // Validate the domain
        // Note: Validation logic depends on your specific requirements
        // For demonstration, let's check if the domain is 'yourdomain.com'
        if ($allowedDomain != '*') {
            if ($domain !== 'yourdomain.com') {
                return response()->json(['error' => 'Invalid domain'], 400);
            }
        }
        $publishableKey = $request->publishablesecretkey;
        // $form = Form::with('fields')->findOrFail($formId);
        $form = Form::with('fields')
            ->where('publishablesecretkey', $publishableKey)
            ->first();
        if (! $form) {
            return redirect('/wrong-secret');
        }
        // $form2 = Form::where('user_id', Auth::id())->get();
        $form2 = Form::where('publishablesecretkey', $publishableKey)->get();
        $form2 = $form2->first();
        $form2 = $form['additional_data'];
        $validatedData = $request->validate(
            collect($form->fields)->mapWithKeys(function ($field) {
                return [$field->name => 'required'];
            })->toArray()
        );
        // var_dump($validatedData);die();
        $entry = $form->entries()->create(['data' => $validatedData, 'submitted_at' => Carbon::now(), 'form_id' => '3434']);
        if (isset($form2['response_type'])) {
            switch ($form2['response_type']) {
                case 'json':
                    $reponseType = 'json';
                    break;
                case 'web':
                    $reponseType = 'web';
                    break;
                default:
                    $reponseType = 'web';
            }
        } else {
            $reponseType = 'web';
        }
        if (isset($form2['callback_url'])) {
            return redirect($form2['callback_url']);
        } else {
            if ($entry) {
                return redirect('/success');
            } else {
                return redirect('/fail');
            }
        }
    }
}
