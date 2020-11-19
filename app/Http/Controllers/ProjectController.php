<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Department;
use App\Project;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Members;
use Mail;
use App\Mail\ProjectMail;

class ProjectController extends Controller
{
    public function index(){
    	$departments=Department::all();
        $users=User::where('role_id',1)->get();
    	return view('manager.add-project',compact('departments','users'))->with('project-message');
    }

    public function store(Request $request){
    	$this->validate($request,[
    		'project-name'=>'required',
    		'client-name'=>'required',
    		'client-contact'=>'required',
    		'client-email'=>'required',
    		'project-deadline'=>'required',
    		'department'=>'required',
    		'status'=>'required',
            'manager'=>'required',
    	]);

    	$project=new Project();
    	$project->manager_id=$request->input('manager');
    	$project->department_id=$request->input('department');
    	$project->project_name=$request->input('project-name');
    	$project->client_name=$request->input('client-name');
    	$project->client_contact=$request->input('client-contact');
    	$project->client_email=$request->input('client-email');
    	$project->deadline=$request->input('project-deadline');
    	$project->status=$request->input('status');
    	$project->save();

    	return redirect()->route('create-a-project')->with('project-message',"Project Created Successfully");
    }

    public function showAll(){
    	$projects=Project::all();
    	foreach ($projects as $project) {
    		$project->department;
    	}
    	return view('manager.view-projects',compact('projects'))->with('project-message');
    }

    public function edit($id){
    	$project=Project::find($id);
    	$departments=Department::all();
    	return view('manager.project-edit',compact('project','departments'));
    }

    public function update(Request $request, $id){
    	$this->validate($request,[
    		'project-name'=>'required',
    		'client-name'=>'required',
    		'client-contact'=>'required',
    		'client-email'=>'required',
    		'project-deadline'=>'required',
    		'department'=>'required',
    		'status'=>'required',
            'manager'=>'required',
    	]);

    	$project=Project::find($id);
    	$project->manager_id=$request->input('manager');
    	$project->department_id=$request->input('department');
    	$project->project_name=$request->input('project-name');
    	$project->client_name=$request->input('client-name');
    	$project->client_contact=$request->input('client-contact');
    	$project->client_email=$request->input('client-email');
    	$project->deadline=$request->input('project-deadline');
    	$project->status=$request->input('status');
    	$project->save();

    	return redirect()->route('view-projects')->with('project-message',"Project Was Updated");
    }

    public function show($id){
    	$project=Project::find($id);
    	$project->department;
    	$projectManager=User::where('id',$project->manager_id)->first();
    	$users=User::all();

    	$projectMembers=Members::where('project_id',$id)->get();
    	$projectMembersArray=[];

    	if(count($projectMembers)>0){
    		$i=0;
    		foreach($projectMembers as $projectMember){
    			$projectMembersArray[$i]=$projectMember->user_id;
    			$i++;
    		}
    	}

    	return view('manager.manage-project',compact('project','project','projectManager','users','projectMembersArray'));
    }

    public function changeStatus(Request $request,$id){
    	$project=Project::find($id);
    	$project->status=$request->input('status');
    	$project->save();

    	return back()->with('project-message','Status Succesfully Changed');
    }

    public function addMembers(Request $request,$id){
    	$members=$request['members'];

    	$databaseMembers=Members::all();

    	$databaseMembersArray=[];
    	$i=0;
    	foreach ($databaseMembers as $member) {
    		$databaseMembersArray[$i]=strval($member->user_id);
    		$i++;
    	}

    	if($members==null){
    		$rmembers=Members::where('project_id',$id)->get();
    		foreach ($rmembers as $member) {
    			$member->delete();
    		}
    	}
    	
    	if($members!=null){
    		$removeMembers=array_diff($databaseMembersArray,$members);
    		foreach ($removeMembers as $member) {
    			$removeMember= Members::where('user_id',intval($member))->where('project_id',$id)->first();
    		
    			if($removeMember){
    				$removeMember->delete();
    			}
    		}
    	}
    	
    	if($members!=null){
    		foreach($members as $member){
    			$members=new Members();
    			$check=Members::where('project_id',$id)->where('user_id',$member)->get();
    			if(count($check)==0){
    				$members->project_id=$id;
    				$members->user_id=$member;
    				$members->save();
    			}
    		}
    	}

        $emails=[];
        $project=Project::find($id);
        $projectName=$project->project_name;

        if($request['members']!=null){
            foreach($request['members'] as $member ){
                $projectInfo=Members::where('project_id',$id)->where('user_id',$member)->get();
                $memberInfo=$projectInfo[0]->user;
                $memberEmail=($memberInfo->email);
                array_push($emails,$memberEmail);
            }

            Mail::to($emails)->send(new ProjectMail($projectName,$project));
        }

    	return back()->with('project-message','Members Added And Email Sent');
    }

    public function destroy($id){
    	$project=Project::find($id);
    	$project->delete();
    	return redirect()->route('view-projects')->with('project-message',"Project Was Deleted");
    }
}
