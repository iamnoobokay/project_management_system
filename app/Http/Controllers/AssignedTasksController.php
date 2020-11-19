<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\Members;
use App\Tasks;
use App\User;
use Mail;
use App\Mail\TaskMessage;
class AssignedTasksController extends Controller
{
    public function getProject(){
    	$userId=Auth::user()->id;
    	$members=Members::where('user_id',$userId)->get();
    	$projects=[];

    	foreach($members as $member){
    		$project=Project::find($member->project_id);
    		array_push($projects,$project);
    	}
    	return view('member.assigned-project',compact('projects'));
    }

    public function tasksByProject($projectId){
    	$userId=Auth::user()->id;
    	$members=Members::where('user_id',$userId)->where('project_id',$projectId)->get();
    	$tasks=[];
    	foreach($members as $member){
    		foreach($member->tasks as $task){
    			if($task->status != "Closed"){
    				array_push($tasks,$task);
    			}
    		}	
    	}
    	return view('member.tasks-by-project',compact('tasks'));
    }

    public function tasksByDeadline(){
        $userId=Auth::user()->id;
        $members=Members::where('user_id',$userId)->get();

        $tasksArray=[];
        foreach($members as $member){
            $tasks=Tasks::where('members_id',$member->id)->orderBy('deadline','desc')->get();
            foreach($tasks as $task){
                $task->project;
            }
            array_push($tasksArray,$tasks);
        }
        return view('member.tasks-by-deadline',compact('tasksArray'));
    }

    public function changeTaskStatus($id){
        $task=Tasks::find($id);

        if($task->status=="New"){
            $task->status="Ongoing";
        }
        elseif($task->status=="Ongoing"){
            $task->status="Resolved";
        }
        elseif($task->status=="Resolved"){
            $task->status="New";
        }

        $task->save();

        return back()->with('task-message','Task Status Updated Successfully');
    }

    public function taskMessageView($id){
        $task=Tasks::find($id);
        return view('member.send-task-message',compact('task'));
    }

    public function sendMail(Request $request,$id){
        $this->validate($request,[
            'message'=>'required',
        ]);
        $taskMessage=$request->input('message');
        $task=Tasks::find($id);
        $project=$task->project;
        $projectManager=User::find($project->manager_id);
        $email=$projectManager->email;

        Mail::to($email)->send(new TaskMessage($taskMessage));

        return back();
    }
}
