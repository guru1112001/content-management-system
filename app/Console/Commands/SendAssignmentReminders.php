<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\TeachingMaterial;
use App\Models\BatchTeachingMaterial;
use App\Models\BatchUser;
use App\Models\TeachingMaterialStatus;
use App\Models\User;
use Carbon\Carbon;
use App\Services\FirebaseService;
use Filament\Notifications\Notification;


class SendAssignmentReminders extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'assignments:send-reminders';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send reminders for upcoming assignment due dates';

    /**
     * Execute the console command.
     */
    protected $firebaseService;

    public function __construct(FirebaseService $firebaseService)
    {
        parent::__construct();
        $this->firebaseService = $firebaseService;
    }

    public function handle()
    {
        $this->sendReminders(7, 'week');
        $this->sendReminders(1, 'day');
    }

    private function sendReminders($daysBeforeDue, $reminderType)
    {
        $dueDate = Carbon::now()->addDays($daysBeforeDue)->toDateString();

        $assignments = TeachingMaterial::where('doc_type', 2)
            ->whereDate('start_submission', $dueDate)
            ->get();

        foreach ($assignments as $assignment) {
            $batchTeachingMaterials = BatchTeachingMaterial::where('teaching_material_id', $assignment->id)->get();

            foreach ($batchTeachingMaterials as $batchTeachingMaterial) {
                $students = BatchUser::where('batch_id', $batchTeachingMaterial->batch_id)->get();

                foreach ($students as $student) {
                    $hasSubmitted = TeachingMaterialStatus::where('teaching_material_id', $assignment->id)
                        ->where('user_id', $student->user_id)
                        ->where('batch_id', $batchTeachingMaterial->batch_id)
                        ->exists();

                    if (!$hasSubmitted) {
                        $user = User::find($student->user_id);
                        $this->sendPushNotification($user, $assignment, $reminderType);
                    }
                }
            }
        }

        $this->info("Sent {$reminderType} reminders for assignments due in {$daysBeforeDue} days.");
    }

    private function sendPushNotification($user, $assignment, $reminderType)
    {
        if ($user->device_token) {
            $title = "Assignment Due Reminder - {$reminderType} notice";
            $body = "Your assignment '{$assignment->title}' is due in one {$reminderType}. Due date: {$assignment->start_submission}";
               // Send Filament notification to database
        Notification::make()
        ->title($title)
        ->body($body)
        ->danger()
        ->sendToDatabase($user);
        
            $this->firebaseService->sendNotification($user->device_token, $title, $body);
        }
    }

}
