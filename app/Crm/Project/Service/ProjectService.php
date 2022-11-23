<?php

namespace Crm\Project\Service;

use Crm\Project\Events\ProjectCreation;
use Crm\Project\Models\Project;
use Crm\Project\Requests\CreateProjectRequest;
use Symfony\Component\HttpFoundation\Response;

class ProjectService
{
    public function notFound($message = 'Not Found', $status = Response::HTTP_NOT_FOUND)
    {
        return response()->json(['status' => $message], $status);
    }

    public function createProject(CreateProjectRequest $request, $customer_id)
    {
        $project = new Project();
        $project->project_name = $request->project_name;
        $project->status = (boolean)$request->status;
        $project->customer_id = $customer_id;
        $project->project_cost = (float)$request->project_cost;
        $project->save();
        event(new ProjectCreation($project));
        return $project;
    }
}
