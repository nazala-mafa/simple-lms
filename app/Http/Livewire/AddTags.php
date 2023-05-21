<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Modules\Lms\Entities\Question;

class AddTags extends Component
{
    public $tags = [];
    public $name = '';
    public Question $question;

    private function reloadTags()
    {
        $this->tags = Tag::where([
            'user_id' => auth()->id(),
            'school_id' => auth()->user()->school_id,
        ])->get();
    }

    public function mount($question)
    {
        $this->question = $question;
        $this->reloadTags();
    }

    public function render()
    {
        return view('livewire.add-tags');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'name' => [
                'required',
                'min:2',
                Rule::unique('tags', 'name')->where('school_id', auth()->user()->school_id)->where('user_id', auth()->id())
            ]
        ]);
    }

    public function saveTag()
    {
        Tag::create([
            'name' => $this->name,
            'user_id' => auth()->id(),
            'school_id' => auth()->user()->school_id
        ]);

        $this->name = '';

        $this->reloadTags();
    }

    public function toggleTag($tag_id)
    {
        if ($this->question->tags()->where('id', $tag_id)->exists()) {
            $this->question->tags()->detach($tag_id);
        } else {
            $this->question->tags()->attach($tag_id);
        }

        $this->question = $this->question->refresh();
    }

    public function removeTag(Tag $tag)
    {
        $tag->delete();
        $this->reloadTags();
    }
}