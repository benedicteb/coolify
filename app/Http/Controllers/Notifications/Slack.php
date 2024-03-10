<?php

namespace App\Http\Controllers\Notifications;

use App\Enums\ProcessStatus;
use App\Http\Controllers\Controller;
use App\Jobs\ApplicationPullRequestUpdateJob;
use App\Jobs\GithubAppPermissionJob;
use App\Models\Application;
use App\Models\ApplicationPreview;
use App\Models\GithubApp;
use App\Models\PrivateKey;
use App\Models\Team;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Visus\Cuid2\Cuid2;

class Slack extends Controller
{
    public function install(Request $request)
    {
        try {
            $team_id = $request->get('team_id');
            $code = $request->get('code');
            $state = $request->get('state');

            $team = Team::find($team_id);

            $route = route('team.notification.index') . "#slack";

            return redirect()->to($route);
        } catch (Exception $e) {
            return handleError($e);
        }
    }
}
