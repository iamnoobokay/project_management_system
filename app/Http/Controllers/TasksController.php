<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\User;
use App\Tasks;
use App\Members;
use Mail;
use App\Mail\TaskMail;
use App\Mail\TaskMessage;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{
    public function tasksByProjectView(){
    	$projects=Project::where('manager_id',Auth::user()->id)->get();
    	foreach($projects as $project){
    		$manager=User::find($project->manager_id);
    		$project->manager=$manager;
    	}
    	// foreach ($projects as $project) {
    	// 	$project->members;
    	// 	$project->department;
    	// 	$project->user;
    	// 	foreach($project->members as $member){
    	// 		$member->user;
    	// 	}
    	// }

    	return view('manager.tasks-by-project',compact('projects'));
    }

    public function tasksByProject($id){
    	$project=Project::find($id);
    	$project->members;
    	$project->department;

    	return view('manager.add-task',compact('project'));
    }

    public function storeTasks(Request $request,$id){
    	$this->validate($request,[
    		'member'=>'required',
    		'deadline'=>'required',
    		'priority'=>'required',
    		'status'=>'required',
    		'message'=>'required',
    	]);

    	$task=new Tasks();
    	$task->project_id=$id;
    	$task->members_id=$request->input('member');
    	$task->deadline=$request->input('deadline');
    	$task->status=$request->input('status');
    	$task->message=$request->input('message');
    	$task->priority=$request->input('priority');
    	$task->save();

    	$member=Members::find($request->input('member'));
    	$userDetails=($member->user);

    	$project=Project::find($id);

    	$projectManager=User::find($project->manager_id);

    	Mail::to($userDetails->email)->send(new TaskMail($userDetails,$project,$projectManager,$task));

    	return back()->with('task-message','Task Assigned And Mail Sent');
    }

    public function getByUser(){
        $users=User::all();
        return view('manager.task-user',compact('users'));
    }

    public function getTasksByUser($id){
        $user=User::find($id);
        $members=$user->members;
        foreach($members as $member){
            if(count($member->tasks)>0){
                foreach($member->tasks as $task){
                    if($task->project->manager_id == Auth::user()->id){
                        $member->tasks;
                    }
                }
            }
        }
        return view('manager.get-tasks-by-user',compact('members'));
    }

    public function getProjects(){
        $projects=Project::where('manager_id',Auth::user()->id)->get();
        return view('manager.task-project',compact('projects'));
    }

    public function getTasksByProject($id){
        $tasks=Tasks::where('project_id',$id)->get();
        foreach ($tasks as $task) {
            $member=$task->members;
            $member->user;

        }
        return view('manager.get-tasks-by-project',compact('tasks'));
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
            $task->status="Closed";
        }
        else{
            $task->status="New";
        }

        $task->save();

        return back()->with('task-message','Task Status Updated Successfully');
    }

    public function changeTaskPriority($id){
        $task=Tasks::find($id);

        if($task->priority=="Low"){
            $task->priority="Medium";
        }
        elseif($task->priority=="Medium"){
            $task->priority="High";
        }
        else{
            $task->priority="Low";
        }
        $task->save();

        return back()->with('task-message','Task Priority Changed Successfully');
    }

    public function destroy($id){
        $tasks=Tasks::find($id);
        $tasks->delete();
        return back()->with('task-message','Task Deleted Successfully');   
    }

    public function extendDeadlineView($id){
        $tasks=Tasks::find($id);
        return view('manager.extend-task-deadline',compact('tasks'));
    }

    public function extendDeadline(Request $request,$id){
        $this->validate($request,[
            'deadline'=>'required',
        ]);

        $task=Tasks::find($id);

        $task->deadline=$request->input('deadline');
        $task->save();

        return back()->with('task-message','Deadline Extended');
    }

    public function tasksByDeadlineView(){
        $userId=Auth::user()->id;
        $members=Members::where('user_id',$userId)->get();

        $tasksArray=[];
        foreach($members as $member){
            $tasks=Tasks::where('members_id',$member->id)->orderBy('deadline','desc')->get();
            foreach($tasks as $task){
                $task->project;
            }
            if(count($tasks)!=0){
                array_push($tasksArray,$tasks);
            }
        }
        // dd($tasksArray);
        return view('manager.tasks-by-deadline',compact('tasksArray'));
    }

    public function changeStatus($id){
        $task=Tasks::find($id);
        $task->project;
        if($task->project->manager_id == Auth::user()->id){
            if($task->status=="New"){
                $task->status="Ongoing";
            }
            elseif($task->status=="Ongoing"){
                $task->status="Resolved";
            }
            elseif($task->status=="Resolved"){
                $task->status="Closed";
            }
            else{
                $task->status="New";
            }
        }
        else{
            if($task->status=="New"){
                $task->status="Ongoing";
            }
            elseif($task->status=="Ongoing"){
                $task->status="Resolved";
            }
            else{
                $task->status="New";
            }
        }
        $task->save();
        return back();
    }

    public function sendMessage($id){
        $task=Tasks::find($id);
        return view('manager.send-task-message',compact('task'));
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

    public function assignedTasksProject(){
        $userId=Auth::user()->id;
        $members=Members::where('user_id',$userId)->get();
        $projects=[];

        foreach($members as $member){
            $project=Project::find($member->project_id);
            array_push($projects,$project);
        }
        return view('manager.assigned-by-project',compact('projects'));
    }

    public function assignedByProject($projectId){
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
        return view('manager.get-assigned-tasks-by-project',compact('tasks'));
    }
}
