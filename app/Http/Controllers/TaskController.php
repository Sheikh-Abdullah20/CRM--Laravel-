<?php

namespace App\Http\Controllers;

use App\Models\Account;
use App\Models\Contact;
use App\Models\Lead;
use App\Models\Task;
use App\Notifications\taskNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;

class TaskController extends Controller
{
    
    public function index(Request $request)
    {

        if($request->filled('task_id')){
            $selectedIds = explode(',', $request->task_id);
            $task = Task::whereIn('id',$selectedIds)->delete();
            $message = "Tasks Has Been Deleted";
            Notification::send(Auth::user(), new taskNotification($task,$message));
            Toastr()->error("Selected Tasks Has Been Deleted",[],'Deleted');
            return redirect()->route('task.index');
        }

        $search = $request->search;
        $tasks = Task::when($search, function($query) use ($search){
            $query->where('subject','LIKE','%'.$search.'%')
            ->orWhere('related_to','LIKE','%'.$search.'%');
        })->get();
       return view('tasks.index',compact('tasks','search'));
    }

    
    public function create()
    {
        $accounts = Account::all();
        $contacts = Contact::all();
        $leads = Lead::all();
        return view('tasks.create',compact('leads','accounts','contacts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'task_owner' => 'required',
            'subject' => 'required',
            'due_date' => 'required|date',
            'group' => 'required',
            'person_of_group' => 'required',
            'status' => 'required',
            'priority' => 'required',
            'reminder' => 'nullable',
            'reminder_time' => 'required_with:reminder',
        ]);

        $task = Task::create([
            'task_owner' => $request->task_owner,
            'subject' => $request->subject,
            'due_date' => $request->due_date,
            'group' => $request->group,
            'person_of_group' => $request->person_of_group,
            'related_to' => $request->related_to,
            'status' => $request->status,
            'priority' => $request->priority,
            'description' => $request->description,
            'reminder' => $request->reminder ? 'true' : 'false',
            'reminder_time' => $request->reminder ? $request->reminder_time : NULL ,
            'creator_id' => Auth::user()->id,
        ]); 

        if($task){
            $message = "Task Has Been Created";
            Notification::send(Auth::user(), new taskNotification($task,$message));
            Toastr()->success("Task Has Been Created");
            return redirect()->route('task.index');
        }else{
            Toastr()->error("Error Occured While Creating Task :(");
            return redirect()->route('task.create');
        }
    }

  
    public function show(string $id)
    {
        $task = Task::find($id);
        return view('tasks.show',compact('task'));
    }

 
    public function edit(string $id)
    {
        $task = Task::find($id);
        $accounts = Account::all();
        $contacts = Contact::all();
        $leads = Lead::all();
        return view('tasks.edit',compact('task','contacts','leads','accounts'));
    }

  
    public function update(Request $request, string $id)
    {
      $request->validate([

        'task_owner' => 'required',
        'subject' => 'required',
        'due_date' => 'required|date',
        'group' => 'required',
        'person_of_group' => 'required',
        'status' => 'required',
        'priority' => 'required',
        'reminder' => 'nullable',
        'reminder_time' => 'required_with:reminder',
        
      ]);

      $task = Task::find($id);
      if($task){
       $updated =  $task->update([
            'task_owner' => $request->task_owner,
            'subject' => $request->subject,
            'due_date' => $request->due_date,
            'group' => $request->group,
            'person_of_group' => $request->person_of_group,
            'related_to' => $request->related_to,
            'status' => $request->status,
            'priority' => $request->priority,
            'description' => $request->description,
            'reminder' => $request->reminder ? 'true' : 'false',
            'reminder_time' => $request->reminder ? $request->reminder_time : NULL ,
            'creator_id' => Auth::user()->id,
        ]);

        if($updated){
            $message = "Task Has Been Updated";
            Notification::send(Auth::user(), new taskNotification($task,$message));
            Toastr()->success("Task Has Been Updated");
            return redirect()->route('task.index');
        }else{
            Toastr()->error("Error Occured While Updating Task :(");
            return redirect()->route('task.index');
        }
      }
    }


    public function taskCsv(){

        $tasks = Task::all();

        $filename = "Task_Report ". time() . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="'. $filename,'"'
        ];

        $generate = function() use ($tasks){
            $file = fopen("php://output",'w');

            fputcsv($file,[
                'Task Owner',
                'Subject',
                'Due Date',
                'Group',
                'Person of Group',
                'Related to',
                'Status',
                'Priority',
                'Description',
                'Reminder',
                'Reminder Status'
            ]);

            foreach($tasks as $task){
                fputcsv($file, [
                    $task->task_owner,
                    $task->subject,
                    $task->due_date,
                    $task->group,
                    $task->person_of_group,
                    $task->related_to,
                    $task->status,
                    $task->priority,
                    $task->description ?? 'No Description',
                    $task->reminder,
                    $task->reminder_status
                ]);
            }

            fclose($file);
        };

        return response()->stream($generate, 200, $headers);
    }
    
    public function okay($id){
        $task = Task::find($id);

        if($task){
           $update =  $task->update([
                'reminder_sent' => 'sent'
            ]);

            if($update){
                Toastr()->success("Thanks For Responding :)");
                return redirect()->route('task.index');
            }
        }
    }


    public function complete($id){
        $task = Task::find($id);

        if($task){
           $update =  $task->update([
               'status' => 'Completed',
               'reminder_sent' => 'task_ended'
           ]);

           if($update){
               Toastr()->success("Task Has Been Mark as Completed");
               return redirect()->route('task.index');
           }else{
            Toastr()->error("Error Occured While Completing Task :(");
               return redirect()->route('task.index');
           }
        }
    }


    public function remeaning($id){
        $task = Task::find($id);

        if($task){
           $update =  $task->update([
               'reminder_sent' => 'sent',
               'due_date' => Carbon::parse($task->due_date)->addMinutes(10),
           ]);

           if($update){
               Toastr()->success("Task Due Date Has Been Extended");
               return redirect()->route('task.index');
           } else{
            Toastr()->error("Error Occured While Sending Reminder :(");
               return redirect()->route('task.index');
           }
        }
    }
    public function destroy(string $id)
    {
        $task = Task::find($id);

        if($task){
            $task->delete();
            $message = "Task Has Been Deleted";
            Notification::send(Auth::user(), new taskNotification($task,$message));
            Toastr()->error("Task Has Been Deleted",[],'Deleted');
            return redirect()->route('task.index');
        }else{
            Toastr()->error("Task Not Found",[],'Failed');
            return redirect()->route('task.index');
        }
    }
}
