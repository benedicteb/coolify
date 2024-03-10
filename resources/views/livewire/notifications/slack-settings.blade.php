<div>
    <form wire:submit='submit' class="flex flex-col">
        <div class="flex items-center gap-2">
            <h2>Slack</h2>
            <x-forms.button type="submit">
                Save
            </x-forms.button>
            @if ($team->slack_enabled)
                <x-forms.button class="text-white normal-case btn btn-xs no-animation btn-primary"
                                wire:click="sendTestNotification">
                    Send Test Notifications
                </x-forms.button>
            @endif
        </div>
        <div class="w-48">
            <x-forms.checkbox instantSave id="team.slack_enabled" label="Enabled" />
        </div>
    </form>
    @if (data_get($team, 'slack_enabled'))
        <h2 class="mt-4">OAuth settings</h2>
        <div class="w-64">
            <form class="flex flex-col items-end gap-2 pb-4 xl:flex-row" wire:submit='saveModel'>
                <x-forms.input required id="team.slack_client_id" helper="Client ID" label="Client ID" />
                <x-forms.input required id="team.slack_team_id" helper="Team ID" label="Team ID" />

                <x-forms.button type="submit">
                    Save
                </x-forms.button>
            </form>
        </div>
    @endif

    @if ($this->areSettingsValid())
        <a target="_blank" href="https://{{ data_get($team, 'slack_team_id') }}.slack.com/oauth/v2/authorize?scope=incoming-webhook&client_id={{ data_get($team, 'slack_client_id') }}&redirect_uri=https://localhost:8000/slack/redirect">
            <x-forms.button>Connect to workspace</x-forms.button>
        </a>
    @endif
</div>
