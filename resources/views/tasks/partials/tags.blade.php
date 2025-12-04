<div id="taskTagsSection" data-task-id="{{ $task->id }}">
    <h6>Tags</h6>
    <div id="taskTagsList" class="mb-2">
        @foreach($task->tags as $t)
            <span class="badge me-1" style="background:{{ $t->color ?? '#6c757d' }}; color:#fff">
                {{ $t->name }}
                <a href="#" class="text-light ms-1 detachTag" data-tag="{{ $t->id }}" data-task="{{ $task->id }}">&times;</a>
            </span>
        @endforeach
    </div>

    <div class="d-flex gap-2">
        <input id="taskTagInput" class="form-control" placeholder="Comma separated or existing tag names">
        <button id="attachTagsBtn" class="btn btn-sm btn-outline-primary">Attach</button>
    </div>

    <div class="mt-2">
        <small>Or pick existing:</small>
        <div id="allTagsList" class="mt-1">
            @foreach(App\Models\Tag::orderBy('name')->get() as $t)
                <button class="btn btn-sm btn-light me-1 addExistingTag" data-name="{{ $t->name }}">{{ $t->name }}</button>
            @endforeach
        </div>
    </div>
</div>
