@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>{{ $form->name }}</h1>
        <a href="{{ route('fields.create', $form->id) }}" class="btn btn-primary mb-3">Add Field</a>
        <ul class="list-group mb-3">
            @foreach($form->fields as $field)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    {{ $field->label }} ({{ $field->type }})
                    <a href="{{ route('fields.edit', [$form->id, $field->id]) }}" class="btn btn-secondary btn-sm">Edit</a>
                </li>
            @endforeach
        </ul>

        <h2>Code Snippets</h2>

        <div class="mb-3">
            <h5>HTML</h5>
            <pre><code class="language-html">&lt;form action="https://forms.databytedigital.com/v2/customeridrandom/random" method="POST"&gt;
    @csrf
    @foreach($form->fields as $field)
        @if($field->type == 'text')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;input type="text" id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" required&gt;
            &lt;/div&gt;
        @elseif($field->type == 'email')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;input type="email" id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" required&gt;
            &lt;/div&gt;
        @elseif($field->type == 'textarea')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;textarea id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" required&gt;&lt;/textarea&gt;
            &lt;/div&gt;
        @elseif($field->type == 'number')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;input type="number" id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" required&gt;
            &lt;/div&gt;
        @elseif($field->type == 'date')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;input type="date" id="{{ $field->name }}" name="{{ $field->name }}" class="form-control" required&gt;
            &lt;/div&gt;
        @elseif($field->type == 'checkbox')
            &lt;div class="mb-3 form-check"&gt;
                &lt;input type="checkbox" id="{{ $field->name }}" name="{{ $field->name }}" class="form-check-input"&gt;
                &lt;label for="{{ $field->name }}" class="form-check-label"&gt;{{ $field->label }}&lt;/label&gt;
            &lt;/div&gt;
        @elseif($field->type == 'radio')
            &lt;div class="mb-3 form-check"&gt;
                &lt;input type="radio" id="{{ $field->name }}" name="{{ $field->name }}" class="form-check-input"&gt;
                &lt;label for="{{ $field->name }}" class="form-check-label"&gt;{{ $field->label }}&lt;/label&gt;
            &lt;/div&gt;
        @elseif($field->type == 'select')
            &lt;div class="mb-3"&gt;
                &lt;label for="{{ $field->name }}"&gt;{{ $field->label }}&lt;/label&gt;
                &lt;select id="{{ $field->name }}" name="{{ $field->name }}" class="form-select" required&gt;
                    &lt;option value=""&gt;Select an option&lt;/option&gt;
                    <!-- Add options dynamically here if needed -->
                &lt;/select&gt;
            &lt;/div&gt;
        @endif
    @endforeach
            &lt;button type="submit" class="btn btn-success"&gt;Submit&lt;/button&gt;
        &lt;/form&gt;</code></pre>
            <button class="btn btn-secondary btn-clipboard" data-clipboard-target=".language-html">Copy HTML</button>
        </div>

        <div class="mb-3">
            <h5>JavaScript</h5>
            <pre><code class="language-javascript">document.querySelector('form').addEventListener('submit', function(event) {
    event.preventDefault();
    // Add your JS code here
});</code></pre>
            <button class="btn btn-secondary btn-clipboard" data-clipboard-target=".language-javascript">Copy JavaScript</button>
        </div>

        <div class="mb-3">
            <h5>PHP cURL</h5>
            <pre><code class="language-php">&lt;?php
$url = "https://forms.databytedigital.com/v2/customeridrandom/random"; // Replace with your endpoint URL

$fields = [];
@foreach($form->fields as $field)
    $fields['{{ $field->name }}'] = $_POST['{{ $field->name }}'];
@endforeach

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);
curl_close($ch);

echo $response;
?&gt;</code></pre>
            <button class="btn btn-secondary btn-clipboard" data-clipboard-target=".language-php">Copy PHP</button>
        </div>

        <div class="mb-3">
            <h5>Python Requests</h5>
            <pre><code class="language-python">import requests

url = 'https://forms.databytedigital.com/v2/customeridrandom/random'  # Replace with your endpoint URL

fields = {
    @foreach($form->fields as $field)
        '{{ $field->name }}': 'value',  # Replace 'value' with actual data
    @endforeach
}

response = requests.post(url, data=fields)
print(response.text)</code></pre>
            <button class="btn btn-secondary btn-clipboard" data-clipboard-target=".language-python">Copy Python</button>
        </div>
    </div>
@endsection
