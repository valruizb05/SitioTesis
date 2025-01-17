<form action="{{ route('submitQuiz', ['filename' => $filename]) }}" method="POST">
    @csrf
    @foreach ($quiz as $index => $question)
        <div style="margin-bottom: 20px;">
            <p><strong>{{ $index + 1 }}. {{ $question['question'] }}</strong></p>
            @foreach ($question['options'] as $optionIndex => $option)
                <label>
                    <input type="radio" name="answers[{{ $index }}]" value="{{ $optionIndex }}">
                    {{ $option }}
                </label><br>
            @endforeach
        </div>
    @endforeach
    <button type="submit" style="padding: 10px 20px; background-color: #28a745; color: white; border: none; border-radius: 5px; cursor: pointer;">Enviar Respuestas</button>
</form>
