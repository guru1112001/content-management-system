<!-- resources/views/filament/pages/view-questions.blade.php -->
<x-filament::page>
    <h2>{{ $questionBank->name }}</h2>
    @foreach ($questionBank->questions as $question)
        <div class="border rounded p-4 mb-2">
            <h4>Question: {{ $question->question_text }}</h4>
            <div class="flex items-center">
                <span class="mr-4">Marks: {{ $question->marks }}</span>
                <span class="text-red-500">Negative Marks: {{ $question->negative_marks }}</span>
            </div>
            <div class="mt-2">
                @foreach ($question->options as $option)
                    <div class="flex items-center">
                        <input type="radio" class="mr-2" disabled {{ $option->is_correct ? 'checked' : '' }}>
                        <span>{{ $option->option_text }}</span>
                        @if ($option->is_correct)
                            <span class="text-green-500 ml-2">(Correct Answer)</span>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</x-filament::page>
