<?php

namespace App\Livewire\Project\Service;

use App\Jobs\ContainerStatusJob;
use App\Models\Service;
use Livewire\Component;

class Configuration extends Component
{
    public ?Service $service = null;
    public $applications;
    public $databases;
    public array $parameters;
    public array $query;
    public function getListeners()
    {
        $userId = auth()->user()->id;
        return [
            "echo-private:user.{$userId},ServiceStatusChanged" => 'check_status',
            "check_status"
        ];
    }
    public function render()
    {
        return view('livewire.project.service.configuration');
    }
    public function mount()
    {
        $this->parameters = get_route_parameters();
        $this->query = request()->query();
        $this->service = Service::whereUuid($this->parameters['service_uuid'])->first();
        if (!$this->service) {
            return redirect()->route('dashboard');
        }
        $this->applications = $this->service->applications->sort();
        $this->databases = $this->service->databases->sort();
    }
    public function check_status()
    {
        dispatch_sync(new ContainerStatusJob($this->service->server));
        $this->dispatch('refresh')->self();
        $this->dispatch('serviceStatusChanged');
    }
}
