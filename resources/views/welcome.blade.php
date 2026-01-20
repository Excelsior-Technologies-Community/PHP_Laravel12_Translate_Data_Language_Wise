@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>{{ translate('messages', 'welcome_title', [], $currentLocale) }}</h3>
            </div>
            <div class="card-body">
                <h4>{{ translate('messages', 'current_language', [], $currentLocale) }}: 
                    <span class="badge bg-primary">{{ strtoupper($currentLocale) }}</span>
                </h4>
                
                <div class="mt-4">
                    <p><strong>{{ translate('messages', 'greeting', [], $currentLocale) }}:</strong> 
                    {{ translate('messages', 'hello_message', [], $currentLocale) }}</p>
                    
                    <p><strong>{{ translate('messages', 'description', [], $currentLocale) }}:</strong> 
                    {{ translate('messages', 'system_description', [], $currentLocale) }}</p>
                    
                    <p><strong>{{ translate('messages', 'features', [], $currentLocale) }}:</strong> 
                    {{ translate('messages', 'features_list', [], $currentLocale) }}</p>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h5>{{ translate('messages', 'add_translation', [], $currentLocale) }}</h5>
            </div>
            <div class="card-body">
                <form id="translationForm">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">{{ translate('messages', 'group', [], $currentLocale) }}</label>
                        <input type="text" name="group" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ translate('messages', 'key', [], $currentLocale) }}</label>
                        <input type="text" name="key" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">{{ translate('messages', 'text', [], $currentLocale) }}</label>
                        <textarea name="text" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">{{ translate('messages', 'submit', [], $currentLocale) }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('translationForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    fetch('/add-translation', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            group: this.group.value,
            key: this.key.value,
            text: this.text.value
        })
    })
    .then(response => response.json())
    .then(data => {
        alert('Translation added successfully!');
        this.reset();
        location.reload();
    })
    .catch(error => console.error('Error:', error));
});
</script>
@endpush