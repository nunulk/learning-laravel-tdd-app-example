<h1>{{ $lesson->name }}</h1>
<div>
    <span>空き状況: {{ $lesson->vacancyLevel->mark() }}</span>
</div>
