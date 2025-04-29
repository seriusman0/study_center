<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\FamilyMember;
use App\Models\User;

class UserSiblings extends Component
{
    public $user;
    public $siblings = [];
    public $newSibling = [
        'nama' => '',
        'member_id' => ''
    ];

    public function mount(User $user)
    {
        $this->user = $user;
        $this->loadSiblings();
    }

    public function loadSiblings()
    {
        $this->siblings = $this->user->familyMembers()
            ->where('member_type', 'Sibling')
            ->get()
            ->toArray();
    }

    public function addSibling()
    {
        $this->validate([
            'newSibling.nama' => 'required|string|max:255',
            'newSibling.member_id' => 'nullable|string|max:255'
        ]);

        $this->user->familyMembers()->create([
            'member_type' => 'Sibling',
            'nama' => $this->newSibling['nama'],
            'member_id' => $this->newSibling['member_id']
        ]);

        $this->newSibling = [
            'nama' => '',
            'member_id' => ''
        ];

        $this->loadSiblings();
    }

    public function removeSibling($siblingId)
    {
        $this->user->familyMembers()
            ->where('id', $siblingId)
            ->where('member_type', 'Sibling')
            ->delete();

        $this->loadSiblings();
    }

    public function render()
    {
        return view('livewire.user-siblings');
    }
}
