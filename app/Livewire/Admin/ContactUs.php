<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Livewire\Component;
use Livewire\WithPagination;

class ContactUs extends Component
{
    use WithPagination;
    public    $topTitle;
    public    $formTopTitle;
    public    $infoTopTitle;
    public    $position;
    public    $status;
    public    $title;
    public    $subtitle;
    public    $icon;
    public    $name;
    public    $email;
    public    $phone;
    public    $text;
    protected $contacts;
    public    $contact;
    public    $firstRecord;
    public    $infos;
    public    $info;

    public function mount()
    {
        $this->firstRecord = Contact::query()->first();
        if (!$this->firstRecord) {
            $this->firstRecord = Contact::query()->create();
        }
        $this->infos = Contact::query()->where('id', '>', $this->firstRecord->id)->where('position', 0)->get();
        $this->fetchData();
    }


    public function fetchData()
    {
        $this->topTitle     = $this->firstRecord->topTitle;
        $this->formTopTitle = $this->firstRecord->formTopTitle;
        $this->infoTopTitle = $this->firstRecord->infoTopTitle;
    }

    public function infoEdit(Contact $contact)
    {
        $this->clearInputs();
        $this->info     = $contact;
        $this->title    = $contact->title;
        $this->subtitle = $contact->subtitle;
        $this->icon     = $contact->icon;

    }

    public function infoDelete(Contact $contact)
    {
        $contact->delete();
        $this->mount();
        $this->clearInputs();
    }

    public function infoSubmit()
    {
        $this->info->update([
            'title'    => $this->title,
            'subtitle' => $this->subtitle,
            'icon'     => $this->icon,
        ]);
        $this->clearInputs();
        $this->mount();
    }

    public function infoAdd()
    {
        $this->clearInputs();
        $info       = Contact::query()->create([
            'title'    => $this->title,
            'subtitle' => $this->subtitle,
            'icon'     => $this->icon,
        ]);
        $this->info = $info;
        $this->mount();
    }

    public function clearInputs()
    {
        $this->title    = '';
        $this->subtitle = '';
        $this->icon     = '';
        $this->contact  = '';
        $this->info     = '';
        $this->name     = '';
        $this->email    = '';
        $this->phone    = '';
        $this->text     = '';
    }

    public function updateTexts()
    {
        $this->firstRecord->update([
            'topTitle'     => $this->topTitle,
            'formTopTitle' => $this->formTopTitle,
            'infoTopTitle' => $this->infoTopTitle,
        ]);
        $this->fetchData();
    }

    public function contactSee(Contact $contact)
    {
        $this->clearInputs();
        $this->contact = $contact;
        $this->name    = $contact->name;
        $this->email   = $contact->email;
        $this->phone   = $contact->phone;
        $this->text    = $contact->text;
        $this->contact->update([
            'status' => 1,
        ]);
        $this->mount();
    }

    public function contactDelete(Contact $contact)
    {
        $contact->delete();
        $this->mount();
    }

    public function changeStatus(Contact $contact)
    {
        $contact->update([
            'status' => $contact->status == 0 ? 1 : 0,
        ]);
        $this->mount();
    }

    public function render()
    {
        $this->contacts = Contact::query()
            ->where('id', '>', $this->firstRecord->id)
            ->where('position', 1)
            ->orderByDesc('created_at')
            ->paginate(20);
        return view('livewire.admin.contact-us',['contacts' => $this->contacts]);
    }
}
