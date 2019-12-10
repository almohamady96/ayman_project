<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Response;

class NotificationsController extends Controller
{
    //
    public function readAdminNotification($NID)
    {
        $notification = Notification::find($NID);
        if ($notification->type == 'contact') {
            $notification->status = 'read';
            $notification->update();
            return redirect('AdminPanel/Contacts/' . $notification->linked_id . '/View');
        }
        if ($notification->type == 'Registration') {
            $notification->status = 'read';
            $notification->update();
            return redirect('AdminPanel/Registrations/' . $notification->linked_id . '/View');
        }
        if ($notification->type == 'PersonalTraining') {
            $notification->status = 'read';
            $notification->update();
            return redirect('AdminPanel/PersonalTrainings/' . $notification->linked_id . '/View');
        }
        if ($notification->type == 'CompaniesTraining') {
            $notification->status = 'read';
            $notification->update();
            return redirect('AdminPanel/CompaniesTrainings/' . $notification->linked_id . '/View');
        }
        if ($notification->type == 'RegisterTrainer') {
            $notification->status = 'read';
            $notification->update();
            return redirect('AdminPanel/RegisterTrainers/' . $notification->linked_id . '/View');
        }

    }

    public function readSupervisorNotification($NID)
    {
        $notification = Notification::find($NID);

    }


    public function getAllAdminNotifications()
    {
        $notifications = Notification::where('receiver_id', '=', Auth::user()->id)
            ->where('sendto', '=', 'admin')
            ->orderBy('id', 'desc')->get();
        return view('AdminPanel.AllAdminNotifications')->with([
            'PageTitle' => 'كل الإشعارات',
            'Active' => 'Notifications',
            'notifications' => $notifications,
        ]);
    }

    public function getAllSupervisorNotifications()
    {
        $notifications = Notification::where('receiver_id', '=', Auth::user()->id)
            ->where('sendto', '=', 'admin')
            ->orderBy('id', 'desc')->get();
        return view('SupervisorPanel.AllSupervisorNotifications')->with([
            'PageTitle' => 'كل الإشعارات',
            'Active' => 'Notifications',
            'notifications' => $notifications,
        ]);
    }


    public function DeleteNotification($NID)
    {
        $notification = Notification::find($NID);
        if ($notification->delete()) {
            return Response::json($NID);
        } else {
            return Response::json("false");
        }
    }

}
