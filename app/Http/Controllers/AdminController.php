<?php

namespace App\Http\Controllers;

use App\Models\Deal;
use App\Models\Lead;
use App\Models\Meeting;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index(){

        $deals = Deal::all();
        
        $allMonths  = [
           'January','February','March','April','May','June','July','August','September','October','November','December'
        ];

        $dealsByMonth = $deals->groupBy(function($deal){
            return Carbon::parse($deal->created_at)->format('F');
        })->map->count()->all();

        $chartDeal =[
            'labels' => $allMonths,
            'data' => []
        ];
        foreach($allMonths as $month){
            $chartDeal['data'][] = $dealsByMonth[$month] ?? 0;
        }

        // return $chartDeal;

        $Meetings = Meeting::all();
        $meetingsByMonth = $Meetings->groupBy(function($meeting){
            return Carbon::parse($meeting->created_at)->format('F');
        })->map->count()->all();

        $meetingMonths = collect($meetingsByMonth)->keys()->all();
       
       $chartMeeting = [
       'labels' => $meetingMonths,
       'data' => [],
       'count' => []

       ];

       foreach($meetingMonths as $month){
           $chartMeeting['data'][] = $meetingsByMonth[$month] ?? 0;
       }

        $meetingsCount = $Meetings->count(); 
        $chartMeeting['count'][] =  $meetingsCount;



        $tasks = Task::all();

        $tasksdata = $tasks->groupBy(function($task){
            return Carbon::parse($task->created_at)->format("F");
        })->map->count()->all();
        
        $taskMonths = collect($tasksdata)->keys()->all();

        $chartTask = [
            'labels' => $taskMonths,
            'data'  =>  [],
            'count' =>  []
        ];


       foreach($taskMonths as $task){
           $chartTask['data'][] = $tasksdata[$task] ?? 0;
       }

        $count = $tasks->count();
        $chartTask['count'][] = $count;



        // return $chartTask;





        $leads = Lead::all();


        $leadsMonths = $leads->groupBy(function($task){
            return Carbon::parse($task->created_at)->format("F");
        })->map->count()->all();


        $leadMonths = collect($leadsMonths)->keys()->all();


        $chartLead = [
            'labels' => $leadMonths,
            'data'=> [],
            'count'=> []
        ];



        foreach($leadMonths as $lead){
            $chartLead['data'][] = $leadsMonths[$lead] ?? 0;
        }

        $count = $leads->count();
        $chartLead['count'][] = $count;

        return view('dashboard',compact('chartDeal','chartMeeting','chartTask','chartLead'));

    }
}
