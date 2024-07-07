<?php

namespace App\Http\Controllers;

use App\Models\Form;
use App\Models\FormField;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function index()
    {
        $forms = Form::with('fields')->get();

        return view('forms.index', compact('forms'));
    }

    public function create()
    {
        return view('forms.create');
    }

    public function store1(Request $request)
    {
        $data = $request->only('name');
        $data['user_id'] = auth()->id();
        $publishableSecretKey = Str::random(40);
        $data['publishablesecretkey'] = $publishableSecretKey;

        $form = Form::create($data);

        return redirect()->route('forms.index');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->all();
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'response_type' => 'required|in:json,web',
        //     'callback_url' => 'nullable|url',
        //     'note' => 'nullable|string|max:1000',
        //     'ip_tracking' => 'boolean',
        // ]);

        // Prepare additional data to be stored as JSON
        $additionalData = [
            'response_type' => $validatedData['response_type'],
            'callback_url' => $validatedData['callback_url'],
            'note' => $validatedData['note'],
            'ip_tracking' => isset($validatedData['ip_tracking']) ? true : false,
        ];

        // Create a new form instance
        $form = new Form();
        $form->user_id = auth()->id();
        $publishableSecretKey = Str::random(40);
        $form->publishablesecretkey = $publishableSecretKey;
        $form->name = $validatedData['name'];
        $form->additional_data = $additionalData; // Store as JSON
        $form->save();

        // Redirect back or to a success page
        return redirect()->route('forms.index')->with('success', 'Form created successfully.');
    }
    // public function show1($id)
    // {
    //     // $form = Form::with('fields')->findOrFail($id);

    //     $form = Form::findOrFail($id);
    //     $fields = FormField::where('form_id', $id)->get();
    //     $fields->publishablesecretkey = $form->publishablesecretkey;
    //     $form->fields = $fields;
    //     $fields->each(function ($field) use ($form) {
    //         $field->publishablesecretkey = $form->publishablesecretkey;
    //     });
    //     $endpoint = 'https://forms.databytedigital.com/v2/customeridrandom/random';
    //     $codeSnippets = $this->generateCode($form, $endpoint);

    //     return view('forms.show', compact('form', 'codeSnippets'));
    // }

    public function show($id)
    {
        $form = DB::table('forms')->where('id', $id)->first();
        $fields = DB::table('form_fields')->where('form_id', $id)->get()->all();
        $final_fields = array_map(function ($field) {
            return (array) $field;
        }, $fields);
        $final_fields[] = [
            'label' => 'publishablesecretkey',
            'name' => 'publishablesecretkey',
            'type' => 'hidden',
            'value' => $form->publishablesecretkey,
            'status' => 'hidden',
        ];
        $endpoint = config('app.live_url').'/api/submit';
        $codeSnippets = $this->generateCode($final_fields, $endpoint);
        $form = Form::findOrFail($id);

        return view('forms.show', compact('form', 'codeSnippets'));
    }

    private function generateCode($form, $endpoint)
    {
        $result = [];
        $htmlResult = $this->htmlCode($form, $endpoint);
        $htmlResult = $this->mixCode('HTML', $htmlResult);
        array_push($result, $htmlResult);
        $pythonResult = $this->pythonCode($form, $endpoint);
        $pythonResult = $this->mixCode('Python', $pythonResult);
        array_push($result, $pythonResult);
        $phpResult = $this->phpCode($form, $endpoint);
        $phpResult = $this->mixCode('PHP Curl', $phpResult);

        array_push($result, $phpResult);

        return $result;
    }

    private function mixCode($languagName, $dynamicCode, $additionalData = [])
    {
        $languagNameLower = strtolower($languagName);
        $languagNameLower = str_replace(' ', '', $languagNameLower);
        $codeFirst = '<div class="bg-gray-800 rounded-lg p-4">
                        <h5 class="text-lg font-semibold mb-2 text-white">'.$languagName.'</h5>
                        <pre class="language-'.$languagNameLower.'">';

        $codeLast = '</pre>
                        <button class="bg-gray-600 hover:bg-gray-700 text-white py-1 px-3 rounded-md text-sm copy-button" data-clipboard-target=".language-'.$languagNameLower.'">Copy '.$languagName.'</button>
                    </div>';

        return $codeFirst.$dynamicCode.$codeLast;
    }

    private function pythonCode($fields, $endpoint)
    {
        $code = '<code>import requests

url = \''.$endpoint.'\'

fields = {';

        foreach ($fields as $field) {
            if (isset($field['value'])) {
                $value = $field['value'];
            } else {
                $value = $field['name'];
            }
            $code .= "
    '{$field['name']}': '{$value}',  ";
        }
        $code .= '
}
response = requests.post(url, data=fields)
print(response.text)</code>';

        return $code;
    }

    private function phpCode($fields, $endpoint)
    {
        $code = '<code>&lt;?php'.PHP_EOL;
        $code .= '$url = "'.htmlspecialchars($endpoint).'";'.PHP_EOL;
        $code .= PHP_EOL;
        $code .= '$fields = [];'.PHP_EOL;
        foreach ($fields as $field) {
            if (array_key_exists('value', $field)) {
                $code .= '     $fields[\''.$field['name'].'\'] = \''.$field['value'].'\';'.PHP_EOL;
            } else {
                $code .= '     $fields[\''.$field['name'].'\'] = $_POST[\''.$field['name'].'\'];'.PHP_EOL;
            }
        }
        $code .= PHP_EOL;
        $code .= '$ch = curl_init($url);'.PHP_EOL;
        $code .= 'curl_setopt($ch, CURLOPT_POST, 1);'.PHP_EOL;
        $code .= 'curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));'.PHP_EOL;
        $code .= 'curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);'.PHP_EOL;
        $code .= PHP_EOL;
        $code .= '$response = curl_exec($ch);'.PHP_EOL;
        $code .= 'curl_close($ch);'.PHP_EOL;
        $code .= PHP_EOL;
        $code .= 'echo $response;'.PHP_EOL;
        $code .= '?&gt;</code>';

        return $code;
    }

    private function htmlCode($fields, $endpoint)
    {
        $html = '<code>&lt;form action="'.htmlspecialchars($endpoint).'" method="POST"&gt;';
        // $html .= htmlspecialchars(csrf_field());

        foreach ($fields as $field) {
            if (isset($field['value'])) {
                $value = $field['value'];
            } else {
                $value = '';
            }
            switch ($field['type']) {
                case 'text':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;input type="text" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-control" required&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'email':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;input type="email" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-control" required&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'textarea':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;textarea id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-control" required&gt;&lt;/textarea&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'number':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;input type="number" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-control" required&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'date':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;input type="date" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-control" required&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;';
                    break;
                case 'checkbox':
                    $html .= '&lt;div class="mb-3 form-check"&gt;'.PHP_EOL;
                    $html .= '&lt;input type="checkbox" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-check-input"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'" class="form-check-label"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;';
                    break;
                case 'radio':
                    $html .= '&lt;div class="mb-3 form-check"&gt;'.PHP_EOL;
                    $html .= '&lt;input type="radio" id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-check-input"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'" class="form-check-label"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'select':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;label for="'.htmlspecialchars($field['name']).'"&gt;'.htmlspecialchars($field['label']).'&lt;/label&gt;'.PHP_EOL;
                    $html .= '&lt;select id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" class="form-select" required&gt;'.PHP_EOL;
                    $html .= '&lt;option value=""&gt;Select an option&lt;/option&gt;'.PHP_EOL;
                    $html .= '&lt;/select&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
                case 'hidden':
                    $html .= '&lt;div class="mb-3"&gt;'.PHP_EOL;
                    $html .= '&lt;input type="text" hidden id="'.htmlspecialchars($field['name']).'" name="'.htmlspecialchars($field['name']).'" value="'.htmlspecialchars($value).'" class="form-control" required&gt;'.PHP_EOL;
                    $html .= '&lt;/div&gt;'.PHP_EOL;
                    break;
            }
        }

        $html .= '&lt;button type="submit" class="btn btn-success"&gt;Submit&lt;/button&gt;';
        $html .= '&lt;/form&gt;</code>';

        return $html;
    }

    private function h1tmlCode($fields, $endpoint)
    {
        $html = '<code><form action="'.$endpoint.'" method="POST">';
        $html .= csrf_field();

        foreach ($fields as $field) {
            switch ($field['type']) {
                case 'text':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<input type="text" id="'.$field['name'].'" name="'.$field['name'].'" class="form-control" required>';
                    $html .= '</div>';
                    break;
                case 'email':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<input type="email" id="'.$field['name'].'" name="'.$field['name'].'" class="form-control" required>';
                    $html .= '</div>';
                    break;
                case 'textarea':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<textarea id="'.$field['name'].'" name="'.$field['name'].'" class="form-control" required></textarea>';
                    $html .= '</div>';
                    break;
                case 'number':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<input type="number" id="'.$field['name'].'" name="'.$field['name'].'" class="form-control" required>';
                    $html .= '</div>';
                    break;
                case 'date':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<input type="date" id="'.$field['name'].'" name="'.$field['name'].'" class="form-control" required>';
                    $html .= '</div>';
                    break;
                case 'checkbox':
                    $html .= '<div class="mb-3 form-check">';
                    $html .= '<input type="checkbox" id="'.$field['name'].'" name="'.$field['name'].'" class="form-check-input">';
                    $html .= '<label for="'.$field['name'].'" class="form-check-label">'.$field['label'].'</label>';
                    $html .= '</div>';
                    break;
                case 'radio':
                    $html .= '<div class="mb-3 form-check">';
                    $html .= '<input type="radio" id="'.$field['name'].'" name="'.$field['name'].'" class="form-check-input">';
                    $html .= '<label for="'.$field['name'].'" class="form-check-label">'.$field['label'].'</label>';
                    $html .= '</div>';
                    break;
                case 'select':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<select id="'.$field['name'].'" name="'.$field['name'].'" class="form-select" required>';
                    $html .= '<option value="">Select an option</option>';
                    $html .= '</select>';
                    $html .= '</div>';
                    break;
                case 'hidden':
                    $html .= '<div class="mb-3">';
                    $html .= '<label for="'.$field['name'].'">'.$field['label'].'</label>';
                    $html .= '<select id="'.$field['name'].'" name="'.$field['name'].'" class="form-select" required>';
                    $html .= '<option value="">Select an option</option>';
                    $html .= '</select>';
                    $html .= '</div>';
                    break;
            }
        }

        $html .= '<button type="submit" class="btn btn-success">Submit</button>';
        $html .= '</form></code>';

        return $html;
    }
}
