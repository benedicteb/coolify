<?php

namespace App\Livewire\Notifications;

use App\Models\Team;
use App\Notifications\Test;
use Livewire\Component;

class SlackSettings extends Component
{
    public Team $team;
    protected $rules = [
        'team.slack_enabled' => 'nullable|boolean',
        'team.slack_client_id' => 'required|string',
        'team.slack_team_id' => 'required|string',
    ];
    protected $validationAttributes = [
        'team.slack_client_id' => 'Slack Client ID',
        'team.slack_team_id' => 'Slack Client ID',
    ];

    public function mount()
    {
        $this->team = auth()->user()->currentTeam();
    }
    public function instantSave()
    {
        try {
            $this->submit();
        } catch (\Throwable $e) {
            ray($e->getMessage());
            $this->team->slack_enabled = false;
            $this->validate();
        }
    }

    public function submit()
    {
        $this->resetErrorBag();
        $this->validate();
        $this->saveModel();
    }

    public function areSettingsValid()
    {
        return !empty($this->team->slack_client_id) && !empty($this->team->slack_team_id);
    }

    public function saveModel()
    {
        $this->team->save();
        refreshSession();
        $this->dispatch('success', 'Settings saved.');
    }

    public function sendTestNotification()
    {
        $this->team?->notify(new Test());
        $this->dispatch('success', 'Test notification sent.');
    }
}
